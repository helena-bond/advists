<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('editable', dirname(__FILE__) . '/../extensions/x-editable');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Demo',
    'language' => 'ru',
    'aliases' => array(
        'bootstrap' => dirname(__FILE__) . '/../extensions/bootstrap',
    ),
    // preloading 'log' component
    'preload' => array('log', 'bootstrap'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
        'application.helpers.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.user.helpers.*',
    //'application.vendors.phpexcel.PHPExcel',
    //'editable.*' //easy include of editable classes
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '12345',
            'generatorPaths' => array(
                'bootstrap.gii',
            ),
            'ipFilters' => array('*'),
        ),
        'SensorarioUrlRoute',
        'user' => array(
            # encrypting method (php hash function)
            'hash' => 'phpass',
            # send activation email
            'sendActivationMail' => true,
            # allow access for non-activated users
            'loginNotActiv' => true,
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,
            # automatically login from registration
            'autoLogin' => true,
            # registration path
            'registrationUrl' => array('/user/registration'),
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
            # login form path
            'loginUrl' => array('/user/login'),
            # page after login
            'returnUrl' => array('/user/profile'),
            # page after logout
            'returnLogoutUrl' => array('/user/login'),
        ),
    #...
    ),
    // application components
    'components' => array(
        'session' => array(
            'class' => 'DbHttpSession',
            'connectionID' => 'db',
            'timeout' => 3600 * 24 * 3,
        ),
        'user' => array(
            // enable cookie-based authentication
            'class' => 'WebUser',
            'allowAutoLogin' => true,
            'loginUrl' => array('/user/login'),
        ),
        'authManager' => array(
            'class' => 'PhpAuthManager',
            'defaultRoles' => array('guest'),
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                
                '<controller:\w+>/<link:((?!index|create|admin|update|delete).+)>' => '<controller>/view',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:(index|create|admin)>' => '<controller>/<action>',
                '<controller:\w+>/<action:(update|delete)>/<id:\d+>' => '<controller>/<action>',
            ),
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=wordpress',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => 'demo_',
            'enableProfiling' => true,
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
             /*array(
              'class' => 'CWebLogRoute',
              ), */
            ),
        ),
        'bootstrap' => array(
            'class' => 'application.extensions.bootstrap.components.Bootstrap',
        ),
        'loid' => array(
            'class' => 'application.extensions.lightopenid.loid',
        ),
        'editable' => array(
            'class' => 'editable.EditableConfig',
            'form' => 'bootstrap', //form style: 'bootstrap', 'jqueryui', 'plain' 
            'mode' => 'inline', //mode: 'popup' or 'inline'  
            'defaults' => array(//default settings for all editable elements
                'emptytext' => '',
                'ajaxOptions' => array('dataType' => 'json')
            )
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'report' => array(
            'userCanSuggest' => false,
        )
    ),
);
