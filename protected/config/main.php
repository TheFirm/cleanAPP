<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$config = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	'import'=>array(),

	'modules'=>array(
		'admin',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'urlManager'=>array(
			'showScriptName' => false,
			'urlFormat' => 'path',
			'rules'=>array(
				'' => 'site/index',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=cleanapp',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'schemaCachingDuration' => !YII_DEBUG ? 86400 : 0,
			'enableParamLogging' => YII_DEBUG,
		),
		'cache' => array(
			'class' => 'CFileCache',
		),
		'assetManager' => array(
			'class' => 'ext.EAssetManagerBoostGz',
			'minifiedExtensionFlags' => array('min.js', 'minified.js', 'packed.js'),
		),
		'clientScript'=>array(
			'packages' => array(
				/*'jquery' => array( // Google CDN
					'baseUrl' => 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/',
					'js' => array(YII_DEBUG ? 'jquery.js' : 'jquery.min.js'),
				),*/
				/*'jquery' => array( // Yandex CDN
					'baseUrl' => 'http://yandex.st/jquery/1.7.2/',
					'js' => array(YII_DEBUG ? 'jquery.js' : 'jquery.min.js'),
				),*/
				'jquery' => array( // jQuery CDN - provided by (mt) Media Temple
					'baseUrl' => 'http://code.jquery.com/',
					'js' => array(YII_DEBUG ? 'jquery-1.11.1.js' : 'jquery-1.11.1.min.js'),
				),
				'bootstrap3' => array(
					'baseUrl' => '//netdna.bootstrapcdn.com/bootstrap/3.1.1/',
					'css' => array('css/bootstrap.min.css', 'css/bootstrap-theme.min.css'),
					'js' => array('js/bootstrap.min.js'),
					'depends' => array('jquery'),
				),
				'font-awesome' => array(
					'baseUrl' => '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/',
					'css' => array(YII_DEBUG ? 'font-awesome.css' : 'font-awesome.min.css'),
				),
			),
			'behaviors' => array(
				array(
					'class' => 'ext.behaviors.localscripts.LocalScriptsBehavior',
					'publishJs' => !YII_DEBUG,
					// Uncomment this if your css don't use relative links
					// 'publishCss' => !YII_DEBUG,
				),
			),
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
				array(
					'class'   => 'FormattedFileLogRoute',
					'format'  => "{time}\t{ip}\t{category}\t{uri}\t{message}",
					'except'  => 'exception.CHttpException.404',
					'levels'  => 'error',
					'logFile' => 'error.log',
				),
				array(
					'class'      => 'FormattedFileLogRoute',
					'format'     => "{time}\t{ip}\t{uri}\t{sref}",
					'categories' => 'exception.CHttpException.404',
					'logFile'    => 'error404.log',
				),
				array(
					'class'   => 'FormattedFileLogRoute',
					'format'  => "{time}\t{ip}\t{uri}\t{msg}\n{trace}",
					'levels'  => 'warning',
					'logFile' => 'warning.log'
				),
			),
		),
	),

	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);

if (YII_DEBUG) {
	$config['import'] = array_merge($config['import'], array(
		// Composer autoloaded files
		'application.models.*',
		'application.components.*',
	));
}

// Apply local config modifications
@include dirname(__FILE__) . '/main-local.php';

return $config;
