<?php

date_default_timezone_set('America/New_York');

/*$config['modules']['gii'] = array(
	'class'=>'system.gii.GiiModule',
	'password' => false,
	// If removed, Gii defaults to localhost only. Edit carefully to taste.
	'ipFilters'=>array('127.0.0.1','::1'),
);*/

$group = &$config['components']['db'];
$group = array_merge($group, array(
	'connectionString' => 'mysql:host=localhost;dbname=mydbname',
	'username' => 'username',
	'password' => 'password',
));

// yiidebugtb
$config['components']['log']['routes'][] = array(
	'class'=>'XWebDebugRouter',
	'config'=>'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
	'levels'=>'error, warning, trace, profile, info',
	'allowedIPs'=>array('127.0.0.1','::1'),
);
