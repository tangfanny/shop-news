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

<body style="overflow:hidden"><header class="Hui-header cl">
<span class="Hui-userbox"><span class="c-white"><!-- 超级管理员： --><?php echo ($info['admin_name']); ?></span>
<a class="btn btn-danger radius ml-10" href="<?php echo U('/Login/logout');?>" title="退出"><i class="icon-off"></i> 退出</a></span> <a aria-hidden="false" class="Hui-nav-toggle" id="nav-toggle" href="#"></a> </header>
<div class="cl Hui-main">
  <aside class="Hui-aside" style="">
    <div class="menu_dropdown bk_2">
      <?php if(is_array($menu_list)): $i = 0; $__LIST__ = $menu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl id="menu-user">
          <dt><i class="icon-edit"></i> <?php echo ($vo["name"]); ?><b></b></dt>
          <dd>
            <ul>
              <?php if(is_array($vo["parenidlist"])): $i = 0; $__LIST__ = $vo["parenidlist"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><li>
                      <a _href="<?php echo U($vo2['action']);?>" href="javascript:;">
                          <?php echo ($vo2["name"]); ?>
                      </a>
                  </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
          </dd>
        </dl><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
  </aside>
  <div class="dislpayArrow"><a class="pngfix" href="javascript:void(0);"></a></div>
  <section class="Hui-article">
    <div id="Hui-tabNav" class="Hui-tabNav">
      <div class="Hui-tabNav-wp">
        <ul id="min_title_list" class="acrossTab cl">
          <li class="active"><span title="我的桌面" data-href="<?php echo U('/Index/welcome');?>">我的桌面</span><em></em></li>
        </ul>
      </div>
      <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default btn-small" href="javascript:;"><i class="icon-step-backward"></i></a><a id="js-tabNav-next" class="btn radius btn-default btn-small" href="javascript:;"><i class="icon-step-forward"></i></a></div>
    </div>
    <div id="iframe_box" class="Hui-articlebox">
      <div class="show_iframe">
        <div style="display:none" class="loading"></div>
        <iframe scrolling="yes" frameborder="0" src="<?php echo U('/Index/welcome');?>"></iframe>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/H-ui.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/H-ui.admin.js"></script>
</body>
</html>