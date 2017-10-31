<?php
class LoginAction extends Action {
	
	public function index(){
        if (C('SentVerifyCode.sent')==1) {
            $this->display();
        }else{
            $this->display('index2');
        }
	}

    public function Dologin(){

        if (!IS_POST){
            header("HTTP/1.0 404 Not Found");//使HTTP返回404状态码
            $this->display('Mess/404');
            exit();
        }

        $username = I('username');
        if(!preg_match("/^[A-Za-z]+$/",$username)){
            echo 1;
            exit();
        }
       $key = 0 ;
       $redis = new Redis();
       $redis->connect(C('redis_config.host'), C('redis_config.port'));
       $redis->auth(C('redis_config.password'));
       $key = $redis->get($username."_admin_username");
       if ( $key > 10 ) {
           echo 3;
           exit();
       }
        
        $pwd = I('password','','md5');
        $Admin_user = M('admin_user');
        $user = $Admin_user->Field("user_id,phone,status,pass,last_login_time,nikename,name,last_login_ip,department")->where(array('id' => $username))->find();
        $id = $user['user_id'];
        
        if (!$id) {
            echo 1;
            exit();
        }
        if($user['pass'] != $pwd){
            $redis->set($username."_admin_username",$key+1,3600*2);
            echo 2;
            exit();
        }
        if (C('SentVerifyCode.sent')==1) {
            $mobile = $user['phone'];
            $code = $redis->get($mobile."_verify_code");
            $code2 = I('code');
            if ($code != $code2 || empty($code2)) {
                echo 5;
                exit();
            }
        }else{
            if ($_SESSION['verify'] != md5($_POST['verify'])) {
                echo 4;
                exit();
            }
        }
        
        if ($user['status'] == 0) {
            echo 0;
            exit();
        }

        $data = array(
        	'user_id' => $id,
            'last_login_time' => time(),
        );
        $Admin_user->save($data);
        $user['last_login_time'] = isset($user['last_login_time'])?$user['last_login_time']:time();
        session_start();
        session('nikename',$user['nikename']);
        session('username',$user['name']);
        session('group_role_id',$user['department']);
        session('sessionId',$id);
        session('logintime',date('Y-m-d H:i:s',$user['last_login_time']));
        session(array('name'=>'sessionId','expire'=>86400*24));
        // $this->redirect('/Index');
        echo 10;
    }

    //退出
    public function logout(){
        session_unset();
        session_destroy();
        $this->redirect('/Login');
    }

    //验证码
    public function verify(){
        import('ORG.Util.Image');
        Image::buildImageVerify(5, 1, 'png', 100, 39);
    }

    //短信验证码
    public function SendCode(){
        $username = I('username');
        $pwd = I('password','','md5');
        if(!preg_match("/^[A-Za-z]+$/",$username)){
            echo 1;exit();
        }
        $Admin_user = M('admin_user');
        $user = $Admin_user->Field("phone,pass")->where(array('id'=>$username))->find();
        if ($user['pass'] != $pwd) {
            echo 2;exit();
        }
        if (empty($user['phone'])) {
            echo 3;exit();
        }else{
            $data = sendMsgByMobile($user['phone'],$type=1);
        }
    }

}
