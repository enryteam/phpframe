<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('PortalAction');
class helpcenter extends PortalAction
{
	private $pageSize = 8;
	public function __construct()
	{
		parent::__construct();
		//购物车商品总数
		$shopcar = D("Portal")->query("select sum(num) as sum from jjs_shopcar where user_id = ".$_SESSION["user_id"]);

		//用户资料
		$userdata  = D("Portal")->query("select id,image,nickname,phone,email,bank_card,bank_name,mills_id,bank,realname,level_id,count from jjs_user where id=".$_SESSION['user_id']);
		$this->assign("topcate",$topcate);
		$this->assign("mills_id",$userdata[0]["mills_id"]);
		$this->assign("shopcar",$shopcar[0]["sum"]);
		$this->assign("id",$userdata[0]["id"]);
		$this->assign("image",$userdata[0]["image"]);
		$this->assign("nickname",$userdata[0]["nickname"]);
		$this->assign("phone",$userdata[0]["phone"]);
		$this->assign("realname",$userdata[0]["realname"]);
	}
	//默认
	public function index()
	{
		$result = D('Portal')->query("select * from `jjs_help` ");
		$this->assign('help', $result[0]);
		$this->display();
	}
	
}
