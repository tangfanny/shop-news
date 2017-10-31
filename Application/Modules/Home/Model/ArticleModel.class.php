<?php

/**
 * @copyright Article 栏目管理
 * @author donghui
 * @version 2015年11月9日
 */

class ArticleModel extends Model{

    

    //广告是否显示
    public function ChangeAvderShow($params){

        $banner = M("ms_banner"); 
        $id = $params['id'];
        $is_show = $params['is_show'];
        $res = $banner->where("id=%d",$id)->setField('is_show',$is_show);
        if ($res) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result; 
    }

    //广告编辑
    public function AdverEdit($params){

        $banner = M("ms_banner"); 
        $data = array();
        $data['title'] = $params['title'];
        $data['url'] = $params['url'];
        $data['rankid'] = $params['rankid'];
        $data['desc'] = $params['desc'];
        $data['update_time'] = time();
        if (!empty($params['logo'])) {
            $data['path'] = $params['logo'];
        }
        $id = $params['id'];
        if ($banner->where("id=%d",$id)->data($data)->save()) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result;   
    }

    //广告单条查询
    public function getAdverOnlyData($id){

        $banner = M("ms_banner"); 
        $result =  $banner->where("id=%d",$id)->find();

        return $result;
    }

    //广告是否显示
    public function DelAdverData($params){

        $banner = M("ms_banner"); 
        $id = $params['id'];
        $res = $banner->where("id=%d",$id)->setField('is_del',1);
        if ($res) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result; 
    }


    //栏目管理
    public function getColumnMenu($params){

        $id = $params['menuid'];
        $parentid = $params['pid'];
        $list =  M("admin_menu")
              ->where("id=%d and parentid=%d",$id,$parentid)
              ->find();

        return $list;
    }

    //获取全部分类
    public function getCateAll(){
        $where['is_del']=0;
        $where['is_show']=1;
        $list =  M("ms_cate")->Field("*")->order('sort asc')->where($where)->select();
        return $list;
    }

    //根据分类ID获取分类
    public function getCateData($cid){
        $del = 0;
        $list =  M("ms_cate")->where("cid=%d and is_del=%d",$cid,$del)->find();
        return $list;
    }

    //添加分类
    public function addCate($data){
        $cate = M("ms_cate");
        $crel = M("ms_ctrel");
        $data['create_time'] = time();
        $cate->startTrans();
        $result = $cate->add($data);
        $data2 = array();
        $data2['cid'] = $result;
        $result2 = $crel->add($data2);
        if ($result && $result2) {
            $cate->commit();//成功则提交
            $result3 = 1;
        }else{
            $cate->rollback();//不成功，则回滚
            $result3 = 0;
        }
        return $result3;
    }

    //分类排序
    public function CateOrderBySort($params){
        $cate = M("ms_cate"); 
        $data = array();
        $data['sort'] = $params['sort'];
        $data['update_time'] = time();
        $cid = $params['cid'];
        if ($cate->where("cid=%d",$cid)->data($data)->save()) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result;
    }

    //分类是否显示
    public function ChangeCateShow($params){
        $cate = M("ms_cate");
        $cid = $params['cid'];
        $is_show = $params['is_show'];
        $res = $cate->where("cid=%d",$cid)->setField('is_show',$is_show);
        if ($res) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result; 
    }


    //获取所有分类和对应标签
    public function getTagByCate(){
        $Model = M('ms_cate');
        $catelist = $Model ->Field('t_ms_ctrel.id,t_ms_ctrel.cid,t_ms_ctrel.tid,t_ms_cate.cate_name,t_ms_cate.sort,t_ms_cate.is_show,t_ms_tag.tag_name')
                          ->join("t_ms_ctrel on t_ms_ctrel.cid = t_ms_cate.cid")
                          ->join("t_ms_tag on (t_ms_ctrel.tid = t_ms_tag.tid and t_ms_tag.is_del = 0)")
                          ->order('t_ms_cate.sort asc')
                          ->where('t_ms_cate.is_del = 0')
                          ->select();
        $b = array();
        foreach($catelist as $v) {
              if(! isset($b[$v['cid']])){
                    $b[$v['cid']] = $v;
              }else{
               $b[$v['cid']]["tag_name"].= ' , '.$v["tag_name"];
            }
        }

        return $b;
    }

    //根据分类ID获取对应标签
    public function getTagByCateID($cid){
        $Model = M('ms_ctrel');
        $where['t_ms_cate.cid'] = $cid;
        $catelist = $Model->Field('t_ms_ctrel.cid,t_ms_ctrel.tid,t_ms_tag.tag_name,t_ms_tag.sort')
                          ->join("t_ms_cate on t_ms_ctrel.cid=t_ms_cate.cid")
                          ->join("t_ms_tag on t_ms_tag.tid=t_ms_ctrel.tid")
                          ->where($where)
                          ->order('t_ms_cate.sort asc')
                          ->select();
        $b = array();
        foreach($catelist as $v) {
              if(! isset($b[$v['cid']])){
                    $b[$v['cid']] = $v;
              }else{
               $b[$v['cid']]["tag_name"] .= ' 、' . $v["tag_name"];
            }
        }

        return $b;
    }

