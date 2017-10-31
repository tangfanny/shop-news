<?php

class TongAction extends BaseAction {
 
    public function Index(){
        $sou = $_GET['condition'];
        $sou1 = $_GET['condition1'];
        $search = $_GET['search'];
        $sou = strtotime($sou);
        $sou1 = strtotime($sou1);
        switch ($search) {
        case '1':
            $condition=$sou;
            $condition1=$sou1;
            break;
        default:
            $condition ='';
            break;
        }
        if(!empty($sou)){       
        $where = ('t_ms_article.check_time >=' . $condition . ' AND '.'t_ms_article.check_time <= ' . $condition1);
        }
    	$user= M('ms_article');
    	$group = $user->Field("t_ms_article.tpv, FROM_UNIXTIME(t_ms_article.check_time,'%Y-%m-%d %H:%i:%s') AS createtime,t_ms_author.nikename,t_ms_article.title,t_ms_attr.name,t_ms_article.is_check") 
                    ->join('t_ms_attr on t_ms_article.attr = t_ms_attr.id')
                    ->join('t_ms_author on t_ms_author.uid = t_ms_article.uid')
                    ->where($where)
                    ->order('t_ms_article.check_time  DESC')
                    ->select();
   			$this->data=$group; 	
			$this->display();

    }



    
}
