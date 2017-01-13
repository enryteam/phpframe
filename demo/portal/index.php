<?php
header('Access-Control-Allow-Origin:*');
@session_start();
error_reporting(0);//DEBUG: E_ALL/0

/**
 * index.php 入口
 */
define('APP_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('PHPFRAME_PATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

include PHPFRAME_PATH . '/phpframe/base.php';
pc_base::creat_app();
?>