    //根据分类ID获取对应标签
    public function getTagByCateID2($cid){
        $Model = M('ms_ctrel');
        $where['t_ms_cate.cid'] = $cid;
        $catelist = $Model->Field('t_ms_ctrel.cid,t_ms_ctrel.tid,t_ms_tag.tag_name,t_ms_tag.sort')
                          ->join("t_ms_cate on t_ms_ctrel.cid=t_ms_cate.cid")
                          ->join("t_ms_tag on t_ms_tag.tid=t_ms_ctrel.tid")
                          ->where($where)
                          ->order('t_ms_cate.sort asc')
                          ->select();
        return $catelist;
    }

    //为分类修改标签(增加,修改)
    public function AddTagForCate($params){
        $crel = M("ms_ctrel");
        $list = array();
        $result2 = $crel->where(array('cid'=>$params['cid']))->delete();
        foreach ($params['tag'] as $key => $value) {
            $list[$key]['cid'] = $params['cid'];
            $list[$key]['tid'] = $value;
        }
        return $crel->addAll($list);
    }
    
    //删除(逻辑)分类
    public function DelCateData($cid){
        $cate = M("ms_cate");
        $crel = M("ms_ctrel");
        $data['update_time'] = time();
        $data['is_del'] = 1;
        $cate->startTrans();
        $result = $cate->where("cid=%d",$cid)->data($data)->save();
        $result2 = $crel->where("cid=%d",$cid)->delete();
        if ($result && $result2) {
            $cate->commit();
            $result3 = 1;
        }else{
            $cate->rollback();
            $result3 = 0;
        }
        return $result3;
    }


    //获取全部标签
    public function getTagAll($id){
        $id = 0;
        $tag = M("ms_tag");
        $condition['is_del'] = 0;
        $datatag = $tag->Field("tid,sort,tag_name,is_show")->order('tid')->where($condition)->select();
        if ($id == 1) {
            $taglist = getCollectByArray($datatag,'tag_name');
        }else{
            $taglist = $datatag;
        } 
        return $taglist;
    }

    //获取全部标签2
    public function getTagList(){
        $Model = M('ms_ctrel');
        $taglist = $Model->Field('t_ms_ctrel.id,t_ms_ctrel.cid,t_ms_ctrel.tid,t_ms_cate.cate_name,t_ms_tag.sort,t_ms_tag.is_show,t_ms_tag.tag_name')
                          ->order('t_ms_tag.sort asc')
                          ->join("t_ms_tag on t_ms_ctrel.tid=t_ms_tag.tid")
                          ->join("t_ms_cate on t_ms_cate.cid=t_ms_ctrel.cid")
                          ->where('t_ms_tag.is_del=0')
                          ->select();

        $res = array();
        foreach($taglist as $item) {
            if(! isset($res[$item['tid']])){
                $res[$item['tid']] = $item;
            }else{
                $res[$item['tid']]['cate_name'] .= ' 、' . $item['cate_name'];
            }
        }
        return $res;
    }

    //添加标签
    public function addTag($params){
        if (empty($params['tag_name'])) {
            return 0;
        }
        $tag  = M("ms_tag");
        $taglist = array();
        $taglist['create_time'] = time();
        $taglist['tag_name'] = $params['tag_name'];
        $result = $tag->add($taglist);
        if($result){
            $result3 = 1;
        }else{
            $result3 = 0;
        }
        return $result3;
    }

    //标签排序
    public function TagOrderBySort($params){
        $tag = M("ms_tag"); 
        $data = array();
        $sort = $params['sort'];
        $tid = $params['tid'];
        $res = $tag->where("tid=%d",$tid)->setField('sort',$sort);
        if ($res) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result;
    }

    //标签是否显示
    public function ChangeTagShow($params){
        $tag = M("ms_tag");
        $tid = $params['tid'];
        $is_show = $params['is_show'];
        $res = $tag->where("tid=%d",$tid)->setField('is_show',$is_show);
        if ($res) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result; 
    }

    //删除(逻辑)标签
    public function DelTagData($id){
        $Tag = M("ms_tag");
        $data['update_time'] = time();
        $data['is_del'] = 1;
        if ($Tag->where("tid=%d",$id)->data($data)->save()) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result;
    }

    //获取全部属性
    public function getAttrAll($sub){        
        if ($sub == 1) {
            $condition['is_sub'] = 1;
        }else if ($sub == 2){

        }else{
            $condition['is_sub'] = 0;
        }
        $attr = M("ms_attr");
        $condition['is_del'] = 0;
        $data = $attr->Field("id,name,is_sub")->where($condition)->select();
        return $data;
    }
    //根据属性ID获取属性
    public function getAttrData($id){
        $del = 0;
        $data =  M("ms_attr")->where("id=%d and is_del=%d",$id,$del)->find();
        return $data;
    }

