<?php

class AdminGroupModel extends Model {

	//获取当前管理员的所有分组
    public function getAdminGroup(){
    	$group = $this->getGroupByRoles();
    	if ($group['parentid'] == 1) {
    		$map['parentid']  = array('neq',0);
    		return $this->Field('id,name,mods,create_time')->where($map)->select();
    	}else{
    		return $this->Field('id,name,mods,create_time')->where(array('parentid'=>$group['parentid']))->select();
    	}
    }
	
	//获取当前分组权限
	public function getGroupByRoles(){
		$group_role = $this->Field('parentid,mods')->where(array('id'=>session('group_role_id')))->find();
		$role = $this->Field('mods')->where(array('id'=>$group_role['parentid']))->find();
		$group_role['role'] = $role['mods'];
		return $group_role;

	}
	
	//管理员列表
    public function getGroupUser($con){
    	$parent = $this->getGroupByRoles();
    	$con = array();
    	if ($parent['parentid'] == 1) {
    		$parentall = $this->Field('parentid')->select();
    		$pidall = getCollectByArray($parentall,'parentid');
    		$pid = implode(',',$pidall);
    		$con['t_admin_group.parentid']  = array('in',$pid);
    	}else{
    		$con['t_admin_group.parentid'] = $parent['parentid'];
    	}
        return	M('admin_user')->Field('t_admin_user.user_id,t_admin_user.id,t_admin_user.name,t_admin_user.phone,t_admin_user.nikename,t_admin_user.create_time,t_admin_user.status,t_admin_group.name as group_name')
        			 ->join('t_admin_group on t_admin_group.id = t_admin_user.department')
        			 ->where($con)
        			 ->order('t_admin_group.position asc')
        			 ->select();
    }

    public function getGroupByAdmin(){
         $gid = $this->getGroupByRoles();
         if ($gid['parentid'] == 1) {
             $con['parentid']  = array('neq',0);
         }else{
            $con['parentid']  = array('neq',0);
            $con['parentid']  = array('in',$gid['parentid']);
         }
        $group = $this->Field('t_admin_group.id,t_admin_group.name as group_name,t_admin_user.name')
                    ->join('t_admin_user on t_admin_group.id = t_admin_user.department')
                    ->where($con)
                    ->order('t_admin_group.position asc')
                    ->select();
        $b = array();
        foreach($group as $v) {
              if(! isset($b[$v['id']])){
                    $b[$v['id']] = $v;
              }else{
               $b[$v['id']]["name"] .= ' 、' . $v["name"];
            }
        }
     return $b;
    }

    public function getGroupByAdmin2(){
        $list = $this->Field('id,parentid,name')
                     ->where(array('parentid'=>0))
                     ->order('position')
                     ->select();
        foreach ($list as $key => $value) {
                $list[$key]["son"]=$this->Field('id,parentid,name')->where(array('parentid'=>$value["id"]))->order('create_time')->select();
        }
        return $list;
    }

    //获取全部父分组
    public function getGroupFather(){
        return $this->Field('id,name')->where(array('parentid'=>0))->select();
    }
    //修改分组提交
    public function GroupFathEditSub($id,$name){
        return $this->where(array('id'=>$id))->setField('name',$name);
    }
    
    //添加分组
    public function AddAdminGroup($params){
        $res = 0;
        $params['create_time'] = time();
        if ($this->add($params)) {
            $res = 1;
        }
        return $res;
    }

    //分组管理
    public function getGroupInfo($gid){
        $group = $this->field('mods')->where(array('id'=>$gid))->find();
        $mods = explode(',', $group['mods']);
        $con['roles_id']  = array('in',$mods);
        return M('admin_menu2')->Field('name,roles_id')->where($con)->select();
    }

    //分配分组权限
    public function GroupAllotRoles($params){
        $res = 0;
        if (empty($params['roles_id']) || empty($params['roles'])) {
            return $res;
        }
        $roles_id = implode(',',$params['roles_id']);
        $rolesg = implode(',',$params['roles']);
        $con['id'] = $params['id'];
        $group = $this->field('parentid,mods')->where($con)->find();
        $groupfa = $this->field('id,mods')->where(array('id'=>$group['parentid']))->find();
        // $modes = trim(trim($groupfa['mods'],',').",".$rolesg,','); //父
        // $modes = array_unique(explode(',', $modes));     //去重
        // $modes = implode(',', $modes);                   //转化存入数据库
        $this->where(array('id'=>$groupfa['id']))->setField('mods',$rolesg);
        $data = array('mods'=>$roles_id,'name'=>$params['name']);
        if ($this->where($con)->setField($data)) {
           $res = 1;
        }
        return $res;

    }

}

// $con['id'] = $params['id'];
        // $group_mods = $this->Field('id,parentid,mods')->where($con)->find();
        // $group = $this->Field('id,mods')->where(array('id'=>$group_mods['parentid']))->find();
        // $Adminmenu2 = M('admin_menu2');
        // $meun_roles = $Adminmenu2->Field('parentid')->where(array('roles_id'=>$params['roles_id']))->find();
        // $meun = $Adminmenu2->Field('roles_id')->where(array('id'=>$meun_roles['parentid']))->find();
        // if ($params['is_role'] == 1) {
        //     $modes = trim(trim($group['mods'],',').",".$meun['roles_id'],',');
        //     $modes = array_unique(explode(',', $modes));
        //     $modes = implode(',', $modes);
        //     $mods = trim(trim($group_mods['mods'],',').",".$params['roles_id'],',');
        // }else{
        //     $moddds = explode(',',$group_mods['mods']);
        //     foreach ($moddds as $k=>$v){
        //         if($v==$params['roles_id']){
        //             unset($moddds[$k]);
        //         }
        //     }
        //     $modds = implode(',', $moddds);
        // }
        // // $this->where(array('id'=>$group['id']))->setField('mods',$modes);
        // // $this->where($con)->setField('mods',$mods);
        // $group_mods2 = $this->Field('id,mods')->where(array('id'=>$group['id']))->find();
        
        // return $modds;