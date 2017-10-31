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
<script type="text/javascript" charset="utf-8" src="<?php echo MIXED;?>ue/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo MIXED;?>ue/ueditor.all.js"></script>
<nav class="Hui-breadcrumb"><i class="icon-home"></i> 首页 <span class="c-gray en">&gt;</span>
<a href="<?php echo U('/ManageAr/Index');?>">文章管理</a> <span class="c-gray en">&gt;</span> 发布文章
<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
    <table class="table">
      <tbody>
        <tr class="text-l">
          <td width="100" class="ns-ft-16">选择分类：</td>
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
            <input type="text" style="width:800px" id="title" class="input-text radius" name="title" placeholder=" 输入文章标题，不得超过48个汉字">
          </td>
        </tr>
        <tr class="text-l">
          <td class="ns-ft-16">文章摘要：</td>
          <td colspan="2">
            <textarea style="width:800px" id="subhead" class="input-text radius" rows="3" cols="60" name="subhead" placeholder=" 输入文章摘要"></textarea>
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
          <td class="ns-ft-16">选择属性：</td>
          <td colspan="2" class="ns-ft-16">
            <select class="select" size="1" name="attr" id="attr">
                <?php if(is_array($attr)): $i = 0; $__LIST__ = $attr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            <span class="ns-ml-20">访问量：<input type="text" id="pv" style="width:200px;" class="input-text radius" name="pv"></span>
          </td>
        </tr>
        <tr>
          <td class="ns-ft-16">文章来源：</td>
          <td colspan="2">
             <input type="text" style="width:400px" class="input-text radius" id="source" name="source" placeholder=" 输入文章来源"> 
              —<input type="text" style="width:700px" class="input-text radius ns-ml-05" id="url" name="url" placeholder=" 文章来源的URL地址：http://">
          </td>
        </tr>
        <tr class="text-l">
          <td colspan="3" class="ns-ft-16">
          <div style="float:left;line-height:40px;height:45px;">
            <div class="l ns-mt-05">
                是否打开<span style="color:red;">外链</span>：
                <span class="ns-ml-10"> <input type="radio" name="outurl" value="1"> 是</span>
                <span class="ns-ml-10 ns-mr-22"> <input type="radio" name="outurl" value="2"> 否 </span>
            </div>
                <input type="text" id="link_url" style="width:800px;" class="input-text radius ns-hide" name="link_url" placeholder=" 外链URL">
          </div>
          </td>
        </tr>
        <tr class="text-l">
          <td class="ns-ft-16">
          </td>
          <td colspan="2">
              <div id="post_submit" class="filePicker">发布文章</div>
          </td>
        </tr>
      </tbody>
    </table>
</div>

<script type="text/javascript">
  $(document).ready(function(){
      $(':radio[name="outurl"]').eq(1).attr("checked",true);
  });

  $(':radio[name="outurl"]').click(function(){
    var outurl = $(':radio[name="outurl"]:checked').val();
    if (outurl == 1) {
        $("#link_url").removeClass("ns-hide");
    }else{
        $("#link_url").addClass("ns-hide");
    }
  });
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
    var url ="<?php echo U('ManageAr/ArticleTag');?>";
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

<script type="text/javascript">
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

var ue = UE.getEditor('am-container'); 
//发布文章ajax
var lu = $("#link_url");
var au = $("#url");

lu.change(function(){
  lu.blur(function(){
      link_url = isURL(lu.val());
      NetPing(link_url,lu);
  })  
}),au.change(function(){
      au.blur(function(){
          aurl = isURL(au.val());
          NetPing(aurl,au);
    })
});

    var ue = UE.getEditor('am-container');
//发布文章ajax
$("#post_submit").click(function(){
        link_url = lu.val();
        aurl = au.val();
        var tid="";
        var i=0;
        $("input[type=checkbox]").each(function(){
            if($(this).prop("checked")){
                tid+=","+$(this).val();
                i++;
            }
        });

    var cid = $("#cate option:selected").val();
    if(tid == null || tid == ''){alert("请选择标签！");return false;}
    var title = $("#title").val();
    if (title.length > 48) {
      alert('标题最大长度为48个字！');return false;
    }else if(title == null || title == ''){
      alert('标题不能为空！');return false;
    }; 
    var source = $("#source").val();
    if (aurl != "" && source == '') {
        alert('url存在时文章来源不能为空');return false;
    };
    var logo = $("#chengxing").val();
    var attr = $("#attr").val();
    var subhead = $("#subhead").val();
    if (subhead == '') {
      alert("摘要不能为空！");
      return;
    }
    var content = ue.getContent();
    var pv = $("#pv").val();
    var url ="<?php echo U('ManageAr/ArticleSub');?>";
        $.ajax({
            type:"post",
            url:url,
            data:{'cid':cid,'tid':tid,'title':title,'logo':logo,'source':source,'attr':attr,'url':aurl,'subhead':subhead,'content':content,'pv':pv,'link_url':link_url},
            success: function(data){
              if(data == 1){
                alert("发布成功！");
                window.location.href="<?php echo U('ManageAr/Index');?>";
              }else{
                alert("发布失败，请检查后再试");
              }
            },error:function(data){
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