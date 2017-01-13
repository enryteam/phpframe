<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_sys_class('BaseAction');

class entry_market extends BaseAction
{
	public function __construct()
	{
		
		parent::__construct();

	}

	public function index()
	{
		returnJson('200');
	}

	//挂牌申请
	public function entry_apply()
	{
		$restModel = D("Rest");
		$company = getgpc("company");
		$postal_address = getgpc("postal_address");
		$fixed_telephone = getgpc("fixed_telephone");
		$fax = getgpc("fax");
		$qq = getgpc("qq");
		$postcode = getgpc("postcode");
		$mobile_phone = getgpc("mobile_phone");
		$email = getgpc("email");
		$applicant_type = getgpc("applicant_type");
		$business_licence = getgpc("business_licence");
		$tax_registration = getgpc("tax_registration");
		$organization_code = getgpc("organization_code");
		$account_license_img = getgpc("account_license_img");
		$business_licence_img = getgpc("business_licence_img");
		$tax_registration_img = getgpc("tax_registration_img");
		$organization_code_img = getgpc("organization_code_img");
		$three_img = getgpc("three_img");
		$code = '';
		for($i=1;$i<=4;$i++){
			$code .= chr(rand(65,90));
		}
	
		$res = $restModel->query("select * from `jjs_entry_market` where user_id = ".$_SESSION["user_id"]);
		if($res)
		{
			returnJson("500","申请已提交，正在审核中");
		}
		else{
			$result = $restModel->querySql("insert into `jjs_entry_market` (user_id,company,code,postal_address,fixed_telephone,fax,postcode,mobile_phone,email,applicant_type,business_licence,tax_registration,organization_code,account_license_img,business_licence_img,tax_registration_img,organization_code_img,three_img,qq,ctime)values ('".$_SESSION["user_id"]."', '".$company."', '".$code."', '".$postal_address."', '".$fixed_telephone."', '".$fax."', '".$postcode."', '".$mobile_phone."', '".$email."', '".$applicant_type."', '".$business_licence."', '".$tax_registration."', '".$organization_code."','".$account_license_img."','".$business_licence_img."','".$tax_registration_img."','".$organization_code_img."','".$three_img."','".$qq."','".time()."')");
			if($result)
			{
				returnJson("200","申请提交成功");
			}
			else
			{
				returnJson("500","申请提交失败");
			}
		}
	}

	

}
