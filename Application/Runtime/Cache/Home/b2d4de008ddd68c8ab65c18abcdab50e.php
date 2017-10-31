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
<nav class="Hui-breadcrumb"><i class="icon-home"></i> 首页 <span class="c-gray en">&gt;</span> <a href="<?php echo U('/ManageAr/Index');?>">文章管理</a>
<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh">刷新</i></a></nav>
<div class="pd-20">
  <div class="cl pd-5 bg-1 bk-gray">
    <span class="r">
      <form action="<?php echo U('/ManageAr/ArRecommendTitle');?>" method="get">
          <input type="text" style="width:300px" class="input-text radius" id="condition" name="condition" placeholder=" 输入标题查找文章">
          <button id="post_submit" class="btn btn-secondary radius" type="submit"><i class="Hui-iconfont Hui-iconfont-search"></i> 搜索文章</button>
        </form>
    </span>
  </div>
  <table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr class="text-c">
        <th>标题</th>
      </tr>
    </thead>
    <tbody>
    <?php if(is_array($title)): $i = 0; $__LIST__ = $title;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
        <td class="ns-ft-14 text-l" id="title" style="cursor:pointer;" onClick="sure('<?php echo ($vo["wid"]); ?>','<?php echo ($vo["title"]); ?>')"><?php echo ($vo["title"]); ?></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>

  </table>
</div>
<div class="pageNav"><?php echo ($Page); ?></div>
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.min.js"></script> 
<script type="text/javascript" src="__PUBLIC__/js/H-ui.js"></script> 
<script type="text/javascript" src="__PUBLIC__/js/H-ui.admin.js"></script>
<!-- 搜索文章 -->
<script type="text/javascript">
    $("#post_submit").click(function(){
      var condition = $("#condition").val();
        if(condition.length == 0){  
            alert('请输入搜索条件！');return false;
        }
    });
</script>
<script type="text/javascript">
   function sure(wid,title){
      window.parent.document.getElementById("ar_tid").value=wid;
      window.parent.document.getElementById("title").value=title;
      admin_edit_save();
    }
</script>

</body>
</html>