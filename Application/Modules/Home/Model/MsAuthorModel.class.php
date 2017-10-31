<?php

class MsAuthorModel extends Model {

	//添加作者
    public function AddAuthor($uid,$name){
    	$condition['uid'] = $uid;
    	$author = $this->Field('id,nikename')->where($condition)->find();
    	if ($author) {
    		if ($author['nikename'] != $name) {
    			$this->where($condition)->setField('nikename',$name);
    		}
    		$this->where($condition)->setInc('mcount',1);
    	}else{
    		$data['uid'] = $uid;
    		$data['nikename'] = $name;
    		$data['create_time'] = time();
    		$data['a_id'] = 1;
    		$data['mcount'] = 1;
    		$this->add($data);
    	}
        return $uid;
    }

	

}