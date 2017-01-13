<?php
header('Access-Control-Allow-Origin:*');
@session_start();
/**
 * index.php 入口
 */
define('APP_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('PHPFRAME_PATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

include PHPFRAME_PATH . '/phpframe/base.php';
error_reporting(0);//DEBUG: E_ALL/0
//error_reporting(E_ALL);//DEBUG: E_ALL/0
pc_base::creat_app();
?>
