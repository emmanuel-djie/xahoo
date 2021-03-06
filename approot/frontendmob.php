<?php
//ini_set('display_error','on');
//error_reporting(E_ALL & ~ E_NOTICE & ~ E_WARNING);
// load envoronment
$env_config = dirname(__FILE__).'/protected/xahoomob/config/environment.php';
require_once($env_config);

// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';

// config file
$config=dirname(__FILE__).'/protected/xahoomob/config/main.php';

// show config file not found
if (!file_exists($config)) {
    die('-- config file: { '. $config .' } not found --');
}
require_once($yii);
Yii::createWebApplication($config)->run();