    //新增属性
    public function AddNature($params){
        $attr  = M("ms_attr");
        $attrlist['create_time'] = time();
        $attrlist['name'] = $params['name'];
        $result = $attr->add($attrlist);
        if($result){
            $result3 = 1;
        }else{
            $result3 = 0;
        }
        return $result3;
    }

    //删除属性
    public function AttrDelData($id){
        $attr = M("ms_attr");
        $res = $attr->where("id=%d",$id)->setField('is_del',1);
        if ($res) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result; 
    }

    //统计属性个数
    public function getAttrCount($id){
        $Attr = M("ms_attr");
        $condition['t_ms_attr.id'] = $id;
        $condition['t_ms_article.is_del'] = 0;
        $count = $Attr->join("t_ms_article on (t_ms_article.attr = t_ms_attr.id and t_ms_attr.is_sub = 1)")->where($condition)->count();
        return $count;
    }

    //定义属性专题
    public function SetSalByNature($params){
        $attr = M("ms_attr");
        $id = $params['id'];
        $is_sub = $params['is_sub'];
        $res = $attr->where("id=%d",$id)->setField('is_sub',$is_sub);
        if ($res) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result; 
    }



    //侧TAB
    public function getCtabAll($id){
        $list =  M("ms_ctab")->Field("id,sort,tab_name,is_show,is_del")->order('sort asc')->where("is_del=0")->select();
        return $list; 
    }

    //新增侧TAB
    public function AddCtab($name){
        $ctab  = M("ms_ctab");
        $clist['create_time'] = time();
        $clist['tab_name'] = $name;
        $result = $ctab->add($clist);
        if($result){
            $result3 = 1;
        }else{
            $result3 = 0;
        }
        return $result3;
    }
    
    //侧TAB排序
    public function CtabOrderBySort($id,$sort){
        $ctab = M("ms_ctab");
        $res = $ctab->where("id=%d",$id)->setField('sort',$sort);
        if ($res) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result; 
    }

    //侧TAB显示
    public function CtabShow($id,$is_show){
        $ctab = M("ms_ctab");
        $res = $ctab->where("id=%d",$id)->setField('is_show',$is_show);
        if ($res) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result; 
    }
    //侧TAB删除
    public function CtabDelData($id){
        $ctab = M("ms_ctab");
        $res = $ctab->where("id=%d",$id)->setField('is_del','1');
        if ($res) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result; 
    }

    //侧轮播广告
    public function getCelunAdAll(){
        $banlun =  M("ms_banlun")->Field("*")->order('rankid asc,create_time desc')->where("is_del=0")->select();
        return $banlun; 
    }

    //添加侧轮播广告
    public function celunAdd($params){
        $banlun  = M("ms_banlun");
        $arr = array();
        $arr['create_time'] = time();
        $arr['title'] = $params['title'];
        $arr['path'] = $params['logo'];
        $arr['url'] = $params['url'];
        $result = $banlun->add($arr);
        if($result){
            $result3 = 1;
        }else{
            $result3 = 0;
        }
        return $result3;
    }

    //编辑侧轮播广告
    public function CelunEdit($params){
        $banlun  = M("ms_banlun");
        $data = array();
        if (!empty($params['logo'])) {
            $data['path'] = $params['logo'];
        }
        $data['update_time'] = time();
        $data['title'] = $params['title'];
        $data['url'] = $params['url'];
        $id = $params['id'];
        $result = $banlun->where("id=%d",$id)->data($data)->save();
        if($result){
            $result3 = 1;
        }else{
            $result3 = 0;
        }
        return $result3;
    }

    /**
     * @copyright Article 文章管理
     * @author donghui
     * @version 2015年11月9日
     */


