<?php

class FinfoModel extends Model {

	//查询全部
    public function getFinfo($cid){
        $con['cid'] = $cid;
    	$con['is_del'] = 0;
    	return $this->Field('*')->where($con)->order('sort')->select();
    }
    //查询单条
    public function getFinfoData($id){
        $con['id'] = $id;
    	$con['is_del'] = 0;
    	return $this->Field('*')->where($con)->find();
    }

	public function FinfoHandle($params){
		$res = 0;
		$key = $params['key'];
		unset($params['key']);
		switch ($key) {
			case '0':
				return $this->add($params);
				break;
			case '1':
				return $this->where(array('id'=>$params['id']))->save($params);
				break;
			case '2':
				return $this->where(array('id'=>$params['id']))->setField('is_del',1);
				break;
			case '3':
				if ($this->where(array('id'=>$params['id']))->setField('sort',$params['sort'])) {
					$res = 3;
				}
				break;
			case '4':
				if ($this->where(array('id'=>$params['id']))->setField('is_show',$params['is_show'])) {
					$res = 4;
				}
				break;
			default:
				$res = 0;
				break;
		}
		return $res;
	}

}