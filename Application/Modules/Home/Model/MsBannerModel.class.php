<?php

class MsBannerModel extends Model {

	//banner列表
	public function GetBannerList($bid,$site,$num){
		
		$condition['bid'] = $bid;
    	$condition['site']= $site;
    	$condition['is_del'] = 0;
    	$count = $this->where($condition)->count();
    	import("ORG.Util.Page");
	    $page = new Page($count,$num);
	    $showPage = $page->show();
	    $list= $this->order('rankid asc')
	    		    ->Field("id,rankid,bid,path,url,title,desc,is_show,is_del")
	    			->limit("$page->firstRow, $page->listRows")
	    			->where($condition)
	    			->select();
	    $MaxSort = $this->where($condition)->max('rankid');
	    $data=array();
	    $data["showPage"]=$showPage;
	    $data["maxsort"] =$MaxSort;
	    $data["list"]	 =$list;
	    $data["count"]	 =$count;
	    return $data;
	}
	
	//添加广告
    public function SaveAdver($params){
        $params['path'] = $params['logo'];
        $params['create_time'] = time();
        $res = 0;
        if ($this->add($params)) {
            $res = 1;
        }
        return $res;
    }










} 