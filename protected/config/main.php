<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'sourceLanguage'=>'en',
    'language'=>'zh_cn',
	'name'=>Yii::t('system','Meeting System'),

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
        'application.models.met.*',
		'application.models.forms.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'management'=>array(
			'ipFilters'=>array(),
		),
        'articles','metManage','frontUsers',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'111',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1','192.168.15.*'),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=ms_sfnt',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '123456',
			'charset' => 'utf8',
            'tablePrefix'=>'sfnt_',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
                    'levels'=>'error, warning',
				),
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'upload_folder'=>'upfiles',
        
        'mail_username'=>'xiaosfnt@163.com',
        'mail_pwd'=>'xcsfnt198552',
        'mail_from'=>'xiaosfnt@163.com',
        'mail_fromName'=>'sfnt内容管理系统',
        'mail_host'=>'smtp.163.com',
        'mail_port'=>25,

		'errlogintime' => 5, //登陆错误次数
		'errloginblocktime' => 7200, //登陆错误次数,秒
        
		'stringValidChar'=>'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz',
		'saltlenght'=>4,
        'su' => array(1),
        
        'upload_dir' => 'userfiles',
        'upload_img_max_width' => 1024,
        'upload_img_max_height' => 1024,
        
        'use_uc'=>false,
	),
);