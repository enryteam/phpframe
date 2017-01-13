<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('BmsAction');
class article extends BmsAction
{
	private $pageSize = 10;
	public function __construct()
	{
		$Model=D('Bms');
		//管理员信息
		$admin = $Model->query('select name,logincount,gid from `jjs_members` where id = '.$_SESSION['ADMIN_UID']);
		$logininfo = array("adminname"=>$admin[0]["name"],"logincount"=>$admin[0]["logincount"],"adminip"=>$_SESSION['ADMIN_UserIP'],"logintime"=>$_SESSION['ADMIN_UserTime']);

		//文章分类
		$cate = $Model->query("select * from `jjs_article_cate`");
		
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
	
	//首页
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
		$cateid = getgpc("cateid");
		$where = "where A.cateid = C.id";
		$urlrule = 'index.php?c=article&a=index';
		if($title){
			$where .= " and A.title like '%".$title."%'";
			$urlrule = 'index.php?c=article&a=index&title='.$title;
		}
		if($cateid){
			$where .= " and A.cateid = '".$cateid."'";
			$urlrule = 'index.php?c=article&a=index&cateid='.$cateid;
		}

		$r = $Model->query("select count(1) as count from `jjs_article` A,`jjs_article_cate` C ".$where." order by A.id desc");
		$count = $r[0]["count"];
		$res = $Model->query("select A.*,C.title as catetitle from `jjs_article` A,`jjs_article_cate` C ".$where." order by A.id desc limit ".($page-1)*$page_size.",".$page_size);
		$pages = $this->pages($count, $page, $page_size,$urlrule);

		$this->assign('article',$res);
		$this->assign("pages",$pages);
		$this->assign("count",$count);
		$this->display();
	}

	//添加文章
	public function add()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		$Model=D('Bms');
		if(isPost()){
			$cateid = getgpc("cateid");
			$title = getgpc("title");
			$link = getgpc("link");
			$image = getgpc("image");
			$content = getgpc("content");
			$is_show = getgpc("is_show");
			$res = $Model->querysql("insert into `jjs_article` (cateid,title,link,image,content,is_show,ctime) values('".$cateid."','".$title."','".$link."','".$image."','".$content."','".$is_show."','".time()."')");
			if($res){
				bmsAlert("添加成功",pfUrl("bms","article","index")); 
			}else{
				bmsAlert("添加失败",pfUrl("bms","article","add")); 
			}
		}
		$this->display();
	}

	//编辑文章
	public function edit()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		$Model=D('Bms');
		
		if(isPost()){
			$id = intval(getgpc("id"));
			$cateid = intval(getgpc("cateid"));
			$title = getgpc("title");
			$link = getgpc("link");
			$image = getgpc("image");
			$is_show = getgpc("is_show");
			$content = getgpc("content");
			if(empty($cateid) && empty($title) && empty($image) && empty($is_show) && empty($content)){
				bmsAlert("请至少选择一项进行修改",pfUrl("bms","article","edit")); 
			}
			
			$condition = "update `jjs_article` set";
			if($cateid){
				$condition .= " cateid = '".$cateid."',";
			}if($link){
				$condition .= " link = '".$link."',";
			}
			if($title){
				$condition .= " title = '".$title."',";
			}
			if($image){
				$condition .= " image = '".$image."',";
			}
			$condition .= " is_show = '".$is_show."',";
			if($content){
				$condition .= " content = '".$content."',";
			}
			$condition = substr($condition,0,-1);

			$res = $Model->querysql($condition." where id = ".$id);
			if($res){
				bmsAlert("编辑成功",pfUrl("bms","article","index")); 
			}else{
				bmsAlert("编辑失败",pfUrl("bms","article","edit")); 
			}
		}

		$id = intval(getgpc("id"));
		if($id>0){
			$detail = $Model->query("select * from `jjs_article` where id = ".$id);
			$this->assign("detail",$detail[0]);
		}
		$this->display();
	}

	//删除文章
	public function remove()
    {
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}

        $id = isset($_GET['id']) ? intval(getgpc("id")) : bmsAlert("内容不存在", pfUrl(null, "article", "index"));
		$res = D('Bms')->querysql("delete from `jjs_article` where id = ".$id);

        if ($res) {

            bmsAlert("删除成功", pfUrl(null, "article", "index"));

        } else {

            bmsAlert("删除失败", pfUrl(null, "article", "index"));

        }

    }

	
}
