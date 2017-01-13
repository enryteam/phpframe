<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('PortalAction');
class goods extends PortalAction
{
	public function __construct()
	{
		//购物车商品总数
		$shopcar = D("Portal")->query("select count(1) as count from jjs_shopcar where user_id = ".$_SESSION["user_id"]);

		//用户资料
		$userdata = D("Portal")->query("select id,realname,phone,idcard,bank,bank_card,address,head_img,nickname,email,role,type from `jjs_user` where id=".$_SESSION['user_id']);

		$this->assign("shopcar",$shopcar[0]["count"]);
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
					$multipage .= "<a href='" . pageurl($urlrule, 1, $array) . "#anchor' onclick='page(1)'>1</a><a href='##'>...</a></li>";
				} else {
					$multipage .= "<a href='" . pageurl($urlrule, 1, $array) . "#anchor' onclick='page(1)'>1</a>";
				}
			}
			for ($i = $from; $i <= $to; $i ++) {
				if ($i != $curr_page) {
					$multipage .= "<a href='" . pageurl($urlrule, $i, $array) . "#anchor' onclick='page(".$i.")'>".$i."</a>";
				} else {
					$multipage .= "<a href='" . pageurl($urlrule, $i, $array) . "#anchor' onclick='page(".$i.")' style='background:rgb(230,38,51);color:white;'>".$i."</a>";
				}
			}
			
			
			if ($curr_page < $pages) {
			
				if ($curr_page < $pages - 5 && $more) {
				
					$multipage .= "<a href='##' >...</a><a href='" . pageurl($urlrule, $pages, $array) . "#anchor' onclick='page(".$pages.")'>". $pages ."</a><a href='" . pageurl($urlrule, $curr_page + 1, $array) . "#anchor' onclick='page(".($curr_page + 1).")'>下一页&nbsp;&nbsp;&gt;</a>";
				} else {
				
				   $multipage .= "<a href='" . pageurl($urlrule, $pages, $array) . "#anchor' onclick='page(".$pages.")'>". $pages ."</a><a href='" . pageurl($urlrule, $curr_page + 1, $array) . "#anchor' onclick='page(".($curr_page + 1).")'>下一页&nbsp;&nbsp;&gt;</a> ";
				}
			} elseif ($curr_page == $pages) {
				$multipage .= "<a href='##' onclick='page(".$pages.")' style='background:rgb(230,38,51);color:white;'>". $pages ."</a><a href='##' >下一页&nbsp;&nbsp;&gt;</a>";
			} else {
				$multipage .= "<a href='" . pageurl($urlrule, $pages, $array) . "#anchor' onclick='page(".$pages.")'>". $pages ."</a><a href='" . pageurl($urlrule, $curr_page + 1, $array) . "#anchor' onclick='page(".($curr_page + 1).")'>下一页&nbsp;&nbsp;&gt;</a>";
			}
		}
		$multipage = $multipage;
		return $multipage;
		
	}

	//默认
	public function index()
	{
		$page_size = 16;
		$page = max(getgpc('page'),1);
		$cid = getgpc("cid");

		//商品排序
		if($orderby)
		{
			if($orderby == "默认"){
				$r = D("Portal")->query("select count(1) as count from `jjs_goods` G,`jjs_entry_market` M,`jjs_user` U where G.goods_status = 1 and G.status = 1 and G.stock > 0 and G.user_id = M.user_id and M.status = 1 and G.user_id = U.id ");
				$allgoods = D("Portal")->query("select G.id,G.title,G.price,G.img,G.sold,M.company,M.qq,U.realname from `jjs_goods` G,`jjs_entry_market` M,`jjs_user` U where G.goods_status = 1 and G.status = 1 and G.stock > 0 and G.user_id = M.user_id and M.status = 1 and G.user_id = U.id order by G.ctime desc limit ".($page-1)*$page_size.",".$page_size);
				$count = $r[0]['count'];
			
			}elseif($orderby == "销量"){
				$r = D("Portal")->query("select count(1) as count from `jjs_goods` G,`jjs_entry_market` M,`jjs_user` U where G.goods_status = 1 and G.status = 1 and G.stock > 0 and G.user_id = M.user_id and M.status = 1 and G.user_id = U.id ");
				$allgoods = D("Portal")->query("select G.id,G.title,G.price,G.img,G.sold,M.company,M.qq,U.realname from `jjs_goods` G,`jjs_entry_market` M,`jjs_user` U where G.goods_status = 1 and G.status = 1 and G.stock > 0 and G.user_id = M.user_id and M.status = 1 and G.user_id = U.id order by G.sold desc limit ".($page-1)*$page_size.",".$page_size);
				$count = $r[0]['count'];

			}elseif($orderby == "最新"){
				$r = D("Portal")->query("select count(1) as count from `jjs_goods` G,`jjs_entry_market` M,`jjs_user` U where G.goods_status = 1 and G.status = 1 and G.stock > 0 and G.user_id = M.user_id and M.status = 1 and G.user_id = U.id ");
				$allgoods = D("Portal")->query("select G.id,G.title,G.price,G.img,G.sold,M.company,M.qq,U.realname from `jjs_goods` G,`jjs_entry_market` M,`jjs_user` U where G.goods_status = 1 and G.status = 1 and G.stock > 0 and G.user_id = M.user_id and M.status = 1 and G.user_id = U.id order by G.ctime desc limit ".($page-1)*$page_size.",".$page_size);
				$count = $r[0]['count'];

			}elseif($orderby == "价格"){
				$r = D("Portal")->query("select count(1) as count from `jjs_goods` G,`jjs_entry_market` M,`jjs_user` U where G.goods_status = 1 and G.status = 1 and G.stock > 0 and G.user_id = M.user_id and M.status = 1 and G.user_id = U.id ");
				$allgoods = D("Portal")->query("select G.id,G.title,G.price,G.img,G.sold,M.company,M.qq,U.realname from `jjs_goods` G,`jjs_entry_market` M,`jjs_user` U where G.goods_status = 1 and G.status = 1 and G.stock > 0 and G.user_id = M.user_id and M.status = 1 and G.user_id = U.id order by G.price desc limit ".($page-1)*$page_size.",".$page_size);
					$count = $r[0]['count'];
			}

			$urlrule = pfurl('','goods','index',array("orderby"=>$orderby));
			$pages = $this->pages($count, $page, $page_size,$urlrule);
			
		}else{
			$r = D("Portal")->query("select count(1) as count from `jjs_goods` G,`jjs_entry_market` M,`jjs_user` U where G.goods_status = 1 and G.status = 1 and G.stock > 0 and G.user_id = M.user_id and M.status = 1 and G.user_id = U.id");
			$allgoods = D("Portal")->query("select G.id,G.title,G.price,G.img,G.sold,M.company,M.qq,U.realname from `jjs_goods` G,`jjs_entry_market` M,`jjs_user` U where G.goods_status = 1 and G.status = 1 and G.stock > 0 and G.user_id = M.user_id and M.status = 1 and G.user_id = U.id order by G.ctime desc limit ".($page-1)*$page_size.",".$page_size);
			$count = $r[0]['count'];
		}

		//商品搜索
		$search = getgpc("search");

		if($search){
			$r = D("Portal")->query("select count(1) as count from `jjs_goods` G,`jjs_entry_market` M,`jjs_user` U where G.goods_status = 1 and G.status = 1 and G.stock > 0 and G.user_id = M.user_id and M.status = 1 and G.user_id = U.id and title like '%".$search."%' or code = '".$search."'");
			$allgoods = D("Portal")->query("select G.id,G.title,G.price,G.img,G.sold,M.company,M.qq,U.realname from `jjs_goods` G,`jjs_entry_market` M,`jjs_user` U where G.goods_status = 1 and G.status = 1 and G.stock > 0 and G.user_id = M.user_id and M.status = 1 and G.user_id = U.id and title like '%".$search."%' or code = '".$search."'");
			$count = $r[0]['count'];
			
		}
		$urlrule = pfurl('','goods','index');
		$pages = $this->pages($count, $page, $page_size,$urlrule);
		
		$this->assign("orderby", $orderby);
		$this->assign("allgoods",$allgoods);
		$this->assign("count", $count);
		$this->assign("pages",$pages);

		$this->display();
	}

	//商品详情页
	public function detail()
	{
		$goods_id = intval(getgpc("goods_id"));

		//商品详情
		$detail  = D("Portal")->query("select G.*,M.company,M.qq,U.realname from `jjs_goods` G,`jjs_entry_market` M,`jjs_user` U where G.user_id = M.user_id and M.user_id = U.id and G.id = ".$goods_id);
		if(empty($detail))
		{
			header("Location:index.php?c=goods&a=index");
			exit;
		}
		foreach($detail as $k=>$v){
			$detail[$k]["price"] = ltrim(implode(',', str_split($v["price"],4)),'-'); 
		}
		$urlrule = pfurl('','goods','detail',array("goods_id"=>$goods_id));
		$pages = $this->pages($count, $page, $page_size,$urlrule);

		$this->assign("detail",$detail[0]);
		$this->display();
	}

	//入场登记
	public function release()
	{
		if(empty($_SESSION['user_id'])&&!in_array(getgpc("a"),array("login","barclays")))
		{
			header("Location:../acenter/index.php?c=index&a=login");
		}
		$this->display();
	}

	//网上开户
	public function barclays()
	{
		$this->display();
	}

	//挂牌指南
	public function entry_market()
	{
		$this->display();
	}
	
}
