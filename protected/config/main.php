<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
require(dirname(__FILE__).'/defineInfo.php');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'MyRealTour',
	'defaultController'=>'login',
	// preloading 'log' component
	'preload'=>array('log'),
	'language'=>'en_us',
	'sourceLanguage'=>'zh_cn',
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.models.Logic.*',
		'application.components.*',
		'application.components.opentok.*',
		'application.components.googlecalendar.*',
		'application.components.phpmailer.*',
		'application.helpers.*',
		'application.extensions.EAjaxUpload.*',
		'application.extensions.timepicker.*',
		'application.extensions.jcrop.*',
		'application.vendors.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'mrt',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=>array(
						'application.gii',
				),
		),
		'importcsv'=>array(
				'path'=>'upload/importCsv/', // path to folder for saving csv file and file with import params
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class' => 'WebUser',
			'loginUrl' => array('login'),
		),
		'session' => array(
				'class' => 'CHttpSession',
				'timeout'=>'36000000',
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			//'urlSuffix'=>'.html',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
  	 /*'db'=>array(
				'connectionString' => 'mysql:host=localhost;dbname=mrt',
				'emulatePrepare' => true,
				'username' => 'mrt_db',
				'password' => 'yu2mY7rertNu',
				'charset' => 'utf8',
				'enableProfiling'=>true,
				'enableParamLogging'=>true,
		),  */
  		 'db'=>array(
		 'connectionString' => 'mysql:host=localhost;dbname=mrt',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => '1234',
				'charset' => 'utf8',
				'enableProfiling'=>true,
				'enableParamLogging'=>true,
		),   
  	 	 /*   'db'=>array(
				'connectionString' => 'mysql:host=localhost;dbname=mrt',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => '111111',
				'charset' => 'utf8',
				'enableProfiling'=>true,
				'enableParamLogging'=>true,
		),  */
		'request'=>array(
				//'enableCsrfValidation'=>(isset($_POST['PHPSESSID'])) ? false  : true,
				//'enableCookieValidation'=>(isset($_POST['PHPSESSID'])) ? false  : true,
				'enableCsrfValidation'=>false,
				'enableCookieValidation'=>false,
		),
		'errorHandler'=>array(
            'errorAction'=>'site/error',
        ),
        'image'=>array(
        		'class'=>'application.extensions.image.CImageComponent',
        		'driver'=>'GD',
        ),
 	  /* 	 'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CWebLogRoute',
					'levels'=>'trace, info, error, warning',
				),
			),
		), */
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'copyrightInfo'=>'Copyright &copy; '.date('Y').' by SIG.',
	),
);
