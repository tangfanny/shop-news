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
<nav class="Hui-breadcrumb"><i class="icon-home"></i> 首页 <span class="c-gray en">&gt;</span> 平台底部管理 <span class="c-gray en">&gt;</span>
<a href="<?php echo U('Index/Footer');?>">底部管理</a> <span class="c-gray en">&gt;</span> 关于我们 <span class="c-gray en">&gt;</span> 增加
<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<script type="text/javascript" charset="utf-8" src="<?php echo MIXED;?>ue/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo MIXED;?>ue/ueditor.all.js"></script>
<div class="pd-20">
    <form action="<?php echo U('/Index/Footerd');?>" method="post" enctype="multipart/form-data">  
      <table class="table table-bg">
        <tbody>
          <tr>
            <th width="100" class="text-r">名称：</th>
            <td>
              <input type="text" class="input-text radius" name="name" placeholder="输入名称，最佳四个字" required="required">
            </td>
          </tr>
          <tr class="text-l">
            <th width="100" class="text-r">正文：</th>
            <td colspan="2">
              <script id="am-container" name="content" type="text/plain" style="width:1024px;height:450px;"></script>
            </td>
          </tr> 
          <tr>
            <th></th>
            <td>
                <input type="hidden" name="cid" value="1">
                <input type="hidden" name="key" value="0">
                <button id="post_submit" class="btn btn-success radius" type="submit"><i class="icon-ok"></i> 确定</button>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
</div>
<script type="text/javascript">
    var ue = UE.getEditor('am-container');
</script>

</body>
</html>