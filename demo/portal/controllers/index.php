<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('PortalAction');
class index extends PortalAction
{
	public function __construct()
	{
		//七天之后卖家卖商品的钱进入可用余额(买家未确认收货情况)
		$stamtime = time()-3600*24*7;
		$res = D("Portal")->query("select P.order_sn,P.sqlstr,O.tel,P.sellerid from `jjs_store_payment` P,`jjs_order` O where P.order_sn = O.order_sn and P.created<'".$stamtime."' and P.status = 0 and O.status = 2");
		if($res){
			foreach($res as $k=>$v){
				D("Portal")->querysql("".mysql_real_escape_string($v["sqlstr"])."");
				D("Portal")->querysql("update `jjs_store_payment` set status = 1 where order_sn = ".$v["order_sn"]);
				D("Portal")->querysql("update `jjs_order` set status = 3,receipt_time = '".date("Y-m-d H:i:s")."',complete_time = '".date("Y-m-d H:i:s")."' where order_sn = '".$v["order_sn"]."'");
				D("Portal")->querysql("insert into `jjs_detail` (user_id,cate,remark,amount,ctime) values('".$v["sellerid"]."','1257','订单号为".$v["order_sn"]."的商品进账','+".$v["tel"]."','".date("Y-m-d H:i:s")."')");
			}

		}

		//10天之内未发货将退回买家可用余额
		$otime = date("Y-m-d H:i:s",time()-3600*24*10);
		$orders = D("Portal")->query("select order_sn,user_id,total,seller_id from `jjs_order` where status in(1,20) and pay_time<'".$otime."'");
		if($orders){
			foreach($orders as $k=>$v){
				D("Portal")->querysql("update `jjs_user_finance` set outamount = outamount-".$v["total"]." where user_id = ".$v["user_id"]);
				D("Portal")->querysql("insert into `jjs_detail` (user_id,cate,remark,amount,ctime) values('".$v["user_id"]."','1256','订单".$v["order_sn"]."超时已自动取消','+".$v["total"]."','".date("Y-m-d H:i:s")."')");
				D("Portal")->querysql("insert into `jjs_detail` (user_id,cate,remark,amount,ctime) values('".$v["user_id"]."','1256','订单".$v["order_sn"]."超时已自动取消','0','".date("Y-m-d H:i:s")."')");
				D("Portal")->querysql("delete from `jjs_order` where order_sn = '".$v["order_sn"]."'");
				D("Portal")->querysql("delete from `jjs_store_payment` where order_sn = '".$v["order_sn"]."'");
			}
		}
		
		
		
		//购物车商品总数
		$shopcar = D("Portal")->query("select count(1) as count from `jjs_shopcar` where user_id = ".$_SESSION["user_id"]);

		//用户资料
		$userdata = D("Portal")->query("select id,realname,phone,idcard,bank,bank_card,address,head_img,nickname,email,role,type from `jjs_user` where id=".$_SESSION['user_id']);

		//热门商品
		$goods = D("Portal")->query("select id,title,img from `jjs_goods` where goods_status = 1 and status = 1 and stock > 0 order by sold desc limit 8");

		$this->assign("shopcar",$shopcar[0]["count"]);
		$this->assign("userdata",$userdata[0]);
		$this->assign("goods",$goods);
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

	//首页数据
	public function index()
	{
		//通知公告
		$announcement = D("Portal")->query("select A.* from `jjs_article` A,`jjs_article_cate` C where A.cateid = C.id and C.title = '通知公告' order by A.id desc limit 6");

		//市场动态
		$market_dynamics = D("Portal")->query("select A.* from `jjs_article` A,`jjs_article_cate` C where A.cateid = C.id and C.title = '市场动态' order by A.id desc limit 6");
		
		//底部友情链接
		$links = D("Portal")->query("select * from `jjs_link` where is_show = 1");

		
		//实时行情
		$goods = D("Portal")->query("select id,user_id,code,price,title,num,surplus_num from `jjs_goods_release` where release_status = 1");
		$pricetables = D("Portal")->query("show tables like '%price%'");
		foreach($goods as $key=>$vo){
			if($pricetables){
				$highestprice = array();
				$lowestprice = array();
				$newprice = array();
				$totalprice = array();
				$num = array();
				foreach($pricetables as $k=>$v){
					//最高价、最低价
					$res = D("Portal")->query("select max(price) as highestprice,min(price) as lowestprice from `".$v["Tables_in_jjs (%price%)"]."` where g_code = '".$vo["code"]."' order by ctime desc");
					if($res[0]["highestprice"]) $highestprice[] = $res[0]["highestprice"];
					if($res[0]["lowestprice"]) $lowestprice[] = $res[0]["lowestprice"];
					
					//最新价
					$deal = D("Portal")->query("select price from `".$v["Tables_in_jjs (%price%)"]."` where g_code = '".$vo["code"]."' order by ctime desc limit 1");
					if($deal[0]["price"]) $newprice[] = $deal[0]["price"];
					
					//价格统计
					$total = D("Portal")->query("select sum(price) as totalprice,count(1) as count from `".$v["Tables_in_jjs (%price%)"]."` where g_code = '".$vo["code"]."' order by ctime desc");
					if($total[0]["totalprice"]){ 
						$totalprice["totalprice"] += $total[0]["totalprice"];
						$totalprice["count"] += $total[0]["count"];
					}

					//成交量统计
					$totalnum = D("Portal")->query("select sum(num) as dealnum from `".$v["Tables_in_jjs (%price%)"]."` where g_code = '".$vo["code"]."' order by ctime desc");
					if($totalnum[0]["dealnum"]){ 
						$dealnum += $totalnum[0]["dealnum"];
					}

				}
				$highestprice[] = $vo["price"];
				$lowestprice[] = $vo["price"];
				rsort($highestprice);
				sort($lowestprice);

				$opentime = date("Y-m-d 04:00:00",time());
				$closetime = date("Y-m-d 21:00:00",time()-24*3600);
				$openprice = D("Portal")->query("select price from `jjs_price_".date("Ymd",time())."` where g_code = '".$vo["code"]."' and ctime > '".$opentime."' order by ctime asc limit 1");
				$closeprice = D("Portal")->query("select price from `jjs_price_".date("Ymd",time()-24*3600)."` where g_code = '".$vo["code"]."' and ctime < '".$closetime."' order by ctime desc limit 1");

				
				if($newprice){ 
					$range = end($newprice)-$vo["price"];
					$rangerate = sprintf("%.2f",($range/$vo["price"])*100)."%";
					$goods[$key]["newprice"] = end($newprice); //最新价
					$goods[$key]["range"] = $range; //涨跌
				}else{ 
					$goods[$key]["newprice"] = $vo["price"];
					$goods[$key]["range"] = 0; //涨跌
				}

				//现量统计
				$coin = D("Portal")->query("select sum(quantity) as quantity from `jjs_contract` where g_code = '".$vo["code"]."' and status = 0 and cate = 1 and is_del = 0");
				$surplus = $vo["surplus_num"]-$coin[0]["quantity"];//现量
				$goods[$key]["surplus"] = $surplus;

				if($highestprice) $goods[$key]["highestprice"] = $highestprice[0]; else $goods[$key]["highestprice"] = $vo["price"];//最高价
				if($lowestprice) $goods[$key]["lowestprice"] = $lowestprice[0]; else $goods[$key]["lowestprice"] = $vo["price"];//最低价
				if($totalprice){ $goods[$key]["totalprice"] = $totalprice["totalprice"];$goods[$key]["avarageprice"] = round($totalprice["totalprice"]/$totalprice["count"],2); }else{ $goods[$key]["totalprice"] = 0;$goods[$key]["avarageprice"] = $vo["price"];}//均价
				if($dealnum) $goods[$key]["dealnum"] = $dealnum; else $goods[$key]["dealnum"] = 0;//成交量

				if($openprice[0]["price"] && $closeprice[0]["price"]){ 

					$goods[$key]["openprice"] = $openprice[0]["price"]; //开盘价
					$goods[$key]["closeprice"] = $closeprice[0]["price"];//昨日收盘价

				}elseif($openprice[0]["price"] && empty($closeprice[0]["price"])){ 
					$now = D("Portal")->query("select t_price from `jjs_contract` where g_code = '".$vo["code"]."' and status != 0 and ctime < '".date("Y-m-d",time()-24*3600)."' order by ctime desc limit 1 ");
					$goods[$key]["openprice"] = $openprice[0]["price"]; //开盘价
					if($now[0]["t_price"]) $goods[$key]["closeprice"] = $now[0]["t_price"];else $goods[$key]["closeprice"] = $vo["price"];

				}elseif(empty($openprice[0]["price"]) && $closeprice[0]["price"]){ 

					$goods[$key]["openprice"] = $closeprice[0]["price"]; //开盘价
					$goods[$key]["closeprice"] = $closeprice[0]["price"];//昨日收盘价

				}elseif(empty($openprice[0]["price"]) && empty($closeprice[0]["price"])){ 
					$now = D("Portal")->query("select t_price from `jjs_contract` where g_code = '".$vo["code"]."' and status != 0 and ctime < '".date("Y-m-d",time()-24*3600)."' order by ctime desc limit 1 ");
					
					if($now[0]["t_price"]){ $goods[$key]["openprice"] = $now[0]["t_price"]; $goods[$key]["closeprice"] = $now[0]["t_price"];}else{$goods[$key]["openprice"] = $vo["price"]; $goods[$key]["closeprice"] = $vo["price"];}//昨日收盘价

				}
				
			}
		}
		$realtime_quotes = $goods;
		
		$this->assign("announcement",$announcement);
		$this->assign("market_dynamics",$market_dynamics);
		$this->assign("links",$links);
		$this->assign("realtime_quotes",$realtime_quotes);
		$this->display();
	}

	//入场登记更多
	public function more()
	{
		$page_size = $this->pageSize;
		$page = max(getgpc('page'),1);

		$goodsnum = D("Portal")->query("select count(1) as count from `jjs_goods` where goods_status = 1 and status = 1 and release_status = 1 and stock > 0 ");
		$count = $goodsnum[0]["count"];
		$goods = D("Portal")->query("select id,title,img from `jjs_goods` where goods_status = 1 and status = 1 and release_status = 1 and stock > 0 order by ctime desc limit ".($page-1)*$page_size.",".$page_size);
		$urlrule = pfurl('','index','more');
		$pages = $this->pages($count, $page, $page_size,$urlrule);

		$this->assign("goods",$goods);
		$this->assign("pages",$pages);
		$this->assign("count",$count);
	}

	
}
