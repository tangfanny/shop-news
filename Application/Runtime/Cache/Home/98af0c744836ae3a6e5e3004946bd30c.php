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
<nav class="Hui-breadcrumb"><i class="icon-home"></i> 首页 <span class="c-gray en">&gt;</span> <a href="<?php echo U('/Recruit/Index');?>">招聘信息</a>
<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
  <div class="cl pd-5 bg-1 bk-gray">
    <span class="r">
      <form action="<?php echo U('/Recruit/Index');?>" method="get">
          <select class="select" size="1" name="search">
              <option value="1">职位名称</option>
              <option value="0">工作地点</option>  
          </select>
          <input type="text" style="width:300px" class="input-text radius" id="condition" name="condition" placeholder="请根据条件输入">
          <button id="post_submit" class="btn btn-secondary radius" type="submit"><i class="Hui-iconfont Hui-iconfont-search"></i> 搜索信息</button>
        </form>
    </span>
  </div>
  <table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr class="text-c">
        <th>招聘标题</th>
        <th>职位名称</th>
        <th>工作性质</th>
        <th>驳&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;回</th>
        <th width="100px">招聘人数</th>
        <th>月薪范围</th>
        <th>工作地点</th>
        <th width="100px">工作经验</th>
        <th width="100px">联系方式</th>
        <th>logo</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
    <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
      <td class="ns-ft-14" style="text-align:left;"><a href="<?php echo U('Recruit/Edit',Array('idx'=>$vo['idx']));?>"><?php echo ($vo["title"]); ?></a></td>
		<td class="ns-ft-14"  style="text-align:left;"><?php echo ($vo["job_postion"]); ?></td>
    <td>
    <?php switch($vo['job_xingzhi']): case "全职": ?><span style="color:blue">全职</span><?php break;?>
          <?php case "兼职": ?><span style="color:green">兼职</span><?php break;?>
          <?php case "实习": ?><span style="color:red">实习</span><?php break;?>
          <?php default: endswitch;?></td>
    <td>
    <?php switch($vo['ispass']): case "0": ?><span style="color:blue">待审核</span><?php break;?>
          <?php case "1": ?><span style="color:green">通过</span><?php break;?>
          <?php case "2": ?><span style="color:red">驳回</span><?php break;?>
          <?php default: endswitch;?>
        </td>
		<td class="ns-ft-14"><?php echo ($vo["job_num"]); ?></td>
    <?php if($vo["job_money_low"] == '0' and $vo["job_money_height"] == '0'): ?><td class="ns-ft-14">面议</td>
    <?php else: ?>
		<td class="ns-ft-14"><?php echo ($vo["job_money_low"]); ?>--<?php echo ($vo["job_money_height"]); ?></td><?php endif; ?>
		<td class="ns-ft-14"><?php echo ($vo["job_city"]); ?></td>
     <?php if($vo["job_jingyan"] == null): ?><td class="ns-ft-14">不限</td>
     <?php else: ?>
    <td class="ns-ft-14"><?php echo ($vo["job_jingyan"]); ?></td><?php endif; ?>
		<td class="ns-ft-14"><?php echo ($vo["hr_email"]); ?></td>
    <td class="ns-ft-14"> <?php if(is_numeric($vo['pic']) && strlen($vo['pic'])==18):?>
              <img width="50px" src="<?php echo FILE_URL.$vo['pic'].'?imageView2/2/w/200 ';?>"/>
              <?php elseif(empty($vo['pic'])): ?>
              <?php else: ?>
              <img width="50px" src="<?php echo IMG_URL.$vo['pic'].'?imageView2/2/w/200' ;?>"/>
              <?php endif;?></td>
        <td class="f-14">
          <a class="l ns-ml-10" title="编辑" href="<?php echo U('Recruit/Edit',Array('idx'=>$vo['idx']));?>"><i class="ml-5 icon-edit"></i></a><i class="l ns-ml-10 ">|</i>
          <a title="删除" href="javascript:;" idx="<?php echo ($vo["idx"]); ?>" onClick="adver_del(this)" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a>
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>
</div>
<div class="pageNav"><?php echo ($pages); ?></div>
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.min.js"></script> 
<script type="text/javascript" src="__PUBLIC__/js/H-ui.js"></script> 
<script type="text/javascript" src="__PUBLIC__/js/H-ui.admin.js"></script>
<script>
  $('#post_submit').click(function(){
    var condition = $("#condition").val();
    if(condition.length == 0){
       alert('请输入搜索条件！');return false;
    }
  })
</script>
<script type="text/javascript">
  function adver_del(e){
      layer.confirm('确认要删除吗？',function(index){

          var url ="<?php echo U('Recruit/Delete');?>";
          var idx= $(e).attr('idx');
          $.ajax({
              type:"post",
              url:url,
              data:{'idx':idx},
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