<?php

class AdminMenu2Model extends Model {

	//获取全部菜单(权限)
	public function MenuListByMenuid(){
       	$mods = D('AdminGroup')->getGroupByRoles();
       	$con['roles_id']  = array('in',$mods['role']);
		$con['is_show'] = 1;
		$con['parentid'] = 0;
	    $list = $this->Field('id,parentid,name,roles_id')
	    			 ->where($con)
	    			 ->order('position')
	    			 ->select();

	    $where['roles_id']  = array('in',$mods['mods']);
	    foreach ($list as $key => $value) {
	    		$where['parentid'] = $value["id"];
	    		$where['is_show'] = 1;
	    		$list[$key]["parenidlist"] = $this->Field('id,parentid,name,roles_id,action')->where($where)->select();
	    }
	    return $list;
	}
	//获取全部菜单
	public function MenuListAll(){
		$con['is_show'] = 1;
		$con['parentid'] = 0;
	    $list = $this->Field('id,parentid,name,roles_id')
	    			 ->where($con)
	    			 ->order('position')
	    			 ->select();
	    foreach ($list as $key => $value) {
	    		$where['parentid'] = $value["id"];
	    		$list[$key]["parenidlist"] = $this->Field('id,parentid,name,roles_id')->where($where)->select();
	    }
	    return $list;
	}


}