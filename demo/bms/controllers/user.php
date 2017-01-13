<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('BmsAction');
class user extends BmsAction
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
	
	//用户列表
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
		$is_check = getgpc("is_check");
		$role = getgpc("role");
		$where = "where 1";
		$urlrule = 'index.php?c=user&a=index';
		if($phone){
			$where .= " and phone = '".$phone."'";
			$urlrule = 'index.php?c=user&a=index&phone='.$phone;
		}
		if($realname){
			$where .= " and realname = '".$realname."'";
			$urlrule = 'index.php?c=user&a=index&phone='.$phone;
		}
		if($is_check == 0 && $is_check != ''){
			$where .= " and is_check = 0";
			$urlrule = 'index.php?c=user&a=index&is_check='.$is_check;
		}elseif($is_check == 1){
			$where .= " and is_check = 1";
			$urlrule = 'index.php?c=user&a=index&is_check='.$is_check;
		}elseif($is_check == 2){
			$where .= " and is_check = 2";
			$urlrule = 'index.php?c=user&a=index&is_check='.$is_check;
		}
		if($role){
			$where .= " and role = '".$role."'";
			$urlrule = 'index.php?c=user&a=index&role='.$role;
		}
		$r = $Model->query("select count(1) as count from `jjs_user` ".$where." order by ctime desc");
		$count = $r[0]["count"];
		$res = $Model->query("select * from `jjs_user` ".$where." order by ctime desc limit ".($page-1)*$page_size.",".$page_size);
		
		$pages = $this->pages($count, $page, $page_size,$urlrule);
		
		$this->assign('users',$res);
		$this->assign("pages",$pages);
		$this->assign("count",$count);
		$this->display();
	}


	//用户冻结
	public function freeze()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		$Model=D('Bms');
		$id = intval(getgpc("id"));
		if($id>0){
			$res = $Model->querysql("update `jjs_user` set is_freeze = 1 where id = ".$id);
			if($res){
				bmsAlert("操作成功",pfUrl("bms","user","index")); 
			}else{
				bmsAlert("操作失败",pfUrl("bms","user","index")); 
			}
		}
		
	}

	//解除冻结
	public function del_freeze()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		$Model=D('Bms');
		$id = intval(getgpc("id"));
		if($id>0){
			$res = $Model->querysql("update `jjs_user` set is_freeze = 0 where id = ".$id);
			if($res){
				bmsAlert("操作成功",pfUrl("bms","user","index")); 
			}else{
				bmsAlert("操作失败",pfUrl("bms","user","index")); 
			}
		}
		
	}

	//用户编辑
	public function edit()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		$Model=D('Bms');
		
		if(isPost()){
			$id = intval(getgpc("id"));
			$realname = getgpc("realname");
			$idcard = getgpc("idcard");
			$email = getgpc("email");
			$emergency_contact = getgpc("emergency_contact");
			$emergency_contact_phone = getgpc("emergency_contact_phone");
			$role = intval(getgpc("role"));
			$is_check = intval(getgpc("is_check"));
			if(empty($realname) && empty($idcard) && empty($email) && empty($emergency_contact) && empty($emergency_contact_phone) && empty($role)){
				bmsAlert("请至少选择一项进行修改",pfUrl("bms","user","edit")); 
			}
			$condition = "update `jjs_user` set";
			if($realname){
				$condition .= " realname = '".$realname."',";
			}
			if($idcard){
				$condition .= " idcard = '".$idcard."',";
			}
			if($email){
				$condition .= " email = '".$email."',";
			}
			if($emergency_contact){
				$condition .= " emergency_contact = '".$emergency_contact."',";
			}
			if($emergency_contact_phone){
				$condition .= " emergency_contact_phone = '".$emergency_contact_phone."',";
			}
			if($role){
				if($role == 1){
					$condition .= " type = 0,";
				}elseif($role == 2){
					$condition .= " type = 1,";
				}
				$condition .= " role = '".$role."',";
			}
			if($is_check){
				$condition .= " is_check = '".$is_check."',";
			}
			$condition = substr($condition,0,-1);
			$user = $Model->query("select email,is_check,phone from `jjs_user` where id = ".$id);
			if($is_check == 1&&$user[0]["is_check"]!=1){
				$code = '';
				for($i=1;$i<=4;$i++){
					$code .= chr(rand(65,90));
				}
				$account = $code.rand(100000,999999);
				$password = md5($code.$user[0]["phone"]);
				$message = $code.$user[0]["phone"];

				file_put_contents("CAS.txt",'https://apistore.51daniu.cn/rest/index.php?c=mail&a=smtp&body=尊敬的用户，您的开户申请已通过审核，此次申请为您分配的账号为：'.$account.'，密码：'.$message.'，请妥善保管&subject=开户申请通知&mailto='.$user[0]["email"]);
				$ret = json_decode(file_get_contents('https://apistore.51daniu.cn/rest/index.php?c=mail&a=smtp&body=尊敬的用户，您的开户申请已通过审核，此次申请为您分配的账号为：'.$account.'，密码：'.$message.'，请妥善保管&subject=开户申请通知&mailto='.$user[0]["email"]."&pc=jjs"),true);

				
				if($ret["code"]== 200){
					$Model->querysql("update `jjs_user` set account = '".$account."',password = '".$password."' where id = ".$id);
				}
			}elseif($is_check == 2){
				file_put_contents("CAS.txt",'https://apistore.51daniu.cn/rest/index.php?c=mail&a=smtp&body=尊敬的用户，您的开户申请未通过审核，请您重新提交完整资料&subject=开户申请通知&mailto='.$user[0]["email"]);
				$ret = json_decode(file_get_contents('https://apistore.51daniu.cn/rest/index.php?c=mail&a=smtp&body=尊敬的用户，您的开户申请未通过审核，请您重新提交完整资料&subject=开户申请通知&mailto='.$user[0]["email"]."&pc=jjs"),true);
			}

			$res = $Model->querysql($condition." where id = ".$id);
			if($res){
				
				bmsAlert("操作成功",pfUrl("bms","user","index")); 
			}else{
				bmsAlert("操作失败",pfUrl("bms","user","edit")); 
			}
		}
		$id = intval(getgpc("id"));
		if($id>0){
			$detail = $Model->query("select * from `jjs_user` where id = ".$id);
			$this->assign("detail",$detail[0]);
		}
		
		$this->display();
	}
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
					$pattern = '23456789abcdefghijklmnpqrstuvwxyz';  
					for($i=0;$i<6;$i++)   
					{   
						$key1 .= $pattern{mt_rand(0,32)};    //生成php随机数
					}
					$sql = "insert into `jjs_user`(id,referral_code,tuser_id,realname,sex,phone,idtype,idcard,password,bank,bank_card,address,emergency_contact,emergency_contact_phone,ctime,email,is_check) values('".rand(100000000,999999999)."','".$key1."','".$strs[1]."','".$strs[0]."','".$strs[2]."','".$strs[5]."','".$strs[3]."','".$strs[4]."','".md5(trim($strs[6]))."','".$strs[7]."','".$strs[8]."','".$strs[9]."','".$strs[10]."','".$strs[11]."','".time()."','".$strs[12]."',1)";
					$res=D('bms')->querySql($sql);
					if(!$res) $tag+=1;
					$key1='';
				}
			}
			if($tag>0){
				bmsAlert("有".$tag."条记录导入失败",pcUrl("user","index"));
			}else{
				bmsAlert("所有记录导入成功",pcUrl("user","index"));
			}
		}
		$this->display();
	}
	
}
