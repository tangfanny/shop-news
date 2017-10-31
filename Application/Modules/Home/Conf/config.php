<?php
define('FILE_URL', PUBLIC_URL);

return array(
   	'TMPL_PARSE_STRING'=>array(
   		'__PUBLIC__'=>PUBLIC_URL . 'ar_back',
		'__QINIU__'=>PUBLIC_URL . 'qiniu_upload/',
    	'__SCON__'=>PUBLIC_URL . 'js',
   		'__UPLOADS__'=>"http://".$_SERVER ['HTTP_HOST'].__ROOT__.'/uploads',
   	),

    //redis配置
    'redis_config'=>array(
          'host'=>'cache.secwk.com',
          'port'=>'6379',
          'password'=>'1q2O5htCzdP.hCd1',
    ),

    //登录是否需要短信验证码
    'SentVerifyCode'=>array(  
          'sent'=>'0', 
    ),

    // 'TMPL_EXCEPTION_FILE'=>'./App/Tpl/Public/error.html', // 定义公共错误模板
);

?>
