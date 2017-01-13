<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('AcenterAction');
class user extends AcenterAction
{

    private $pageSize = 8;
    public function __construct()
    {
		if(empty($_SESSION['user_id'])&&!in_array(getgpc("a"),array("login","barclays")))
		{
			header("Location:".pfUrl("acenter","index","login"));
		}
		//商品分类
		$cate = D("Acenter")->query("select * from `jjs_goods_cate`");

		//购物车商品总数
		$shopcar = D("Acenter")->query("select count(1) as count from jjs_shopcar where user_id = ".$_SESSION["user_id"]);

		//用户资料
		$userdata = D("Acenter")->query("select id,realname,phone,idcard,bank,bank_card,address,head_img,nickname,email,role,tpassword,type,area,accountname,business_licence,organization_code,tax_registration,referral_code from `jjs_user` where id=".$_SESSION['user_id']);
		
		//资产类型
		$cates = array(
			"0"=>"全部","5"=>"充值","1"=>"提现","2"=>"购买商城商品","1257"=>"商城订单进账","1256"=>"订单超时自动取消","18010"=>"持仓可用余额","18011"=>"持仓保证金","18014"=>"交易结算返还可用余额","18012"=>"卖出增加可用余额","18112"=>"平台手续费扣除","1333"=>"卖出交易手续费分润"
		);
		$this->assign("shopcar",$shopcar[0]["count"]);
		$this->assign("userdata",$userdata[0]);
		$this->assign("cate",$cate);
		$this->assign("cates",$cates);

		$r = D("Acenter")->query("select * from `jjs_store` where status =1 and user_id = ".$_SESSION["user_id"]);
		if($r) $this->assign("dianpu",'yes');
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

	
	//我的订单
	public function myorder()
	{
		$page_size = $this->pageSize;
		$page = max(getgpc('page'),1);
		$order_sn = getgpc("order_sn");

		//我的订单列表（买家身份）
		$ordersnum = D("Acenter")->query("select count(1) as count from `jjs_order` where user_id = ".$_SESSION["user_id"]." order by ctime desc");
		$count = $ordersnum[0]["count"];
		$orders = D("Acenter")->query("select * from `jjs_order` where user_id = ".$_SESSION["user_id"]." order by ctime desc limit ".($page-1)*$page_size.",".$page_size);
		$urlrule = pfurl('','user','myorder');
		$pages = $this->pages($count, $page, $page_size,$urlrule);

		//订单详情
		$detail = D("Acenter")->query("select * from `jjs_order` where order_sn = '".$order_sn."'");

		//物流信息
		$logistics = json_decode(file_get_contents('http://apistore.51daniu.cn/rest/index.php?a=search&c=express&num='.$detail[0]["logistics_sn"]),true);
		
		//店铺信息
		$store = D("Acenter")->query("select M.*,U.realname,U.phone from `jjs_entry_market` M,`jjs_user` U where M.user_id = U.id and M.user_id = ".$detail[0]["seller_id"]);

		$this->assign("orders",$orders);
		$this->assign("store",$store);
		$this->assign("pages",$pages);
		$this->assign("count",$count);
		$this->assign("detail",$detail);
		$this->assign("logistics",$logistics['data']['data']);
		
		//载入模板
		$this->display();
	}
	
	//订单详情
	public function order_sn()
	{
		$page_size = $this->pageSize;
		$page = max(getgpc('page'),1);
		$order_sn=  getgpc('order_sn');
		//订单详情
		$detail = D("Acenter")->query("select * from `jjs_order` where order_sn = '".$order_sn."'");
		//物流信息
		$logistics = json_decode(file_get_contents('http://apistore.51daniu.cn/rest/index.php?a=search&c=express&num='.$detail[0]["logistics_sn"]),true);
		
		//店铺信息
		$store = D("Acenter")->query("select M.*,U.realname,U.phone from `jjs_entry_market` M,`jjs_user` U where M.user_id = U.id and M.user_id = ".$detail[0]["seller_id"]);

		$this->assign("store",$store);
		$this->assign("detail",$detail);
		$this->assign("logistics",$logistics['data']['data']);
		
		//载入模板
		$this->display();
	}
	
	//资产明细
	public function assets()
	{
		$page_size = 14;
		$page = max(getgpc('page'),1);
		//资产类型查询
		$remark = getgpc("remark");
		if(!empty($remark)){
			if($remark == "全部"){
				$r = D("Acenter")->query("select count(1) as count from `jjs_detail` where user_id = ".$_SESSION["user_id"]." group by cate,ctime order by ctime desc");
				$count = count($r);
				$res = D("Acenter")->query("select * from `jjs_detail` where user_id = ".$_SESSION["user_id"]." group by cate,ctime order by ctime desc limit ".($page-1)*$page_size.",".$page_size);
				
			}else{
				$r = D("Acenter")->query("select count(1) as count from `jjs_detail` where user_id = ".$_SESSION["user_id"]." and remark like '%".$remark."%' group by cate,ctime order by ctime desc");
				$count = count($res);
				$res = D("Acenter")->query("select * from `jjs_detail` where user_id = ".$_SESSION["user_id"]." and remark like '%".$remark."%' group by cate,ctime order by ctime desc limit ".($page-1)*$page_size.",".$page_size);
				
			}

			$urlrule = 'index.php?c=user&a=assets&remark='.$remark;
		}
		//资产明细时间查询
		$today_start = date("Y-m-d 00:00:00",time());
		$today_end = date("Y-m-d 00:00:00",strtotime($today_start)+(3600*24));
		$seven = date("Y-m-d 00:00:00",strtotime($today_start)-(3600*24*7));//最近7天
		$thirty = date("Y-m-d 00:00:00",strtotime($today_start)-(3600*24*30));//最近30天
		$three_month = date("Y-m-d 00:00:00",strtotime($today_start)-(3600*24*30*3));//最近3个月
		$condition = getgpc("condition");
		if(!empty($condition)){
			
			if($condition=="今天"){
				$r = D("Acenter")->query("select count(1) as count from `jjs_detail` where user_id = ".$_SESSION["user_id"]." and ctime between '".$today_start."' and '".$today_end."' group by cate,ctime order by id desc");
				$res = D("Acenter")->query("select * from `jjs_detail` where user_id = ".$_SESSION["user_id"]." and ctime between '".$today_start."' and '".$today_end."' group by cate,ctime order by id desc limit ".($page-1)*$page_size.",".$page_size);
				
				$count = count($r);
			}
			elseif($condition=="最近7天"){
				$r = D("Acenter")->query("select count(1) as count from `jjs_detail` where user_id = ".$_SESSION["user_id"]." and ctime >= '".$seven."' group by cate,ctime order by id desc");
				$res = D("Acenter")->query("select * from `jjs_detail` where user_id = ".$_SESSION["user_id"]." and ctime >= '".$seven."' group by cate,ctime order by id desc limit ".($page-1)*$page_size.",".$page_size);
				$count = count($r);
			}
			elseif($condition=="最近30天"){
				$r = D("Acenter")->query("select count(1) as count from `jjs_detail` where user_id = ".$_SESSION["user_id"]." and ctime >= '".$thirty."' group by cate,ctime order by id desc");
				$res = D("Acenter")->query("select * from `jjs_detail` where user_id = ".$_SESSION["user_id"]." and ctime >= '".$thirty."' group by cate,ctime order by id desc limit ".($page-1)*$page_size.",".$page_size);
				$count = count($r);
			}
			elseif($condition=="最近3个月"){
				$r = D("Acenter")->query("select count(1) as count from `jjs_detail` where user_id = ".$_SESSION["user_id"]." and ctime >= '".$three_month."' group by cate,ctime order by id desc");
				$res = D("Acenter")->query("select * from `jjs_detail` where user_id = ".$_SESSION["user_id"]." and ctime >= '".$three_month."' group by cate,ctime order by id desc limit ".($page-1)*$page_size.",".$page_size);
				$count = count($r);
			}

			$urlrule = 'index.php?c=user&a=assets&condition='.$condition;

		}

		if(empty($remark)&&empty($condition))
		{
			$r = D("Acenter")->query("select count(1) as count from `jjs_detail` where user_id = ".$_SESSION["user_id"]." group by cate,ctime order by ctime desc");
			$res = D("Acenter")->query("select id,ctime,remark,sum(amount) as amount from `jjs_detail` where user_id = ".$_SESSION["user_id"]." group by cate,ctime order by ctime desc limit ".($page-1)*$page_size.",".$page_size);
			$count = count($r);
			$urlrule = pfurl('','user','assets');
		}
		
		$pages = $this->pages($count, $page, $page_size,$urlrule);
		
		$this->assign("res",$res);
		$this->assign("pages",$pages);
		$this->assign("count",$count);
		
		//载入模板
		$this->display();
	}

	//个人资料
	public function personal()
	{
		//用户资料
		$userdata = D("Acenter")->query("select id,realname,phone,idcard,bank,bank_card,address,head_img,nickname,email,role,branch,tpassword from `jjs_user` where id=".$_SESSION['user_id']);
		
		/*查询用户绑定的银行id*/
		$userbank = D("Acenter")->query("select id from `jjs_bank` where title = '".$userdata[0]["bank"]."'");

		/*查询所有银行*/
		$banklist = D("Acenter")->query("select id,title from `jjs_bank`");

		//已有的收货地址
		$address = D("Acenter")->query("select * from `jjs_receipt_address` where user_id = ".$_SESSION["user_id"]);

		$this->assign("userdata",$userdata[0]);
		$this->assign("hiddenphone",substr_replace($userdata[0]["phone"],"****",3,4));
		$this->assign("bank_id",$userbank[0]["id"]);
		$this->assign("banklist",$banklist);
		$this->assign("address",$address);

		//载入模板
		$this->display();
	}
	
	//收货地址
	public function addr()
	{
		//已有的收货地址
		$address = D("Acenter")->query("select * from `jjs_receipt_address` where user_id = ".$_SESSION["user_id"]);
		$this->assign("address",$address);
		//载入模板
		$this->display();
	}
	
	//修改银行卡
	public function bank()
	{
		//用户资料
		$userdata = D("Acenter")->query("select id,realname,phone,idcard,bank,bank_card,address,head_img,nickname,email,role,branch,tpassword from `jjs_user` where id=".$_SESSION['user_id']);
		/*查询用户绑定的银行id*/
		$userbank = D("Acenter")->query("select id from `jjs_bank` where title = '".$userdata[0]["bank"]."'");
		/*查询所有银行*/
		$banklist = D("Acenter")->query("select id,title from `jjs_bank`");
		$this->assign("userdata",$userdata[0]);
		$this->assign("bank_id",$userbank[0]["id"]);
		$this->assign("banklist",$banklist);
		//载入模板
		$this->display();
	}
	
	//修改密码
	public function pay_pwd()
	{
		//用户资料
		$userdata = D("Acenter")->query("select id,realname,phone,idcard,bank,bank_card,address,head_img,nickname,email,role,branch,tpassword from `jjs_user` where id=".$_SESSION['user_id']);
		$this->assign("userdata",$userdata[0]);
		$this->assign("hiddenphone",substr_replace($userdata[0]["phone"],"****",3,4));
		//载入模板
		$this->display();
	}

	//提现
	public function cash()
	{

		//用户帐户余额查询
		$account = D("Acenter")->query("select * from `jjs_user_finance` where user_id = ".$_SESSION["user_id"]);
		$available = $account[0]["recharge"]+$account[0]["inamount"]+$account[0]["extendamount"]+$account[0]["tempamount"]-$account[0]["withdraw"]-$account[0]["bond"]-$account[0]["outamount"];
		
		//用户绑定信息
		$userbind = D("Acenter")->query("select phone,bank_card from `jjs_user` where id = ".$_SESSION["user_id"]);

		$this->assign("available",$available);
		$this->assign("bank_card",$userbind["0"]["bank_card"]);
		$this->assign("phone",$userbind["0"]["phone"]);
		$this->display();
	}

	//充值
	public function pay()
	{
		//用户账户信息
		$userdata = D("Acenter")->query("select phone,bank_card from `jjs_user` where id = ".$_SESSION["user_id"]);
		$this->assign("phone",$userdata[0]["phone"]);
		$this->display();
	}
	
//店铺申请
	public function application() 
	{
		$r = D("Acenter")->query("select * from `jjs_store` where user_id = ".$_SESSION["user_id"]);
		if($r) $this->assign("shenqing",$r[0]);
		$this->display();
	}
	
//商品列表
	public function store()
	{
		$page_size = $this->pageSize;
		$page = max(getgpc('page'),1);
		$key = getgpc("key");
		if(!$key) $key = 'ctime';
		$goodsnum = D("Acenter")->query("select count(1) as count from `jjs_goods` where user_id = ".$_SESSION["user_id"]." order by $key desc");
		$count = $goodsnum[0]["count"];
		$goods = D("Acenter")->query("select * from `jjs_goods` where user_id = ".$_SESSION["user_id"]." order by $key desc limit ".($page-1)*$page_size.",".$page_size);
		$urlrule = 'index.php?c=user&a=store&key='.$key;
		$pages = $this->pages($count, $page, $page_size,$urlrule);
		$this->assign("goods",$goods);
		$this->assign("pages",$pages);
		$this->assign("count",$count);

		//载入模板
		$this->display();
	}
//添加商品
	public function good_add()
	{
		$fenlei = D("Acenter")->query("select * from `jjs_goods_cate` where status = 1");
		$this->assign("fenlei",$fenlei);
		//载入模板
		$this->display();
	}
//编辑商品
	public function good_edit()
	{
		$id = getgpc("id");
		$goods = D("Acenter")->query("select * from `jjs_goods` where user_id = ".$_SESSION["user_id"]." and id = $id");
		//载入模板
		$this->assign("good",$goods[0]);
		$fenlei = D("Acenter")->query("select * from `jjs_goods_cate` where status = 1");
		$this->assign("fenlei",$fenlei);
		$this->display();
	}
//卖家订单管理
	public function dingdan() 
	{
		$page_size = $this->pageSize;
		$page = max(getgpc('page'),1);
		//我的店铺订单
		$ordersnum = D("Acenter")->query("select count(1) as count from `jjs_order` where seller_id = ".$_SESSION["user_id"]." and status > 0 order by ctime desc");
		$count = $ordersnum[0]["count"];
		$orders = D("Acenter")->query("select a.*,b.img,b.title from jjs_order AS a INNER JOIN jjs_goods AS b ON a.gid = b.id where a.seller_id = ".$_SESSION["user_id"]." and a.status > 0 order by a.status desc , a.ctime desc limit ".($page-1)*$page_size.",".$page_size);
		$urlrule = pfurl('','user','dingdan');
		$pages = $this->pages($count, $page, $page_size,$urlrule);
		$this->assign("orders",$orders);
		$this->assign("pages",$pages);
		$this->assign("count",$count);
		//载入模板
		$this->display();
	}
	//交易商发售列表
	public function fashou() {
		$page_size = $this->pageSize;
		$page = max(getgpc('page'),1);
		$goodsnum = D("Acenter")->query("select count(1) as count from `jjs_goods_release` where user_id = ".$_SESSION["user_id"]." order by ctime desc");
		$count = $goodsnum[0]["count"];
		$goods = D("Acenter")->query("select * from `jjs_goods_release` where user_id = ".$_SESSION["user_id"]." order by ctime desc limit ".($page-1)*$page_size.",".$page_size);
		$urlrule =  pfurl('','user','fashou');
		$pages = $this->pages($count, $page, $page_size,$urlrule);
		$this->assign("goods",$goods);
		$this->assign("pages",$pages);
		$this->assign("count",$count);

		//载入模板
		$this->display();
	}
	//交易商编辑发售
	public function fashou_edit() {
		$goods_id=  getgpc('goods_id');
		$goods = D("Acenter")->query("select * from `jjs_goods_release` where user_id = ".$_SESSION["user_id"]." and id = '".$goods_id."'");
		$urlrule =  pfurl('','user','fashou');
		$this->assign("good",$goods[0]);

		//载入模板
		$this->display();
	}

	//我的财报
	public function deal()
	{
		
		$page_size = $this->pageSize;
		$page = max(getgpc('page'),1);
		
		$cate = trim(getgpc("cate"));
		$currenttime = trim(getgpc("currenttime"));
		$starttime = trim(getgpc("starttime"));
		$overtime = trim(getgpc("overtime"));
		$where = " where C.user_id = U.id and C.status >0";
		$urlrule = 'index.php?c=finance&a=index';
		if($cate == "买入"){
			$where .= " and C.cate = 0";
			$urlrule = 'index.php?c=finance&a=index&cate=买入';
		}elseif($cate == "卖出"){
			$where .= " and C.cate = 1";
			$urlrule = 'index.php?c=finance&a=index&cate=卖出';
		}

		if($currenttime){
			$where .= " and C.deal_time like '%".$currenttime."%'";
			$urlrule = 'index.php?c=finance&a=index&currenttime='.$currenttime;
		}

		if($starttime && $overtime){
			$where .= " and C.deal_time between '".$starttime."' and '".$overtime."' ";
			$urlrule = 'index.php?c=finance&a=index&starttime='.$starttime.'&overtime='.$overtime;
		}elseif($starttime && empty($overtime)){
			$where .= " and C.deal_time >= '".$starttime."'";
			$urlrule = 'index.php?c=finance&a=index&starttime='.$starttime;
		}elseif(empty($starttime) && $overtime){
			$where .= " and C.deal_time <= '".$overtime."'";
			$urlrule = 'index.php?c=finance&a=index&overtime='.$overtime;
		}
		$r = D("Acenter")->query("select U.realname,U.phone,C.cate,C.g_code,sum(C.quantity) as quantity,C.price,C.t_price,C.fee,C.ctime,C.deal_time from `jjs_contract` C,`jjs_user` U ".$where." group by C.deal_time,C.cate,C.g_code ");
		$res = D("Acenter")->query("select U.realname,U.phone,C.cate,C.g_code,sum(C.quantity) as quantity,C.price,C.t_price,C.fee,C.ctime,C.deal_time from `jjs_contract` C,`jjs_user` U ".$where." group by C.deal_time,C.cate,C.g_code order by C.deal_time desc limit ".($page-1)*$page_size.",".$page_size);
		$count = count($r);
		$pages = $this->pages($count, $page, $page_size,$urlrule);

		$this->assign('lists',$res);
		$this->assign("pages",$pages);
		$this->assign("count",$count);
		
		$this->display();
	}

	//我的推荐
	public function extend()
	{
		$res = D("Acenter")->query("select referral_code from `jjs_user` where id = ".$_SESSION["user_id"]);

		//我邀请的人数
		$invitenum = D("Acenter")->query("select count(1) as count from	`jjs_user` where tuser_code = '".$res[0]["referral_code"]."'");
		
		//二维码邀请链接
		$barcode = urlencode('http://jjs.51daniu.cn/portal/index.php?c=barclays&a=register&referral_code='.$res[0]["referral_code"]);//二维码使用场景mweb非pcweb非mapp  by enry 0626
		$ret = json_decode(file_get_contents('http://apistore.51daniu.cn/service/qrcode/create.php?keyword='.$barcode),true);//二维码
		$qr_code = $ret["data"];

		//推广短链接
		$duan_url=urlencode('http://jjs.51daniu.cn/portal/index.php?c=barclays&a=register&referral_code='.$res[0]["referral_code"]);
		$ret =json_decode(file_get_contents('http://apistore.51daniu.cn/rest/index.php?c=qrcode&a=url2dwz&url='.$duan_url),true);
		
		$this->assign("invitenum",$invitenum[0]["count"]);
		$this->assign('invite_links', $ret["data"]);
		$this->assign('qr_code', $ret["data"]);
		$this->assign("referral_code",$res[0]["referral_code"]);
	 
		//载入模板
		$this->display();
	}


}
