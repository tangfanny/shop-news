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
<a href="<?php echo U('/Recruit/Index');?>">招聘信息</a> <span class="c-gray en">&gt;</span> 编辑信息
<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
<form action="<?php echo U('/Recruit/update');?>" method="post" enctype="multipart/form-data">
    <table class="table">
    <input type="hidden" id="wid" name="idx" value="<?php echo ($info[0]['idx']); ?>">
      <tbody>
        
        <tr class="text-l">
          <td class="ns-ft-16">招聘标题:</td>
          <td colspan="2">
            <input type="text" style="width:800px" id="title" class="input-text radius" name="title" placeholder="请输入招聘标题" value="<?php echo ($info[0]['title']); ?>">
          </td>
        </tr>
        <tr class="text-l">
          <td class="ns-ft-16">职位名称:</td>
          <td colspan="2">
            <input type="text" style="width:800px" id="title" class="input-text radius" name="job_postion" placeholder="请输入职位名称" value="<?php echo ($info[0]['job_postion']); ?>">
          </td>
        </tr>
        <tr class="text-l">
          <td class="ns-ft-16">工作性质:</td>
          <td colspan="2">
             <input type="radio" name="job_xingzhi" id="" value="全职" <?php if($info[0]['job_xingzhi'] == '全职'): ?>checked<?php endif; ?>>全职
             <input type="radio" name="job_xingzhi" id="" value="兼职" <?php if($info[0]['job_xingzhi'] == '兼职'): ?>checked<?php endif; ?>>兼职
             <input type="radio" name="job_xingzhi" id="" value="实习" <?php if($info[0]['job_xingzhi'] == '实习'): ?>checked<?php endif; ?>>实习
          </td>
        </tr>
         <tr class="text-l">
          <td class="ns-ft-16">驳&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;回:</td>
          <td colspan="2">
             <input type="radio" name="ispass" id="" value="0" <?php if($info[0]['ispass'] == '0'): ?>checked<?php endif; ?>>待审核
             <input type="radio" name="ispass" id="" value="1" <?php if($info[0]['ispass'] == '1'): ?>checked<?php endif; ?>>通过
             <input type="radio" name="ispass" id="" value="2" <?php if($info[0]['ispass'] == '2'): ?>checked<?php endif; ?>>驳回
          </td>
        </tr>
      
        <tr class="text-l">
          <td class="ns-ft-16">招聘人数:</td>
          <td colspan="2">
            <input type="text" style="width:800px" id="title" class="input-text radius" name="job_num" placeholder="如不填写默认不限" value="<?php echo ($info[0]['job_num']); ?>">
          </td>
        </tr>
        
        <tr class="text-l">
        <td class="ns-ft-16">月薪范围:</td>
        <td colspan="2">
        <?php if($info[0]['job_money_low'] == 0 and $info[0]['job_money_height'] == 0): ?><input type="number" name="job_money_low" style="width:394.5px;"  placeholder="最低月薪,请填写整数，如:3，单位" kstyle="width:100px;text-align:center;" class="input-text radius">
          <input type="number" name="job_money_height" style="width:394px;" placeholder="最高月薪,请填写整数，如:9, 单位k" style="width:100px;text-align:center;" class="input-text radius">
        <?php else: ?>
          <input type="number" name="job_money_low" style="width:394.5px;"  placeholder="最低月薪,请填写整数，如:3，单位" kstyle="width:100px;text-align:center;" class="input-text radius" value="<?php echo ($info[0]["job_money_low"]); ?>">
          <input type="number" name="job_money_height" style="width:394px;" placeholder="最高月薪,请填写整数，如:9, 单位k" style="width:100px;text-align:center;" class="input-text radius" value="<?php echo ($info[0]["job_money_height"]); ?>"><?php endif; ?>
        </td>
        </tr>
        <tr class="text-l">
          <td class="ns-ft-16">工作地点:</td>
          <td colspan="2">
            <input type="text" style="width:800px" id="title" class="input-text radius" name="job_city" placeholder="比如:北京" value="<?php echo ($info[0]['job_city']); ?>">
          </td>
        </tr>
        <tr class="text-l">
          <td class="ns-ft-16">工作经验:</td>
          <td colspan="2">
            <select class="select" size="1" name="job_jingyan" style="width:811px;">
            <?php if($info[0]['job_jingyan'] == null): ?><option value="不限" select="selected">不限</option>
            <?php else: ?>
              <option value="不限" <?php if($info[0]['job_jingyan'] == '不限'): ?>selected<?php endif; ?>>不限</option><?php endif; ?>
              <option value="应届毕业生" <?php if($info[0]['job_jingyan'] == '应届毕业生'): ?>selected<?php endif; ?>>应届毕业生</option>
              <option value="1-3年" <?php if($info[0]['job_jingyan'] == '1-3年'): ?>selected<?php endif; ?>>1-3年</option>
              <option value="3-5年" <?php if($info[0]['job_jingyan'] == '3-5年'): ?>selected<?php endif; ?>>3-5年</option>
              <option value="5-10年" <?php if($info[0]['job_jingyan'] == '5-10年'): ?>selected<?php endif; ?>>5-10年</option>
              <option value="10年以上" <?php if($info[0]['job_jingyan'] == '10年以上'): ?>selected<?php endif; ?>>10年以上</option>
            </select>
          </td>
        </tr>
        <tr class="text-l">
          <td class="ns-ft-16">联系方式:</td>
          <td colspan="2">
            <input type="text" style="width:800px" id="title" class="input-text radius" name="hr_email" placeholder="请输入HR邮箱:" value="<?php echo ($info[0]['hr_email']); ?>">
          </td>
        </tr>
        <tr class="text-l">
          <td class="ns-ft-16">职位描述:</td>
          <td colspan="2">
            <script id="am-container1" name="job_description" type="text/plain" style="width:1024px;height:450px;"><?php echo ($info[0]['job_description']); ?></script>
          </td>
        </tr>
        <tr class="text-l">
          <td class="ns-ft-16">职位要求:</td>
          <td colspan="2">
            <script id="am-container2" name="job_content" type="text/plain" style="width:1024px;height:450px;"><?php echo ($info[0]['job_content']); ?></script>
          </td>
        </tr>
        <tr class="text-l">
          <td class="ns-ft-16">公司简介:</td>
          <td colspan="2">
            <script id="am-container3" name="comp_desc" type="text/plain" style="width:1024px;height:450px;"><?php echo ($info[0]['comp_desc']); ?></script>
          </td>
        </tr>
        <tr>
            <th class="text-r">原LOGO：</th>
            <td>
               <?php if(is_numeric($info[0]['pic']) && strlen($info[0]['pic'])==18):?>
              <img  src="<?php echo FILE_URL.$info[0]['pic'].'?imageView2/2/w/200 ';?>"/>
              <?php elseif(empty($info[0]['pic'])): ?>
              <?php else: ?>
              <img  src="<?php echo IMG_URL.$info[0]['pic'].'?imageView2/2/w/200' ;?>"/>
              <?php endif;?>
            </td>
          </tr>
        <tr>
            <th class="text-r">新LOGO：</th>
            <td>
              <input type="file" class="am-hide" id="pickfiles" >
              <input type="hidden" id='chengxing' name="logo">
              <div id="container">
              </div>
              <div>
                     <img src="" id="imgpreview" alt="" >
              </div>
            </td>
          </tr>

        <tr class="text-l">
          <td class="ns-ft-16">
          </td>
          <td colspan="2">
              
              <input type="submit" class="btn btn-primary" value="修改信息">
          </td>
        </tr>
      </tbody>
    </table>
  </form>
</div>
<script src="__PUBLIC__/jcorp/j/jquery.Jcrop.js"></script>
<link rel="stylesheet" href="__PUBLIC__/jcorp/c/jquery.Jcrop.css" type="text/css" />
<script src="__PUBLIC__/js/ns-jcorp-admin.js"></script>
<script>
    ns_jcorp($("#btn_upload"),$("#ns_newfile"),$("#di_img_con"),$("#btn_jc_complete"),1,1,200,200);
</script>

<script type="text/javascript">
   var ue = UE.getEditor('am-container1');
</script>
<script type="text/javascript">
   var ue = UE.getEditor('am-container2');
</script>
<script type="text/javascript">
   var ue = UE.getEditor('am-container3');
</script>

<script type="text/javascript" src="__PUBLIC__/js/H-ui.js"></script>
<script type="text/javascript" src="__QINIU__plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="__QINIU__plupload/js/i18n/zh_CN.js"></script>
<script type="text/javascript" src="__QINIU__ui.js"></script>
<script type="text/javascript" src="__QINIU__qiniu.js"></script>
<script type="text/javascript" src="__QINIU__highlight.js"></script>
<script type="text/javascript" src="__QINIU__main-upload.js"></script>

</body>
</html>