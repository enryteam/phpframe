<?php
defined('IN_PHPFRAME') or exit('No permission resources.');

pc_base::load_app_class('RestAction');

class barclays extends RestAction
{
	public function __construct()
	{
		
		parent::__construct();
	}

	public function index()
	{
		returnJson('200');
	}

	//随机生成数字加字母组合
	static function getRandomString($len, $chars=null)
	{
		if (is_null($chars)){
			$chars = "abcdefghijkmnpqrstuvwxyz23456789";
		} 
		mt_srand(10000000*(double)microtime());
		for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++){
			$str .= $chars[mt_rand(0, $lc)]; 
		}
		return $str;
	}

	//用户验证码
	public function sendcode()
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

	//发送验证邮件
	public function sendemail()
	{
		$email = trim(getgpc("email"));
		$pattern_email = "/^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/";//邮箱正则
		if(preg_match($pattern_email,$email )){
			
			$code = $this->getRandomString(6);
			/*$code = '';
			for($i=1;$i<=6;$i++){
				$code .= chr(rand(65,105));
			}*/

			file_put_contents("CAS.txt",'https://apistore.51daniu.cn/rest/index.php?c=mail&a=smtp&body=尊敬的用户，验证码为'.$code.'&subject=开户申请邮箱验证&mailto='.$email);
			$ret = json_decode(file_get_contents('https://apistore.51daniu.cn/rest/index.php?c=mail&a=smtp&body=尊敬的用户，验证码为'.$code.'&subject=开户申请邮箱验证&mailto='.$email."&pc=jjs"),true);
			if($ret["code"]== 200){
				$_SESSION['smsemail'] = $email;
				$_SESSION['emailcode'] = $code;
				returnJson('200','邮件发送成功',$ret['data']);
			}else{
				//状态非0，说明失败
				//$msg = $result['reason'];
				returnJson('500',"邮件发送失败",$ret['data']);
			}
		}else{
			returnJson("500","邮箱格式不正确");
		}
		
	}

	
	//开户
	public function register()
	{
		$restModel=D('Rest');
		$realname = getgpc("realname");
		$sex = getgpc("sex");
		$idtype = getgpc("idtype");
		$idcard = getgpc("idcard");
		$referral_code = getgpc("referral_code");
		$phone = getgpc("phone");
		$smscode = getgpc("smscode");
		$email = getgpc("email");
		$emailcode = getgpc("emailcode");
		$bank = getgpc("bank");
		$bank_card = getgpc("bank_card");
		$address = getgpc("address");
		$emergency_contact = getgpc("emergency_contact");
		$emergency_contact_phone = getgpc("emergency_contact_phone");
		$id_front_img = getgpc("id_front_img");
		$id_back_img = getgpc("id_back_img");
		$id_hold_img = getgpc("id_hold_img");
		$pattern = '23456789abcdefghijklmnpqrstuvwxyz';  
		for($i=0;$i<6;$i++)   
		{   
				$key .= $pattern{mt_rand(0,32)};    //生成php随机数
		}
		if(!empty($_SESSION['smscode'])&& $_SESSION['smscode']==$smscode && $_SESSION['smsphone'] == $phone)
		{
			if(!empty($_SESSION['emailcode'])&& $_SESSION['emailcode']==$emailcode && $_SESSION['smsemail'] == $email)
			{
				
				$tuser_id = $restModel->query("select id,tlist from `jjs_user` where referral_code = '".$referral_code."'");//推广用户的id
				$sql="insert into `jjs_user`(id,referral_code,tuser_code,realname,sex,phone,idtype,idcard,bank,bank_card,address,emergency_contact,emergency_contact_phone,ctime,email,id_front_img,id_back_img,id_hold_img) values('".rand(100000000,999999999)."','".$key."','".$referral_code."','".$realname."','".$sex."','".$phone."','".$idtype."','".$idcard."','".$bank."','".$bank_card."','".$address."','".$emergency_contact."','".$emergency_contact_phone."','".time()."','".$email."','".$id_front_img."','".$id_back_img."','".$id_hold_img."')";
				$res = $restModel->querysql($sql);
				$user_id = $restModel->query("select last_insert_id()");//获取当前的记录id

				$tlist = $user_id[0]["last_insert_id()"].",";

				$restModel->querysql("update `jjs_user` set tlist = '".$tlist."' where id = ".$tuser_id[0]["id"]);//更新推广用户的推广关系树
				if($res){
					$restModel->querysql("insert into `jjs_user_finance` (id,user_id,ctime) values('".rand(100000000,999999999)."','".$user_id[0]["last_insert_id()"]."','".time()."')");
					returnJson('200',"开户申请已提交,请等待工作人员验证");
				}else{
					returnJson('500','开户申请提交失败');
				}
			}
			else
			{
				returnJson('500','邮箱验证码错误');
			}
		}
		else
		{
			returnJson('500','手机验证码错误');
		}
	}

	public function forget()
	{
		$phone = getgpc("phone");
		$smscode = getgpc("smscode");
		$password = md5(getgpc("password"));
		$repassword = md5(getgpc("repassword"));
		if(!empty($_SESSION['smscode'])&& $_SESSION['smscode']==$smscode && $_SESSION['smsphone'] == $phone)
		{
			if($repassword == $password){
				$res = D("Rest")->querysql("update `ewb_user` set password = '".$password."' where phone = '".$phone."'");
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
