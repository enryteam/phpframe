<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_sys_class('BaseAction');

class buy extends BaseAction
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		returnJson('200');
	}

	//添加购物车
	public function add_shopcar()
	{
		$restModel = D("Rest");
		$gid = getgpc("gid");
		$num = empty(getgpc("num"))?'1':getgpc("num");

		if($gid){
			$is_val = $restModel->query("select * from `jjs_shopcar` where user_id = '".$_SESSION["user_id"]."' and gid = ".$gid);
			if($is_val){
				$res = $restModel->querysql("update `jjs_shopcar` set num = num+".$num." where gid = ".$gid);
			}else{
				$res = $restModel->querysql("insert into `jjs_shopcar`(user_id,gid,num,ctime) values('".$_SESSION["user_id"]."','".$gid."','".$num."','".time()."')");
			}
			
			if($res){
				returnJson("200","添加成功");
			}else{
				returnJson("500","添加失败");
			}
		}
	}

	//删除购物车
	public function del_goods()
	{
		$id = getgpc("id");
		$restModel = D("Rest");
		$res = $restModel->querysql("delete from `jjs_shopcar` where id = ".$id);
		if($res){
			returnJson("200","删除成功");
		}else{
			returnJson("500","删除失败");
		}
	}
	
	//删除收货地址
	public function del_address()
	{
		$restModel = D("Rest");
		$id = getgpc("id");
		$res = $restModel->querysql("delete from `jjs_receipt_address` where id = ".$id);
		if($res){
			returnJson("200","删除成功");
		}else{
			returnJson("500","删除失败");
		}
	}

	//去结算更新购物车
	public function update_shopcar()
	{
		$restModel = D("Rest");
		$arr = explode(",",substr(getgpc("arr"),0,-1));
		
		//购物车全部商品
		$allgoods = $restModel->query("select S.id,S.gid,G.title,G.img,G.price from `jjs_shopcar` S,`jjs_goods` G where S.gid = G.id and S.user_id = ".$_SESSION["user_id"]);
		foreach($allgoods as $k=>$v){
			$res = $restModel->querysql("update `jjs_shopcar` set num = '".$arr[$k]."' where id = ".$v["id"]);
		}
		if($res){
			returnJson("200","操作成功");
		}else{
			returnJson("500","操作失败");
		}
	}

	//临时购物车
	public function temp_shopcar()
	{
		$restModel = D("Rest");
		$goods_id = getgpc("goods_id");
		if($goods_id){
			//判断该商品是否合法
			$trues = $restModel->query("select id from `jjs_goods` where id = ".$goods_id);
			if($trues){
				returnJson("200","数据合法");
				
			}else{
				returnJson("500","数据非法");
			}
		}
	}

	//提交订单(购物车)
	public function commit_order()
	{
		$restModel = D("Rest");
		$addressid = intval(getgpc("addressid"));//收货地址id
		$amount = getgpc("amount");//实付
		$demand = getgpc("demand");//买家留言
		$address = $restModel->query("select * from `jjs_receipt_address` where id = ".$addressid);
		if(empty($address))
		{
			returnJson("500","收货地址不能为空！",$address_id);
		}
		
		$res = $restModel->query("select C.gid,C.num,G.user_id as seller_id,G.price,G.title,G.img from `jjs_shopcar` C,`jjs_goods` G where C.gid = G.id and C.user_id = ".$_SESSION["user_id"]);
		
		foreach($res as $k=>$v){
			$total = $v["num"]*$v["price"];
			$tel = $total;
			$r = $restModel->querysql("insert into `jjs_order` (order_sn,gid,user_id,seller_id,num,total,consignee,address,phone,tel,g_title,g_price,g_img,single_time,ctime,postcode,pay_cate,demand) values('".date("Ymd").rand(10000000,99999999)."','".$v["gid"]."','".$_SESSION["user_id"]."','".$v["seller_id"]."','".$v["num"]."','".$total."','".$address[0]["realname"]."','".$address[0]["address"]."','".$address[0]["phone"]."','".$tel."','".$v["title"]."','".$v["price"]."','".$v["img"]."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','".$address[0]["postcode"]."',2,'".$demand."')");
			$restModel->querysql("update `jjs_goods` set stock = stock-".$v["num"].",sold = sold+".$v["num"]." where id = ".$v["gid"]);
			$orderid[] = $restModel->query("select last_insert_id()");//获取当前的记录id
		}
		foreach($orderid as $k=>$v){
			foreach($v as $key=>$vo){
				$orderids[] = $vo["last_insert_id()"];
			}
			
		}
		if($r){
			
			$restModel->querysql("delete from `jjs_shopcar` where user_id = ".$_SESSION["user_id"]);
			returnJson("200","提交成功",implode(",",$orderids));
			
		}else{
			returnJson("500","提交失败");
		}
	}

	//提交订单(临时购物车)
	public function commit_temporder()
	{
		$restModel = D("Rest");
		$addressid = intval(getgpc("addressid"));//收货地址id
		$amount = getgpc("amount");//实付
		$demand = getgpc("demand");//留言
		$goods_id = intval(getgpc("goods_id"));//商品id
		$order_sn = date("Ymd").rand(10000000,99999999);
		$address = $restModel->query("select * from `jjs_receipt_address` where id = ".$addressid);
		if(empty($address))
		{
			returnJson("500","收货地址不能为空！",$address_id);
		}
		$res = $restModel->query("select * from `jjs_goods` where id = ".$goods_id);

		$r = $restModel->querysql("insert into `jjs_order` (order_sn,gid,user_id,seller_id,num,total,consignee,address,phone,tel,g_title,g_price,g_img,single_time,ctime,postcode,pay_cate,demand) values('".$order_sn."','".$goods_id."','".$_SESSION["user_id"]."','".$res[0]["user_id"]."','".round($amount/$res[0]["price"])."','".$amount."','".$address[0]["realname"]."','".$address[0]["address"]."','".$address[0]["phone"]."','".$amount."','".$res[0]["title"]."','".$res[0]["price"]."','".$res[0]["img"]."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','".$address[0]["postcode"]."',2,'".$demand."')");
		
		$orderid = $restModel->query("select last_insert_id()");//获取当前的记录id
		
		if($r){
			$restModel->querysql("update `jjs_goods` set stock = stock-".round($amount/$res[0]["price"]).",sold = sold+".round($amount/$res[0]["price"])." where id = ".$goods_id);
			returnJson("200","提交成功",$orderid[0]["last_insert_id()"]);
			
		}else{
			returnJson("500","提交失败");
		}
	}

	public function checkorder()
	{
		$orderids = explode(",",getgpc("orderids"));
		$tpassword = getgpc("tpassword");
		$restModel = D("Rest");
		$result = $restModel->query("select * from `jjs_user_finance` where user_id = ".$_SESSION["user_id"]);
		$res = $restModel->query("select * from `jjs_user` where id = ".$_SESSION["user_id"]);

		//用户帐户余额查询
		$account = $restModel->query("select * from `jjs_user_finance` where user_id = ".$_SESSION["user_id"]);
		$available = $account[0]["recharge"]+$account[0]["inamount"]+$account[0]["extendamount"]+$account[0]["tempamount"]-$account[0]["withdraw"]-$account[0]["bond"]-$account[0]["outamount"];

		$i = 0;
		foreach($orderids as $k=>$v){
			$goods = $restModel->query("select * from `jjs_order` where id = '".$v."'");
			$total = $goods[0]["total"];
			if(md5($tpassword) == $res[0]["tpassword"]){
				if($total <= $available){
					$restModel->querySql("update `jjs_order` set status = 1,pay_time = '".date("Y-m-d H:i:s")."' where order_sn = '".$goods[0]["order_sn"]."'");
					$restModel->querySql("update `jjs_user_finance` set outamount = outamount+".$goods[0]["total"]." where user_id = ".$_SESSION["user_id"]);
					$restModel->querySql("insert into `jjs_detail` (user_id,cate,remark,amount,ctime) values('".$_SESSION["user_id"]."','2','买商品支出','-".$goods[0]["total"]."','".date("Y-m-d H:i:s")."')");
					/*
					*异步处理结算 by enry
					*/
					$sql = "update jjs_user_finance set inamount = inamount+".$goods[0]["tel"]." where user_id = ".$goods[0]["seller_id"];
					$r = $restModel->querySql("insert into `jjs_store_payment` (order_sn,created,buyerid,sellerid,sqlstr,status) values('".$goods[0]["order_sn"]."','".time()."','".$_SESSION["user_id"]."','".$goods[0]["seller_id"]."','".$sql."',0)");
					
					$i++;
				}
				else
				{
					
					returnJson("500","账户资金不足，请充值");
				}

			}
			else
			{
				returnJson("500","支付密码错误，请重新输入");
			}
		}
		if($i == count($orderids)){
			returnJson("200","支付成功");
		}else{
		
			returnJson("500","支付失败");
		}
	}
}
