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
<nav class="Hui-breadcrumb"><i class="icon-home"></i> 首页 <span class="c-gray en">&gt;</span> 栏目管理 <span class="c-gray en">&gt;</span> 分类管理
<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
<div class="ns_dh_cm_tab ns-mb-15">
    <a <?php if( $id == 1 ): ?>class="ns_dh_cm_tabfocus"<?php else: ?>class="ns_dh_cm_taba"<?php endif; ?> href="<?php echo U('/Article/ColumnMenu',Array('id'=>1));?>">分类管理</a>
      <a class="ns_dh_cm_taba" href="<?php echo U('/Article/ColumnMenu',Array('id'=>2));?>">标签管理</a>
      <a class="ns_dh_cm_taba" href="<?php echo U('/Article/ColumnMenu',Array('id'=>3));?>">属性管理</a>
      <a class="ns_dh_cm_taba" href="<?php echo U('/Article/ColumnMenu',Array('id'=>4));?>">侧TAB管理</a>
</div>
  <div class="cl pd-5 bg-1">
    <span class="l">
      <input type="text" style="width:300px" class="input-text radius" id="cate_name" name="cate_name" placeholder=" 输入分类名称">
      <div class="btn btn-secondary radius" onclick='javascript:addCate(this)';><i class="icon-plus"></i> 新增分类</div>
    </span>
    <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span>
  </div>
  <table class="table table-border table-bordered table-hover table-bg">
    <thead>
      <tr>
        <th scope="col" colspan="6">分类管理</th>
      </tr>
      <tr class="text-c">
        <th width="140">名称</th>
        <th width="100">位置</th>
        <th width="80">是否显示</th>
        <th>标签</th>
        <th width="100">操作</th>
      </tr>
    </thead>
    <tbody>
    <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr class="text-c">
        <td class="ns-ft-15"><?php echo ($vo["cate_name"]); ?></td>
        <td>
<input type="number" style="width:100px;text-align:center;" class="input-text radius" cid="<?php echo ($vo['cid']); ?>" value="<?php echo ($vo["sort"]); ?>" onchange='javascript:c(this)';></td>
        <td>
        <?php if($vo['is_show'] == 1){ ?>
          <input type="checkbox" is_show="<?php echo ($vo['is_show']); ?>" num="<?php echo ($vo['cid']); ?>" checked="checked" onchange='javascript:b(this)';>
        <?php }else{ ?>
          <input type="checkbox" is_show="<?php echo ($vo['is_show']); ?>" num="<?php echo ($vo['cid']); ?>" onchange='javascript:b(this)';>
        <?php } ?>
        </td>
        <td class="ns-ft-13 text-l"><?php echo ($vo["tag_name"]); ?></td>
        <td class="f-14">
        <a href="javascript:;" onClick="admin_role_edit('1','1000','300','<?php echo ($vo["cate_name"]); ?>---修改标签','<?php echo U('/Article/TagAddForCate',Array('cid'=>$vo['cid']));?>')">编辑标签</a>
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>
</div>
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.min.js"></script> 
<script type="text/javascript" src="__PUBLIC__/js/H-ui.js"></script> 
<script type="text/javascript" src="__PUBLIC__/js/H-ui.admin.js"></script>
<!-- 添加分类 -->
<script type="text/javascript">
  function addCate(e){

    var cate_name = $("#cate_name").val();
    if(cate_name.length == 0){  
        alert("名称为空？"); return false;
    }
    var url ="<?php echo U('/Article/CateAddSub');?>";
        $.ajax({
            type:"post",
            url:url,
            data:{'cate_name':cate_name},
            success: function(data){
            if(data == 1){
              location.replace(location.href);
            }else{
              alert("error!");
              location.replace(location.href);
            }
          },

        });

  }
</script>
<!-- 分类排序 -->
<script type="text/javascript">
  function c(e){

    var cid= $(e).attr('cid');
    var sort = $(e).val();
    var url ="<?php echo U('Article/CateOrderBySort');?>";
        $.ajax({
            type:"post",
            url:url,
            data:{'cid':cid,'sort':sort},
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
    var id= $(e).attr('num');
    var is_show =$(e).attr('is_show');
    var url ="<?php echo U('Article/CateShowAjax');?>";
      $.ajax({
          type:"post",
          url:url,
          data:{'cid':id,'is_show':is_show},
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
<!-- 删除分类 -->
<script type="text/javascript">
  function adver_del(obj,id){
      layer.confirm('确认要删除吗？',function(index){

          var url ="<?php echo U('Article/CateDelAjax');?>";
          $.ajax({
              type:"post",
              url:url,
              data:{'cid':id},
              success: function(data){
              if(data == 1){

                  $(obj).parents("tr").remove();
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