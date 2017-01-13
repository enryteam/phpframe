<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('BmsAction');
class agent_operation extends BmsAction
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
	
	//代理运营中心列表
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
		$where = "where type = 3";
		$urlrule = 'index.php?c=agent_operation&a=index';
		if($phone){
			$where .= " and phone = '".$phone."'";
			$urlrule = 'index.php?c=agent_operation&a=index&phone='.$phone;
		}
		if($realname){
			$where .= " and realname = '".$realname."'";
			$urlrule = 'index.php?c=agent_operation&a=index&realname='.$realname;
		}
		if($is_check == 0 && $is_check != ''){
			$where .= " and is_check = 0";
			$urlrule = 'index.php?c=agent_operation&a=index&is_check='.$is_check;
		}elseif($is_check == 1){
			$where .= " and is_check = 1";
			$urlrule = 'index.php?c=agent_operation&a=index&is_check='.$is_check;
		}elseif($is_check == 2){
			$where .= " and is_check = 2";
			$urlrule = 'index.php?c=agent_operation&a=index&is_check='.$is_check;
		}
		
		$r = $Model->query("select count(1) as count from `jjs_user` ".$where." order by ctime desc");
		$count = $r[0]["count"];
		$res = $Model->query("select * from `jjs_user` ".$where." order by ctime desc limit ".($page-1)*$page_size.",".$page_size);
		
		$pages = $this->pages($count, $page, $page_size,$urlrule);
		
		$this->assign('operates',$res);
		$this->assign("pages",$pages);
		$this->assign("count",$count);
		$this->display();
	}

	//代理运营中心编辑
	public function edit()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		$Model=D('Bms');
		
		if(isPost()){
			$id = intval(getgpc("id"));
			$is_check = intval(getgpc("is_check"));
			$condition = "update `jjs_user` set";
			if($is_check){
				$condition .= " is_check = '".$is_check."',";
			}
			$condition = substr($condition,0,-1);
			$res = $Model->querysql($condition." where id = ".$id);
			if($res){
				
				bmsAlert("操作成功",pfUrl("bms","agent_operation","index")); 
			}else{
				bmsAlert("操作失败",pfUrl("bms","agent_operation","edit")); 
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
					
					$sql = "insert into `jjs_user`(id,referral_code,tuser_code,type,mechanism,realname,phone,password,idcard,address,email,bank_card,bank,accountname,business_licence,organization_code,tax_registration,businessname,businessduties,businessphone,businessidcard,ctime) values('".rand(100000000,999999999)."','".$key1."','".$strs[18]."','".$strs[0]."','".$strs[1]."','".$strs[2]."','".$strs[3]."','".md5(trim($strs[17]))."','".$strs[4]."','".$strs[5]."','".$strs[6]."','".$strs[7]."','".$strs[8]."','".$strs[9]."','".$strs[10]."','".$strs[11]."','".$strs[12]."','".$strs[13]."','".$strs[14]."','".$strs[15]."','".$strs[16]."','".time()."')";
					$res=D('bms')->querySql($sql);
					if(!$res) $tag+=1;
					$key1='';
				}
			}
			if($tag>0){
				bmsAlert("有".$tag."条记录导入失败",pcUrl("agent_operation","index"));
			}else{
				bmsAlert("所有记录导入成功",pcUrl("agent_operation","index"));
			}
		}
		$this->display();
	}

	//删除运营中心
	public function remove()
    {
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}

        $id = isset($_GET['id']) ? intval(getgpc("id")) : bmsAlert("内容不存在", pfUrl(null, "agent_operation", "index"));
		$res = D('Bms')->querysql("delete from `jjs_operate` where id = ".$id);

        if ($res) {

            bmsAlert("删除成功", pfUrl(null, "agent_operation", "index"));

        } else {

            bmsAlert("删除失败", pfUrl(null, "agent_operation", "index"));

        }

    }

	//全部发展客户
	public function development()
	{
		$page_size = $this->pageSize;
		$page = max(getgpc('page'),1);
		$realname = trim(getgpc("realname"));
		$is_check = getgpc("is_check");
		$where = "where tuser_code in(select referral_code from `jjs_user` where type = 3)";
		if($realname){
			$where .= " and realname like '%".$realname."%'";
			$urlrule = 'index.php?c=agent_operation&a=development&realname='.$realname;
		}
		if($is_check == 0 && $is_check != ''){
			$where .= " and is_check = 0";
			$urlrule = 'index.php?c=agent_operation&a=development&is_check='.$is_check;
		}elseif($is_check == 1){
			$where .= " and is_check = 1";
			$urlrule = 'index.php?c=agent_operation&a=development&is_check='.$is_check;
		}elseif($is_check == 2){
			$where .= " and is_check = 2";
			$urlrule = 'index.php?c=agent_operation&a=development&is_check='.$is_check;
		}

		$r = D("Bms")->query("select count(1) as count from `jjs_user` ".$where);
		$count = $r[0]["count"];
		$res = D("Bms")->query("select id,realname,phone,idcard,bank,bank_card,email,referral_code from `jjs_user` ".$where." limit ".($page-1)*$page_size.",".$page_size);
		$pages = $this->pages($count, $page, $page_size);
		
		$this->assign("res",$res);
		$this->assign("pages",$pages);
		$this->assign("count",$count);
		
		$this->display();
	}

	//分级发展客户
	public function detail()
	{
		$referral_code = trim(getgpc("referral_code"));
		$page_size = $this->pageSize;
		$page = max(getgpc('page'),1);
		$realname = trim(getgpc("realname"));
		$is_check = getgpc("is_check");
		if($referral_code){$where = "where tuser_code = '".$referral_code."'";$this->assign("referral_code",$referral_code);}else{ $where  = " where 1";}
		if($realname){
			$where .= " and realname like '%".$realname."%'";
			$urlrule = 'index.php?c=agent_operation&a=detail&referral_code='.$referral_code.'&realname='.$realname;
		}
		if($is_check == 0 && $is_check != ''){
			$where .= " and is_check = 0";
			$urlrule = 'index.php?c=agent_operation&a=detail&referral_code='.$referral_code.'&is_check='.$is_check;
		}elseif($is_check == 1){
			$where .= " and is_check = 1";
			$urlrule = 'index.php?c=agent_operation&a=detail&referral_code='.$referral_code.'&is_check='.$is_check;
		}elseif($is_check == 2){
			$where .= " and is_check = 2";
			$urlrule = 'index.php?c=agent_operation&a=detail&referral_code='.$referral_code.'&is_check='.$is_check;
		}

		$r = D("Bms")->query("select count(1) as count from `jjs_user` ".$where);
		$count = $r[0]["count"];
		$res = D("Bms")->query("select id,realname,phone,idcard,bank,bank_card,email,referral_code from `jjs_user` ".$where." limit ".($page-1)*$page_size.",".$page_size);
		$pages = $this->pages($count, $page, $page_size);
		if($count<=0){
			bmsAlert("该客户还没有发展客户", pfUrl(null, "agent_operation", "development"));
		}
		$this->assign("res",$res);
		$this->assign("pages",$pages);
		$this->assign("count",$count);
		
		
		$this->display();
	}

	public function deal()
	{
		$parameter = D("Bms")->query("select * from `jjs_deal_setting`");
		$page_size = $this->pageSize;
		$page = max(getgpc('page'),1);
		$referral_code = trim(getgpc("referral_code"));

		$where = "where C.user_id = U.id and U.type = 3 and C.status>0";
		if($referral_code){
			$where .= " and U.referral_code = '".$referral_code."'";
		}
		$urlrule = 'index.php?c=operate&a=deal';
		$deal = D("Bms")->query("select C.cate,C.g_code,sum(C.quantity) as quantity,C.price,C.t_price,C.ctime,C.deal_time,U.realname,U.phone,U.referral_code from `jjs_contract` C,`jjs_user` U ".$where." group by cate,status limit ".($page-1)*$page_size.",".$page_size);
		$r = D("Bms")->query("select C.* from `jjs_contract` C,`jjs_user` U ".$where." group by cate,status ");
		$count = count($r);
		foreach($deal as $k=>$v){
			$deal[$k]['fee'] = sprintf("%.4f",$v["t_price"]*$v["quantity"]*($parameter[0]["fee"]/2));
			$deal[$k]['operate_fee'] = sprintf("%.4f",$v["t_price"]*$v["quantity"]*($parameter[0]["operate"]/2));
			$deal[$k]['agent_operation_fee'] = sprintf("%.4f",$v["t_price"]*$v["quantity"]*($parameter[0]["agent_operation"]/2));
			$deal[$k]['agent_fee'] = sprintf("%.4f",$v["t_price"]*$v["quantity"]*($parameter[0]["agent"]/2));
			
		}
		$pages = $this->pages($count, $page, $page_size,$urlrule);
		$this->assign("deal",$deal);
		$this->assign("pages",$pages);
		$this->assign("count",$count);
		$this->display();

	}

	
}
