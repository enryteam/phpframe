<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('BmsAction');
class group extends BmsAction
{
	private $pageSize = 8;
	public function __construct()
	{
		$Model=D('Bms');
		$admin = $Model->query('select name,logincount,gid from `jjs_members` where id = '.$_SESSION['ADMIN_UID']);
		$logininfo = array("adminname"=>$admin[0]["name"],"logincount"=>$admin[0]["logincount"],"adminip"=>$_SESSION['ADMIN_UserIP'],"logintime"=>$_SESSION['ADMIN_UserTime']);
		$this->assign("admin",$logininfo);
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
	
	
	//管理组信息
	public function index()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		$page_size = $this->pageSize;
		$page = max(getgpc('page'),1);
		$r = D("Bms")->query("select count(1) as count from `jjs_auth_group` where status = 1");
		$count = $r[0]["count"];
		$sql="select * from `jjs_auth_group` where status = 1 limit ".($page-1)*$page_size.",".$page_size;
		$groupStatus = D('Bms')->query($sql);
		$pages = $this->pages($count, $page, $page_size,'',$groupStatus);
		$this->assign("groupStatus",$groupStatus);
		$this->assign("pages",$pages);
		$this->assign("count",$count);
		$this->display();
	}

	//管理组添加或编辑
	public function add()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		$Model=D('Bms');
		$id = intval(getgpc("id"));
		if(isPost()){
			$title = getgpc("title");
			$rules = implode(',',getgpc("rules"));
			if($id>0){
				$sql="update `jjs_auth_group` set title = '$title',rules = '$rules' where id = ".$id;
				$res = $Model->querySql($sql);
				if($res){
					bmsAlert("修改成功",pfUrl("","group","index"));
				}else{
					bmsAlert("修改失败",pfUrl("","group","add",array('id'=>$id)));
				}
			}else{
				if($title && $rules){
					$res = $Model->querySql("insert into `jjs_auth_group` (title,rules) values('$title','$rules')");
					if($res){
						bmsAlert("添加成功",pfUrl("","group","index"));
					}else{
						bmsAlert("添加失败",pfUrl("","group","add"));
					}
				}else{
					bmsAlert("添加失败,信息录入不全",pfUrl("","group","add"));
				}
			}
		}
		$sql="select * from `jjs_auth_group` where id = ".$id;
		$detail = $Model->query($sql);
		$this->assign("detail",$detail[0]);
		$sql="select * from `jjs_admin_rule` where fid = 0";
		$res = $Model->query($sql);
		foreach ($res as $key => $vo) {
			$sql="select * from `jjs_admin_rule` where fid = ".$vo['id'];
			$re = $Model->query($sql);
			$res[$key]['zi']=$re;
		}
		$this->assign("quanxian",$res);
		$this->display();
	}
	
	//管理员锁定和解锁
	public function status()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		$Model=D('Bms');
		$id = intval(getgpc("id"));
		$status = intval(getgpc("status"));
		if($id>0){
			$res = $Model->querysql("update `jjs_auth_group` set status = '$status' where id = ".$id);
			if($res){
				bmsAlert("操作成功",pfUrl("bms","group","index")); 
			}else{
				bmsAlert("操作失败",pfUrl("bms","group","index")); 
			}
		}
	}
}
