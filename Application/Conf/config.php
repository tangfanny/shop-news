<?php
return array(
	//'配置项'=>'配置值'
	'APP_GROUP_LIST' 		=> 'Home', //项目分组设定
	'DEFAULT_GROUP'  		=> 'Home', 		//默认分组
	'APP_GROUP_MODE'        =>  1,  		// 分组模式 0 普通分组 1 独立分组
    'APP_GROUP_PATH'        =>  'Modules', // 分组目录 独立分组模式下面有效

    'URL_CASE_INSENSITIVE'  => true,   		// 默认false 表示URL区分大小写 true则表示不区分大小写
	'URL_MODEL'             => 2,       	// URL访问模式,可选参数0、1、2、3,代表以下四种模式：
	'LOAD_EXT_CONFIG'		=> 'dbconnect', // 扩展配置

   	'SESSION_AUTO_START' 	=>	true,
   	'LAYOUT_ON'             =>	true,  		// 开启布局

	'LOG_RECORD'			=> false, 		// 开启日志记录
	'LOG_LEVEL'  			=>'EMERG,ALERT,CRIT,ERR,SQL', // 只记录EMERG ALERT CRIT ERR 错误
	'LOG_TYPE' 				=>3, //  采用文件方式记录日志
	 
	'SHOW_PAGE_TRACE' 		=>false, // 显示页面Trace信息

);
?>