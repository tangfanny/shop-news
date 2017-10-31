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
<nav class="Hui-breadcrumb"><i class="icon-home"></i> 首页 <span class="c-gray en">&gt;</span>
<a href="<?php echo U('/ManageAr/Recommend');?>">首页推荐</a> <span class="c-gray en">&gt;</span> 编辑首页推荐文章
<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
  <form action="<?php echo U('ManageAr/ArRecommendEdit');?>" method="post" enctype="multipart/form-data">
    <table class="table">
      <tbody>
        <tr class="text-l">
          <td class="ns-ft-16"><button type="button" class="btn btn-secondary radius ns-ml-05" onClick="admin_role_edit('1','','','选择文章','<?php echo U('ManageAr/ArRecommendTitle');?>')"><i class="icon-plus"></i>点击选择文章</button></td>
          <td colspan="2" >
                <input type="hidden" name="wid" id="ar_tid" value="<?php echo ($alist["wid"]); ?>">
                <input type="text" style="width:800px" id="title" class="input-text radius" readonly="true" name="title" value="<?php echo ($alist["title"]); ?>" placeholder=" 选择文章标题">
          </td>

        </tr>
        <tr>
            <td class="ns-ft-16">开始时间：</td>
            <td colspan="2"><input class="Wdate input-text radius" id="start_time" type="text" name="start_time" onClick="WdatePicker()" value="<?php echo (date('Y-m-d',$alist["start_time"])); ?>" readonly></td>
        </tr>
         <tr>
            <td class="ns-ft-16">结束时间：</td>
            <td colspan="2"><input class="Wdate input-text radius" id="end_time" type="text" name="end_time" onClick="WdatePicker()" value="<?php echo (date('Y-m-d',$alist["end_time"])); ?>" readonly></td>
        </tr>
        <tr class="text-l">
          <td class="ns-ft-16">
          </td>
          <td colspan="2">
              <input type="hidden" name="sort" value="<?php echo ($sort); ?>">
               <button id="post_submit" class="btn btn-success radius"><i class="icon-ok"></i> 确定</button>
          </td>
        </tr>
      </tbody>
    </table>
    </form>
</div>

<script type="text/javascript">
//保存推荐
$("#post_submit").click(function(){
    var title = $("#title").val();
    if (title.length > 48) {
      alert('标题最大长度为48个字！');return false;
    }else if(title == null || title == ''){
      alert('标题不能为空！');return false;
    }

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
  });
</script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/H-ui.js"></script> 
<script type="text/javascript" src="__PUBLIC__/js/H-ui.admin.js"></script>


</body>
</html>