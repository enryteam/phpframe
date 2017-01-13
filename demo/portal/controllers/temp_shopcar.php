<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('PortalAction');
class temp_shopcar extends PortalAction
{
	public function __construct()
	{
		if(empty($_SESSION["user_id"]))
		{
		header("Location:/acenter/index.php?c=index&a=login");exit;
		}
		//购物车商品总数
		$shopcar = D("Portal")->query("select sum(num) as sum from `jjs_shopcar` where user_id = ".$_SESSION["user_id"]);

		//用户资料
		$userdata = D("Portal")->query("select id,realname,phone,idcard,bank,bank_card,address,head_img,nickname,email,role,type from `jjs_user` where id=".$_SESSION['user_id']);

		$this->assign("shopcar",$shopcar[0]["sum"]);
		$this->assign("userdata",$userdata[0]);

		parent::__construct();
	}
	
	
	//临时购物车 商品下单页
	public function confirm()
	{
		$goods_id = getgpc("goods_id");
		$num = empty(getgpc("num"))?'1':getgpc("num");
		//收货地址
		$address = D("Portal")->query("select * from `jjs_receipt_address` where user_id = ".$_SESSION["user_id"]);
		
		$allgoods = D("Portal")->query("select * from `jjs_goods` where id = ".$goods_id);
		foreach($allgoods as $k=>$v){
			$allgoods[$k]["buynum"] = $num;
		}
		foreach($allgoods as $k=>$v){
			$allgoods[$k]["total"] = $v["price"]*$v["buynum"];
			$sum += $v["price"]*$v["buynum"];
		}
		
		$this->assign("address",$address);
		$this->assign("allgoods",$allgoods);
		$this->assign("sum",$sum);
		$this->assign("goods_id",$goods_id);
		$this->display();
	}
}
