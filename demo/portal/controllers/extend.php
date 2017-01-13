<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('PortalAction');
class extend extends PortalAction
{
	private $pageSize = 8;
	public function __construct()
	{
		//购物车商品总数
		$shopcar = D("Portal")->query("select sum(num) as sum from jjs_shopcar where user_id = ".$_SESSION["user_id"]);

		//用户资料
		$userdata  = D("Portal")->query("select id,image,nickname,phone,email,bank_card,bank_name,mills_id,bank,realname,level_id,count from jjs_user where id=".$_SESSION['user_id']);
		$this->assign("topcate",$topcate);
		$this->assign("mills_id",$userdata[0]["mills_id"]);
		$this->assign("shopcar",$shopcar[0]["sum"]);
		$this->assign("id",$userdata[0]["id"]);
		$this->assign("image",$userdata[0]["image"]);
		$this->assign("nickname",$userdata[0]["nickname"]);
		$this->assign("phone",$userdata[0]["phone"]);
		$this->assign("realname",$userdata[0]["realname"]);
		parent::__construct();
	}
	//默认
	public function index()
	{
		if(empty($_SESSION["user_id"]))
		{
		header("Location:/acenter/index.php?c=index&a=login");exit;
		}
		$res = D("Portal")->query("select * from `jjs_user` where id = ".$_SESSION["user_id"]);
		$this->assign('realname', $res[0]['realname']);
		$uid = $res[0]["uid"];
		$invite_links = $res[0]["invite_links"];
		$head_img = $res[0]["head_img"];
//邀请二维码
		$barcode = urlencode('http://jjs.51daniu.cn/mweb/register.html?uid_code='.$res[0]["uid"]);//二维码使用场景mweb非portal非mapp  by enry 0626
		$ret = json_decode(file_get_contents('http://apistore.51daniu.cn/service/qrcode/create.php?keyword='.$barcode),true);//二维码
		$res[0]['head_img'] = $ret["data"];
		D("Portal")->querySql('update jjs_user set head_img = "'.$ret["data"].'" where id = '.$_SESSION["user_id"]);
			
		
//推广总人数
		$re = D("Portal")->query("select count(1) as num from `jjs_user` where tuser_id = ".$_SESSION["user_id"]);
		$res[0]['tuser_num']=$re[0]['num'];
//推广收益,金币
		$result = D("Portal")->query("select sum(amount) as total from `jjs_rdetail` where user_id = ".$_SESSION["user_id"]." and cate in(4,5,6)");
		$res[0]['extend']=$result[0]['total']==NULL?0:$result[0]['total'];
//推广收益,卷
		$re = D("Portal")->query("select sum(amount) as amount  from `jjs_coupon` where user_id = ".$_SESSION["user_id"]);
		$res[0]['amount']=$re[0]['amount']/100;
//推广链接
		$duan_url=urlencode('http://jjs.51daniu.cn/acenter/index.php?c=index&a=register&uid='.$res[0]['uid']);
		$ret =json_decode(file_get_contents('http://apistore.51daniu.cn/rest/index.php?c=qrcode&a=url2dwz&url='.$duan_url),true);
		$res[0]['invite_links']=$ret["data"];
		$this->assign('mydata', $res[0]);
//推广收益金币排行榜
		$jinbi = D("Portal")->query('select a.total,b.phone,b.image from (select sum(amount) as total,user_id from `jjs_rdetail` where cate in(4,5,6) group by user_id) as a left join jjs_user as b on a.user_id =b.id order by a.total desc limit 0,10');
		foreach ($jinbi as $key => $vo) {
			if(!$vo['image']){
				$jinbi[$key]['image']='http://cdn.51daniu.cn//upfile//2016//06//17//13//img_1466142213.jpeg';
			}
			$jinbi[$key]['phone']=substr_replace($vo['phone'],"****",3,4);
		}
//推广收益现金券排行榜
		$quan=D("Portal")->query('select a.amount,b.phone,b.image from (select sum(amount) as amount,user_id  from `jjs_coupon` group by user_id) as a left join jjs_user as b on a.user_id =b.id order by a.amount desc limit 0,10');
		foreach ($quan as $key => $vo) {
			if(!$vo['image']){
				$quan[$key]['image']='http://cdn.51daniu.cn//upfile//2016//06//17//13//img_1466142213.jpeg';
			}
			$quan[$key]['phone']=substr_replace($vo['phone'],"****",3,4);
		}
		$this->assign('paihang',array('jinbi'=>$jinbi,'quan'=>$quan));
		$this->display();
	}


}
