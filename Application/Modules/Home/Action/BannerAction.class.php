<?php

class BannerAction extends BaseAction {
    public function Index(){
    	$recruit = M('m_homebanner');
    	$result = $recruit->order('rankid asc')->select();
    	$this->result = $result;
    	// var_dump($result);
    	$this->display();
    }
     public function Footer(){
    	$this->display();
    }
    public function Add(){
    	$I = I();
    	$banlun  = M("m_homebanner");
        $arr = array();
        $arr['title'] = $I['title'];
        $arr['url'] = $I['url'];
        $pattern = "/(http|ftp|https):\/\/([\w.]+\/?)\S*/";
        $url = $arr['url'];
        if(empty($url)){
            $this->success('修改失败!!链接不能为空', U('Home/Banner/index'),6);
            exit;
        }
        preg_match($pattern, $url, $matches);
        if(empty($matches)){
            $this->success('修改失败!!链接格式不正确,请参考http://news.secwk.com', U('Home/Banner/index'),6);
            exit;
        }   
        $arr['rankid'] = $I['rankid'];
        $arr['desc'] = $I['desc'];
        $arr['path'] = $I['path'];
        $arr['path_a'] = $I['path_a'];
        $result = $banlun->add($arr);
        if($result){
		    $this->success('添加成功', U('Home/Banner/index'));
		 } else {
		    $this->error('添加失败',U('Home/Banner/index'));
		 }    	
    }
    public function CateShowAjax(){
    	$params = array_map('trim', $_REQUEST);
    	if (empty($params['cid']) || empty($params['is_show'])) {
            echo 0;
        }
        $cate = M("m_homebanner");
        $id = $params['id'];
        $is_show = $params['is_show'];
        $res = $cate->where("id=%d",$id)->setField('is_show',$is_show);
        if ($res) {
            echo 1;
        }else{
            echo 0;
        } 
    }
    public function Delete(){
    	$id = I('id');
		$where['id'] = $id;
		$user= M('m_homebanner');
		$info = $user->where($where)->delete();
		if($info == 1){
		  echo 1;
		 } else {
		  echo 0;
		 }
    }
    public function Edit(){
    	$id = I('id');
    	$where['id'] = $id;
    	$user = M('m_homebanner');
    	$info = $user->where($where)->select();
	    $this->info=$info;
	    // var_dump($info);
    	$this->display();
    }
    /**
     * banner编辑处理逻辑
     * @return [type] [description]
     */
     public function update(){
    	if(!empty($_POST['logo'])){
    		$_POST['path'] = $_POST['logo'];
    	}

        //$pattern = "/http:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is";
        $url = trim($_POST['url']);

        // preg_match($pattern, $url, $matches);
        if(varify_url($url) === false){
            $this->success('修改失败!!链接无法访问', U('Home/Banner/index'),6);
            exit;
        }   
    	$id = $_POST['id'];
		$where['id'] = $id;
        //dump($_POST);die('aa');
		$user = M('m_homebanner');
		$info = $user->where($where)->save($_POST);
		if($info){
		    $this->success('修改成功', U('Home/Banner/index'),3);
		 } else {
		    $this->error('修改失败',U('Home/Banner/index'),3);
		 }
    }


}
