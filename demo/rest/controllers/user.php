<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_sys_class('BaseAction');

class user extends BaseAction
{
	public function __construct()
	{
		if(empty($_SESSION['user_id']))
		{
			returnJson('403','请先登录');
		}

		parent::__construct();

	}

	public function index()
	{
		returnJson('200');
	}

	//用户资料
	public function userdata()
	{
		
		$userdata = D("Rest")->query("select id,realname,phone,idcard,bank,bank_card,address,head_img,nickname,email,role,tpassword as is_set,referral_code from `jjs_user` where id=".$_SESSION['user_id']);
		
		if($userdata)
		{
			foreach($userdata as $k=>$v){
				$userdata[$k]["hiddenphone"] = substr_replace($v["phone"],"****",3,4);//手机号中间4位用*代替
			}
			returnJson('200','请求成功',$userdata[0]);
		}
		else
		{
			returnJson('500','请求失败');
		}
	}

	/*//我的资产
	public function assets()
	{
		$restModel=D('Rest');
		
		if($result){
			returnJson("200","",array(
										"assets"=>$assets,
										"coin"=>intval($coin),
										"bamount"=>$bamount,
										"damount"=>$damount,
										"available"=>$available,
										"wabao_amount"=>$wabao_amount
										));
		}else{
			returnJson("500","",array(
										"assets"=>0,
										"coin"=>0,
										"bamount"=>0,
										"damount"=>0,
										"available"=>$available,
										"wabao_amount"=>$wabao_amount
			));
		}
	}*/

	//收货地址列表
	public function address()
	{
		$address = D("Rest")->query("select * from `jjs_receipt_address` where user_id = ".$_SESSION["user_id"]);
		if($address){
			returnJson("200","请求成功",$address);
		}
		else
		{
			returnJson("200","暂无收货地址");
		}
	}

	//新增收货地址
	public function add_address()
	{
		$realname = getgpc("realname");
		$phone = getgpc("phone");
		$postcode = getgpc("postcode");
		$address = getgpc("address");
		$area = getgpc("area");
		$is_default = getgpc("is_default");
		
		//收货地址个数（最多只能有3个）
		$num = D("Rest")->query("select count(1) as count from `jjs_receipt_address` where user_id = ".$_SESSION["user_id"]);
		if($num[0]["count"]>2){
			returnJson("500","您最多可以新增3条");
		}else{
			$res = D("Rest")->querysql("insert into `jjs_receipt_address`(user_id,realname,phone,postcode,address,area,is_default)  values ('".$_SESSION["user_id"]."', '".$realname."', '".$phone."', '".$postcode."', '".$address."','".$area."','".$is_default."')");
			if($res){
				returnJson("200","新增成功");
			}
			else
			{
				returnJson("500","新增失败");
			}
		}
		
		
	}

	//删除收货地址
	public function del_address()
	{
		$id = getgpc("id");
		$res = D("Rest")->querySql("delete from `jjs_receipt_address` where id = ".$id);
		if($res){
			returnJson("200","删除成功");
		}
		else
		{
			returnJson("500","删除失败");
		}

	}
	
	//设置支付密码
	public function tpassword()
	{
		$restModel = D("Rest");
		$phone = getgpc("phone");
		$tpassword = md5(getgpc("tpassword"));
		$retpassword = md5(getgpc("retpassword"));
		$smscode = getgpc("smscode");
		if(!empty($_SESSION['smscode'])&& $_SESSION['smscode']==$smscode && $_SESSION['smsphone'] == $phone){
			if($retpassword==$tpassword){
				$res = $restModel->querysql("update `jjs_user` set tpassword = '".$tpassword."' where id = ".$_SESSION["user_id"]);
				if($res){
					returnJson("200","设置成功");
				}
				else
				{
					returnJson("500","设置失败");
				}
			}else{
				returnJson("500","两次输入密码不一致");
			}
		}else{
			returnJson("500","验证码填写有误");
		}
		

	}
	
	//提交提现申请
	public function commit_withdraw()
	{
		$phone = getgpc("phone");
		$bank_card = getgpc("bank_card");
		$amount = intval(getgpc("amount"));
		$tpassword = md5(getgpc("tpassword"));
		$smscode = getgpc("smscode");
		
		if(!empty($_SESSION['smscode'])&& $_SESSION['smscode']==$smscode && $_SESSION['smsphone'] == $phone){

			//用户帐户余额查询
			$account = D("Acenter")->query("select * from `jjs_user_finance` where user_id = ".$_SESSION["user_id"]);
			$available = $account[0]["recharge"]+$account[0]["inamount"]+$account[0]["extendamount"]+$account[0]["tempamount"]-$account[0]["withdraw"]-$account[0]["bond"]-$account[0]["outamount"];
			
			$user = D("Rest")->query("select * from `jjs_user` where id = ".$_SESSION["user_id"]);
			if($amount<=$available){
				if($amount<10000 || $amount>5000000){
					returnJson("500","提现金额必须大于10000金币且小于5000000金币");
				}else{
					if($tpassword == $user[0]["tpassword"]){
							$res = D("Rest")->querysql("insert into `jjs_withdraw` (user_id,bank_card_id,amount,ctime) values('".$_SESSION['user_id']."','".$user[0]['bank_card']."','".$amount."','".time()."')");

							D("Rest")->querysql("insert into `jjs_detail` (user_id,cate,remark,amount,ctime) values('".$_SESSION['user_id']."','1','申请提现','-".$amount."','".date('Y-m-d H:i:s')."')");
							D("Rest")->querysql("update `jjs_user_finance` set withdraw = withdraw+".$amount." where user_id = ".$_SESSION["user_id"]);
							if($res){
								returnJson("200","提交成功");
							}else{
								returnJson("500","提交失败");
							}
						
					}else{
						returnJson("500","交易密码错误");
					}
				}

			}else{
				returnJson("500","提现金额必须小于可提现金额");
			}
		}else{
			returnJson("500","验证码填写有误");
		}

	}

