<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../../../framework1.3/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();

$user = array(
    'ip' => '10.10.15.3',
    'port' => 4370,
    'enrollNumber' => 123,
    'name' => 'Alex',
    'cardNumber' => '777'
);

$device = array(
    'ip' => '10.10.15.3',
    'port' => 4370,
);

//Soap::registerNewUser($user);
//Soap::getAllUsersData($device);

        
Soap::getSoapFunctions();
Soap::getControllerTime($device);
