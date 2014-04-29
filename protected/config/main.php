<?php


require 'environment.php';
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'ReadFiend',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.models.forms.*',
        'application.components.*',
        'application.modules.admin.models.*',
        'application.modules.admin.models.campaign.*',
        'application.modules.admin.models.campaign.forms.*',
    ),
    'modules' => array(
        //for newsletter module
        'newsletter',
        'dashboard',
        
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            //'ipFilters'=>array('127.0.0.1','::1'),
            'ipFilters' => array($_SERVER['REMOTE_ADDR']),
        ),
        'admin' => array(
            'defaultController' => 'index',
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        //bootstrap support for crud model
         'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName'=>false,
            'rules' => array(
                '' => '/site/index',
                '/campaign/create' => '/campaign/create',
		'/campaign/<id:\d+>' => '/campaign/index',
                 'dashboard/<action:\w+>' => 'dashboard/default/<action>',     
                '/campaign/<id:\d+>/step1' => '/campaign/step1',
                '/campaign/<id:\d+>/step2' => '/campaign/step2',
                '/campaign/<id:\d+>/step3' => '/campaign/step3',
                '/campaign/<id:\d+>/step4' => '/campaign/step4',
                '/campaign/<id:\d+>/step5' => '/campaign/step5',
                '/login/fbconnect' => '/login/facebook/p/1',
                
                //For fund raising
                '/campaign/<pid:\d+>/contribute' => '/fundraise/contribute',
                '/campaign/<pid:\d+>/contribute/payment' => '/fundraise/payment',
                '/campaign/<pid:\d+>/contribute/share' => '/fundraise/share',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '/register' => '/Appuser/create',
            ),
        ),
        'db' => array(
            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
        ),
        // uncomment the following to use a MySQL database
        
          'db'=>array(
          'connectionString' => 'mysql:host=localhost;dbname='.$dbName,
          'emulatePrepare' => true,
          'username' => $dbUser,
          'password' => $dbPassword,
          'charset' => 'utf8',
          ),
         
        
        'clientScript' => array(
            'defaultScriptFilePosition' => CClientScript::POS_END
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
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
		'adminEmail' => 'webmaster@example.com',
		'FB' => array(
			'APPID' => $fbAppId,
			'SECRET' => $fbSecret,
		 ),
        
    ),
);
