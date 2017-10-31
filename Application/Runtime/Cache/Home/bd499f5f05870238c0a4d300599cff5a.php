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
<a href="<?php echo U('Index/Footer');?>">底部管理</a> <span class="c-gray en">&gt;</span> <a href="<?php echo U('/Index/Footer');?>">关于我们</a>
<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
<div class="ns_dh_cm_tab ns-mb-15">
    <a class="ns_dh_cm_tabfocus" href="<?php echo U('/Index/Footer');?>">关于我们</a>
    <a class="ns_dh_cm_taba" href="<?php echo U('/Index/Link');?>">友情链接</a>
    <a class="ns_dh_cm_taba" href="<?php echo U('/Index/Cooperation');?>">合作伙伴</a>
    <a class="ns_dh_cm_taba" href="<?php echo U('/Index/Contact');?>">联系方式</a>
</div>
<table class="table table-border table-bordered table-hover table-bg l" style="width:728px;">
    <thead>
      <tr>
  <th scope="col" colspan="4"><a href="<?php echo U('Index/Footeradd');?>" class="btn btn-secondary radius ns-ml-05"><i class="icon-plus"></i> 新增</a></th>
      </tr>
      <tr class="text-c">
        <th>名称</th>
        <th width="120">排序</th>
        <th width="120">是否显示</th>
        <th width="120">操作</th>
      </tr>
    </thead>
    <tbody>
    <?php if(is_array($about)): $i = 0; $__LIST__ = $about;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
        <td class="ns-ft-15"><?php echo ($vo["name"]); ?></td>
        <td>
<input type="number" style="width:100px;text-align:center;" class="input-text radius" num="<?php echo ($vo['id']); ?>" value="<?php echo ($vo["sort"]); ?>" onchange='javascript:c(this)';></td>
        <td>
        <label class="ns-item">
          <?php if( $vo['is_show'] == 0 ): ?><input type="checkbox" is_show="<?php echo ($vo['is_show']); ?>" num="<?php echo ($vo['id']); ?>" checked="checked" onchange='javascript:b(this)';>
          <?php else: ?>
            <input type="checkbox" is_show="<?php echo ($vo['is_show']); ?>" num="<?php echo ($vo['id']); ?>" onchange='javascript:b(this)';><?php endif; ?>
        </label>
        </td>
        <td class="f-14">
        <a title="编辑名称" href="<?php echo U('Index/Footeredit',array('id'=>$vo['id']));?>"><i class="ml-5 icon-edit"></i></a>
        <a title="删除" href="<?php echo U('Index/Footerd',array('id'=>$vo['id'],'key'=>2));?>" class="ml-5"><i class="icon-trash"></i></a>
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>
  <div class="dh_footer">
      <div class="dh_footer_header">
        <div class="dh_footer_info">LOGO</div>
          <div class="dh_footer_logo" onClick="admin_role_edit('1','','','上传LOGO','<?php echo U('Index/Footerphoto',Array('id'=>$logo['id']));?>')">
            <?php if( $logo['id'] == '' ): ?><div class="dh_footer_logobg">点击上传</div>
              <?php else: ?>
                <div class="dh_footer_logo2"><img width="210" height="65" src="<?php echo IMG_URL.$logo['logo'];?>"></div><?php endif; ?>
          </div>
      </div>
  </div>
  <div class="dh_fbeian">
备案信息：<input type="text" class="input-text radius" num="<?php echo ($beian['id']); ?>" style="width:98%;" value="<?php echo ($beian['name']); ?>" onchange='javascript:d(this)';>
  </div>
  
</div>
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.min.js"></script> 
<script type="text/javascript" src="__PUBLIC__/js/H-ui.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/H-ui.admin.js"></script>
<script type="text/javascript">
  function c(e){
    var id= $(e).attr('num');
    var sort = $(e).val();
    var url ="<?php echo U('Index/Footerajax');?>";
        $.ajax({
            type:"post",
            url:url,
            data:{'id':id,'sort':sort,'key':3},
            success: function(data){
              if(data == 3){
                location.replace(location.href);
              }else{
                alert("操作失败，请联系管理员");
                location.replace(location.href);
              }
          },

        });
  }

  function b(e){
    if(e.checked){
      $(e).attr('is_show',0);
    }else{
      $(e).attr('is_show',1);
    }
    var id= $(e).attr('num');
    var is_show =$(e).attr('is_show');
    var url ="<?php echo U('Index/Footerajax');?>";
      $.ajax({
          type:"post",
          url:url,
          data:{'id':id,'is_show':is_show,'key':4},
          success: function(data){
          if(data == 4){
            location.replace(location.href);
          }else{
            alert("操作失败，请联系管理员");
            location.replace(location.href);
          }
        },
      });
  }

  function d(e){
    var id= $(e).attr('num');
    var name = $(e).val();
    var url ="<?php echo U('Index/FooterBeian');?>";
        $.ajax({
            type:"post",
            url:url,
            data:{'id':id,'name':name},
            success: function(data){location.replace(location.href);},
        });
  }

$("#clear-cache").click(function(){
    var url ="<?php echo U('Index/ClearCache');?>";
      $.ajax({
            type:"post",
            url:url,
            data:{'id':1},
            success: function(data){
              if(data == 1){
                $("#clear-cache").addClass("disabled");
                alert("清除成功");
                location.replace(location.href);
              }else{
                alert("操作失败，请联系管理员");
                location.replace(location.href);
              }
          },

        });
      
});
</script>
</body>
</html>