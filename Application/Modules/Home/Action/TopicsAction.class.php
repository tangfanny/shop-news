<?php

/**
 * @copyright TopicsAction 专题管理
 * @author donghui
 * @version 2015年11月19日
 */

class TopicsAction extends BaseAction {

	public function Index(){
		$con = I('condition');
		$search = I('search');
		$str = "%".$con."%";
		switch ($search) {
			case '1':	//搜标题
				$condition['t_ms_article.title']=array('like',$str);
				break;
			case '2':	//搜文章ID
				$condition['t_ms_article.wid']=array('like',$str);
				break;
			case '3':	//搜发布者
				$condition['t_ms_author.nikename']=array('like',$str);
				break;
			case '4':	//搜分类
				$condition['t_ms_cate.cate_name']=array('like',$str);
				break;
			case '5':	//搜属性
				$condition['t_ms_attr.name']=array('like',$str);
				break;
			default:
				$condition = array();
				break;
		}
		if (empty($con)) {
			$search = "专题管理";
		}else{
			$search = "搜索 ".$con." 的结果。";
		}
		
		$alist  = D("Article")->Topicslist(12,$condition);
		$showPage = $alist['showPage'];
		$list = $alist['list'];
		$this->assign("search",$search);
		$this->assign("list",$list);
		$this->assign("Page",$showPage);
        $this->display('Article/Topics/list');
	}

