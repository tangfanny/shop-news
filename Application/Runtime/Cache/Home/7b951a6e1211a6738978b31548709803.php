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
<nav class="Hui-breadcrumb"><i class="icon-home"></i> 首页 <span class="c-gray en">&gt;</span> <a href="<?php echo U('/ManageAr/Recommend');?>">文章首页推荐</a>
<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
  <!-- <div class="cl pd-5 bg-1 bk-gray">
  <span class="l">
      <a class="filePicker" href="<?php echo U('/ManageAr/ArRecommendAdd');?>">添加首页推荐文章</a>
    </span>
  </div> -->
  <table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr class="text-c">
        <th>标题</th>
        <th width="100">推荐排序</th>
        <th width="100">操作</th>
      </tr>
    </thead>
    <tbody>
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
          <td class="ns-ft-14 text-l"><span><?php echo ($vo["title"]); ?></span></td>

          <td class="ns-ft-14"><span><?php echo ($vo["recommend_sort"]); ?></span></td>

          <td class="f-14">
            <a class="l ns-ml-10" title="编辑" href="<?php echo U('ManageAr/ArRecommendEdit',Array('recommend_sort'=>$vo['recommend_sort'],'article_id'=>$vo['wid']));?>">编辑</a><i class="l ns-ml-10 ">|</i>
            <a title="删除" href="<?php echo U('ManageAr/ArRecommendDelData',Array('recommend_sort'=>$vo['recommend_sort'],'id'=>$vo['id']));?>"   class="ml-5" style="text-decoration:none">删除</a>
          </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>
</div>
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.min.js"></script> 
<script type="text/javascript" src="__PUBLIC__/js/H-ui.js"></script> 
<script type="text/javascript" src="__PUBLIC__/js/H-ui.admin.js"></script>


</body>
</html>