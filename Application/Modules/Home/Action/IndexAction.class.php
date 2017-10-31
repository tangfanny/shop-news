<?php
class IndexAction extends BaseAction {

	public function index(){
		$main_menu = D("AdminMenu2")->MenuListByMenuid();
        $info['admin_name'] = session('username');
        $this->assign("menu_list",$main_menu);
        $this->assign("info",$info);
        $this->display();
	}

	public function welcome(){
        $info['admin_name'] = session('username');
        $info['logintime'] = session('logintime');
        $this->assign("info",$info);
        $this->display('welcome');
	}

	public function Adver(){
		$menuid 		=I("menuid");
        $this->display();
	}

	public function Footer(){
		$about = D("Finfo")->getFinfo(1);
		$logo = D("Finfo")->getFinfo(4);
		$beian = D("Finfo")->getFinfo(6);
    	$this->assign("about",$about);
    	$this->assign("logo",$logo['0']);
    	$this->assign("beian",$beian['0']);
		$this->display();
	}
	public function Footeradd(){
		$this->display('addabout');
	}
	public function Footerphoto(){
		$id = I('id');
		if (!empty($id)) {
			$logo = D("Finfo")->getFinfoData($id);
			$this->assign("logo",$logo);
		}
		$this->display('photo');
	}
	public function Footeredit(){
		$data = D("Finfo")->getFinfoData(I('id'));
		$this->assign("data",$data);
		$this->display('aboutedit');
	}

	public function Footerd(){
		$params = array_map('trim', $_REQUEST);
		D('Finfo')->FinfoHandle($params);
		$this->redirect('Footer');
	}

	public function FootSubPto(){
		$params = array_map('trim', $_REQUEST);
		$params['key'] = 1;
		if (empty($params['id'])) {
			$params['key'] = 0;
		}
		D('Finfo')->FinfoHandle($params);
		echo '<script type="text/javascript" src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';
	}

	public function Footerajax(){
		echo D('Finfo')->FinfoHandle($_POST);
	}

	public function FooterBeian(){
		$params = array_map('trim', $_REQUEST);
		echo M('Finfo')->where(array('id'=>$params['id']))->setField('name',$params['name']);
	}

	public function Link(){
		$link = D("Finfo")->getFinfo(2);
    	$this->assign("link",$link);
		$this->display();
	}

	public function LinkAdd(){
		$params = array_map('trim', $_REQUEST);
		$res = D('Finfo')->FinfoHandle($params);
		$this->redirect('Link');
	}
	public function LinkDel(){
		$params = array_map('trim', $_REQUEST);
		$res = D('Finfo')->FinfoHandle($params);
		$this->redirect('Link');
	}
	public function LinkEdit(){
		$data = D("Finfo")->getFinfoData(I('id'));
		$this->assign("data",$data);
		$this->display('linkedit');
	}
	public function LinkEditSub(){
		$params = array_map('trim', $_REQUEST);
		D('Finfo')->FinfoHandle($params);
		echo '<script type="text/javascript" src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';
	}
	public function Contact(){
		$lianxi = D("Finfo")->getFinfo(5);
    	$this->assign("lianxi",$lianxi);
		$this->display();
	}

	public function ContactAdd(){
		$params = array_map('trim', $_REQUEST);
		$res = D('Finfo')->FinfoHandle($params);
		$this->redirect('contact');
	}
	public function ContactEdit(){
		$data = D("Finfo")->getFinfoData(I('id'));
		$this->assign("data",$data);
		$this->display('contactedit');
	}
	public function Cooperation(){
		$cooper = D("Finfo")->getFinfo(3);
    	$this->assign("cooper",$cooper);
		$this->display();
	}
	public function CooperAdd(){
		$data = D("Finfo")->getFinfoData(I('id'));
		$this->assign("data",$data);
		$this->display('cooperadd');
	}
	public function CooperDel(){
		$params = array_map('trim', $_REQUEST);
		$res = D('Finfo')->FinfoHandle($params);
		$this->redirect('cooperation');
	}
	public function CooperEdit(){
		$data = D("Finfo")->getFinfoData(I('id'));
		$this->assign("data",$data);
		$this->display('cooperedit');
	}
	public function CooperSubPto(){
		$params = array_map('trim', $_REQUEST);
		$params['key'] = 1;
		if (empty($params['id'])) {
			$params['key'] = 0;
		}
		D('Finfo')->FinfoHandle($params);
		echo '<script type="text/javascript" src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';
	}

}
