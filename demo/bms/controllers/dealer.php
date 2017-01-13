<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('BmsAction');
class dealer extends BmsAction
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
	
	//挂牌列表
	public function index()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		$Model=D('Bms');
		$page_size = $this->pageSize;
		$page = max(getgpc('page'),1);
		
		$phone = getgpc("phone");
		$realname = getgpc("realname");
		$status = getgpc("status");
		
		$where = "where M.user_id = U.id";
		$urlrule = 'index.php?c=entry_market&a=index';
		if($phone){
			$where .= " and U.phone = '".$phone."'";
			$urlrule = 'index.php?c=entry_market&a=index&phone='.$phone;
		}
		if($realname){
			$where .= " and U.realname like '%".$realname."%'";
			$urlrule = 'index.php?c=entry_market&a=index&realname='.$realname;
		}
		if($status == 0 && $status != ''){
			$where .= " and M.status = 0";
			$urlrule = 'index.php?c=entry_market&a=index&status='.$status;
		}elseif($status == 1){
			$where .= " and M.status = 1";
			$urlrule = 'index.php?c=entry_market&a=index&status='.$status;
		}elseif($status == 2){
			$where .= " and M.status = 2";
			$urlrule = 'index.php?c=entry_market&a=index&status='.$status;
		}
		$r = $Model->query("select count(1) as count from `jjs_entry_market` M,`jjs_user` U ".$where." order by M.ctime desc");
		$count = $r[0]["count"];
		$res = $Model->query("select M.*,U.phone,U.realname,U.idcard from `jjs_entry_market` M,`jjs_user` U ".$where." order by M.ctime desc limit ".($page-1)*$page_size.",".$page_size);
		$pages = $this->pages($count, $page, $page_size,$urlrule);
		$this->assign('entry_market',$res);
		$this->assign("pages",$pages);
		$this->assign("count",$count);
		$this->display();
	}

	//挂牌审核
	public function check()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		$Model=D('Bms');
		
		if(isPost()){
			$id = intval(getgpc("id"));
			$status = intval(getgpc("status"));
			if($id>0){
				$res = $Model->querysql("update `jjs_entry_market` set status = ".$status." where id = ".$id);
				if($res){
					$user = $Model->query("select email from `jjs_entry_market` where id = ".$id);
					if($status == 1){
						$code = '';
						for($i=1;$i<=4;$i++){
							$code .= chr(rand(65,90));
						}
						$password = md5($user[0]["phone"].$user[0]["realname"]);
						file_put_contents("CAS.txt",'https://apistore.51daniu.cn/rest/index.php?c=mail&a=smtp&body=尊敬的用户，您的挂牌申请已通过，此次申请为您分配的账号为：'.$code.rand(100000,999999).'，密码：'.$password.'&subject=开户申请通知&mailto='.$user[0]["email"]);
						$ret = json_decode(file_get_contents('https://apistore.51daniu.cn/rest/index.php?c=mail&a=smtp&body=尊敬的用户，您的开户申请已通过，此次申请为您分配的账号为：'.$code.rand(100000,999999).'，密码：'.$password.'&subject=开户申请通知&mailto='.$user[0]["email"]."&pc=jjs"),true);
						if($ret["code"]== 200){
							$Model->querysql("update `jjs_user` set account = '".$$code.rand(100000,999999)."',password = '".$password."' where id = ".$id);
						}
					}elseif($status == 2){
						file_put_contents("CAS.txt",'https://apistore.51daniu.cn/rest/index.php?c=mail&a=smtp&body=尊敬的用户，您的开户申请未通过审核，请您重新提交完整资料&subject=开户申请通知&mailto='.$user[0]["email"]);
						$ret = json_decode(file_get_contents('https://apistore.51daniu.cn/rest/index.php?c=mail&a=smtp&body=尊敬的用户，您的开户申请未通过审核，请您重新提交完整资料&subject=开户申请通知&mailto='.$user[0]["email"]."&pc=jjs"),true);
					}
					bmsAlert("操作成功",pfUrl("bms","dealer","index")); 
				}else{
					bmsAlert("操作失败",pfUrl("bms","dealer","check")); 
				}
			}
		}
		$id = intval(getgpc("id"));
		if($id>0){
			$detail = $Model->query("select M.*,U.realname,U.idcard,U.phone from `jjs_entry_market` M,`jjs_user` U where M.user_id = U.id and M.id = ".$id);
			$this->assign("detail",$detail[0]);
		}
		
		$this->display();
	}

	//删除记录
	public function remove()
    {
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}

        $id = isset($_GET['id']) ? intval(getgpc("id")) : bmsAlert("内容不存在", pfUrl(null, "dealer", "index"));
		$res = D('Bms')->querysql("delete from `jjs_entry_market` where id = ".$id);

        if ($res) {

            bmsAlert("操作成功", pfUrl(null, "dealer", "index"));

        } else {

            bmsAlert("操作失败", pfUrl(null, "dealer", "index"));

        }

    }
		//批量挂牌
		public function batchimport() {
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		if(isPost())
		{
			$filename = $_FILES['inputExcel']['name'];
			$tmp_name = $_FILES['inputExcel']['tmp_name'];
			if($_FILES['inputExcel']['type']!='application/vnd.ms-excel'){
				bmsAlert("上传文件必须是《.xls》类型的表格",pfUrl("","user","batchimport"));
				die;
			}
			$sqlArr = uploadXLS($filename,$tmp_name);
			$tag=0;
			foreach($sqlArr as $key => $strs)
			{
				if(!empty($strs))
				{
					$sql = "insert into `jjs_entry_market` (user_id,company,code,postal_address,fixed_telephone,fax,postcode,mobile_phone,email,applicant_type,business_licence,tax_registration,organization_code,qq,status,ctime)values ('".$strs[0]."', '".$strs[1]."', '".$strs[2]."', '".$strs[3]."', '".$strs[4]."', '".$strs[5]."', '".$strs[6]."', '".$strs[7]."', '".$strs[8]."', '".$strs[9]."', '".$strs[10]."', '".$strs[11]."', '".$strs[12]."', '".$strs[13]."','1','".time()."')";
					$res=D('bms')->querySql($sql);
					if(!$res) $tag+=1;
					$key='';
				}
			}
			if($tag>0){
				bmsAlert("有".$tag."条记录导入失败",pcUrl("dealer","index"));
			}else{
				bmsAlert("所有记录导入成功",pcUrl("dealer","index"));
			}
			
		}
		$this->display();
	}
}
