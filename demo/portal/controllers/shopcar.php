<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('PortalAction');
class shopcar extends PortalAction
{
	public function __construct()
	{
		//购物车商品总数
		$shopcar = D("Portal")->query("select count(1) as count from `jjs_shopcar` where user_id = ".$_SESSION["user_id"]);

		//用户资料
		$userdata = D("Portal")->query("select id,realname,phone,idcard,bank,bank_card,address,head_img,nickname,email,role,type from `jjs_user` where id=".$_SESSION['user_id']);

		$this->assign("shopcar",$shopcar[0]["count"]);
		$this->assign("userdata",$userdata[0]);

		parent::__construct();
	}

	//默认
	public function index()
	{
		$sum = 0;
		//购物车全部商品
		$allgoods = D("Portal")->query("select S.id,S.num,S.gid,G.title,G.img,G.price,G.intro from `jjs_shopcar` S,`jjs_goods` G where S.gid = G.id and S.user_id = ".$_SESSION["user_id"]);
		//购物车商品总额
		foreach($allgoods as $k=>$v){
			$sum += $v["price"]*$v["num"];
			$allgoods[$k]["total"] = $v["price"]*$v["num"];
		}
		$this->assign("allgoods",$allgoods);
		$this->assign("sum",$sum);
		$this->display();
	}

	
	//商品下单页
	public function confirm()
	{
		//收货地址
		$address = D("Portal")->query("select * from `jjs_receipt_address` where user_id = ".$_SESSION["user_id"]);
		
		//购物车全部商品
		$allgoods = D("Portal")->query("select S.id,S.gid,S.num,G.title,G.img,G.price from `jjs_shopcar` S,`jjs_goods` G where S.gid = G.id and S.user_id = ".$_SESSION["user_id"]);
		foreach($allgoods as $k=>$v){
			$allgoods[$k]["total"] = $v["price"]*$v["num"];
			$sum += $v["price"]*$v["num"];
		}
		$gids = D("Portal")->query("select gid from `jjs_shopcar` where user_id = ".$_SESSION["user_id"]);
		foreach($gids as $k=>$v){
			$goods_ids[] = $v["gid"];
		}

		$this->assign("address",$address);
		$this->assign("allgoods",$allgoods);
		$this->assign("sum",$sum);
		$this->assign("gids",implode(",",$goods_ids));
		$this->display();
	}
}
