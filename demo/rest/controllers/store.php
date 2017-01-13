<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_sys_class('BaseAction');

class store extends BaseAction
{
	public function __construct()
	{
		
		parent::__construct();

	}

	public function index()
	{
		returnJson('200');
	}
	//我的店铺
	public function my_store()
	{
		$restModel = D("Rest");
		$result = $restModel->query("select * from `jjs_store` where user_id = ".$_SESSION["user_id"]." and status = 1");
		if(empty($result)){
			returnJson("500","暂无商店");
		}
		else
		{
			returnJson("200","",array("store_img"=>$result[0]["store_img"],
									  "store_name"=>$result[0]["store_name"]
									  ));
		}
	}

	//店铺申请
	public function store_application()
	{
		$name = getgpc("name");
		$store_name = getgpc("store_name");
		$qq = getgpc("qq");
		$identity = getgpc("identity");
		$id_front = getgpc("id_front");
		$id_back = getgpc("id_back");
		$id_person = getgpc("id_person");
		$restModel = D("Rest");
		$r = $restModel->query("select * from `jjs_store` where user_id = ".$_SESSION["user_id"]);
		if($r){
			returnJson("201","申请已提交，请勿重复操作");
		}else{
			$res = $restModel->querySql("insert into `jjs_store` (user_id,realname,identity,store_name,id_front,id_back,id_person,qq,ctime)values ('".$_SESSION["user_id"]."', '".$name."', '".$identity."', '".$store_name."','".$id_front."', '".$id_back."', '".$id_person."','".$qq."','".date('Y-m-d H:i:s')."')");
			if($res){
				returnJson("200","申请已提交");
			}else{
				returnJson("200","申请提交失败");
			}
		}
	}

	//店铺管理
	public function store_manage()
	{
		$restModel = D("Rest");
		$result = $restModel->query("select * from `jjs_user` where id = ".$_SESSION["user_id"]);
		$res = $restModel->query("select * from `jjs_store` where user_id = ".$_SESSION["user_id"]);
		if($res){
			returnJson("200","查询成功",array("store_img"=>$result[0]["image"],
											 "store_name"=>$res[0]["store_name"],
											 "store_level"=>$res[0]["store_level"],
											 "store_notice"=>$res[0]["store_notice"],
											 "main_categories"=>$res[0]["main_categories"],
											 "hot_line"=>$res[0]["hot_line"],
											 "qq"=>$res[0]["qq"]
											 ));
		}
		else
		{
			returnJson("500","查询失败");
		}
	}

	//店铺管理保存按钮
	public function manage_save()
	{
		$restModel = D("Rest");
		$store_name = getgpc("store_name");
		$store_notice = getgpc("store_notice");
		$hot_line = getgpc("hotline");
		$qq = getgpc("qq");
		$result = $restModel->querySql("update `jjs_store` set store_name = '".$store_name."',store_notice = '".$store_notice."',hot_line = '".$hot_line."',qq = '".$qq."' where user_id = ".$_SESSION["user_id"]);
		if($result){
			returnJson("200","保存成功");
		}
		else{
			returnJson("500","保存失败");
		}
	}

	//订单详情
	public function order_details()
	{
		$restModel = D("Rest");
		$order_sn = getgpc("order_sn");
		$res = $restModel->query("select order_sn,g_img,g_title,tel,consignee,address,phone,single_time,status,demand,logistics_sn,logistics_name from `jjs_order` where order_sn = '".$order_sn."'");
		foreach($res as $k=>$v){
			if($v["status"]==0){
				$res[$k]["status"] = '待付款';
			}elseif($v["status"]==1){
				$res[$k]["status"] = '待发货';
			}elseif($v["status"]==2){
				$res[$k]["status"] = '待收货';
			}elseif($v["status"]==3){
				$res[$k]["status"] = '待评价';
			}elseif($v["status"]==4){
				$res[$k]["status"] = '已评价';
			}elseif($v["status"]==5){
				$res[$k]["status"] = '订单完成';
			}elseif($v["status"]==6){
				$res[$k]["status"] = '订单卖家取消';
			}elseif($v["status"]==7){
				$res[$k]["status"] = '订单买家退款';
			}elseif($v["status"]==8){
				$res[$k]["status"] = '卖家同意退款';
			}elseif($v["status"]==9){
				$res[$k]["status"] = '卖家拒绝退款';
			}elseif($v["status"]==20){
				$res[$k]["status"] = '买家提醒发货';
			}
		}
		if($res){
			returnJson("200","请求成功",$res[0]);
		}else{
			returnJson("200","请求失败");
		}
	}

}
