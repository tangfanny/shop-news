<?php
	
    /**
     * 打印函数
     * @param array $array 打印的数组
     */
    function P($array){
        echo "<pre>";
        print_r($array);
    }

    //随机数
    function getrandoms(){

        $rand=rand(100000,999999);
        $day=date('md');
        $time=strrev(date('his'));

        $sn = rand(0, 2);
        $ysn = rand(1,20);
        
        if ($sn == 0) {
            $years=substr((strrev(date('y')) + $ysn),0, 2);
            $random=$rand.$years.$time.$day;
        } else if ($sn == 1) {
            $years=substr((strrev(date('y')) + $ysn),0, 2);
            $random=$years.$day.$time.$rand;
        } else {
            $years=substr((strrev(date('y')) + $ysn),0, 2);
            $random=$rand.$years.$day.$time;
        }
        return $random;
    }

    /**
     * 获取 ip 地址
     * @author ruxing.li
     * @return string
     */

    function getIp(){
        $realip = '';
        $unknown = 'unknown';
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && ! empty($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)) {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                foreach ($arr as $ip) {
                    $ip = trim($ip);
                    if ($ip != 'unknown') {
                        $realip = $ip;
                        break;
                    }
                }
            } else 
                if (isset($_SERVER['HTTP_CLIENT_IP']) && ! empty($_SERVER['HTTP_CLIENT_IP']) && strcasecmp($_SERVER['HTTP_CLIENT_IP'], $unknown)) {
                    $realip = $_SERVER['HTTP_CLIENT_IP'];
                } else 
                    if (isset($_SERVER['REMOTE_ADDR']) && ! empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) {
                        $realip = $_SERVER['REMOTE_ADDR'];
                    } else {
                        $realip = $unknown;
                    }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), $unknown)) {
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            } else 
                if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), $unknown)) {
                    $realip = getenv("HTTP_CLIENT_IP");
                } else 
                    if (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), $unknown)) {
                        $realip = getenv("REMOTE_ADDR");
                    } else {
                        $realip = $unknown;
                    }
        }
        $realip = preg_match('/[\d\.]{7,15}/', $realip, $matches) ? $matches[0] : $unknown;
        return $realip;
    }


     /**
     * 获取URL
     */   
    function getREURL(){
    	 $URL="http://".$_SERVER['SERVER_NAME'].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; 
    	 return $URL;
    }


    /**************************************************************
     *
    *    将数组转换为JSON字符串（兼容中文）
    *    @param  array   $array      要转换的数组
    *    @return string      转换得到的json字符串
    *    @access public
    *
    *************************************************************/
    function JSON($array) {
    	arrayRecursive($array, 'urlencode', true);
    	$json = json_encode($array);
    	return urldecode($json);
    }

    /**
     * 获取二维数组中值的集合
     *
     * @author ruxing.li <liruxing@91kuaishou.com>
     * @param array $array            
     * @param string $key            
     * @param string $value            
     */
    function getCollectByArray($array, $value = '', $key = false, $condition = false){
        if (! $key && empty($value))
            return array();
        $arr = array();
        $arr = array_reduce($array, create_function('$v,$w', ($condition ? 'if (' . $condition . ')' : '') . '$v[' . ($key ? '$w["' . $key . '"]' : '') . ']=$w["' . $value . '"];return $v;'));
        return $arr;
    }

    /**
     * 验证是否为数组并且不为空
     *
     * @author ruxing.li <liruxing@91kuaishou.com>
     * @param mul $var            
     * @return boolean
     */
    function validateArray($var){
        return (is_array($var) && ! empty($var) ? true : false);
    }

    /**
     * 获取二维数组，二维数组根据某个数字索引排序，模仿MySQL ORDER BY
     *
     * @author ruxing.li <liruxing@91kuaishou.com>
     * @param array $array            
     * @param string $field
     *            索引的类型必须是整型
     * @param string $sort            
     * @return array
     */
    function getSortArrayByIndex($array, $field, $sort = 'asc'){

        if (! self::validateArray($array) || ! is_string($field) || empty($field) || ! in_array($sort, array(
            'asc',
            'desc'
        ))) {
            return array();
        }
        $sort = strtolower($sort);
        $sort = array(
            'direction' => (strcasecmp($sort, 'asc') === 0 ? 'SORT_ASC' : 'SORT_DESC'),
            'field' => $field
        ); // 排序字段
        
        $arrSort = array();
        foreach ($array as $uniqid => $row) {
            foreach ($row as $key => $value) {
                $arrSort[$key][$uniqid] = $value;
            }
        }
        if ($sort['direction']) {
            array_multisort($arrSort[$sort['field']], constant($sort['direction']), $array);
        }
        return $array;
    }


    //发送短信
    function sendMsgByMobile($mobile,$type=1){

        $redis = new Redis();
        $redis->connect(C('redis_config.host'), C('redis_config.port'));
        $redis->auth(C('redis_config.password'));

        $rd = $redis->get($mobile."_verify_code");
        if(!empty($rd)){
            return -1;
        }
        $msg = verifyCode();
        $redis->set($mobile."_verify_code",$msg,60);

        $post_data = array();
        $post_data['account'] = iconv('GB2312', 'GB2312',"vip_wkzc");
        $post_data['pswd'] = iconv('GB2312', 'GB2312',"Tch123456");
        $post_data['mobile'] =$mobile;

        if($type==1){
             $message="动态验证码：".$msg."，请勿向任何人泄露。";
        }

        $post_data['msg']=mb_convert_encoding($message,'UTF-8', 'UTF-8');
        $url="http://222.73.117.158/msg/HttpBatchSendSM?"; //群发
        $o="";
        foreach ($post_data as $k=>$v)
        {
            $o.= "$k=".urlencode($v)."&";
        }
        $post_data=substr($o,0,-1);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $result = curl_exec($ch);
        return 111;
    }


    function verifyCode(){

        $key = '';
        $pattern = '1234567890';
        for ($i = 0; $i < 6; $i++) {
            $key .= $pattern{mt_rand(0, 9)};
        }
        return $key;
    }

    /**
     * 验证url是否能被访问
     * @param  [type] $url [description]
     * @return [type]      [description]
     */
    function varify_url($url){
        if(preg_match('/(http|ftp|https):\/\//',$url,$se)==0){
            $url='http://'.$url;
        }else{
            $url=$se[0].$url;
        }
        $check = @fopen($url,"r");

            if($check){
                $status['st'] = true;
                $status['url'] = $url;
            }
            else{
                $status['st'] = false;
            }
            
            return $status;
    }    

?>