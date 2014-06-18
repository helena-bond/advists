<?php
header('Content-type: text/html; charset=utf-8');
// change the following paths if necessary
$yii=dirname(__FILE__).'/../../framework1.14/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

if (get_magic_quotes_gpc()) { function magicQuotes_awStripslashes(&$value, $key) {$value = stripslashes($value);} $gpc = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST); array_walk_recursive($gpc, 'magicQuotes_awStripslashes');}

require_once($yii);
Yii::createWebApplication($config)->run();
