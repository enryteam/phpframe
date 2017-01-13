<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('BmsAction');
class index extends BmsAction
{
	public function __construct()
	{
		$Model=D('Bms');
		$admin = $Model->query('select name,logincount,gid from `jjs_members` where id = '.$_SESSION['ADMIN_UID']);
		$logininfo = array("adminname"=>$admin[0]["name"],"logincount"=>$admin[0]["logincount"],"adminip"=>$_SESSION['ADMIN_UserIP'],"logintime"=>$_SESSION['ADMIN_UserTime']);
		$this->assign("admin",$logininfo);
		$user_quanxian = $Model->query('select * from `jjs_auth_group` where id = '.$admin[0]['gid']);
		$_SESSION['user_quanxian'] = explode(',', $user_quanxian[0]['rules']);
		parent::__construct();
	}

	//验证码
	public function checkcode()
	{
		$srcstr = "1a2s3d4f5g6hj8k9qwertyupzxcvbnm";
		mt_srand();
		$code = "";
		for ($i = 0; $i < 4; $i++) {
			$code .= $srcstr[mt_rand(0, 30)];
		} 
		//验证码图片的宽度
		$width  = 50; 
		//验证码图片的高度
		$height = 25;  
		//声明需要创建的图层的图片格式
		@ header("Content-Type:image/png");
		//创建一个图层
		$im = imagecreate($width, $height);
		//背景色
		$back = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
		//模糊点颜色
		$pix  = imagecolorallocate($im, 92, 189, 170);
		//字体色
		$font = imagecolorallocate($im, 22, 160, 133);
		//绘模糊作用的点
		mt_srand();
		for ($i = 0; $i < 1000; $i++) {
			imagesetpixel($im, mt_rand(0, $width), mt_rand(0, $height), $pix);
		}
		//输出字符
		imagestring($im, 5, 7, 5, $code, $font);
		//输出矩形
		imagerectangle($im, 0, 0, $width -1, $height -1, $font);
		//输出图片
		imagepng($im);
		imagedestroy($im);
		//选择 Session
		$_SESSION["checkcode"] = md5($code);	
	}
	
	//登录
	public function login()
	{
			
		//登录处理
		if(isPost())
		{
			//登陆检测	
			if(empty(getgpc('name'))) {
				bmsAlert('请输入账号！',pfUrl('Bms','index','login'));
			}elseif(empty(getgpc('pwd'))){
				bmsAlert('请输入密码！',pfUrl('Bms','index','login'));
			}

			//查询管理员
			$Model=D('Bms');
			$member = $Model->query('select * from `jjs_members` where name = "'.getgpc("name").'"');
			
			//检测管理员是否存在  member_type:用户类型  1：普通用户  2:系统管理员
			if(empty($member) or $member[0]['member_type'] != 2)
			{
				bmsAlert('对不起，该管理员不存在！',pfUrl('Bms','index','login'));
			}else{

				//管理员密码验证
				if($member[0]['pwd'] != md5(trim(getgpc('pwd'))))
				{
					bmsAlert('对不起，管理员密码验证失败！',pfUrl('Bms','index','login'));
				}

				
				//检测组是否正常
				$groupStatus = $Model->query('select * from `jjs_auth_group` where id = '.$member[0]['gid']);
				if($groupStatus[0]['status'] != 1)
				{
					//管理员组已被禁止
					bmsAlert('对不起，您的账号所在管理员组已被禁止！',pfUrl('Bms','index','login'));
				}
				
				//检测管理员是否正常
				if($member[0]['status'] != 1)
				{
					//管理员账号已被禁止
					bmsAlert('对不起，您的账号已被禁止！',pfUrl('Bms','index','login'));
				}
				
				//登陆次数累加
				$Model->querysql('update `jjs_members` set logincount = logincount+1 where id = '.$member[0]['id']);

				//登陆成功
				$_SESSION['ADMIN_UID'] = $member[0]['id'];
				$_SESSION['ADMIN_UserName'] = $member[0]['name'];
				$_SESSION['ADMIN_UserIP'] = $_SERVER["REMOTE_ADDR"];
				$_SESSION['ADMIN_UserTime'] = date("Y-m-d H:i:s");

				//登录记录
				$Model->querysql("insert into `jjs_login_log`(admin_id,admin_name,loginip,logintime) values('".$member[0]['id']."','".$member[0]['name']."','".$_SERVER["REMOTE_ADDR"]."','".time()."')");

				//页面跳转
				bmsAlert('恭喜您，登陆成功！',pfUrl('Bms','index','index'));
			}
		
		}
		//显示登陆模板
		$this->display();
	}

	//退出
	public function logout()
	{
		unset($_SESSION['ADMIN_UID']);
		unset($_SESSION['ADMIN_UserName']);
		bmsAlert("退出成功",pfUrl("bms","index","login")); 
		
	}
	
	//首页
	public function index()
	{
		$Model=D('Bms');
		//入金总额、出金总额
		$account = $Model->query('select sum(recharge) as recharge,sum(withdraw) as withdraw from `jjs_user_finance`');

		//总成交量
		$dealnum = $Model->query("select sum(quantity) as dealnum from `jjs_contract` where status >0");

		//总发售量
		$releasenum = $Model->query("select count(1) as count from `jjs_goods_release` where release_status = 1");

		//用户总量
		$usernum = $Model->query("select count(1) as count from `jjs_user` where is_check = 1");

		//挂牌总量
		$entrymarket = $Model->query("select count(1) as count from `jjs_entry_market` where status = 1");

		//商铺总量
		$mallnum = $Model->query("select count(1) as count from `jjs_store` where status = 1");

		//订单总量
		$ordernum = $Model->query("select count(1) as count from `jjs_order` where status > 0");
		
		//登录日志
		$log = $Model->query("select * from `jjs_login_log` order by logintime desc limit 9");

		$datas = array("recharge"=>$account[0]["recharge"],"withdraw"=>$account[0]["withdraw"],"dealnum"=>$dealnum[0]["dealnum"],"releasenum"=>$releasenum[0]["count"],"usernum"=>$usernum[0]["count"],"entrymarket"=>$entrymarket[0]["count"],"mallnum"=>$mallnum[0]["count"],"ordernum"=>$ordernum[0]["count"]);

		$this->assign("datas",$datas);
		$this->assign("log",$log);
		$this->display();
	}
}
