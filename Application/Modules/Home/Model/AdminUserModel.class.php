<?php

class AdminUserModel extends Model {

	public function AddAdminUser($params){
		$where['id'] = $params['id'];
		$result = $this->field('id')->where($where)->find();
		$res = 0;
		if (!$result) {
			$params['create_time'] = time();
			$params['pass'] = md5($params['pass']);
			if ($this->add($params)) {
				$res = 1;
			}else{
				$res = 2;
			}
		}
		return $res;
	}

    //锁定管理员
    public function AdminUserLock($params){
        return $this->where(array('user_id'=>$params['user_id']))->setField('status',$params['status']);
	}
	
	//编辑管理员
	public function AdminUserEdit($uid){
		return $this->Field('t_admin_user.user_id,t_admin_user.id,t_admin_user.name,t_admin_user.nikename,t_admin_user.phone,t_admin_user.department')
        			->where(array('t_admin_user.user_id'=>$uid))
        			->find();
		
	}

	//编辑管理员提交
	public function AdminEditSub($params){
		$res = 0;
		if ($this->where(array('user_id'=>$params['uid']))->save($params)) {
            $res = 1;
        }
        return $res; 
	}

}