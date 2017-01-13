<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('BmsAction');
class goods_cate extends BmsAction
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
	
	//商品分类列表
	public function index()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		$Model=D('Bms');
		$page_size = $this->pageSize;
		$page = max(getgpc('page'),1);
		
		$title = getgpc("title");
		$status = getgpc("status");
		$where = "where 1";
		$urlrule = 'index.php?c=goods_cate&a=index';
		if($title){
			$where .= " and title like '%".$title."%'";
			$urlrule = 'index.php?c=goods_cate&a=index&title='.$title;
		}
		
		if($status=="no"){
			$where .= " and status = 0";
			$urlrule = 'index.php?c=goods_cate&a=index&status='.$status;
		}elseif($status == 1){
			$where .= " and status = 1";
			$urlrule = 'index.php?c=goods_cate&a=index&status='.$status;
		}
		$r = $Model->query("select count(1) as count from `jjs_goods_cate` ".$where." order by id desc");
		$count = $r[0]["count"];
		$res = $Model->query("select * from `jjs_goods_cate` ".$where." order by id desc limit ".($page-1)*$page_size.",".$page_size);
		$pages = $this->pages($count, $page, $page_size,$urlrule);
		
		$this->assign('goods_cate',$res);
		$this->assign("pages",$pages);
		$this->assign("count",$count);
		$this->display();
	}

	//编辑商品分类
	public function edit()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		$Model=D('Bms');
		
		if(isPost()){
			$id = intval(getgpc("id"));
			$title = getgpc("title");
			$img = getgpc("img");
			$status = getgpc("status");
			$sort = getgpc("sort");
			$pid = getgpc("pid");
			$condition = "update `jjs_goods_cate` set";
			if($title){
				$condition .= " title = '".$title."',";
			}
			if($img){
				$condition .= " img = '".$img."',";
			}
			if($sort){
				$condition .= " sort = '".$sort."',";
			}
			if($status == 0 && $status != ''){
				$condition .= " status = 0,";
			}elseif($status == 1){
				$condition .= " status = 1,";
			}
			$condition = substr($condition,0,-1);

			$res = $Model->querysql($condition." where id = ".$id);
			if($res){
				bmsAlert("操作成功",pfUrl("bms","goods_cate","index")); 
			}else{
				bmsAlert("操作失败",pfUrl("bms","goods_cate","edit")); 
			}
		}

		$id = intval(getgpc("id"));
		if($id>0){
			$detail = $Model->query("select * from `jjs_goods_cate` where id = ".$id);
			$this->assign("detail",$detail[0]);
		}
		
		$this->display();
	}

	//添加商品分类
	public function add()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		$Model=D('Bms');
		
		if(isPost()){
			$title = getgpc("title");
			$img = getgpc("img");
			$status = getgpc("status");
			$sort = getgpc("sort");
			$res = $Model->querysql("insert into `jjs_goods_cate`(title,img,status,sort,ctime) values('".$title."','".$img."','".$status."','".$sort."','".time()."')");
			if($res){
				bmsAlert("操作成功",pfUrl("bms","goods_cate","index")); 
			}else{
				bmsAlert("操作失败",pfUrl("bms","goods_cate","add")); 
			}
		}

		$id = intval(getgpc("id"));
		if($id>0){
			$detail = $Model->query("select * from `jjs_goods_cate` where id = ".$id);
			$this->assign("detail",$detail[0]);
		}
		
		$this->display();
	}

	//删除分类
	public function remove()
    {
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}

        $id = isset($_GET['id']) ? intval(getgpc("id")) : bmsAlert("内容不存在", pfUrl(null, "goods_cate", "index"));
		$res = D('Bms')->querysql("delete from `jjs_goods_cate` where id = ".$id);

        if ($res) {

            bmsAlert("删除成功", pfUrl(null, "goods_cate", "index"));

        } else {

            bmsAlert("删除失败", pfUrl(null, "goods_cate", "index"));

        }

    }

	
}
