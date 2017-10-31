<?php

class AdminAction extends BaseAction {

    public function Index(){
        $group=D("AdminGroup")->getAdminGroup();
        $user=D("AdminGroup")->getGroupUser();
    	$this->assign("user",$user);
    	$this->assign("group",$group);
    	$this->display('admin-list');
    }

	public function AdminUserAdd(){
    	$params = array_map('trim', $_REQUEST);
		echo D("AdminUser")->AddAdminUser($params);
    }

    //用户锁定
    public function AdminUserLock(){
        $params = array_map('trim', $_REQUEST);
        echo D("AdminUser")->AdminUserLock($params);
    }
 
    public function AdminUserEdit(){
        $admin=D("AdminUser")->AdminUserEdit(I('uid'));
        $group=D("AdminGroup")->getAdminGroup();
        $this->assign("admin",$admin);
        $this->assign("group",$group);
        $this->display('admin-edit');
    }

    //编辑管理员提交
    public function AdminEditSub(){
        $params = array_map('trim', $_REQUEST);
        if (empty($params['phone'])) {
            echo '<script>alert("修改失败！手机号码不能为空。");src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';
            exit;
        }
        if (empty($params['nikename'])) {
            echo '<script>alert("修改失败！昵称不能为空。");src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';
            exit;
        }
        $params['pass'] = md5($params['pass']);
        if (empty($params['pass'])) {
            unset($params['pass']);
        }
        $result = D("AdminUser")->AdminEditSub($params);
        if ($result == 1) {
            echo '<script type="text/javascript" src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';
        }else{
            echo '<script>alert("修改失败！请联系管理员。");src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';
        }
    }

    //分组管理
    public function AdminGroup(){
        $group=D("AdminGroup")->getGroupByAdmin2();
        $groupf=D("AdminGroup")->getGroupFather();
        $this->assign("group",$group);
        $this->assign("groupf",$groupf);
        // $this->display('admin-group');
        $this->display('group-class');

    }

    //分组管理
    public function AdminGroup2(){
        $group=D("AdminGroup")->getGroupByAdmin();
        $this->assign("group",$group);
        $this->display('admin-group');
    }

    //父分组编辑
    public function GroupFatherEdit(){
        $this->assign("id",I('id'));
        $this->assign("name",I('name'));
        $this->display('group-class-edit');
    }

    //父分组编辑提交
    public function GroupFaEditSub(){
        D("AdminGroup")->GroupFathEditSub(I('id'),I('name'));
        echo '<script type="text/javascript" src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';
        
    }

    //添加分组
    public function AdminGroupAdd(){
        echo D("AdminGroup")->AddAdminGroup($_POST);
    }

    //权限管理
    public function AdminGroupRole(){
        $group =D("AdminGroup")->getGroupInfo(I('gid'));
        $Menu  =D("AdminMenu2")->MenuListAll();

        foreach ($Menu as $key => $value) {
            $Menu[$key]['fal'] = 0;
            foreach ($Menu[$key]["parenidlist"] as $k => $v) {
                    $Menu[$key]["parenidlist"][$k]['flag'] = 0;
                foreach ($group as $key1 => $value1) {
                    if($group[$key1]["roles_id"]==$Menu[$key]["parenidlist"][$k]["roles_id"]){
                        $Menu[$key]["parenidlist"][$k]['flag'] = 1;
                        $Menu[$key]['fal'] = 1;
                    }
                }
            }
        }
        $this->assign("menu",$Menu);
        $this->assign("name",I('name'));
        $this->assign("id",I('gid'));
        $this->display('admin-group-role');
    }

    //分组权限提交
    public function GroupRoleSub(){
        $params = $_POST;
        $group =D("AdminGroup")->GroupAllotRoles($params);
        echo '<script type="text/javascript" src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';
    }

}
