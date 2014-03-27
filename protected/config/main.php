<?php
// Define application environment

defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'default'));
$dbName = 'stereotribes';
$dbUser = 'root';
$dbPassword = 'mysql';
if(APPLICATION_ENV == 'jump-dev') {
       $dbName = 'stereotribes';
       $dbUser = 'stereotribes';
       $dbPassword = 'stereotribes';


       $fbAppId = '231266650409136';
       $fbSecret = 'f6aefdeb97323090980fc2f4e98bcf1a';
}
// uncomment the following to define a path alias

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
        'application.components.*',
        'application.modules.admin.models.*',
    ),
    'modules' => array(
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
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '' => '/site/index',
                
                '/admin/feeds/profile/<provider_id:[a-zA-Z+_0-9.-]+>/<provider_name:[a-zA-Z+_0-9.-]+>/' => array('/admin/feeds/profile/'),
                
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
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
