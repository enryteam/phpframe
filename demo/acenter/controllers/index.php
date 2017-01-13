<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('AcenterAction');
class index extends AcenterAction
{
	public function __construct()
	{
		
		//购物车商品总数
		$shopcar = D("Acenter")->query("select count(1) as count from jjs_shopcar where user_id = ".$_SESSION["user_id"]);

		//用户资料
		$userdata = D("Acenter")->query("select id,realname,phone,idcard,bank,bank_card,address,head_img,nickname,email,role,tpassword,type,area,accountname,business_licence,organization_code,tax_registration from `jjs_user` where id=".$_SESSION['user_id']);

		$this->assign("shopcar",$shopcar[0]["count"]);
		$this->assign("userdata",$userdata[0]);
		$r = D("Acenter")->query("select * from `jjs_store` where status =1 and user_id = ".$_SESSION["user_id"]);
		if($r) $this->assign("dianpu",'yes');
		parent::__construct();
	}

	//登录
	public function login()
	{
		
		//载入模板
		$this->display();
		
	}
	
	//注册
	public function register()
	{
		$this->display();
	}

	//忘记密码
	public function forget()
	{
		$this->display();
	}

	static function pages($num, $curr_page, $perpage = 20, $urlrule, $array = array(), $setpages = 5)
	{
		
		if (defined('URLRULE') && $urlrule == '') {
			$urlrule = URLRULE;
			$array = $GLOBALS['URL_ARRAY'];
		} elseif ($urlrule != '') {
			$urlrule .= '&page={$page}';
		}
		$multipage = '';
		if ($num > $perpage) {
			$page = $setpages + 1;
			$offset = ceil($setpages / 2 - 1);
			$pages = ceil($num / $perpage);
			if (defined('IN_ADMIN') && ! defined('PAGES'))
				define('PAGES', $pages);
			$from = $curr_page - $offset;
			$to = $curr_page + $offset;
			$more = 0;
			if ($page >= $pages) {
				$from = 2;
				$to = $pages - 1;
			} else {
				if ($from <= 1) {
					$to = $page - 1;
					$from = 2;
				} elseif ($to >= $pages) {
					$from = $pages - ($page - 2);
					$to = $pages - 1;
				}
				$more = 1;
			}
			if ($curr_page > 0) {
				if ($curr_page == 1) {
					$multipage .= "<a href='##' onclick='page(1)' style='background:rgb(230,38,51);color:white;'>1</a>";
				} elseif ($curr_page > 6 && $more) {
					$multipage .= "<a href='" . pageurl($urlrule, 1, $array) . "' onclick='page(1)'>1</a><a href='##'>...</a></li>";
				} else {
					$multipage .= "<a href='" . pageurl($urlrule, 1, $array) . "' onclick='page(1)'>1</a>";
				}
			}
			for ($i = $from; $i <= $to; $i ++) {
				if ($i != $curr_page) {
					$multipage .= "<a href='" . pageurl($urlrule, $i, $array) . "' onclick='page(".$i.")'>".$i."</a>";
				} else {
					$multipage .= "<a href='" . pageurl($urlrule, $i, $array) . "' onclick='page(".$i.")' style='background:rgb(230,38,51);color:white;'>".$i."</a>";
				}
			}
			
			
			if ($curr_page < $pages) {
			
				if ($curr_page < $pages - 5 && $more) {
				
					$multipage .= "<a href='##' >...</a><a href='" . pageurl($urlrule, $pages, $array) . "' onclick='page(".$pages.")'>". $pages ."</a><a href='" . pageurl($urlrule, $curr_page + 1, $array) . "' onclick='page(".($curr_page + 1).")'>下一页&nbsp;&nbsp;&gt;</a>";
				} else {
				
				   $multipage .= "<a href='" . pageurl($urlrule, $pages, $array) . "' onclick='page(".$pages.")'>". $pages ."</a><a href='" . pageurl($urlrule, $curr_page + 1, $array) . "' onclick='page(".($curr_page + 1).")'>下一页&nbsp;&nbsp;&gt;</a>";
				}
			} elseif ($curr_page == $pages) {
				$multipage .= "<a href='##' onclick='page(".$pages.")' style='background:rgb(230,38,51);color:white;'>". $pages ."</a><a href='##' >下一页&nbsp;&nbsp;&gt;</a> ";
			} else {
				$multipage .= "<a href='" . pageurl($urlrule, $pages, $array) . "' onclick='page(".$pages.")'>". $pages ."</a><a href='" . pageurl($urlrule, $curr_page + 1, $array) . "' onclick='page(".($curr_page + 1).")'>下一页&nbsp;&nbsp;&gt;</a>";
			}
		}
		$multipage = $multipage;
		return $multipage;
		
	}

