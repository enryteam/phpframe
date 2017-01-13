<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_sys_class('BaseAction');

class login extends BaseAction
{
	public function __construct()
	{
		parent::__construct();

	}

	public function index()
	{
		returnJson('200');
	}

	//登录(手机，账号或邮箱登录方式)
	public function dologin()
	{
		$restModel = D("Rest");
		$loginmode = getgpc("loginmode");
		$token = trim(getgpc("token"));
		$account = trim(getgpc("account"));
		$validity = trim(getgpc("validity"));
		$id = intval(getgpc("id"));
		$password = getgpc("password");
		$pattern_phone = "/^1[34578]{1}\d{9}$/";//手机正则
		$pattern_email = "/^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/";//邮箱正则

		if(preg_match($pattern_phone,$loginmode)){
    		$res = $restModel->query("select id,password,account from `jjs_user` where phone = '".$loginmode."'");
		}elseif(preg_match($pattern_email,$loginmode )){
			$res = $restModel->query("select id,password,account from `jjs_user` where email = '".$loginmode."'");
		}else{
			$res = $restModel->query("select id,password,account from `jjs_user` where account = '".$loginmode."'");
		}
		if(empty($loginmode)&&empty($password)&&$token&&$account&&$validity&&$id){
			
			if($token == md5($account.$id."CN.ENRY.JJS".$validity)){
				$_SESSION['user_id'] = $id;
				echo "<meta http-equiv='Refresh' content='0.01'; url='../acenter/' /><script>window.location.href='../acenter/';</script>";exit;
				//returnJson("200","登录成功",array("token"=>md5($account.$id."CN.ENRY.JJS".$validity),"validity"=>$validity,"account"=>$account));
			}else{
				returnJson("500","登录失败");
			}

		}else{
			if($res){
				if(md5($password) == $res[0]["password"]){
					$time = time();
					$_SESSION['user_id'] = $res[0]['id'];

					returnJson("200","登录成功",array("token"=>md5($res[0]["account"].$res[0]["id"]."CN.ENRY.JJS".$time),"id"=>$res[0]["id"],"validity"=>$time,"account"=>$res[0]["account"]));
				}else{
					returnJson("500","密码输入错误，请重新输入");
				}
			}else{
				returnJson("403","用户不存在");
			}
		}

		
	}
	//用户退出
	public function logout()
	{
		unset($_SESSION['user_id']);
		returnJson('200','退出成功');
	}

	//登录状态判断
	public function login_status()
	{
		if(empty($_SESSION['user_id'])){
			returnJson("500","请先登录");
		}else{
			returnJson("200","已登录");
		}
	}



	//用户验证码
	public function captcha()
	{
		$phone = getgpc('phone');

		if(!is_mobile($phone))
		{
			returnJson('500','手机号码不正确');
		}
		$smscode = rand(1000,9999);

		file_put_contents("CAS.txt",'http://apistore.51daniu.cn/rest/index.php?c=sms&a=captcha&phone='.$phone.'&checkcode='.$smscode);
		$ret = json_decode(file_get_contents('http://apistore.51daniu.cn/rest/index.php?c=sms&a=captcha&phone='.$phone.'&checkcode='.$smscode."&pc=jjs"),true);

		if($ret["code"]== 200){

		  $_SESSION['smsphone'] = $phone;
		  $_SESSION['smscode'] = $smscode;

		  returnJson('200','短信发送成功',$ret['data']);
		}else{
		  //状态非0，说明失败
		  //$msg = $result['reason'];
		  returnJson('500',$ret["message"],$ret['data']);
		}
	}
	
	//忘记密码（PCWEB）
	public function refund()
	{
		$restModel = D("Rest");
		$phone = getgpc("phone");
		$smscode = getgpc("smscode");
		$password = md5(getgpc("password"));
		$repassword = md5(getgpc("repassword"));
		$user = $restModel->query("select id from `jjs_user` where phone = '".$phone."'");
		if(empty($user)){
			returnJson('500','账号不存在');
		}else{
			if(!empty($_SESSION['smscode'])&& $_SESSION['smscode']==$smscode && $_SESSION['smsphone'] == $phone)
			{
				
				if($repassword == $password){
					$res = $restModel->querysql("update `jjs_user` set password = '".$password."' where phone = '".$phone."'");
					if($res){
						returnJson("200","修改成功");
					}else{
						returnJson("500","修改失败");
					}
				}else{
					returnJson("500","两次密码输入不一致，请重新输入");
				}
			}else
			{
				returnJson('500','验证码可能有误');
			}
		}
	}

	//忘记密码（MAPP）
	public function forget()
	{
		$restModel = D("Rest");
		$phone = getgpc("phone");
		$smscode = getgpc("smscode");
		$password = md5(getgpc("password"));
		$user = $restModel->query("select id from `jjs_user` where phone = '".$phone."'");
		if(empty($user)){
			returnJson('500','账号不存在');
		}else{
			if(!empty($_SESSION['smscode'])&& $_SESSION['smscode']==$smscode && $_SESSION['smsphone'] == $phone)
			{
				$res = $restModel->querysql("update `jjs_user` set password = '".$password."' where phone = '".$phone."'");
				if($res){
					returnJson("200","修改成功");
				}else{
					returnJson("500","修改失败");
				}
			}else
			{
				returnJson('500','验证码可能有误');
			}
		}
	}

}
