<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('PortalAction');
class entry_market extends PortalAction
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

	//挂牌申请
	public function entry_apply()
	{
		//通知公告
		$announcement = D("Portal")->query("select * from `jjs_article` A,`jjs_article_cate` C where A.cateid = C.id and C.title = '通知公告' order by A.id desc limit 6");

		//市场动态
		$market_dynamics = D("Portal")->query("select * from `jjs_article` A,`jjs_article_cate` C where A.cateid = C.id and C.title = '市场动态' order by A.id desc limit 6");
		
		//底部友情链接
		$links = D("Portal")->query("select * from `jjs_link` where is_show = 1");

		//查询时间点
		$monday = strtotime('-2 monday', time());//上周一
		$days = array();
		for($i=0;$i<7;$i++){
			$days[] = date('Y-m-d',strtotime('+'.$i.' day',$monday));
		}
		foreach($days as $day)
		{
			$res = D("Portal")->query("select * from `jjs_price_trend` where goods_id = ".$goods_id." and ctime like '".$day."'");
			$price[] = $res[0]["price"];
		}
		//实时行情
		$realtime_quotes = array("price"=>$price,"day"=>$days);
		
		$this->assign("announcement",$announcement);
		$this->assign("market_dynamics",$market_dynamics);
		$this->assign("links",$links);
		$this->assign("realtime_quotes",$realtime_quotes);
		$this->display();
	}

	
}
