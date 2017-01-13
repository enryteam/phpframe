<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('PortalAction');
class information extends PortalAction
{
	public function __construct()
	{
		//购物车商品总数
		$shopcar = D("Portal")->query("select count(1) as count from jjs_shopcar where user_id = ".$_SESSION["user_id"]);

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

	//信息公告
	public function bulletin()
	{
		//通知公告
		$announcement = D("Portal")->query("select A.* from `jjs_article` A,`jjs_article_cate` C where A.is_show = 1 and A.cateid = C.id and C.title = '通知公告' order by A.id desc limit 14");

		//市场动态
		$market_dynamics = D("Portal")->query("select * from `jjs_entry_market` where status = 1 order by ctime desc limit 12");
		
		$this->assign("announcement",$announcement);
		$this->assign("market_dynamics",$market_dynamics);
		$this->display();
	}

	//用户指导
	public function user_guide()
	{
		//相关流程
		$related_process = D("Portal")->query("select A.* from `jjs_article` A,`jjs_article_cate` C where A.is_show = 1 and A.cateid = C.id and C.title = '相关流程' order by A.id desc limit 5");

		//问题解答
		$problem_solving = D("Portal")->query("select A.* from `jjs_article` A,`jjs_article_cate` C where A.is_show = 1 and A.cateid = C.id and C.title = '问题解答' order by A.id desc limit 4");
		
		$this->assign("related_process",$related_process);
		$this->assign("problem_solving",$problem_solving);
		$this->display();
	}
	
	//市场综述
	public function market_overview()
	{
		$page_size = 8;
		$page = max(getgpc('page'),1);

		//市场综述
		$r = D("Portal")->query("select count(1) as count from `jjs_article` A,`jjs_article_cate` C where A.is_show = 1 and A.cateid = C.id and C.title = '市场综述'");
		$count = $r[0]['count'];
		$market_overview = D("Portal")->query("select A.* from `jjs_article` A,`jjs_article_cate` C where A.is_show = 1 and A.cateid = C.id and C.title = '市场综述' order by A.id desc limit ".($page-1)*$page_size.",".$page_size);
		
		$urlrule = pfurl('','information','market_overview');
		$pages = $this->pages($count, $page, $page_size,$urlrule);
		
		$this->assign("market_overview",$market_overview);
		$this->assign("count", $count);
		$this->assign("pages",$pages);
		$this->display();
	}

	//交易中心
	public function dealcenter()
	{
		//买入总量、总额
		$buy = D("Portal")->query("select sum(price) as price,sum(quantity) as quantity from `jjs_contract` where cate = 0 and status !=0");
		$buytotal = $buy[0]["price"]*$buy[0]["quantity"];

		//卖出总量、总额
		$sold = D("Portal")->query("select sum(price) as price,sum(quantity) as quantity from `jjs_contract` where cate = 1 and status !=0");
		$soldtotal = $sold[0]["price"]*$sold[0]["quantity"];

		 //成交总量、总额
		$deal = D("Portal")->query("select sum(price) as price,sum(quantity) as quantity from `jjs_contract` where status !=0");
		$dealtotal = $deal[0]["price"]*$deal[0]["quantity"];

		//交易动态trading_dynamics
		$trading_dynamics = D("Portal")->query("select C.*,U.account from `jjs_contract` C,`jjs_user` U where status !=0 and C.user_id = U.id limit 12");
		
		//交易指南
		$trading_guide = D("Portal")->query("select A.* from `jjs_article` A,`jjs_article_cate` C where A.cateid = C.id and C.title = '交易指南' order by A.id desc limit 14");
		
		$this->assign('dealdata',array("dealtotal"=>$dealtotal,"soldtotal"=>$soldtotal,"buytotal"=>$buytotal));
		$this->assign("trading_dynamics",$trading_dynamics);
		$this->assign("trading_guide", $trading_guide);
		$this->display();
	}

	//行业资讯
	public function industry_information()
	{
		$page_size = 32;
		$page = max(getgpc('page'),1);

		//行业资讯
		$r = D("Portal")->query("select count(1) as count from `jjs_article` A,`jjs_article_cate` C where A.cateid = C.id and C.title = '行业资讯'");
		$count = $r[0]['count'];
		$industry_information = D("Portal")->query("select A.* from `jjs_article` A,`jjs_article_cate` C where A.cateid = C.id and C.title = '行业资讯' order by A.id desc limit ".($page-1)*$page_size.",".$page_size);
		
		$urlrule = pfurl('','information','industry_information');
		$pages = $this->pages($count, $page, $page_size,$urlrule);
		
		$this->assign("industry_information",$industry_information);
		$this->assign("count", $count);
		$this->assign("pages",$pages);
		$this->display();
	}

	//相关下载
	public function related_download()
	{
		$page_size = 8;
		$page = max(getgpc('page'),1);

		//相关下载
		$r = D("Portal")->query("select count(1) as count from `jjs_article` A,`jjs_article_cate` C where A.is_show = 1 and A.cateid = C.id and C.title = '相关下载'");
		$count = $r[0]['count'];
		$related_download = D("Portal")->query("select A.* from `jjs_article` A,`jjs_article_cate` C where A.is_show = 1 and A.cateid = C.id and C.title = '相关下载' order by A.id desc limit ".($page-1)*$page_size.",".$page_size);
		
		$urlrule = pfurl('','information','related_download');
		$pages = $this->pages($count, $page, $page_size,$urlrule);
		
		$this->assign("related_download",$related_download);
		$this->assign("count", $count);
		$this->assign("pages",$pages);
		$this->display();
	}

	//文章详情页
	public function detail()
	{
		$id = intval(getgpc("id"));
		$remark = getgpc("remark");
		$detail = D("Portal")->query("select * from `jjs_article` where id = ".$id);
		$catename = D("Portal")->query("select title from `jjs_article_cate` where id = ".$detail[0]["cateid"]);
		//上一篇
		$sql_former = "select * from `jjs_article` where id<".$id." and cateid = ".$detail[0]["cateid"]." order by id desc ";

		//下一篇
		$sql_later = "select * from `jjs_article` where id>".$id." and cateid = ".$detail[0]["cateid"];

		$queryset_former = mysql_query($sql_former); //执行sql语句
		if(mysql_num_rows($queryset_former)){ //返回记录数，并判断是否为真，以此为依据显示结果
			$resultformer = mysql_fetch_array($queryset_former);
			$former = "<a href='index.php?c=information&a=detail&id=$resultformer[id]&cateid=".$detail[0]["cateid"]."&remark=".$remark."'> ". mb_substr(strip_tags($resultformer['title']),0,20,'utf-8')." </a>";
		} else {$former = "没有了";}
		
		$queryset_later = mysql_query($sql_later);
		if(mysql_num_rows($queryset_later)){
			$result = mysql_fetch_array($queryset_later);
			$later = "<a href='index.php?c=information&a=detail&id=$result[id]&cateid=".$detail[0]["cateid"]."&remark=".$remark."'> ". mb_substr(strip_tags($result['title']),0,20,'utf-8')."</a><br>";
		} else {$later = "没有了<br>";} 

		$this->assign("detail",$detail[0]);
		$this->assign("former",$former);
		$this->assign("later",$later);
		$this->assign("catename",$catename[0]["title"]);
		$this->display();
	}

	//更多文章显示
	public function more()
	{
		$page_size = 8;
		$page = max(getgpc('page'),1);
		$cateid = intval(getgpc("cateid"));
		$count = D("Portal")->query("select count(1) as count from `jjs_article` where is_show = 1 and cateid = ".$cateid);
		$more = D("Portal")->query("select * from `jjs_article` where is_show = 1 and cateid = ".$cateid." order by id desc limit ".($page-1)*$page_size.",".$page_size);
		$urlrule = pfurl('','information','more',array('cateid'=>$cateid));
		$pages = $this->pages($count[0]["count"], $page, $page_size,$urlrule);

		$this->assign("more",$more);
		$this->assign("count", $count[0]["count"]);
		$this->assign("pages",$pages);
		$this->assign("cateid",$cateid);
		$this->display();
	}
	

}
