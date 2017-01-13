<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('BmsAction');
class order extends BmsAction
{
	private $pageSize = 10;
	public function __construct()
	{
		$Model=D('Bms');
		//管理员信息
		$admin = $Model->query('select name,logincount,gid from `jjs_members` where id = '.$_SESSION['ADMIN_UID']);
		$logininfo = array("adminname"=>$admin[0]["name"],"logincount"=>$admin[0]["logincount"],"adminip"=>$_SESSION['ADMIN_UserIP'],"logintime"=>$_SESSION['ADMIN_UserTime']);

		//商品分类
		$cate = $Model->query("select * from `jjs_goods_cate`");
		
		$this->assign("admin",$logininfo);
		$this->assign("cate",$cate);
		$user_quanxian = $Model->query('select * from `jjs_auth_group` where id = '.$admin[0]['gid']);
		$_SESSION['user_quanxian'] = explode(',', $user_quanxian[0]['rules']);
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
					$multipage .= "<li><a href='##'><i class='fa fa-chevron-left'></i></a></li><li><a href='##' onclick='page(1)' style='background:#1abc9c;color:white;'>1</a></li>";
				} elseif ($curr_page > 6 && $more) {
					$multipage .= "<li><a href='" . pageurl($urlrule, $curr_page - 1, $array) . "' onclick='page(".($curr_page + 1).")'><i class='fa fa-chevron-left'></i></a></li><li><a href='" . pageurl($urlrule, 1, $array) . "' onclick='page(1)'>1</a></li><li><a href='##'>...</a></li>";
				} else {
					$multipage .= "<li><a href='" . pageurl($urlrule, $curr_page - 1, $array) . "' onclick='page(".($curr_page + 1).")'><i class='fa fa-chevron-left'></i></a></li><li><a href='" . pageurl($urlrule, 1, $array) . "' onclick='page(1)'>1</a></li>";
				}
			}
			for ($i = $from; $i <= $to; $i ++) {
				if ($i != $curr_page) {
					$multipage .= "<li><a href='" . pageurl($urlrule, $i, $array) . "' onclick='page(".$i.")'>".$i."</a></li>";
				} else {
					$multipage .= "<li><a href='" . pageurl($urlrule, $i, $array) . "' onclick='page(".$i.")' style='background:#1abc9c;color:white;'>".$i."</a></li>";
				}
			}
			
			
			if ($curr_page < $pages) {
			
				if ($curr_page < $pages - 5 && $more) {
				
					$multipage .= "<li><a href='##' >...</a></li><li><a href='" . pageurl($urlrule, $pages, $array) . "' onclick='page(".$pages.")'>". $pages ."</a></li><li><a href='" . pageurl($urlrule, $curr_page + 1, $array) . "' onclick='page(".($curr_page + 1).")'><i class='fa fa-chevron-right'></i></a></li>";
				} else {
				
				   $multipage .= "<li><a href='" . pageurl($urlrule, $pages, $array) . "' onclick='page(".$pages.")'>". $pages ."</a></li><li><a href='" . pageurl($urlrule, $curr_page + 1, $array) . "' onclick='page(".($curr_page + 1).")'><i class='fa fa-chevron-right'></i></a></li>";
				}
			} elseif ($curr_page == $pages) {
				$multipage .= "<li><a href='##' onclick='page(".$pages.")' style='background:#1abc9c;color:white;'>". $pages ."</a></li><li><a href='##' ><i class='fa fa-chevron-right'></i></a></li>";
			} else {
				$multipage .= "<li><a href='" . pageurl($urlrule, $pages, $array) . "' onclick='page(".$pages.")'>". $pages ."</a></li><li><a href='" . pageurl($urlrule, $curr_page + 1, $array) . "' onclick='page(".($curr_page + 1).")'><i class='fa fa-chevron-right'></i></a></li>";
			}
		}
		$multipage = $multipage;
		return $multipage;
		
	}
	//退出
	public function logout()
	{
		unset($_SESSION['ADMIN_UID']);
		unset($_SESSION['ADMIN_UserName']);
		bmsAlert("退出成功",pfUrl("bms","index","login")); 
		
	}
	
	//订单列表
	public function index()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		$Model=D('Bms');
		$page_size = $this->pageSize;
		$page = max(getgpc('page'),1);
		
		$order_sn = getgpc("order_sn");
		$status = getgpc("status");
		
		$where = "where O.user_id = U.id and O.gid = G.id";
		$urlrule = 'index.php?c=order&a=index';

		if($order_sn){
			$where .= " and O.order_sn = '".$order_sn."'";
			$urlrule = 'index.php?c=order&a=index&order_sn='.$order_sn;
		}
		
		if($status == "no"){
			$where .= " and O.status = 0";
			$urlrule = 'index.php?c=order&a=index&status='.$status;
		}elseif($status == 1){
			$where .= " and O.status = 1";
			$urlrule = 'index.php?c=order&a=index&status='.$status;
		}elseif($status == 2){
			$where .= " and O.status = 2";
			$urlrule = 'index.php?c=order&a=index&status='.$status;
		}elseif($status == "completed"){
			$where .= " and O.status >= 3";
			$urlrule = 'index.php?c=order&a=index&status='.$status;
		}elseif($status=="all"){
			$where .= "";
			$urlrule = 'index.php?c=order&a=index&status='.$status;
		}
		
		$r = $Model->query("select count(1) as count from `jjs_order` O,`jjs_user` U,`jjs_goods` G ".$where." order by O.ctime desc");
		$count = $r[0]["count"];
		$res = $Model->query("select O.*,U.realname,G.title from `jjs_order` O,`jjs_user` U,`jjs_goods` G ".$where." order by O.ctime desc limit ".($page-1)*$page_size.",".$page_size);
		$pages = $this->pages($count, $page, $page_size,$urlrule);
		
		$this->assign('order',$res);
		$this->assign("pages",$pages);
		$this->assign("count",$count);
		$this->display();
	}

	//商品审核
	public function edit()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		$Model=D('Bms');
		
		if(isPost()){
			$id = intval(getgpc("id"));
			$status = intval(getgpc("status"));
			if($status>0){
				$res = $Model->querysql("update `jjs_order` set status = ".$status." where id = ".$id);
				if($res){
					bmsAlert("操作成功",pfUrl("bms","order","index")); 
				}else{
					bmsAlert("操作失败",pfUrl("bms","order","edit")); 
				}
			}
			
		}
		$id = intval(getgpc("id"));
		if($id>0){
			$detail = $Model->query("select * from `jjs_order` where id = ".$id);
			$this->assign("detail",$detail[0]);
		}
		
		$this->display();
	}

	
}
