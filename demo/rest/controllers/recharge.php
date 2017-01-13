<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_sys_class('BaseAction');

class recharge extends BaseAction
{
	public function __construct()
	{
		parent::__construct();

	}

	//充值
	public function pay()
	{
		$amount = intval(getgpc("amount"));

		if($amount<=0){
			returnJson("500","充值金额不低于1000");
		}
		
		$res = D("Rest")->querysql("update `jjs_user_finance` set recharge = recharge + ".$amount." where user_id = '".$_SESSION["user_id"]."'");
		if($res){
			returnJson("200","充值成功");
		}else{
			returnJson("500","充值失败");
		}
	
	}

	

}
