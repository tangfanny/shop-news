<?php

/**
 * @copyright ManageArAction 文章管理
 * @author donghui
 * @version 2015年11月9日
 */

class ManageArAction extends BaseAction {

	public function Index(){
		$con = I('condition');
		$search = I('search');
		$str = "%".$con."%";
		switch ($search) {
			case '0':	//搜标题
				$condition['t_ms_article.title']=array('like',$str);
				break;
			case '1':	//搜文章ID
				$condition['t_ms_article.wid']=array('like',$str);
				break;
			case '2':	//搜发布者
				$condition['t_ms_author.nikename']=array('like',$str);
				break;
			case '3':	//搜分类
				$condition['t_ms_cate.cate_name']=array('like',$str);
				break;
			case '4':	//搜属性
				$condition['t_ms_attr.name']=array('like',$str);
				break;
			default:
				$condition = array();
				break;
		}
		$alist  = D("Article")->Articlelist(12,$condition);
		$showPage = $alist['showPage'];
		$list = $alist['list'];
		$p = $alist['p'];
		$this->assign("list",$list);
		$this->assign("Page",$showPage);
		if(empty($p)){
			$p = '1';
		}
		$this->assign("p",$p);
		// var_dump($showPage);
        $this->display('Article/article/list');
	}

	//文章首页推荐
	public function Recommend(){
		// $con = I('condition');
		// $search = I('search');
		// $str = "%".$con."%";
		// switch ($search) {
		// 	case '0':	//搜标题
		// 		$condition['t_ms_article.title']=array('like',$str);
		// 		break;
		// 	case '1':	//搜文章ID
		// 		$condition['t_ms_article.wid']=array('like',$str);
		// 		break;
		// 	default:
		// 		$condition = array();
		// 		break;
		// }
		// $alist  = D("Article")->Articlelist(12,$condition);
		// $showPage = $alist['showPage'];
		// $list = $alist['list'];
		// $p = $alist['p'];
		// $this->assign("list",$list);
		// $this->assign("Page",$showPage);
		// if(empty($p)){
		// 	$p = '1';
		// }
		$this->display('Article/recommend/ArRecommend');
	}

