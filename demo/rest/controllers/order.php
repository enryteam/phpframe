<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_sys_class('BaseAction');

class order extends BaseAction
{
	public function __construct()
	{
		parent::__construct();

	}

	public function index()
	{
		returnJson('200');
	}

	//订单发货
	public function delivery_goods()
	{
		$order_sn = getgpc("order_sn");
		$logistics_name = getgpc("logistics_name");
		$logistics_sn = getgpc("logistics_sn");

		if(empty($logistics_name) && empty($logistics_sn)){
			returnJson("500","请填写完整的发货信息");
		}
		$res = D("Rest")->querysql("update `jjs_order` set status = 2,logistics_sn = '".$logistics_sn."',logistics_name ='".$logistics_name."',deliver_time = '".date('Y-m-d H:i:s')."' where order_sn = '".$order_sn."'");
		if($res){
			returnJson("200","发货成功");
		}else{
			returnJson("500","发货失败");
		}
	
	}

	//删除订单
	public function del_order()
	{
		$order_sn = getgpc("order_sn");
		$result = D("Rest")->querysql("delete from `jjs_order` where order_sn = '".$order_sn."'");
		if($result){
			returnJson("200","删除成功");
		}
		else{
			returnJson("500","删除失败");
		}

	}

	//取消订单(还未付款)
	public function cancel_order()
	{
		$order_sn = getgpc("order_sn");
		$goods = D("Rest")->query("select * from `jjs_order` where order_sn = '".$order_sn."'");

		$result = D("Rest")->querySql("update `jjs_order` set status = 6,cancel_time = '".date("Y-m-d H:i:s")."' where order_sn = '".$order_sn."'");
		if($result){
			$r = D("Rest")->query("select num,gid from `jjs_order` where order_sn = '".$order_sn."'");
			D("Rest")->querysql("update `jjs_goods` set stock = stock+'".$r[0]["num"]."' where id = ".$r[0]["gid"]);
			returnJson("200","取消成功");
		}
		else{
			returnJson("500","取消失败");
		}

	}

	//提醒发货
	public function remind_delivery()
	{
		$order_sn = getgpc("order_sn");
		$result = D("Rest")->querysql("update `jjs_order` set status = 20 where order_sn = '".$order_sn."'");
		if($result){
			returnJson("200","提醒成功");
		}
		else{
			returnJson("500","提醒失败");
		}
	}

	//申请退货
	public function return_order()
	{
		$order_sn = getgpc("order_sn");
		$type = getgpc("type");
		$reason = getgpc("reason");
		$amount = getgpc("amount");
		$res = D("Rest")->querySql("insert into `jjs_return` (user_id,order_sn,type,reason,amount,ctime) values('".$_SESSION["user_id"]."','".$order_sn."','".$type."','".$reason."','".$amount."','".date("Y-m-d H:i:s")."')");
		if($res){
			D("Rest")->querySql("update `jjs_order` set status = 7 where order_sn = '".$order_sn."'");
			returnJson("200","提交成功");
		}else{
			returnJson("500","提交失败");
		}

	}
	
	//买家退货
	public function return_goods()
	{
		$order_sn = getgpc("order_sn");
		$logistics_name = getgpc("logistics_name");
		$logistics_sn = getgpc("logistics_sn");
		$res = D("Rest")->querySql("update `jjs_return` set logistics_name = '".$logistics_name."',logistics_sn = '".$logistics_sn."',deliver_time = '".date("Y-m-d H:i:s")."' where order_sn = '".$order_sn."'");
		if($res){
			returnJson("200","操作成功");
		}else{
			returnJson("500","操作失败");
		}

	}

	//退款处理
	public function deal_with_return()
	{
		$restModel = D("Rest");
		$order_sn = getgpc("order_sn");
		$res = $restModel->query("select * from `jjs_return` where order_sn = ".$order_sn);
		$type = getgpc("type");
		
		if($type=="同意"){
		
			$restModel->querySql("update `jjs_return` set status = 1 where order_sn = ".$order_sn);
			$restModel->querySql("update `jjs_order` set status = 8 where order_sn = ".$order_sn);
			$finance = $restModel->query("select goodsamount from `jjs_user_finance` where user_id = ".$_SESSION["user_id"]);
			if($finance[0]["goodsamount"] >= $res[0]["amount"]){
				$restModel->querySql("update `jjs_user_finance` set goodsamount = goodsamount-".$res[0]["amount"]." where user_id = ".$_SESSION["user_id"]);
				$restModel->querySql("update `jjs_user_finance` set tempamount = tempamount+".$res[0]["amount"]." where user_id = ".$res[0]["user_id"]);
				$restModel->querySql("insert into `jjs_detail`(user_id,cate,remark,amount,ctime) values('".$_SESSION["user_id"]."','1400','订单退款扣除','-".$res[0]["amount"]."','".date("Y-m-d H:i:s")."')");
				$restModel->querySql("insert into `jjs_detail`(user_id,cate,remark,amount,ctime) values('".$res[0]["user_id"]."','1401','订单退款到账','".$res[0]["amount"]."','".date("Y-m-d H:i:s")."')");
				returnJson("200","同意退款");
			}else{
				returnJson("500","订单：".$order_sn."还未进账");
			}
			
		
		}elseif($type=="拒绝"){
			$restModel->querySql("update `jjs_return` set status = 1 where order_sn = ".$order_sn);
			$restModel->querySql("update `jjs_order` set status = 9 where order_sn = ".$order_sn);
			returnJson("500","退款已拒绝");
		}
	}

	//确认收货
	public function confirm_receipt()
	{
		$restModel = D("Rest");
		$order_sn = getgpc("order_sn");
		$tpassword = md5(getgpc("tpassword"));
		$order = $restModel->query("select tel,seller_id from `jjs_order` where order_sn= '".$order_sn."'");
		$user_tpassword = $restModel->query("select tpassword from `jjs_user` where id = ".$_SESSION["user_id"]);
		$store_payment = $restModel->query("select * from `jjs_store_payment` where order_sn = '".$order_sn."' and status = 0");
		if($tpassword == $user_tpassword[0]["tpassword"]){
			$result = $restModel->querySql("update `jjs_order` set status = 5,receipt_time = '".date("Y-m-d H:i:s")."',complete_time = '".date("Y-m-d H:i:s")."' where order_sn = '".$order_sn."'");
			if($result){
				$restModel->querysql("".mysql_real_escape_string($store_payment[0]["sqlstr"])."");
				$restModel->querysql("update `jjs_store_payment` set status = 1 where order_sn = '".$order_sn."'");
				$restModel->querysql("insert into `jjs_detail` (user_id,cate,remark,amount,ctime) values('".$order[0]["seller_id"]."','1257','订单号为".$order_sn."的商品进账','+".$order[0]["tel"]."','".date("Y-m-d H:i:s")."')");
				returnJson("200","收货成功");
			}
			else{
				returnJson("500","收货失败");
			}
		}else{
			returnJson("500","支付密码输入错误");
		}
	}

}