    //文章列表
    public function Articlelist($num,$condition){
        $Model = M('ms_article');
        $condition['t_ms_article.is_del'] = 0;
        $condition['t_ms_attr.is_del'] = 0;
        $count = $Model->join("t_ms_attr on (t_ms_article.attr = t_ms_attr.id and t_ms_attr.is_sub = 0)")
                        ->join("t_ms_author on t_ms_article.uid = t_ms_author.uid")
                        ->join("t_ms_cate on (t_ms_article.cid = t_ms_cate.cid and t_ms_cate.is_del = 0)")
                        ->where($condition)->count();
        import("ORG.Util.Page");
        $page = new Page($count,$num);
        $p= ($_GET['p']);
        $showPage = $page->show();
        $list = $Model->Field('t_ms_article.wid,t_ms_article.title,t_ms_article.create_time,t_ms_article.check_time,t_ms_article.tpv,t_ms_article.pv,
            t_ms_article.is_check,t_ms_article.sort,t_ms_article.is_show,t_ms_author.nikename,t_ms_cate.cate_name,t_ms_attr.name')
                        ->limit("$page->firstRow, $page->listRows")
                        ->join("t_ms_author on t_ms_article.uid = t_ms_author.uid")
                        ->join("t_ms_cate on (t_ms_article.cid = t_ms_cate.cid and t_ms_cate.is_del = 0)")
                        ->join("t_ms_attr on (t_ms_article.attr = t_ms_attr.id and t_ms_attr.is_sub = 0)")
                        ->where($condition)
                        ->order('t_ms_article.sort asc,t_ms_article.create_time desc')
                        ->select();
        $data=array();
        $data["showPage"]=$showPage;
        $data["p"]=$p;
        $data["list"]=$list;
        return $data; 
    }

    //首页文章推荐
    public function ArticleRecommend(){
        $Model = M('ms_article_recommend');
        $count = $Model->join("t_ms_article on (t_ms_article.wid= t_ms_article_recommend.article_id = 0")
                      ->order('t_ms_article.sort asc')
                      ->select();
        $data = array();
        $data['showPage'] = $showPage;
        $data['list'] = $list;
        return $data;
    }
    //文章排序
    public function ArticleOrderBySort($wid,$sort){
        $Article = M("ms_article");
        $res = $Article->where("wid=".$wid)->setField('sort',$sort);
        if ($res) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result; 
    }

    //文章是否显示
    public function ArticleShowAjax($wid,$is_show){
        $Article = M("ms_article");
        $res = $Article->where("wid=".$wid)->setField('is_show',$is_show);
        if ($res) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result; 
    }

    //删除文章
    public function DelArticle($wid){
        $Article = M("ms_article");
        $now = time();
        $data = array('is_del'=>'1','update_time'=>$now);   //当删除的时候，更新时间为删除时间。
        $res = $Article->where("wid=".$wid)->setField($data);
        if ($res) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result; 
    }

    //获取所有分类和对应标签Article(以分类为主)
    public function getTagByCateCid($cid){
        $condition['t_ms_tag.is_del'] = 0;
        $condition['t_ms_ctrel.tid'] != 0;
        $condition['t_ms_ctrel.cid'] = $cid;
        $Model = M('ms_ctrel');
        $list = $Model->Field('t_ms_tag.tid,t_ms_tag.tag_name')
                      ->join("t_ms_tag on t_ms_ctrel.tid = t_ms_tag.tid")
                      ->where($condition)
                      ->order('t_ms_tag.sort asc')
                      ->select();
        return $list;
    }

    //获取所有标签根据文章ID
    public function getTagByWid($wid){
        $condition['t_ms_tag.is_del'] = 0;
        $condition['t_ms_wtag.tid'] != 0;
        $condition['t_ms_wtag.wid'] = $wid;
        $Model = M('ms_wtag');
        $list = $Model->Field('t_ms_tag.tid,t_ms_tag.tag_name')
                      ->join("t_ms_tag on t_ms_wtag.tid = t_ms_tag.tid")
                      ->where($condition)
                      ->order('t_ms_tag.sort asc')
                      ->select();
        return $list;
    }


    //发布文章(后台新增文章)
    public function AddArticle($params){
        $data = array();
        $tlist = explode(',',$params['tid']);
        $Article = M("ms_article");
        $Article->startTrans();
        $data['wid'] = D("Common")->getrandoms();
        $data['cid'] = $params['cid'];
        $data['title'] = $params['title'];

        $params['url'] = trim($params['url']);
        $params['link_url'] = trim($params['link_url']);

        $data['subhead'] = isset($params['subhead'])?$params['subhead']:"";
        $data['content'] = isset($params['content'])?$params['content']:"";
        $data['source'] = isset($params['source'])?$params['source']:"";
        $data['url'] = isset($params['url'])?$params['url']:"";
        $data['link_url'] = isset($params['link_url'])?$params['link_url']:"";
        $data['logo'] = $params['logo'];
        $data['attr'] = $params['attr'];
        $data['pv'] = isset($params['pv'])?$params['pv']:0;
        $data['create_time'] = time();
        $data['start_time'] = $params['start_time'];    //专题开始时间
        $data['end_time'] = $params['end_time'];        //专题结束时间
        $data['uid'] = isset($params['uid'])?$params['uid']:10;   //作者
        $result1 = $Article->data($data)->add();
        $wtag = M("ms_wtag");
        $list = array();
        foreach ($tlist as $key => $value) {
            $list[$key]['wid'] = $data['wid'];
            $list[$key]['tid'] = $value;
        }
        $result2 = $wtag->addAll($list);
        if ($result1 && $result2) {
            $Article->commit();
            $result = 1;
        }else{
            $Article->rollback();
            $result = 0;
        }
        return $result;
    }


    //编辑文章
    public function ArticleEdit($wid){
        $Article = M("ms_article");
        $del = 0;
        $where['wid'] = $wid;
        $where['is_del'] = 0;
        return $Article->where($where)
        ->field("wid,uid,cid,title,subhead,source,url,content,logo,attr,create_time,update_time,check_time,pv,link_url,start_time,end_time,is_check")
        ->find();
    }


    //编辑文章提交
    public function ArticleEditSub($params){
        $data = array();
        $tlist = explode(',',$params['tid']);
        $wid = $params['wid'];
        $Article = M("ms_article");
        $wtag = M("ms_wtag");
        $Article->startTrans();
        $list = array();
        $result1 = $wtag->where("wid=%d",$wid)->delete();
        if(!$result1){
            $result1 = 1;
        }
        foreach ($tlist as $key => $value) {
            $list[$key]['wid'] = $wid;
            $list[$key]['tid'] = $value;
        }
        $result2 = $wtag->add($list[$key]);
        $params['url'] = trim($params['url']);
        $params['link_url'] = trim($params['link_url']);
        $data['cid'] = $params['cid'];
        $data['title'] = $params['title'];
        $data['subhead'] = isset($params['subhead'])?$params['subhead']:"";
        $data['content'] = isset($params['content'])?$params['content']:"";
        $data['source'] = isset($params['source'])?$params['source']:"";
        $data['url'] = isset($params['url'])?$params['url']:"";
        $data['link_url'] = isset($params['link_url'])?$params['link_url']:"";
        $data['pv'] = isset($params['pv'])?$params['pv']:"";
        $data['attr'] = $params['attr'];

        if (!empty($params['logo'])) {
            $data['logo'] = $params['logo'];
        }
        $data['update_time'] = time();                  //更新时间
        $data['start_time'] = $params['start_time'];    //专题开始时间
        $data['end_time'] = $params['end_time'];        //专题结束时间
        if ($params['is_check'] == 2) {                 //驳回再编辑的文章或专题变成未审核
            $data['is_check']=0;
        }
        // dump($wid);
        $where["wid"]=$wid;
        $result3 = $Article->where($where)->data($data)->save();
        if ($result1 && $result2 && $result3) {
            $Article->commit();
            $result = 1;
        }else{
            $Article->rollback();
            $result = 0;
        }
        return $result;
    }



    /**
     * @copyright Topics 专题管理
     * @author donghui
     * @version 2015年11月19日
     */


    //专题列表
    public function Topicslist($num,$condition){
        $Model = M('ms_article');
        $condition['t_ms_article.is_del'] = 0;
        $condition['t_ms_attr.is_sub'] = 1;
        $count = $Model ->join("t_ms_attr on (t_ms_article.attr = t_ms_attr.id and t_ms_attr.is_del = 0)")
                        ->join("t_ms_author on t_ms_article.uid = t_ms_author.uid")
                        ->join("t_ms_cate on (t_ms_article.cid = t_ms_cate.cid and t_ms_cate.is_del = 0)")
                        ->where($condition)
                        ->count();
        import("ORG.Util.Page");
        $page = new Page($count,$num);
        $showPage = $page->show();
        $list =  $Model ->Field('t_ms_article.wid,t_ms_article.title,t_ms_article.create_time,t_ms_article.tpv,t_ms_article.is_check,
                        t_ms_article.sort,t_ms_article.is_show,t_ms_author.nikename,t_ms_cate.cate_name,t_ms_attr.name')
                        ->join("t_ms_attr on (t_ms_article.attr = t_ms_attr.id and t_ms_attr.is_del = 0)")
                        ->join("t_ms_author on t_ms_article.uid = t_ms_author.uid")
                        ->join("t_ms_cate on (t_ms_article.cid = t_ms_cate.cid and t_ms_cate.is_del = 0)")
                        ->where($condition)
                        ->limit("$page->firstRow, $page->listRows")
                        ->order('t_ms_article.sort asc,t_ms_article.create_time desc')
                        ->select();
        $data=array();
        $data["showPage"]=$showPage;
        $data["list"]    =$list;

        return $data; 
    }

    //专题文章管理
    public function TopicsArManage($num,$condition){
        $Model = M('ms_article');
        $condition['t_ms_article.is_del'] = 0;
        $count = $Model->join("t_ms_sublist on t_ms_article.wid = t_ms_sublist.wid")->where($condition)->count();
        import("ORG.Util.Page"); 
        $page = new Page($count,$num);
        $showPage = $page->show();
        $list = $Model->Field('t_ms_sublist.id,t_ms_article.wid,t_ms_article.title,t_ms_article.create_time,t_ms_sublist.sort,t_ms_author.nikename,t_ms_cate.cate_name,t_ms_attr.name')
                      ->join("t_ms_sublist on t_ms_article.wid = t_ms_sublist.wid")
                      ->join("t_ms_attr on (t_ms_article.attr = t_ms_attr.id and t_ms_attr.is_del = 0)")
                      ->join("t_ms_author on t_ms_article.uid = t_ms_author.uid")
                      ->join("t_ms_cate on (t_ms_article.cid = t_ms_cate.cid and t_ms_cate.is_del = 0)")
                      ->where($condition)
                      ->limit("$page->firstRow, $page->listRows")
                      ->order('t_ms_sublist.sort asc,t_ms_sublist.create_time desc')
                      ->select();
        $data=array();
        $data["showPage"]=$showPage;
        $data["list"]    =$list;

        return $data; 
    }

    //专题文章排序
    public function TopicsArSort($params){
        $Sublist = M("ms_sublist");
        $id = $params['id'];
        $sort = $params['sort'];
        $res = $Sublist->where("id=%d",$id)->setField('sort',$sort);
        if ($res) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result; 
    }
    
    //删除专题的文章
    public function TopicsArDel($id){
        $Sublist = M("ms_sublist");
        $res = $Sublist->where("id=%d",$id)->delete();
        if ($res) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result; 
    }

    //为专题添加文章 $sid专题ID
    public function AddArForTopics($params){
        $Sublist = M("ms_sublist");
        $sub = $params['is_sub'];
        $sid = $params['sid'];
        $wid = $params['wid'];
        $data = array();
        if ($sub == 1) {
        	$data['wid'] = $wid;
        	$data['sid'] = $sid;
        	$data['create_time'] = time();
        	if ($Sublist->add($data)) {
            	$result = 1;
	        }else{
	            $result = 0;
	        }
        }elseif($sub == 0){
        	if ($Sublist->where("wid=%d",$wid)->delete()) {
        		$result = 1;
        	}else{
        		$result = 0;
        	}
        }else{
        	$result = 0;
        }  
        return $result; 
    }

    //专题添加文章列表
	public function TopicsArlist($num,$condition,$sid){
        $Model = M('ms_article');
        $condition['t_ms_article.is_del'] = 0;		// 未删除
        $condition['t_ms_article.is_check'] = 1;	// 审核通过
        $condition['t_ms_attr.is_sub'] = 0;			// 文章
        //所有文章数
        $count = $Model->join("t_ms_attr on (t_ms_article.attr = t_ms_attr.id and t_ms_attr.is_del = 0)")->where($condition)->count();
        import("ORG.Util.Page");
        $page = new Page($count,$num);
        $showPage = $page->show();
        $list = $Model->Field('t_ms_article.wid,t_ms_article.title,t_ms_article.create_time,t_ms_author.nikename,t_ms_cate.cate_name,t_ms_attr.name')
                        ->join("t_ms_attr on (t_ms_article.attr = t_ms_attr.id and t_ms_attr.is_del = 0)")
                        ->join("t_ms_author on t_ms_article.uid = t_ms_author.uid")
                        ->join("t_ms_cate on (t_ms_article.cid = t_ms_cate.cid and t_ms_cate.is_del = 0)")
                        ->where($condition)
                        ->limit("$page->firstRow, $page->listRows")
                        ->order('t_ms_article.sort asc,t_ms_article.create_time desc')
                        ->select();
        
        //将当前专题中的文章标记出来
        $Sublist = M("ms_sublist");
        $result = $Sublist->Field('wid')->where("sid=%d",$sid)->select();
        foreach ($list as $key => $value) {
			foreach ($result as $k => $v) {
				if($result[$k]["wid"]==$list[$key]["wid"]){
					$list[$key]["sub"]=1;
				}
			}
		}

		$data=array();
        $data["showPage"]=$showPage;
        $data["list"]    =$list;

        return $data; 
    }



    /**
     * @copyright Check 审核管理
     * @author donghui
     * @version 2015年11月20日
     */

    //文章审核
    public function ArChecklist($num,$condition){
        $Model = M('ms_article');
        $condition['t_ms_article.is_del'] = 0;      // 未删除文章
        $condition['t_ms_attr.is_del'] = 0;         // 未删除属性
        //所有文章数
        $count = $Model ->join("t_ms_attr on (t_ms_article.attr = t_ms_attr.id and t_ms_attr.is_sub = 0)")
                        ->join("t_ms_author on t_ms_article.uid = t_ms_author.uid")
                        ->join("t_ms_cate on (t_ms_article.cid = t_ms_cate.cid and t_ms_cate.is_del = 0)")
                        ->where($condition)
                        ->count();
        import("ORG.Util.Page");
        $page = new Page($count,$num);
        $showPage = $page->show();
        $list = $Model  ->Field('t_ms_article.wid,t_ms_article.title,t_ms_article.create_time,t_ms_article.check_time,t_ms_article.is_check,t_ms_author.nikename,
            t_ms_cate.cate_name,t_ms_attr.name')
                        ->join("t_ms_attr on (t_ms_article.attr = t_ms_attr.id and t_ms_attr.is_sub = 0)")
                        ->join("t_ms_author on t_ms_article.uid = t_ms_author.uid")
                        ->join("t_ms_cate on (t_ms_article.cid = t_ms_cate.cid and t_ms_cate.is_del = 0)")
                        ->where($condition)
                        ->limit("$page->firstRow, $page->listRows")
                        ->order('t_ms_article.create_time desc')
                        ->select();
        $data=array();
        $data["showPage"]=$showPage;
        $data["list"]    =$list;
        return $data; 
    }

    //查询文章单条(根据wid)
    public function ArticleData($wid){
        $condition['t_ms_attr.is_sub'] = 0;         // 文章
        $condition['t_ms_article.wid'] = $wid;      // 查询
        $data =  M('ms_article')->Field('t_ms_article.wid,t_ms_article.title,t_ms_article.subhead,t_ms_article.source,t_ms_article.url,
            t_ms_author.uid,t_ms_author.nikename,t_ms_cate.cate_name,t_ms_attr.name,t_ms_article.content,t_ms_article.logo,t_ms_article.refusal,
            t_ms_article.is_check,t_ms_article.check_time,t_ms_article.create_time,t_ms_article.update_time')
                                ->join("t_ms_attr on (t_ms_article.attr = t_ms_attr.id and t_ms_attr.is_del = 0)")
                                ->join("t_ms_author on t_ms_article.uid = t_ms_author.uid")
                                ->join("t_ms_cate on (t_ms_article.cid = t_ms_cate.cid and t_ms_cate.is_del = 0)")
                                ->where($condition)
                                ->find();
        $con['t_ms_wtag.wid'] = $wid;
        $data['tag'] = M('ms_tag')->Field('t_ms_tag.tag_name')
                            ->join("t_ms_wtag on (t_ms_wtag.tid = t_ms_tag.tid and t_ms_tag.is_del = 0)")
                            ->where($con)
                            ->select();
        return $data; 
    }

    //文章审核提交
    public function ArticleCheck($params){
        if (empty($params['check_time'])) {
            $params['check_time'] = time();
        }else{
            $params['check_time'] = strtotime($params['check_time']);
        }
        $result = 0;
        if (M('ms_article')->where(array('wid'=>$params['wid']))->data($params)->save()) {
            $Author = M("ms_author");
            if ($params['is_check'] == 1) {
                $con['uid'] = $params['uid'];
                $Author->where($con)->setInc('tcount',1);
                $Author->where($con)->setDec('mcount',1);
            }
            $result = 1;
        }
        return $result;
    }

    //专题审核提交
    public function TopicsCheckSub($params){
        if (empty($params['check_time'])) {
            $params['check_time'] = time();
        }else{
            $params['check_time'] = strtotime($params['check_time']);
        }
        $result = 0;
        if (M('ms_article')->where(array('wid'=>$params['wid']))->data($params)->save()) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result;
    }


    //专题审核
    public function TopicsCheck($num,$condition){
        $Model = M('ms_article');
        $condition['t_ms_article.is_del'] = 0;  //未删除的专题
        $condition['t_ms_attr.is_del'] = 0;
        $count = $Model->join("t_ms_attr on (t_ms_article.attr = t_ms_attr.id and t_ms_attr.is_sub = 1)")->where($condition)->count();
        import("ORG.Util.Page");
        $page = new Page($count,$num);
        $showPage = $page->show();
        $list = $Model->Field('t_ms_article.wid,t_ms_article.title,t_ms_article.check_time,t_ms_article.create_time,t_ms_article.update_time,t_ms_article.is_check,
                           t_ms_author.nikename,t_ms_cate.cate_name,t_ms_attr.name')
                        ->join("t_ms_attr on (t_ms_article.attr = t_ms_attr.id and t_ms_attr.is_sub = 1)")
                        ->join("t_ms_author on t_ms_article.uid = t_ms_author.uid")
                        ->join("t_ms_cate on (t_ms_article.cid = t_ms_cate.cid and t_ms_cate.is_del = 0)")
                        ->where($condition)
                        ->limit("$page->firstRow, $page->listRows")
                        ->order('t_ms_article.create_time desc')
                        ->select();
        $data=array();
        $data["showPage"]=$showPage;
        $data["list"]    =$list;
        return $data; 
    }

    //查询文章单条(根据专题ID)
    public function TopicsData($sid){
        $condition['t_ms_attr.is_del'] = 0;
        $condition['t_ms_article.wid'] = $sid;      // 查询
        $data =  M('ms_article')->Field('t_ms_article.wid,t_ms_article.title,t_ms_article.subhead,t_ms_article.source,t_ms_article.link_url,
            t_ms_author.nikename,t_ms_cate.cate_name,t_ms_attr.name,t_ms_article.content,t_ms_article.logo,t_ms_article.refusal,
            t_ms_article.is_check,t_ms_article.check_time,t_ms_article.create_time,t_ms_article.start_time,t_ms_article.end_time')
                                ->join("t_ms_attr on (t_ms_article.attr = t_ms_attr.id and t_ms_attr.is_sub = 1)")
                                ->join("t_ms_author on t_ms_article.uid = t_ms_author.uid")
                                ->join("t_ms_cate on (t_ms_article.cid = t_ms_cate.cid and t_ms_cate.is_del = 0)")
                                ->where($condition)
                                ->find();
        $con['t_ms_wtag.wid'] = $sid;
        $data['tag'] = M('ms_tag')->Field('t_ms_tag.tag_name')
                            ->join("t_ms_wtag on (t_ms_wtag.tid = t_ms_tag.tid and t_ms_tag.is_del = 0)")
                            ->where($con)
                            ->select();
        return $data; 
    }

    //评论审核
    public function CommentCheck($num,$condition){
        $Model = M('ms_comment');
        $condition['t_ms_article.is_del'] = 0;
        $count = $Model ->join("t_ms_article on (t_ms_comment.wid = t_ms_article.wid and t_ms_comment.is_del = 0)")
                        ->where($condition)->count();
        import("ORG.Util.Page");
        $page = new Page($count,$num);
        $showPage = $page->show();
        $list = $Model->Field('t_ms_comment.id,t_ms_article.title,t_user.nikename,t_ms_comment.content,t_ms_comment.time,
            t_ms_comment.status')
                        ->join("t_ms_article on (t_ms_comment.wid = t_ms_article.wid and t_ms_comment.is_del = 0)")
                        ->join("t_user on t_ms_comment.uid = t_user.id")
                        ->where($condition)
                        ->limit("$page->firstRow, $page->listRows")
                        ->order('t_ms_comment.time desc')
                        ->select();
        $data=array();
        $data["showPage"]=$showPage;
        $data["list"]    =$list;

        return $data; 
    }

    //查询单条评论
    public function CommentData($id){
        $data =   M('ms_comment')->Field('t_ms_comment.id,t_ms_comment.wid,t_ms_comment.uid,t_ms_comment.content,t_ms_comment.time,
            t_ms_comment.status,t_ms_comment.refusal')->where("id=%d",$id)->find();
        $wid = $data['wid'];    $uid = $data['uid']; 
        $data['title'] = M('ms_article')->where("wid=".$wid)->getField('title');
        $data['nikename'] = M('user')->where("id=".$uid)->getField('nikename');
        return $data;
    }

    //获取全部TAB
    public function TablistAll(){
        $con = array();
        $con['is_show'] = 1;
        $con['is_del'] = 0;
        $ctab =  M("ms_ctab")->Field("id,tab_name")->order('sort asc')->where($con)->select();
        return $ctab;
    }
    //侧TAB管理
    public function TopicsTablist($num,$condition){
        $Model = M('ms_tablist');
        $condition['t_ms_ctab.is_del'] = 0;  //未删除的侧TAB
        $condition['t_ms_tablist.is_del'] = 0;  //未删除的侧TAB下内容
        $count = $Model->join("t_ms_ctab on t_ms_ctab.id = t_ms_tablist.tid")->where($condition)->count();
        import("ORG.Util.Page");
        $page = new Page($count,$num);
        $showPage = $page->show();
        $list = $Model->Field('t_ms_tablist.id,t_ms_tablist.tid,t_ms_ctab.tab_name,t_ms_tablist.title,t_ms_tablist.sort,t_ms_tablist.sort,t_ms_tablist.url,
                          t_ms_tablist.is_show')
                        ->join("t_ms_ctab on t_ms_ctab.id = t_ms_tablist.tid")
                        ->where($condition)
                        ->limit("$page->firstRow, $page->listRows")
                        ->order('t_ms_tablist.sort asc,t_ms_tablist.create_time desc')
                        ->select();

        $data=array();
        $data["showPage"]=$showPage;
        $data["list"]    =$list;
        return $data; 
    }

    //侧TAB添加
    public function AddTopicTab($params){
        $tablist = M("ms_tablist"); 
        $data = array();
        $data['tid'] = $params['tid'];
        $data['title'] = $params['title'];
        $data['url'] = $params['url'];
        $data['create_time'] = time();
        if ($tablist->add($data)) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result;
    }

    //侧TAB排序
    public function TopicTabOrder($params){
        $tag = M("ms_tablist"); 
        $data = array();
        $sort = $params['sort'];
        $id = $params['id'];
        $res = $tag->where("id=%d",$id)->setField('sort',$sort);
        if ($res) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result;
    }

    //侧TAB是否显示
    public function TopicTabShow($params){
        $tag = M("ms_tablist"); 
        $data = array();
        $is_show = $params['is_show'];
        $id = $params['id'];
        $res = $tag->where("id=%d",$id)->setField('is_show',$is_show);
        if ($res) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result;
    }

    //TAB单条
    public function TopicTabData($id){
        $tablist = M("ms_tablist"); 
        $result =  $tablist->where("id=%d",$id)->find();
        return $result;
    }

    //TAB编辑
    public function TopicTabEditSub($params){
        $tablist = M("ms_tablist");
        $data = array();
        $data['title'] = $params['title'];
        $data['url'] = $params['url'];
        $data['update_time'] = time();
        $id = $params['id'];
        if ($tablist->where("id=%d",$id)->data($data)->save()) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result;
    }

    //侧TAB删除
    public function TopicTabDel($id){

        $tablist = M("ms_tablist");
        $res = $tablist->where("id=%d",$id)->setField('is_del',1);
        if ($res) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result; 
    }

    //评论删除
    public function DelCommentData($id){
        $Comment = M("ms_comment");
        $res = $Comment->where("id=%d",$id)->setField('is_del',1);
        if ($res) {
            $result = 1;
        }else{
            $result = 0;
        }
        return $result; 
    }




































}
?>