	//文章排序
	public function ArticleOrderBySort(){
		$params = array_map('trim', $_REQUEST);
        $wid = $params['wid'];
        $sort = $params['sort'];
		$result=D("Article")->ArticleOrderBySort($wid,$sort);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//文章是否显示
	public function ArticleShowAjax(){
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

	//删除文章
	public function ArticleDelData(){
		$params = array_map('trim', $_REQUEST);
		if (empty($params['wid'])) {
            echo 0;
        }
		$result=D("Article")->DelArticle($params['wid']);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//发布文章
	public function ArticleAdd(){
		$Cate = D("Article")->getCateAll();
		$attr = D("Article")->getAttrAll();
		$cid = $Cate['0']['cid'];
		$tag = D("Article")->getTagByCateCid($cid);
		$pv = rand(2000,4000);
		$this->assign("Tag",$tag);
		$this->assign("cate",$Cate);
		$this->assign("attr",$attr);
		$this->assign("pv",$pv);
		$this->display('Article/article/addAr');
	}

	//文章的标签获取
	public function ArticleTag(){
		$cid = I('cid');
		$tag = D("Article")->getTagByCateCid($cid);
		echo json_encode($tag);
	}

	//发布文章
	public function ArticleSub(){
		$params = array_map('trim', $_REQUEST);
		$params['tid'] = trim($params['tid'],',');
		if (empty($params['pv'])) {
            $params['pv'] = rand(2000,4000);
		}
		$params['uid'] = D("MsAuthor")->AddAuthor(session('sessionId'),session('nikename'));
		$res = D("Article")->AddArticle($params);
		if ($res == 1) {
			echo 1;
		}else{
			echo 2;
		}
	}

    //编辑文章
    public function ArticleEdit(){
        $wid = I('wid');
        $p = I('p');
        $article = D("Article")->ArticleEdit($wid);
		$tag = D("Article")->getTagByWid($wid);
		$Catelist = D("Article")->getCateAll();
		$attrlist = D("Article")->getAttrAll();
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
		$this->assign("attr",$attr);
		$this->assign("p",$p);
		$this->display('Article/article/ArEdit');
    }

	//编辑文章提交
	public function ArticleEditSub(){
		$params = array_map('trim', $_REQUEST);
		$params['tid'] = trim($params['tid'],',');
		if (empty($params['pv'])) {
            $params['pv'] = rand(2000,4000);
		}
		// dump($params);die('aaa');
		$res = D("Article")->ArticleEditSub($params);
		if ($res == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}


/**
 * @copyright 审核管理
 * @author donghui
 * @version 2015年11月21日
 */

	public function CheckManage(){
		$this->display('Article/check/choice');
	}

	//文章审核
	public function ArticleCheck(){
		$con = I('condition');
		$search = I('search');
		$id = I('id');
		$str = "%".$con."%";
		switch ($search) {
			case '0':	//搜标题
				$condition['t_ms_article.title']=array('like',$str);
				break;
			case '1':	//搜文章ID
				$condition['t_ms_article.wid']=array('like',$str);
				break;
			case '2':	//搜发布者
				$condition['t_ms_author.nikename']=array('like',$str);
				break;
			case '3':	//搜分类
				$condition['t_ms_cate.cate_name']=array('like',$str);
				break;
			case '4':	//搜属性
				$condition['t_ms_attr.name']=array('like',$str);
				break;
			default:
				$condition = array();
				break;
		}
		$show = "全部文章";
		if ($id == 1) {
			$condition['t_ms_author.a_id'] = 0;
			$condition['t_ms_article.is_check'] = 0;
			$show = "未审核外部文章";
		}else if($id == 2){
			$condition['t_ms_author.a_id'] = 1;
			$condition['t_ms_article.is_check'] = 0;
			$show = "未审核内部文章";
		}
		$alist  = D("Article")->ArChecklist(12,$condition);
		$showPage = $alist['showPage'];
		$list = $alist['list'];
		$this->assign("list",$list);
		$this->assign("show",$show);
		$this->assign("Page",$showPage);
		$this->display('Article/check/list');
	}

	//文章审核Data
	public function ArticleCheckData(){
		$wid = I('wid');
		$article = D("Article")->ArticleData($wid);
		$this->assign("article",$article);
		$this->display('Article/check/archeck');
	}

	//审核文章 提交
	public function CheckArSub(){
		$params = array_map('trim', $_REQUEST);
		$res = D("Article")->ArticleCheck($params);
		if ($res == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//专题审核 提交
	public function TopicsCheckSub(){
		$params = array_map('trim', $_REQUEST);
		$res = D("Article")->TopicsCheckSub($params);
		if ($res == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//专题审核
	public function TopicsCheck(){
		$con = I('condition');
		$search = I('search');
		$id = I('id');
		$str = "%".$con."%";
		switch ($search) {
			case '0':	//搜标题
				$condition['t_ms_article.title']=array('like',$str);
				break;
			case '1':	//搜专题ID
				$condition['t_ms_article.wid']=array('like',$str);
				break;
			case '2':	//搜发布者
				$condition['t_ms_author.nikename']=array('like',$str);
				break;
			case '3':	//搜分类
				$condition['t_ms_cate.cate_name']=array('like',$str);
				break;
			case '4':	//搜属性
				$condition['t_ms_attr.name']=array('like',$str);
				break;
			default:
				$condition = array();
				break;
		}
		$show = "全部专题";
		if ($id == 1) {
			$condition['t_ms_article.is_check'] = 0;
			$show = "未审核专题";
		}
		$alist  = D("Article")->TopicsCheck(12,$condition);
		$showPage = $alist['showPage'];
		$list = $alist['list'];
		$this->assign("list",$list);
		$this->assign("show",$show);
		$this->assign("Page",$showPage);
		$this->display('Article/check/top_check');
	}
	//专题审核单条
	public function TopicsCheckData(){
		$sid = I('sid');
		$article = D("Article")->TopicsData($sid);
		$this->assign("article",$article);
		$this->display('Article/check/topics_ch');
	}

	//评论审核
	public function CommentCheck(){
		$con = I('condition');
		$search = I('search');
		$id = I('id');
		$str = "%".$con."%";
		switch ($search) {
			case '0':	//搜标题
				$condition['t_ms_article.title']=array('like',$str);
				break;
			case '1':	//搜专题ID
				$condition['t_ms_article.wid']=array('like',$str);
				break;
			default:
				$condition = array();
				break;
		}
		$show = "全部评论";
		if ($id == 1) {
			$condition['t_ms_comment.status'] = 0;
			$show = "未审核评论";
		}
		$alist  = D("Article")->CommentCheck(12,$condition);
		$showPage = $alist['showPage'];
		$list = $alist['list'];
		$this->assign("list",$list);
		$this->assign("show",$show);
		$this->assign("Page",$showPage);
		$this->display('Article/check/comm_check');
	}

	//评论审核单条
	public function CommentCheckData(){
		$id = I('id');
		$comment = D("Article")->CommentData($id);
		$this->assign("comment",$comment);
		$this->display('Article/check/comment_ch');
	}

	//删除评论
	public function CommentDelData(){
		$id = I('id');
		if (empty($id)) {
            echo 0;
        }
		$result=D("Article")->DelCommentData($id);
		if ($result == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}





}