	//专题排序
	public function TopicsOrderBySort(){	
		$params = array_map('trim', $_REQUEST);
		if (empty($params['wid']) || empty($params['sort'])) {
            echo 0;
            exit();
        }
        $wid = $params['wid'];
        $sort = $params['sort'];
		$result=D("Article")->ArticleOrderBySort($wid,$sort);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//专题是否显示
	public function TopicsShowAjax(){
		$params = array_map('trim', $_REQUEST);
		if (empty($params['wid'])) {
            echo 0;exit();
        }
        $wid = $params['wid'];
        $is_show = $params['is_show'];
		$result=D("Article")->ArticleShowAjax($wid,$is_show);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//删除专题
	public function TopicsDelData(){
		$params = array_map('trim', $_REQUEST);
		$result=D("Article")->DelArticle($params['wid']);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//发布专题
	public function TopicsAdd(){
		$Cate = D("Article")->getCateAll();
		$attr = D("Article")->getAttrAll(1);
		$cid = $Cate['0']['cid'];
		$tag = D("Article")->getTagByCateCid($cid);
		$pv = rand(2000,4000);
		$this->assign("Tag",$tag);
		$this->assign("pv",$pv);
		$this->assign("cate",$Cate);
		$this->assign("attr",$attr);
		$this->display('Article/Topics/addSpe');
	}

	//专题的标签获取
	public function ArticleTag(){
		$cid = I('cid');
		$tag = D("Article")->getTagByCateCid($cid);
		echo json_encode($tag);
	}

	//添加专题
	public function TopicsSub(){
		$params = array_map('trim', $_REQUEST);
		$params['tid'] = trim($params['tid'],',');
		$params['start_time'] = strtotime($params['start_time']);
		$params['end_time'] = strtotime($params['end_time']);
		$params['uid'] = D("MsAuthor")->AddAuthor(session('sessionId'),session('nikename'));
		$res = D("Article")->AddArticle($params);
		if ($res == 1) {
			echo 1;
		}else{
			echo 2;
		}
	}

    //编辑专题
    public function TopicsEdit(){
        $wid = I('wid');
        $article = D("Article")->ArticleEdit($wid);
        $tag = D("Article")->getTagByWid($wid);
		$Catelist = D("Article")->getCateAll();
		$attrlist = D("Article")->getAttrAll(1);
		$taglist = D("Article")->getTagByCateCid($article['cid']);
		foreach ($taglist as $key => $value) {
			foreach ($tag as $key1 => $value1) {
				if($tag[$key1]["tid"]==$taglist[$key]["tid"]){
					$taglist[$key]["flag"]=1;
				}
			}
		}
		$this->assign("tlist",$taglist);
		$this->assign("catelist",$Catelist);
		$this->assign("attrlist",$attrlist);
        $this->assign("article",$article);
		$this->assign("cate",$Cate);
		$this->assign("tag",$tag);
		$this->display('Article/Topics/SpeEdit');
    }

	//编辑专题提交
	public function TopicsEditSub(){
		$params = array_map('trim', $_REQUEST);
		$params['tid'] = trim($params['tid'],',');
		$params['start_time'] = strtotime($params['start_time']);
		$params['end_time'] = strtotime($params['end_time']);
		if (empty($params['pv'])) {
            $params['pv'] = rand(2000,4000);
		}
		
		$params['url'] = trim($params['url']);		
		$res = D("Article")->ArticleEditSub($params);
		if ($res == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//专题文章管理
	public function ManageT(){
		$con = I('condition');
		$search = I('search');
		$sid = I('sid');
		$str = "%".$con."%";
		$condition = array();
		switch ($search) {
			case '1':	//搜标题
				$condition['t_ms_article.title']=array('like',$str);
				break;
			case '2':	//搜文章ID
				$condition['t_ms_article.wid']=array('like',$str);
				break;
			case '3':	//搜发布者
				$condition['t_ms_author.nikename']=array('like',$str);
				break;
			case '4':	//搜分类
				$condition['t_ms_cate.cate_name']=array('like',$str);
				break;
			case '5':	//搜属性
				$condition['t_ms_attr.name']=array('like',$str);
				break;
			default:
				$condition = array();
				break;
		}
		if (empty($con)) {
			$search = I('title');
		}else{
			$search = "搜索".'< '.$con.' >'."的结果。";
		}
		$condition['t_ms_sublist.sid'] = $sid;
		$alist  = D("Article")->TopicsArManage(12,$condition);
		$showPage = $alist['showPage'];
		$list = $alist['list'];
		$title = I('title');
		$this->assign("search",$search);
		$this->assign("list",$list);
		$this->assign("sid",$sid);
		$this->assign("title",$title);
		$this->assign("Page",$showPage);
        $this->display('Article/Topics/ManageT');
	
	}

	//专题文章排序
	public function TopicsArSort(){
		$params = array_map('trim', $_REQUEST);
		$res = D("Article")->TopicsArSort($params);
		if ($res == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//专题文章删除
	public function TopicsArDel(){
		$id = I('id');
		$res = D("Article")->TopicsArDel($id);
		if ($res == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}
	//专题添加文章
	public function AddArForTopics(){
		$sid = I('sid');
		$con = I('condition');
		$search = I('search');
		$str = "%".$con."%";
		$condition = array();
		switch ($search) {
			case '1':	//搜标题
				$condition['t_ms_article.title']=array('like',$str);
				break;
			case '2':	//搜文章ID
				$condition['t_ms_article.wid']=array('like',$str);
				break;
			case '3':	//搜发布者
				$condition['t_ms_author.nikename']=array('like',$str);
				break;
			case '4':	//搜分类
				$condition['t_ms_cate.cate_name']=array('like',$str);
				break;
			case '5':	//搜属性
				$condition['t_ms_attr.name']=array('like',$str);
				break;
			default:
				$condition = array();
				break;
		}
		if (empty($con)) {
			$search = I('title');
		}else{
			$search = "搜索".' '.$con.' '."的结果。";
		}
		$alist  = D("Article")->TopicsArlist(12,$condition,$sid);
		$showPage = $alist['showPage'];
		$list = $alist['list'];		
		$this->assign("search",$search);
		$this->assign("list",$list);
		$this->assign("sid",$sid);
		$this->assign("Page",$showPage);
        $this->display('Article/Topics/Addar');
	}

	//专题添加文章提交ajax
	public function AddArForTopicSub(){
		$params = array_map('trim', $_REQUEST);
		$res = D("Article")->AddArForTopics($params);
		if ($res == 1) {
			echo 1;
		}else{
			echo 2;
		}

	}

	//CATB管理
	public function CtabManage(){
		$con = I('condition');
		$id = I('id');
		$search = I('search');
		$str = "%".$con."%";
		$condition = array();
		switch ($search) {
			case '2':	//搜标题
				$condition['t_ms_tablist.title']=array('like',$str);
				break;
			case '3':	//搜URL
				$condition['t_ms_tablist.url']=array('like',$str);
				break;
			default:
				$condition = array();
				break;
		}
		$tablist = D("Article")->TablistAll();
		if (empty($id)) {
			$condition['t_ms_ctab.id'] = $tablist['0']['id'];
		}else{
			$condition['t_ms_ctab.id'] = $id;
		}
		$alist  = D("Article")->TopicsTablist(12,$condition);
		$tab_name = $alist['list']['0']['tab_name'];
		$tid = $alist['list']['0']['tid'];
		$this->assign("list",$alist['list']);
		$this->assign("Page",$alist['showPage']);
		$this->assign("tablist",$tablist);
		$this->assign("tab_name",$tab_name);
		$this->assign("tid",$tid);
		$this->assign("id",$id);
        $this->display('Article/Adver/ctab_list');
    }

	//增加侧TAB
	public function TopicTabAdd(){
		$tablist = D("Article")->TablistAll();
		$this->assign("tablist",$tablist);
		$this->display('Article/Adver/ctab_add');
	}

	//增加侧TAB提交
	public function TopicTabAddSub(){
		$params = array_map('trim', $_REQUEST);
		$result=D("Article")->AddTopicTab($params);
		if ($result == 1) {
			echo '<script type="text/javascript" src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';exit();
		}else{
			echo '<script>alert("添加失败！请联系管理员。");src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';exit();
		}
	}

	//侧TAB排序list
	public function TopicTabOrder(){
		$params = array_map('trim', $_REQUEST);
		$res =D("Article")->TopicTabOrder($params);
		if ($res == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//侧TAB显示
	public function TopicTabShow(){
		$params = array_map('trim', $_REQUEST);
		$res =D("Article")->TopicTabShow($params);
		if ($res == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//侧TAB编辑
	public function TopicTabEdit(){
		$id = I('id');
		$tab=D("Article")->TopicTabData($id);
		$this->assign("tab",$tab);
		$this->display('Article/Adver/ctab_edit');
	}

	//侧TAB编辑提交
	public function TopicTabEditSub(){
		$params = array_map('trim', $_REQUEST);
		$result=D("Article")->TopicTabEditSub($params);
		if ($result == 1) {
			echo '<script type="text/javascript" src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';exit();
		}else{
			echo '<script>alert("添加失败！请联系管理员。");src="'. PUBLIC_JS_URL.'secwk.js" ></script><script>dialogReload();</script>';exit();
		}
	}

	//侧TAB删除
	public function TopicTabDel(){
		$id = I('id');
		$result=D("Article")->TopicTabDel($id);
		if ($result == 1) {
			echo 1;
		}else{
			echo 2;
		}
	}

		
}
