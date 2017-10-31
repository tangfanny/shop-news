<?php

/**
 * Common Model 方法共用模块
 * @author Dong Hui
 * @date 2015-11-01
 */

class CommonModel extends Model{

    //排序
    public function arraySortByKey(array $array, $key) {
        $asc=true;
        $result=array();
        // 整理出准备排序的数组
        foreach($array as $k=>&$v) {
            $values[$k]=isset($v[$key]) ? $v[$key] : '';
        }
        unset($v);
        // 对需要排序键值进行排序
        $asc ? asort($values) : arsort($values);
        // 重新排列原有数组
        $i=0;
        foreach($values as $k=>$v) {
            $i++;
            $result[$array[$k]['id']]=$array[$k];
        }

        return $result;
    }

    public static function getrandoms(){

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
     *
     * @author ruxing.li <liruxing@91kuaishou.com>
     * @return string
     */
    public static function getIp()
    {
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


}
