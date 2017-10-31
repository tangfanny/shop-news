<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="__PUBLIC__/js/html5.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/respond.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/PIE_IE678.js"></script>
<![endif]-->
<link href="__PUBLIC__/css/H-ui.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/css/ns_custom.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/css/ns_common.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/css/1.0.2/iconfont.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="__PUBLIC__/font/font-awesome.min.css"/>
<script type="text/javascript" src="__SCON__/secwk.config.js" ></script>
<script type="text/javascript" src="__SCON__/secwk.js" ></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<!--[if IE 7]>
<link href="__PUBLIC__/font/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if IE 6]>
<script type="text/javascript" src="__PUBLIC__/js/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>admin</title>
<script type="text/javascript">
setDomain();
</script> 
</head>

<body>
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="__PUBLIC__/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo MIXED;?>ue/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo MIXED;?>ue/ueditor.all.js"></script>
<nav class="Hui-breadcrumb"><i class="icon-home"></i> 首页 <span class="c-gray en">&gt;</span>
<a href="<?php echo U('/Topics/Index');?>">专题管理</a> <span class="c-gray en">&gt;</span> 添加专题
<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
    <table class="table"> 
      <tbody>
        <tr>
          <td class="ns-ft-16">起始时间：</td>
          <td colspan="2">
            <div class="l ns-mr-10 ns-mt-05 ns-ft-16">
                开始时间：<input class="Wdate input-text radius" id="start_time" type="text" onClick="WdatePicker()" readonly>
            </div>
            <div class="l ns-ml-10 ns-mt-05 ns-ft-16">
                结束时间：<input class="Wdate input-text radius" id="end_time" type="text" onClick="WdatePicker()" readonly>
            </div>
          </td>
        </tr>
        <tr class="text-l">
          <td width="90" class="ns-ft-16">选择分类：</td>
          <td colspan="2" class="ns-ft-14">
              <select class="select" size="1" name="cate" id="cate" onChange="javascript:c(this);">
                  <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["cid"]); ?>"><?php echo ($vo["cate_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
              </select>
          </td>
        </tr>
        <tr class="text-l">
          <td class="ns-ft-16">选择标签：</td>
          <td colspan="2">
            <div id="category">
                <?php if(is_array($Tag)): $i = 0; $__LIST__ = $Tag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="l ns-mr-10 ns-mt-05 ns-ft-15">
    <input type="checkbox" id="tag" name="tag" value="<?php echo ($vo['tid']); ?>" onClick="countChoices(this)" /> <?php echo ($vo["tag_name"]); ?>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <span class="l ns-ml-22 ns-mt-05">（最多可以选3个）</span>
          </td>
        </tr>
        <tr class="text-l">
          <td class="ns-ft-16">编辑标题：</td>
          <td colspan="2">
            <input type="text" style="width:800px" id="title" class="input-text radius" name="title" placeholder="输入文章标题，不得超过48个汉字">
          </td>
        </tr>
        <tr class="text-l">
          <td class="ns-ft-16">编辑摘要：</td>
          <td colspan="2">
            <textarea style="width:800px" id="subhead" class="input-text radius" rows="3" cols="60" name="subhead" placeholder="输入文章摘要"></textarea>
          </td>
        </tr>
        <tr class="text-l">
          <td class="ns-ft-16">上传LOGO：</td>
            <td>
                <input type="file" class="am-hide" id="pickfiles" >
                <input type="hidden" id='chengxing' name="logo">
                <div id="container">
                </div>
                <div>
                    <img src="" id="imgpreview" alt="">
                </div>
                <div class="ns-mt-10" id="di_img_con"></div>
            </td>
            <td>
                <span class="ns-ml-10 Huialert Huialert-danger radius" style="color:red;font-size:17px;">选择图片时请按照180*120的像素上传!</span>
            </td>
        </tr>
        <tr class="text-l">
          <td class="ns-ft-16">编辑正文：</td>
          <td colspan="2">
            <script id="am-container" name="content" type="text/plain" style="width:1024px;height:450px;"></script>
          </td>
        </tr> 
        <tr class="text-l">
          <td class="ns-ft-16">专题属性：</td>
          <td colspan="2">
            <select class="select" size="1" name="attr" id="attr">
                <?php if(is_array($attr)): $i = 0; $__LIST__ = $attr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            <span class="ns-ml-20 ns-ft-16">访问量：<input type="text" id="pv" style="width:200px;" class="input-text radius" name="pv" value="<?php echo ($pv); ?>"></span>
          </td>
        </tr>
        <tr class="text-l">
          <td class="ns-ft-16">外链URL：</td>
          <td colspan="2" class="ns-ft-16">
            <input type="text" id="link_url" style="width:600px;" class="input-text radius" name="link_url" placeholder=" 输入外链url地址" >
            <i class="Hui-iconfont ns-ml-10">&#xe67a;</i>
