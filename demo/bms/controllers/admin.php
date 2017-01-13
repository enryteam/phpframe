<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('BmsAction');
class admin extends BmsAction
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
	
	
	//管理员信息
	public function index()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		$page_size = $this->pageSize;
		$page = max(getgpc('page'),1);
		$Model=D('Bms');
		$name =  getgpc('name');
		$phone =  getgpc('phone');
		$status =  getgpc('status');
		$where = 'where 1=1';
		$arr=array();
		if($name){
			$where .=" and name like '%$name%'";
			$arr['name'] =$name;
		}
		if($phone){
			$where .=" and phone = '$phone'";
			$arr['name'] =$name;
		}
		if($status==='0' || $status==1){
			$where .=" and status = '$status'";
			$arr['name'] =$name;
		}
		$admin=$Model->query('select * from `jjs_members` '.$where.' order by id asc');
		$count = count($admin);
		$res = $Model->query("select * from `jjs_members` ".$where." order by id asc limit ".($page-1)*$page_size.",".$page_size);
		$this->assign("admin",$admin);
		$pages = $this->pages($count, $page, $page_size,'',$arr);
		$this->assign("pages",$pages);
		$this->assign("count",$count);
		$this->display();
		
	}

//管理员添加或编辑
	public function add()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		$Model=D('Bms');
		
		if(isPost()){
			$id = intval(getgpc("id"));
			$name = getgpc("name");
			$pwd = trim(getgpc("pwd"));
			$phone = getgpc("phone");
			$gid = getgpc("gid");
			if($id>0){
				if($pwd){
					$sql="update `jjs_members` set name = '$name',pwd = '".md5($pwd)."',phone = '$phone',gid = '$gid' where id = ".$id;
				}else{
					$sql="update `jjs_members` set name = '$name',phone = '$phone',gid = '$gid' where id = ".$id;
				}
				$res = $Model->querySql($sql);
				if($res){
					bmsAlert("修改成功",pfUrl("","admin","index"));
				}else{
					bmsAlert("修改失败",pfUrl("","admin","edit",array('id'=>$id)));
				}
			}else{
				if($name && $pwd && $phone){
					$res = $Model->querySql("insert into `jjs_members` (name,phone,pwd,member_type,gid) values('$name','$phone','".md5($pwd)."',2,'$gid')");
					if($res){
						bmsAlert("添加成功",pfUrl("","admin","index"));
					}else{
						bmsAlert("添加失败",pfUrl("","admin","edit"));
					}
				}else{
					bmsAlert("添加失败,信息录入不全",pfUrl("","admin","edit"));
				}
			}
		}
		$id = intval(getgpc("id"));
		if($id>0){
			$detail = $Model->query("select * from `jjs_members` where id = ".$id);
			$this->assign("detail",$detail[0]);
		}
		$sql="select * from `jjs_auth_group` where status = 1";
		$groupStatus = $Model->query($sql);
		$this->assign("groupStatus",$groupStatus);
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
			$res = $Model->querysql("update `jjs_members` set status = '$status' where id = ".$id);
			if($res){
				bmsAlert("操作成功",pfUrl("bms","admin","index")); 
			}else{
				bmsAlert("操作失败",pfUrl("bms","admin","index")); 
			}
		}
	}
}