	//用户基本信息修改(PCWEB)
	public function modify_userdata()
	{
		$image = getgpc("image");
		$nickname = getgpc("nickname");
		$email = getgpc("email");
		$idcard = getgpc("idcard");
		$res = D("Rest")->querysql("update `jjs_user` set head_img = '".$image."',nickname = '".$nickname."',email = '".$email."',idcard = '".$idcard."' where id = ".$_SESSION["user_id"]);
		if($res){
			returnJson("200","修改成功");
		}else{
			returnJson("500","修改失败");
		}
		
	}

	//用户基本信息修改(MAPP)
	public function update_userdata()
	{
		$image = getgpc("image");
		$nickname = getgpc("nickname");
		$email = getgpc("email");
		$idcard = getgpc("idcard");
		$tpassword = getgpc("tpassword");

		$condition = "update `jjs_user` set";
		if($image){
			$condition .= " head_img = '".$image."',";
		}
		if($nickname){
			$condition .= " nickname = '".$nickname."',";
		}
		if($email){
			$condition .= " email = '".$email."',";
		}
		if($idcard){
			$condition .= " idcard = '".$idcard."',";
		}
		if($tpassword){
			$condition .= " tpassword = '".$tpassword."',";
		}

		$res = D("Rest")->querysql(substr($condition,0,-1)." where id = ".$_SESSION["user_id"]);
		if($res){
			returnJson("200","修改成功");
		}else{
			returnJson("500","修改失败");
		}
		
	}

	//银行列表
	public function bank()
	{
		$bank = D("Rest")->query("select * from `jjs_bank`");
		if($bank){
			returnJson("200","请求成功",$bank);
		}
		else
		{
			returnJson("200","暂无银行，请联系后台管理员添加");
		}
	}

	//绑定银行卡
	public function bindcard()
	{
		$realname = trim(getgpc("realname"));//开户名
		$bank_id = getgpc("bank_id");//开户行
		$branch = trim(getgpc("branch"));//所属分行
		$bank_card = getgpc("bank_card");//银行卡号
		
		//查询银行名称
		$bank = D("Rest")->query("select * from `jjs_bank` where id = ".$bank_id);
		
		//更新用户绑定银行卡信息
		$res = D("Rest")->querysql("update jjs_user set realname = '".$realname."',bank = '".$bank[0]['title']."',branch = '".$branch."',bank_card = '".$bank_card."' where id = ".$_SESSION["user_id"]);
		
		//写入银行卡绑定记录
		D("Rest")->querysql("insert into `jjs_bank_bind` (user_id,realname,bank_id,branch,card,ctime) values('".$_SESSION['user_id']."','".$realname."','".$bank_id."','".$branch."','".$bank_card."','".time()."')");

		if($res)
		{
			returnJson("200","申请提交成功");
		}
		else
		{
			returnJson("500","申请提交失败");
		}

	}

	//关于我们
	public function realated()
	{
		$res = D("Rest")->query("select A.content from `jjs_article` A,`jjs_article_cate` C where A.cateid = C.id and C.title = '关于我们'");
		if($res)
		{
			returnJson("200","请求成功",$res[0]);
		}
		else
		{
			returnJson("500","请求失败");
		}

	}

	//帮助中心列表
	public function helpcenter()
	{
		$res = D("Rest")->query("select A.id,A.title,A.content,A.ctime from `jjs_article` A,`jjs_article_cate` C where A.cateid = C.id and C.title = '帮助中心'");
		if($res)
		{
			foreach($res as $k=>$v){
				$res[$k]["ctime"] = date("Y-m-d",$v["ctime"]);
			}
			returnJson("200","请求成功",$res);
		}
		else
		{
			returnJson("500","请求失败");
		}

	}

	//帮助中心详情
	public function helpdetail()
	{
		$id = intval(getgpc("id"));
		$res = D("Rest")->query("select * from `jjs_article` where id = ".$id);
		if($res)
		{
			returnJson("200","请求成功",$res[0]);
		}
		else
		{
			returnJson("500","请求失败");
		}

	}
	

}
