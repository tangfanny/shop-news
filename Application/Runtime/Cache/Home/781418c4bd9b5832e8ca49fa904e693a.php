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
<nav class="Hui-breadcrumb"><i class="icon-home"></i> 首页 <span class="c-gray en">&gt;</span> <a href="<?php echo U('/Topics/Index');?>">专题管理</a>
<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
  <div class="cl pd-5 bg-1 bk-gray">
    <span class="l">
      <a class="filePicker" href="<?php echo U('/Topics/TopicsAdd');?>">添加专题</a>
    </span>
    <span class="r">
      <span class="select-box">
      <form action="<?php echo U('/Topics/Index');?>" method="get">
          <select class="select" size="1" name="search">
              <option value="1" selected>标题</option>
              <option value="2">专题ID</option>
              <option value="3">发布者</option>
              <option value="4">分类</option>
              <option value="5">属性</option>
          </select>
          <input type="text" style="width:300px" class="input-text radius" id="condition" name="condition" placeholder=" 输入标题或发布者查找专题">
          <button id="post_submit" class="btn btn-secondary radius" type="submit"><i class="Hui-iconfont Hui-iconfont-search"></i> 搜索专题</button>
        </form>
    </span>
  </div>
  <table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr>
        <th scope="col" colspan="10" class="ns-ft-15 text-c"><span style="color:#3bb4f2;"><?php echo ($search); ?></span></th>
      </tr>
      <tr class="text-c">
        <th>标题</th>
        <th width="80">分类</th>
        <th width="60">属性</th>
        <th width="100">发布者</th>
        <th width="120">创建时间</th>
        <th width="50">访问量</th>
        <th width="50">审核状态</th>
        <th width="100">排序</th>
        <th width="50">是否显示</th>
        <th width="150">操作</th>
      </tr>
    </thead>
    <tbody>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
        <td class="ns-ft-14 text-l"><!-- <a href="<?php echo ZHUAN_URL.$vo['wid'];?>"  target="_black"> --><?php echo ($vo["title"]); ?><!-- </a> --></td>
        <td class="ns-ft-14"><?php echo ($vo["cate_name"]); ?></td>
        <td class="ns-ft-14"><?php echo ($vo["name"]); ?></td>
        <td class="ns-ft-14"><?php echo ($vo["nikename"]); ?></td>
        <td class="ns-ft-14">
            <?php echo (date("Y-m-d H:i",$vo["create_time"])); ?>
        </td>
        <td class="ns-ft-15"><?php echo ($vo["tpv"]); ?></td>
        <td class="ns-ft-14">
          <?php switch($vo['is_check']): case "0": ?><span style="color:blue">未审核</span><?php break;?>
            <?php case "1": ?><span style="color:green">通过</span><?php break;?>
            <?php case "2": ?><span style="color:red">驳回</span><?php break;?>
            <?php default: endswitch;?>
        </td>
        <td>
<input type="number" style="width:100px;text-align:center;" class="input-text radius" wid="<?php echo ($vo['wid']); ?>" value="<?php echo ($vo["sort"]); ?>" onchange='javascript:c(this)';>
        </td>
        <td>
        <?php if( $vo['is_show'] == 1 ): ?><input type="checkbox" is_show="<?php echo ($vo['is_show']); ?>" num="<?php echo ($vo['wid']); ?>" checked="checked" onchange='javascript:b(this)';>
        <?php else: ?>
          <input type="checkbox" is_show="<?php echo ($vo['is_show']); ?>" num="<?php echo ($vo['wid']); ?>" onchange='javascript:b(this)';><?php endif; ?>
        </td>
        <td class="f-14">
           <a class="l ns-ml-10" title="管理" href="<?php echo U('Topics/ManageT',Array('sid'=>$vo['wid'],'title'=>$vo['title']));?>">管理</a>
          <i class="l ns-ml-10">|</i>
          <a class="l ns-ml-10" href="<?php echo U('Topics/TopicsEdit',Array('wid'=>$vo['wid']));?>">编辑</a><i class="l ns-ml-10">|</i>
          <a title="删除" href="javascript:;" wid="<?php echo ($vo["wid"]); ?>" onClick="adver_del(this)" class="ml-5" style="text-decoration:none">删除</a>
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>
</div>

<div class="pageNav"><?php echo ($Page); ?></div>
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.min.js"></script> 
<script type="text/javascript" src="__PUBLIC__/js/H-ui.js"></script> 
<script type="text/javascript" src="__PUBLIC__/js/H-ui.admin.js"></script>

<!-- 专题排序 -->
<script type="text/javascript">
  function c(e){

    var wid= $(e).attr('wid');
    var sort = $(e).val();
    var url ="<?php echo U('Topics/TopicsOrderBySort');?>";
        $.ajax({
            type:"post",
            url:url,
            data:{'wid':wid,'sort':sort},
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
<!-- 是否显示 -->
<script type="text/javascript">
  function b(e){
    if(e.checked){
      $(e).attr('is_show',1);
    }
    else{
      $(e).attr('is_show',0); 
    }
    var wid= $(e).attr('num');
    var is_show =$(e).attr('is_show');
    var url ="<?php echo U('Topics/TopicsShowAjax');?>";
      $.ajax({
          type:"post",
          url:url,
          data:{'wid':wid,'is_show':is_show},
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
<!-- 删除专题 -->
<script type="text/javascript">
  function adver_del(e){
      layer.confirm('确认要删除吗？',function(index){

          var url ="<?php echo U('Topics/TopicsDelData');?>";
          var wid= $(e).attr('wid');
          $.ajax({
              type:"post",
              url:url,
              data:{'wid':wid},
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