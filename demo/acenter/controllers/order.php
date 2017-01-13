<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('AcenterAction');
class user extends AcenterAction
{

    private $pageSize = 8;
    public function __construct()
    {
		if(empty($_SESSION['user_id'])){
			header("Location:".pfUrl("acenter","index","login"));
		}

		//购物车商品总数
		$shopcar = D("Portal")->query("select sum(num) as sum from `jjs_shopcar` where user_id = ".$_SESSION["user_id"]);

		//用户资料
		$userdata = D("Portal")->query("select id,realname,phone,idcard,bank,bank_card,address,head_img,nickname,email,role from `jjs_user` where id=".$_SESSION['user_id']);

		$this->assign("shopcarsum",$shopcar[0]["sum"]);
		$this->assign("userdata",$userdata[0]);

		parent::__construct();
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

	//订单管理
	public function coin()
	{
		$page_size = $this->pageSize;
		$page = max(getgpc('page'),1);
		$order_sn = getgpc("order_sn");

		//订单列表
		$ordersnum = D("Acenter")->query("select count(1) as count from `jjs_order` where seller_id = ".$_SESSION["user_id"]." order by ctime desc");
		$count = $ordersnum[0]["count"];
		$orders = D("Acenter")->query("select * from `jjs_order` where seller_id = ".$_SESSION["user_id"]." order by ctime desc limit ".($page-1)*$page_size.",".$page_size);
		$urlrule = pfurl('','user','order');
		$pages = $this->pages($count, $page, $page_size,$urlrule);

		//订单详情
		$detail = D("Acenter")->query("select * from `ewb_order` where order_sn = '".$order_sn."'");

		$this->assign("orders",$orders);
		$this->assign("count",$count);
		$this->assign("pages",$pages);
		$this->assign("detail",$detail[0]);

		$this->display();
	}


}