	//用户中心首页
	public function index()
	{
		if(empty($_SESSION['user_id'])&&!in_array(getgpc("a"),array("login","barclays")))
		{
			header("Location:".pfUrl("acenter","index","login"));
		}
		$page_size = 8;
		$page = max(getgpc('page'),1);
		$orderremark = getgpc("orderremark");


		/*账户*/
		$account = D("Acenter")->query("select * from `jjs_user_finance` where user_id = ".$_SESSION["user_id"]);
		
		//可用余额
		$available = $account[0]["recharge"]+$account[0]["inamount"]+$account[0]["extendamount"]+$account[0]["tempamount"]-$account[0]["withdraw"]-$account[0]["bond"]-$account[0]["outamount"];
		$jlist = D("Acenter")->query("select sum(price) as totalprice from `jjs_contract` where status = 0 and user_id = ".$_SESSION["user_id"]." and is_del = 0");
		$disperity = $available-$jlist[0]["totalprice"];
		//总金币
		$assets = $disperity+$account[0]["frozen"];

		//全部订单
		$allorders = D("Acenter")->query("select * from `jjs_order` where user_id = ".$_SESSION["user_id"]);
		//待付款
		$nopay = D("Acenter")->query("select * from `jjs_order` where user_id = ".$_SESSION["user_id"]." and status = 0");
		//待发货
		$nodeliver = D("Acenter")->query("select * from `jjs_order` where user_id = ".$_SESSION["user_id"]." and status in(1,20)");
		//待收货
		$noreceived = D("Acenter")->query("select * from `jjs_order` where user_id = ".$_SESSION["user_id"]." and status = 2");
		//待评价
		$nocomment = D("Acenter")->query("select * from `jjs_order` where user_id = ".$_SESSION["user_id"]." and status = 3");

		//我的购物车
		$myshopcar = D("Acenter")->query("select S.gid,G.img,G.price from `jjs_shopcar` S,`jjs_goods` G where S.gid = G.id and S.user_id = ".$_SESSION["user_id"]." limit 10");

		//查询用户是否已经挂牌
		$is_entry = D("Acenter")->query("select * from `jjs_entry_market` where user_id = ".$_SESSION["user_id"]);
				
		if($orderremark){
			//全部订单
			if($orderremark == "全部"){
				$ordernum = D("Acenter")->query("select count(1) as count from `jjs_order` where user_id = ".$_SESSION["user_id"]);
				$ordercount = $ordernum[0]["count"];
				$orders = D("Acenter")->query("select * from `jjs_order` where user_id = ".$_SESSION["user_id"]." order by ctime desc limit ".($page-1)*$page_size.",".$page_size);
			}elseif($orderremark == "待付款"){
				$ordernum = D("Acenter")->query("select count(1) as count from `jjs_order` where user_id = ".$_SESSION["user_id"]." and status = 0");
				$ordercount = $ordernum[0]["count"];
				$orders = D("Acenter")->query("select * from `jjs_order` where user_id = ".$_SESSION["user_id"]." and status = 0 order by ctime desc limit ".($page-1)*$page_size.",".$page_size);
			}elseif($orderremark == "待发货"){
				$ordernum = D("Acenter")->query("select count(1) as count from `jjs_order` where user_id = ".$_SESSION["user_id"]." and status = 1");
				$ordercount = $ordernum[0]["count"];
				$orders = D("Acenter")->query("select * from `jjs_order` where user_id = ".$_SESSION["user_id"]." and status = 1 order by ctime desc limit ".($page-1)*$page_size.",".$page_size);
			}elseif($orderremark == "待收货"){
				$ordernum = D("Acenter")->query("select count(1) as count from `jjs_order` where user_id = ".$_SESSION["user_id"]." and status = 2");
				$ordercount = $ordernum[0]["count"];
				$orders = D("Acenter")->query("select * from `jjs_order` where user_id = ".$_SESSION["user_id"]." and status = 2 order by ctime desc limit ".($page-1)*$page_size.",".$page_size);
			}elseif($orderremark == "待评价"){
				$ordernum = D("Acenter")->query("select count(1) as count from `jjs_order` where user_id = ".$_SESSION["user_id"]." and status = 3");
				$ordercount = $ordernum[0]["count"];
				$orders = D("Acenter")->query("select * from `jjs_order` where user_id = ".$_SESSION["user_id"]." and status = 3 order by ctime desc limit ".($page-1)*$page_size.",".$page_size);
			}
			foreach($orders as $k=>$v){
				$orders[$k]["single_time"] = date("Y-m-d H:i",strtotime($v["single_time"]));
			}
			$urlrule = pfurl('','index','index',array("orderremark"=>$orderremarks));
			$pages = $this->pages($ordercount, $page, $page_size,$urlrule);
		}else{
			$ordernum = D("Acenter")->query("select count(1) as count from `jjs_order` where user_id = ".$_SESSION["user_id"]);
			$ordercount = $ordernum[0]["count"];
			$orders = D("Acenter")->query("select * from `jjs_order` where user_id = ".$_SESSION["user_id"]." order by ctime desc limit ".($page-1)*$page_size.",".$page_size);
			$urlrule = pfurl('','index','index');
			$pages = $this->pages($ordercount, $page, $page_size,$urlrule);
		}
		
		
		$this->assign("orders",$orders);
		$this->assign("pages",$pages);
		$this->assign("assets",$assets);
		$this->assign("account",$account);
		$this->assign("disperity",$disperity);
		$this->assign("all",count($allorders));
		$this->assign("nopay",count($nopay));
		$this->assign("nodeliver",count($nodeliver));
		$this->assign("noreceived",count($noreceived));
		$this->assign("nocomment",count($nocomment));
		$this->assign("myshopcar",$myshopcar);
		$this->assign("is_entry",$is_entry);//是否挂牌
		
		$this->display();
	}
	


}
