<?php


$ip = $_SERVER['REMOTE_ADDR'];

$prodIp = '212.0.115.18';

if($ip==$prodIp){// produccion

    // comment out the following two lines when deployed to production
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'prod');
    defined('YII_ENV_DEV') or define('YII_ENV_DEV', false);

}else{

    // comment out the following two lines when deployed to production
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
    defined('YII_ENV_DEV') or define('YII_ENV_DEV', true);

}

// var_dump(YII_DEBUG);
// var_dump(YII_ENV);
// exit;

// comment out the following two lines when deployed to production
// defined('YII_DEBUG') or define('YII_DEBUG', true);
// defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