<span class="ns-ml-10 Huialert Huialert-danger radius" style="color:red;">温馨提示：为空即内部专题，输入url为外链</span>
          </td>
        </tr>
        <tr class="text-l">
          <td class="ns-ft-16">
          </td>
          <td colspan="2">
              <div id="post_submit" class="filePicker">提交审核</div>
          </td>
        </tr>
      </tbody>
    </table>
</div>
<script type="text/javascript">
  function countChoices(obj) {
     $("input[name='tag']").attr('disabled', true);
     if($("input[name='tag']:checked").length >= 3) {
          $("input[name='tag']:checked").attr('disabled', false);
        }else{
          $("input[name='tag']").attr('disabled', false);
        }
    };

  function c(e){
    var cid = $(e).val();
    var url ="<?php echo U('Topics/ArticleTag');?>";
        $.ajax({
            type:"post",
            url:url,
            data:{'cid':cid},
            success: function(data){
              $("#category").empty(); 
              var json = eval(data);
              for(var i = 0;i<json.length;i++){
                 $("#category").append("<div class='l ns-mr-10 ns-mt-05 ns-ft-15'><input type='checkbox' name='tag' data-type='checkbox' data-value="+json[i]["tid"]+" value="+json[i]["tid"]+" onClick='countChoices(this)'>"+"&nbsp;"+json[i]["tag_name"]+"</div>"); ;
              }
            },
        });
  }
</script>
<!-- 图片上传  -->
<script src="__PUBLIC__/jcorp/j/jquery.Jcrop.js"></script>
<link rel="stylesheet" href="__PUBLIC__/jcorp/c/jquery.Jcrop.css" type="text/css" />
<script src="__PUBLIC__/js/ns-jcorp-admin.js"></script>
<script>
    ns_jcorp($("#btn_upload"),$("#ns_newfile"),$("#di_img_con"),$("#btn_jc_complete"),1,1,4,3);
</script>
<script type="text/javascript">
    var ue = UE.getEditor('am-container');
function isURL(str_url) {
    var strRegex = "^((https|http|ftp|rtsp|mms)?://)";
      var re = new RegExp(strRegex);
      if(!re.test(str_url)){
        str_url = 'http://'+str_url;
      }
      return str_url;
} 
function NetPing(url,e) {
        $.ajax({
             async: false,
             url: url,
             dataType: "jsonp",
             statusCode:{
              404:function(){
                alert('链接无效');
              },
              200:function(){
                e.val(url);
              }
             }
         });
}  
var lu = $("#link_url");

lu.change(function(){
  lu.blur(function(){
      link_url = isURL(lu.val());
      NetPing(link_url,lu);
  })  
});       
//添加专题ajax
$("#post_submit").click(function(){
    var link_url = lu.val();   
    var start_time = $("#start_time").val();
    if(start_time == null || start_time == ''){
      alert('开始时间不能为空！');return false;
    };
    var end_time = $("#end_time").val();
    if(end_time == null || end_time == ''){
      alert('结束时间不能为空！');return false;
    };

    var date1 = new Date(Date.parse(start_time));  
    var date2 = new Date(Date.parse(end_time)); 

    if (date1.getTime() > date2.getTime()) {  
            alert("结束时间不得小于开始时间。");  
            return false;
        }

    var tid="";
        var i=0;
        $("input[type=checkbox]").each(function(){
            if($(this).prop("checked")){
                tid+=","+$(this).val();
                i++;
            }
        });
    if(tid == null || tid == ''){alert("请选择标签！");return false;}
    var title = $("#title").val();
    if (title.length > 48) {
      alert('标题最大长度为48个字！');return false;
    }else if(title == null || title == ''){
      alert('标题不能为空！');return false;
    };

    var cid = $("#cate option:selected").val();
    var logo = $("#chengxing").val();
    var attr = $("#attr").val();
    var subhead = $("#subhead").val();
    var pv = $("#pv").val();
    var content = ue.getContent();
    var url ="<?php echo U('Topics/TopicsSub');?>";
        $.ajax({
            type:"post",
            url:url,
            data:{'cid':cid,'tid':tid,'start_time':start_time,'end_time':end_time,'title':title,'logo':logo,'attr':attr,'content':content,'subhead':subhead,'link_url':link_url,'pv':pv},
            success: function(data){
              if(data == 1){
                alert("发布成功！");
                window.location.href="<?php echo U('Topics/Index');?>";
              }else{
                alert("发布失败，请检查后再试");
              }
            },
            error:function(data){
                alert("发布失败！请联系管理员")
              }
        });
  });
</script>
<script type="text/javascript" src="__PUBLIC__/js/H-ui.js"></script>
<script type="text/javascript" src="__QINIU__plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="__QINIU__plupload/js/i18n/zh_CN.js"></script>
<script type="text/javascript" src="__QINIU__ui.js"></script>
<script type="text/javascript" src="__QINIU__qiniu.js"></script>
<script type="text/javascript" src="__QINIU__highlight.js"></script>
<script type="text/javascript" src="__QINIU__main-upload.js"></script>

</body>
</html>