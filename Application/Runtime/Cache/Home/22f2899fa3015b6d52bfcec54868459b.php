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
<nav class="Hui-breadcrumb"><i class="icon-home"></i> 首页 <span class="c-gray en">&gt;</span> <a href="<?php echo U('/Banner/Index');?>">威客安全banner</a>
<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<sapn scope="col" colspan="4" style="margin-top:10px"><a href="<?php echo U('Banner/Footer');?>" style="margin:20px 0 0 20px;" class="btn btn-secondary radius ns-ml-05">添加banner</a></span>
<div class="pd-20">
  <table class="table table-border table-bordered table-hover table-bg">

    <thead>
      <tr class="text-c">
        <th style="width:50px;">顺序</th>
        <th>标题</th>
        <th>简介</th>
        <th>显示</th>
        <th>banner图片</th>
        
        <th>链接地址</th>
        <th style="width:88px;">操作</th>
      </tr>
    </thead>
    <tbody>
    <tr>
    <?php if(is_array($result)): foreach($result as $key=>$vo): ?><td class="ns-ft-14"><?php echo ($vo["rankid"]); ?></td>
      <td><span style="color:green"><?php echo ($vo["title"]); ?></span></td>
  		<td class="ns-ft-14"><?php echo ($vo["desc"]); ?></td>
      <td>
        <?php if($vo['is_show'] == 1){ ?>
          <input type="checkbox" is_show="<?php echo ($vo['is_show']); ?>" num="<?php echo ($vo['id']); ?>" checked="checked" onchange='javascript:b(this)';>
        <?php }else{ ?>
          <input type="checkbox" is_show="<?php echo ($vo['is_show']); ?>" num="<?php echo ($vo['id']); ?>" onchange='javascript:b(this)';>
        <?php } ?>
      </td>
      <td class="ns-ft-14"><img src="<?php echo IMG_URL.$vo['path'];?>" width="50px" alt=""></td>
  		
  		<td class="ns-ft-14"><?php echo ($vo["url"]); ?></td>
          <td class="f-14">
            <a class="l ns-ml-10" title="编辑" href="<?php echo U('Banner/Edit',Array('id'=>$vo['id']));?>"><i class="ml-5 icon-edit"></i></a><i class="l ns-ml-10 ">|&nbsp;</i>
            <a title="删除" href="javascript:;" id="<?php echo ($vo["id"]); ?>" onClick="adver_del(this)" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a>
          </td>
        </tr><?php endforeach; endif; ?>
    </tbody>
  </table>
</div>

<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.min.js"></script> 
<script type="text/javascript" src="__PUBLIC__/js/H-ui.js"></script> 
<script type="text/javascript" src="__PUBLIC__/js/H-ui.admin.js"></script>
<!-- 是否显示 -->
<script type="text/javascript">
  function b(e){
    if(e.checked){
      $(e).attr('is_show',1);
    }
    else{
      $(e).attr('is_show',0); 
    }
    var id= $(e).attr('num');
    var is_show =$(e).attr('is_show');
    var url ="<?php echo U('Banner/CateShowAjax');?>";
      $.ajax({
          type:"post",
          url:url,
          data:{'id':id,'is_show':is_show},
          success: function(data){
          if(data == 1){
            location.replace(location.href);
          }else{
            alert("操作失败，请联系管理员");
            location.replace(location.href);
          }
        },

      });
  }
</script>
<script>
  $('#post_submit').click(function(){
    var condition = $("#condition").val();
    if(condition.length == 0){
       alert('请输入搜索条件！');return false;
    }
  })
</script>
<!-- 删除 -->
<script type="text/javascript">
  function adver_del(e){
      layer.confirm('确认要删除吗？',function(index){

          var url ="<?php echo U('Banner/Delete');?>";
          var id= $(e).attr('id');
          $.ajax({
              type:"post",
              url:url,
              data:{'id':id},
              success: function(data){
              if(data == 1){
                  $(e).parents("tr").remove();
                  layer.msg('已删除!',1);
              }else{
                  alert("操作失败，请联系管理员");
                  location.replace(location.href);
              }
            },

          });

      });
    }
</script>
</body>
</html>