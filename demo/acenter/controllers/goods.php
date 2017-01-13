<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('AcenterAction');
class user extends AcenterAction
{

    private $pageSize = 8;
    public function __construct()
    {
		//商品分类
		$cate = D("Acenter")->query("select * from `jjs_goods_cate`");

		//购物车商品总数
		$shopcar = D("Acenter")->query("select sum(num) as sum from jjs_shopcar where user_id = ".$_SESSION["user_id"]);

		//用户资料
		$userdata = D("Acenter")->query("select id,realname,phone,idcard,bank,bank_card,address,head_img,nickname,email,role from `jjs_user` where id=".$_SESSION['user_id']);

		$this->assign("shopcarsum",$shopcar[0]["sum"]);
		$this->assign("userdata",$userdata[0]);
		$this->assign("cate",$cate);

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

	//商品管理
	public function goods()
	{
		$page_size = 11;
		$page = max(getgpc('page'),1);
		$orderby = getgpc("orderby");
		$goods_id = getgpc("goods_id");
		
		//商品列表
		if($orderby){
			if($orderby == '销量排序'){
				$goodsnum = D("Acenter")->query("select count(1) as count from `jjs_goods` where user_id = ".$_SESSION["user_id"]." order by sold desc");
				$count = $goodsnum[0]["count"];
				$goods = D("Acenter")->query("select * from `jjs_goods` where user_id = ".$_SESSION["user_id"]." order by sold desc limit ".($page-1)*$page_size.",".$page_size);
			}elseif($orderby == '库存排序'){
				$goodsnum = D("Acenter")->query("select count(1) as count from `jjs_goods` where user_id = ".$_SESSION["user_id"]." order by stock desc");
				$count = $goodsnum[0]["count"];
				$goods = D("Acenter")->query("select * from `jjs_goods` where user_id = ".$_SESSION["user_id"]." order by stock desc limit ".($page-1)*$page_size.",".$page_size);
			}elseif($orderby == '上架时间排序'){
				$goodsnum = D("Acenter")->query("select count(1) as count from `jjs_goods` where user_id = ".$_SESSION["user_id"]." order by ctime desc");
				$count = $goodsnum[0]["count"];
				$goods = D("Acenter")->query("select * from `jjs_goods` where user_id = ".$_SESSION["user_id"]." order by ctime desc limit ".($page-1)*$page_size.",".$page_size);
			}
			$urlrule = pfurl('','user','goods',array('orderby'=>$orderby));

		}else{

			$goodsnum = D("Acenter")->query("select count(1) as count from `jjs_goods` where user_id = ".$_SESSION["user_id"]." order by ctime desc");
			$count = $goodsnum[0]["count"];
			$goods = D("Acenter")->query("select * from `jjs_goods` where user_id = ".$_SESSION["user_id"]." order by ctime desc limit ".($page-1)*$page_size.",".$page_size);
			$urlrule = pfurl('','user','goods');

		}
		$pages = $this->pages($count, $page, $page_size,$urlrule);

		//商品编辑详情
		$detail = D("Acenter")->query("select * from `jjs_goods` where id = ".$goods_id);

		$this->assign("goods",$goods);
		$this->assign("count",$count);
		$this->assign("pages",$pages);
		$this->assign("detail",$detail[0]);

		//载入模板
		$this->display();
	}


}
