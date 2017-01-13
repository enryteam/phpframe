<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('PortalAction');
class barclays extends PortalAction
{
	public function __construct()
	{
		//购物车商品总数
		$shopcar = D("Portal")->query("select count(1) as count from `jjs_shopcar` where user_id = ".$_SESSION["user_id"]);

		//用户资料
		$userdata = D("Portal")->query("select id,realname,phone,idcard,bank,bank_card,address,head_img,nickname,email,role,type from `jjs_user` where id=".$_SESSION['user_id']);

		//入场登记
		$goods = D("Portal")->query("select id,title,img from `jjs_goods` where goods_status = 1 and status = 1 and release_status = 1 and stock > 0 order by ctime desc limit 8");

		$this->assign("shopcar",$shopcar[0]["count"]);
		$this->assign("userdata",$userdata[0]);
		$this->assign("goods",$goods);
		parent::__construct();
	}

	//网上开户
	public function register()
	{
		$this->display();
	}

	
}
