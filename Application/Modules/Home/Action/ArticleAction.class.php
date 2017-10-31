<?php

/**
 * @copyright Article 栏目管理
 * @author donghui
 * @version 2015年11月9日
 */

class ArticleAction extends BaseAction {


	public function Adver(){
		$temp=M("ms_template")->Field("id")->where("is_use=1")->find();
		$bid = $temp['id'];
		$this->assign("bid",$bid);
        $this->display('Article/Adver/adver');
	
	}

	public function AdverList(){
		$bid 	= I("bid");
		$site  	= I("site");
		$BannerList  = D("MsBanner")->GetBannerList($bid,$site,$num=6);

		$this->assign("site",$site);
		$this->assign("bid",$bid);
		$this->assign("count",$BannerList['count']);
		$this->assign("page",$BannerList['showPage']);
		$this->assign("maxsort",$BannerList['maxsort']);
		$this->assign("banli",$BannerList['list']);
        $this->display('Article/Adver/adver_list');
	}

	public function AdverAdd(){
		$bid 	= I("bid");
		$site  	= I("site");
		$size = D("ImgSize")->TemplateImgSize($site);
		$maxsortv  	= I("maxsort");
		$maxsort = $maxsortv + 1;
		$this->assign("site",$site);
		$this->assign("bid",$bid);
		$this->assign("size",$size);
		$this->assign("maxsort",$maxsort);
        $this->display('/Article/Adver/adver_add');
	
	}

	//添加广告
	public function AdverCommit(){
		$params = array_map('trim', $_REQUEST);
		$result = D("MsBanner")->SaveAdver($params);
		if ($result == 1) {
			echo  '<script type="text/javascript" src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';
		}else{
			echo '<script>alert("添加失败！请联系管理员。");src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';exit();
		}
		
	}

