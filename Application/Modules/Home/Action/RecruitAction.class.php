<?php

class RecruitAction extends BaseAction {
	//查询数据
    public function Index(){
    	$sou = $_GET['condition'];
    	$search = $_GET['search'];
    	$str = '%'.$sou.'%';
		switch ($search) {
		case '0':
			$condition['t_recruitment.job_city']=array('like',$str);
			break;
		case '1':
			$condition['t_recruitment.job_postion']=array('like',$str);
			break;
		// case '2':	
		// 	$condition['t_recruitment.job_address']=array('like',$str);
		// 	break;
		default:
			$condition = array();
			break;
		}		
    	$recruit = M('recruitment');
    	import('ORG.Util.Page');
		$count = $recruit->where($condition)->count();
		$Page = new Page($count,10);
		$now = "<b class='now'>当前:<b>%nowPage%</b>/%totalPage%页</b>------";
		$total = "<b class='total'>共:<b>%totalRow%</b>%header%</b>";
		$page = "%upPage% %first% %prePage% %linkPage% %nextPage% %end% %downPage%";
		$str = $now." ".$total." ".$page;
		$Page->setConfig('theme',$str);
		$show = $Page->show();
		$limit = $Page->firstRow.','.$Page->listRows;
    	$result = $recruit->where($condition)->order('idx desc')->limit($limit)->select();
    	$this->result = $result;
    	$this->pages=$show;
    	$this->display();
    }

    //删除数据
    public function Delete(){
    	$idx = I('idx');
		$where['idx'] = $idx;
		$user= M('recruitment');
		$info = $user->where($where)->delete();
		if($info == 1){
		  echo 1;
		 } else {
		  echo 0;
		 }
    }
    //编辑数据
    public function Edit(){
    	$idx = I('idx');
    	$where['idx'] = $idx;
    	$user = M('recruitment');
    	$info = $user->where($where)->select();
	    $this->info=$info;
    	$this->display();
    }
    //修改数据
    public function update(){
    	if(!empty($_POST['logo'])){
    		$_POST['pic'] = $_POST['logo'];
    	}
    	if(empty($_POST['job_num'])){
    		$_POST['job_num'] = '不限';
    	}
    	if(empty($_POST['job_jingyan'])){
    		$_POST['job_jingyan'] = '不限';
    	}
    	$id = $_POST['idx'];
		$where['idx'] = $id;
		$user = M('recruitment');
		$info = $user->where($where)->save($_POST);
		if($info){
		    $this->success('修改成功', U('Home/Recruit/index'),3);
		 } else {
		    $this->error('修改失败',U('Home/Recruit/index'),3);
		 }
    }
    //答案
    public function Activity(){
		$recruit = M('user_answer');
	    $result = $recruit->select();
	    $this->result = $result;
	    $this->display();
	  }

}
