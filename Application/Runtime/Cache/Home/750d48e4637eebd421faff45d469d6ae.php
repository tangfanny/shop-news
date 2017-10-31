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
<!-- by xiaoming -->
<nav class="Hui-breadcrumb"><i class="icon-home"></i> 首页 <span class="c-gray en">&gt;</span>
<a href="<?php echo U('/Banner/Index');?>">banner</a> <span class="c-gray en">&gt;</span> 添加banner
<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
<center>
    <form action="<?php echo U('/Banner/add');?>" method="post" enctype="multipart/form-data">
    				<div> banner图片:
              <input type="file" class="am-hide" id="pickfiles" >
              <input type="hidden" id='chengxing' name="path">
              <div id="container">
              </div>
              <div>
                  <img src="" id="imgpreview" alt="">
              </div>
              </div>
             <!--app_banner:-->
              <!--<input type="file" class="am-hide" id="pickfiles" >-->
              <!--<input type="hidden" id='chenxing' name="logo">-->
              <!--<div id="container">-->
              <!--</div>-->
              <!--<div>-->
                  <!--<img src="" id="imgpreview" alt="">-->
              <!--</div>-->
       链接地址:<input type="text" class="input-text radius" name="url"><br><br>
          标题:<input type="text" class="input-text radius" name="title"><br><br>
          顺序:<input type="text" class="input-text radius" name="rankid"><br><br>
          简介:<textarea  class="input-text radius" rows="3" cols="60" name="desc"></textarea><br><br>
          <input type="submit" class="btn btn-primary" value="提交">
    </form>
</center>
<script src="__PUBLIC__/jcorp/j/jquery.Jcrop.js"></script>
<script src="__PUBLIC__/js/ns-jcorp-admin.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/H-ui.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/jcorp/j/jquery.Jcrop.js"></script>
<link rel="stylesheet" href="__PUBLIC__/jcorp/c/jquery.Jcrop.css" type="text/css" />
<script src="__PUBLIC__/js/ns-uploadfile.js"></script>
<script type="text/javascript" src="__QINIU__plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="__QINIU__plupload/js/i18n/zh_CN.js"></script>
<script type="text/javascript" src="__QINIU__ui.js"></script>
<script type="text/javascript" src="__QINIU__qiniu.js"></script>
<script type="text/javascript" src="__QINIU__highlight.js"></script>
<script type="text/javascript" src="__QINIU__main-upload.js"></script>
</div>
</body>

</body>
</html>