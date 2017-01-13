<?php
header('Access-Control-Allow-Origin:*');
@session_start();
/**jessie.qiao
 * index.php 入口
 */

define('APP_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('ATTMS_PATH', APP_PATH . 'attms' . DIRECTORY_SEPARATOR);
define('PHPFRAME_PATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
include PHPFRAME_PATH . '/phpframe/base.php';
error_reporting(0);
@ini_set('session.use_cookies',1);
@ini_set('session.cookie_lifetime',9999999999);

@ini_set('session.gc_maxlifetime', 9999999999);

@ini_set('date.timezone','Asia/Shanghai');
@date_default_timezone_set('Asia/Shanghai');

//@file_put_contents("../weblogs/info/i_".date("YmdH").".txt",serialize($_REQUEST)."\r\n",FILE_APPEND);//debug
define('ATTMS_URL',pc_base::load_config('system','attms_url'));

pc_base::creat_app();


?>
