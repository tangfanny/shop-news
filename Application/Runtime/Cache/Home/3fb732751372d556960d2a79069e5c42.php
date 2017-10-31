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
<nav class="Hui-breadcrumb"><i class="icon-home"></i> 首页 <span class="c-gray en">&gt;</span>
<a href="<?php echo U('Article/Adver');?>"> 安全优佳banner</a>
<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="box_b_b">
	<!-- <div class="filePicker ns-mr-40">模板一</div> -->
		<a class="filePicker" href="<?php echo U('/Article/CelunAd');?>">侧轮播广告</a>
		<a class="filePicker ns-ml-25" href="<?php echo U('/Topics/CtabManage');?>">侧TAB管理</a>
		<div class="box_b_box">
	    	<a class="box_b_b1" title="位置一：684*371" href="<?php echo U('/Article/AdverList',Array('bid'=>$bid,'site'=>1));?>"></a>
	    	<a class="box_b_b2 ns-ml-10" title="位置二：208*181" href="<?php echo U('/Article/AdverList',Array('bid'=>$bid,'site'=>2));?>"></a>
	    	<a class="box_b_b3 ns-ml-10" title="位置三：208*181" href="<?php echo U('/Article/AdverList',Array('bid'=>$bid,'site'=>3));?>"></a>
	    	<a class="box_b_b4 ns-ml-10 ns-mt-10" title="位置四：425*181" href="<?php echo U('/Article/AdverList',Array('bid'=>$bid,'site'=>4));?>"></a>
    	</div>
</div>
</body>
</html>