	//广告是否显示ajax
	public function AdverEditAjax(){
		$params = array_map('trim', $_REQUEST);	
		$result=D("Article")->ChangeAvderShow($params);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//编辑广告
	public function AdverEdit(){
		$id = I('id');
		$Adver=D("Article")->getAdverOnlyData($id);
		$site = $Adver['site'];
		$size=D("ImgSize")->TemplateImgSize($site);
		$width = $size['width'];
		$height = $size['height'];
		$this->assign("adver",$Adver);
		$this->assign("width",$width);
		$this->assign("height",$height);
        $this->display('/Article/Adver/adver_edit');
	}

	//编辑广告提交
	public function AdverEditCommit(){
		$params = array_map('trim', $_REQUEST);
		$result=D("Article")->AdverEdit($params);	
		if ($result == 1) {
			echo '<script type="text/javascript" src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';exit();
		}else{
			echo '<script>alert("编辑失败！请联系管理员。");src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';exit();
		}

	}

	//删除单条广告ajax
	public function AdverDelAjax(){
		$params = array_map('trim', $_REQUEST);		
		$result=D("Article")->DelAdverData($params);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//栏目管理
	public function ColumnMenu(){
		$id = I('id');
		switch ($id) {
			case '1':
				$this->CateMenu(1);
				break;
			case '2':
				$this->LabelMenu(2);
				break;
			case '3':
				$this->natureMenu(3);
				break;
			case '4':
				$this->CetabMenu(4);
				break;
			default:
				$this->CateMenu(1);
				break;
		}
		
	}

	//分类管理
	public function CateMenu($id){
		$list = D("Article")->getTagByCate();
		$count = count($list);
		$this->assign("list",$list);
		$this->assign("id",$id);
		$this->assign("count",$count);
		$this->display('/Article/category');
	}

	//分类是否显示ajax
	public function CateShowAjax(){
		$params = array_map('trim', $_REQUEST);
		if (empty($params['cid']) || empty($params['is_show'])) {
            echo 0;
        }
		$result=D("Article")->ChangeCateShow($params);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//增加分类
	public function CateAddSub(){
		$params = array_map('trim', $_REQUEST);
        $cate = array();
        $cate['cate_name'] = $params['cate_name'];
		$MaxSort = M("ms_cate")->where("is_del=0")->max('sort');
		$cate['sort'] = $MaxSort+1;
		$result=D("Article")->addCate($cate);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//为分类修改标签
	public function TagAddForCate(){
		$cid = I('cid');
		$Tag = D("Article")->getTagAll();
		$tagname = D("Article")->getTagByCateID2($cid);//根据分类ID获取对应标签
		foreach ($Tag as $key => $value) {
			$Tag[$key]["flag"]=0;
			foreach ($tagname as $key1 => $value1) {
				if($tagname[$key1]["tid"]==$Tag[$key]["tid"]){
					$Tag[$key]["flag"]=1;
				}
			}
		}
		$this->assign("tag",$Tag);
		$this->assign("cid",$cid);
		$this->display('/Article/cate_tag_add');
	}

	//为分类修改标签提交
	public function TagAddForCateSub(){
		$result=D("Article")->AddTagForCate($_POST);
		echo '<script type="text/javascript" src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';exit();
	}

	//删除单条分类ajax
	public function CateDelAjax(){
		$cid = I('cid');
		if (empty($cid)) {
            echo 0;exit();
        }
		$result=D("Article")->DelCateData($cid);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//分类排序
	public function CateOrderBySort(){
		$params = array_map('trim', $_REQUEST);
		if (empty($params['cid']) || empty($params['sort'])) {
            echo 0;
        }
		$result=D("Article")->CateOrderBySort($params);	
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//标签管理
	public function LabelMenu($id){
		$catelist = D("Article")->getTagByCate();
		$cate = D("Article")->getCateAll();
		$tlist = D("Article")->getTagAll();
		$this->assign("id",$id);
		$this->assign("clist",$cate);
		$this->assign("list",$tlist);
		$this->display('/Article/labelmenu');
	}

	//新增标签
	public function TagAddSub(){
		$params = array_map('trim', $_REQUEST);
		$result=D("Article")->addTag($params);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//标签排序
	public function TagOrderBySort(){
		$params = array_map('trim', $_REQUEST);
		if (empty($params['tid']) || empty($params['sort'])) {
            echo 0;
        }
		$result=D("Article")->TagOrderBySort($params);	
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//标签是否显示ajax
	public function TagShowAjax(){
		$params = array_map('trim', $_REQUEST);
		if (empty($params['tid']) || empty($params['is_show'])) {
            echo 0;
        }
		$result=D("Article")->ChangeTagShow($params);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//编辑页
	public function ClassEdit(){
		$arr = array();
		$arr['id'] 	 =  I('id');
		$arr['name'] =  I('name');
		$arr['type'] =  I('type');
        $this->assign("arr",$arr);
		$this->display('/Article/class_edit');
	}

	//编辑页提交
	public function ClassEditCommit(){
		$params = array_map('trim', $_REQUEST);
		$type = $params['type'];
		switch ($type) {
			case '1':	//修改分类名称
				$cate = M("ms_cate");
				$res = $cate->where("cid=%d",$params['id'])->setField('cate_name',$params['name']);
				break;
			case '2':	//修改标签名称
				$tag = M("ms_tag");
				$res = $tag->where("tid=%d",$params['id'])->setField('tag_name',$params['name']);
				break;
			case '3': 	//修改属性名称
				$attr = M("ms_attr");
				$res = $attr->where("id=%d",$params['id'])->setField('name',$params['name']);
				break;
			case '4':	//修改侧TAB名称
				$ctab = M("ms_ctab");
				$res = $ctab->where("id=%d",$params['id'])->setField('tab_name',$params['name']);
				break;
			default:	//Other
				$res = false;
				break;
		}
		if ($res) {
			echo '<script type="text/javascript" src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';exit();
		}else{
			echo '<script>alert("修改失败！请联系管理员。");src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';exit();
		}

	}

	//删除单条标签ajax
	public function TagDelAjax(){
		$tid = I('tid');
		$result=D("Article")->DelTagData($tid);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}


	//属性管理
	public function natureMenu($id){
		$attrlist = D("Article")->getAttrAll(2);	
		$this->assign("id",$id);
		$this->assign("attr",$attrlist);
		$this->display('/Article/natmenu');
	}

	//新增属性
	public function NatureAdd(){
		$params = array_map('trim', $_REQUEST);
		if (empty($params['name'])) {
			echo 0;exit();
		}
		$result=D("Article")->AddNature($params);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//属性设为专题
	public function NatureSetSal(){
		$params = array_map('trim', $_REQUEST);
		$result=D("Article")->SetSalByNature($params);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}
	//验证专题属性
	public function AttrSubVerify(){
		$id = I('id');
		$result=D("Article")->SetSubAttr($id);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}


	//删除属性
	public function AttrDelAjax(){
		$params = array_map('trim', $_REQUEST);
		if (empty($params['id'])) {
			echo 0;exit();
		}
		$result=D("Article")->AttrDelData($params['id']);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//删除属性验证
	public function AttrDelVerify(){
		$id = I('id');
		$res = D("Article")->getAttrCount($id);
		if ($res > 0) {
			echo 1;   //属性下有专题，不允许删除
		}else{
			echo 0;
		}
	}

	//侧TAB管理
	public function CetabMenu($id){
		$ctab=D("Article")->getCtabAll();
		$this->assign("id",$id);
		$this->assign("clist",$ctab);
		$this->display('/Article/ctabmenu');
	}

	//新增侧TAB
	public function CtabAdd(){
		$params = array_map('trim', $_REQUEST);
		if (empty($params['name'])) {
			echo 0;
		}
		$result=D("Article")->AddCtab($params['name']);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//侧TAB排序ajax
	public function CtabOrderBySort(){
		$params = array_map('trim', $_REQUEST);
		$result=D("Article")->CtabOrderBySort($params['id'],$params['sort']);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}
	//侧TAB是否显示
	public function CtabIsShow(){
		$params = array_map('trim', $_REQUEST);
		$result=D("Article")->CtabShow($params['id'],$params['is_show']);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}
	//侧TAB删除
	public function CtabDelData(){
		$params = array_map('trim', $_REQUEST);
		$result=D("Article")->CtabDelData($params['id']);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//侧轮播广告管理
	public function CelunAd(){
		$list=D("Article")->getCelunAdAll();
		$this->assign("list",$list);
		$this->display('/Article/Adver/celunad');
	}

	//侧轮播广告add
	public function celun_add(){

		$this->display('/Article/Adver/celun_add');
	}

	//添加侧轮播
	public function celun_adds(){
		$params = array_map('trim', $_REQUEST);
		$pattern = "/(http|ftp|https):\/\/([\w.]+\/?)\S*/";
		$url = $params['url'];
		preg_match($pattern, $url, $matches);
		if(empty($matches)){
			echo '<script>alert("链接格式不正确,请参考http://news.secwk.com"); src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';
			exit;
		}
		
		$res=D("Article")->celunAdd($params);
		if ($res == 1) {
			echo '<script type="text/javascript" src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';exit();
		}else{
			echo '<script>alert("增加失败！请联系管理员。");src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';exit();
		}
	}

	//编辑侧轮播
	public function celun_edit(){
		$id = I('id'); 
		$arr = array();
		$arr['is_del'] = 0;
		$arr['id'] = $id;
		$banlun =  M("ms_banlun")->where($arr)->find();
 		$this->assign("banlun",$banlun);
		$this->display('/Article/Adver/celun_edit');
	}

	//编辑侧轮播提交
	public function CelunEdits(){
		$params = array_map('trim', $_REQUEST);
		$pattern = "/(http|ftp|https):\/\/([\w.]+\/?)\S*/";
		$url = trim($params['url']);		
		$out_site = varify_url($url);
        if($out_site['st'] === false){
			echo '<script>alert("链接格式不正确,请参考http://news.secwk.com"); src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';
			exit;
        }else{
        	$params['url'] = $out_site['url'];
        } 
		$res=D("Article")->CelunEdit($params);
		if ($res == 1) {
			echo '<script type="text/javascript" src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';exit();
		}else{
			echo '<script>alert("修改失败！请联系管理员。");src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';exit();
		}
 		
	}

	//侧轮播排序
    public function CelunOrderBySort(){
    	$params = array_map('trim', $_REQUEST);
    	$rankid = $params['rankid'];
    	$id = $params['id'];
        $ctab = M("ms_banlun");
        $res = $ctab->where("id=%d",$id)->setField('rankid',$rankid);
        if ($res) {
            echo 1;
        }else{
            echo 0;
        }
    }

	//侧轮播是否显示
    public function CelunShow(){
    	$params = array_map('trim', $_REQUEST);
    	$is_show = $params['is_show'];
    	$id = $params['id'];
        $ctab = M("ms_banlun");
        $res = $ctab->where("id=%d",$id)->setField('is_show',$is_show);
        if ($res) {
            echo 1;
        }else{
            echo 0;
        }
    }

	//侧轮播删除
    public function CelunDel(){
    	$params = array_map('trim', $_REQUEST);
    	$id = $params['id'];
        $ctab = M("ms_banlun");
        $res = $ctab->where("id=%d",$id)->setField('is_del',1);
        if ($res) {
            echo 1;
        }else{
            echo 0;
        }
    }



}