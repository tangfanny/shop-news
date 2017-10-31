<?php
// 定义应用目录
define('APP_NAME', 'Application');
define('APP_PATH','./Application/');
//如存在此目录 那么关闭调试模式
$debug_str = dirname(__FILE__).'/../../core/Core_TP/switch/';
if(!is_dir($debug_str)) {
	define('APP_DEBUG', FALSE);
} else {
	define('APP_DEBUG', TRUE);
}
// 引入ThinkPHP入口文件
require dirname(__FILE__).'/../../core/Core_TP/web_core3.1.3/ThinkPHP.php';