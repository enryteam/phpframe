<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
$session_storage = 'session_' . pc_base::load_config('system', 'session_storage');
pc_base::load_sys_class($session_storage);
pc_base::load_sys_class('controller');

/**
 * 公共基类，构造方法
 *
 */
class portal extends controller{

	public function __construct(){
		//
	
	}
	
	
	
}