<?php
defined('IN_PHPFRAME') or exit('No permission resources.');

pc_base::load_app_class('RestAction');

class extend extends RestAction
{
	public function __construct()
	{
		
		parent::__construct();
	}
	//推广首页
	public function index()
	{
		$restModel=D('Rest');


		$result = $restModel->query("select sum(amount) as total from `jjs_rdetail` where user_id = ".$_SESSION["user_id"]." and cate in(4,5,6)");
		$res = $restModel->query("select * from `jjs_coupon` where is_val=0 and user_id = ".$_SESSION["user_id"]);

		returnJson('200','推广总收益',array("extend"=>$result[0]['total']==NULL?0:$result[0]['total'],"coupon"=>count($res)));
	}
	//推广收益
 public function extdetai()
 {
	 ///
 }
	//我要推广
	public function extend()
	{
		 $restModel=D('Rest');
		 $res = $restModel->query("select * from `jjs_user` where id = ".$_SESSION["user_id"]);
		 $uid = $res[0]["uid"];
		 $invite_links = $res[0]["invite_links"];
		 $head_img = $res[0]["head_img"];
		 if($res){

		    if(empty($head_img)){
				$barcode = urlencode('http://jjs.51daniu.cn/mweb/login.html?uid_code='.$res[0]["uid"]);//二维码使用场景mweb非portal非mapp  by enry 0626
				$ret = json_decode(file_get_contents('http://apistore.51daniu.cn/service/qrcode/create.php?keyword='.$barcode),true);//二维码
				$head_img = $ret["data"];
		    }
		 	returnJson("200","",array("uid"=>$uid,
									  "invite_links"=>$invite_links,
									  "head_img"=>$head_img
										));
		 }
		 else
		 {
		 	returnJson("500","");
		 }



	}

	//我要推广页面的推广按钮
	public function push()
	{
		$restModel=D('Rest');
		$res = $restModel->query("select * from `jjs_user_finance` where user_id = ".$_SESSION["user_id"]);

		if($res){
			returnJson("200","发送成功");
		}
		else
		{
			returnJson("500","发送失败");
		}
	}

	//我推荐的人
	public function extend_person()
	{
		 $restModel=D('Rest');
		 $res = $restModel->query("select id,image,account from `jjs_user` where tuser_id = ".$_SESSION["user_id"]);
		 foreach($res as $key=>$vo){
		 	$result = $restModel->query("select * from `jjs_rdetail` where tuser_id = ".$vo['id']." and user_id = ".$_SESSION["user_id"]." and cate in(4,5,6)");
			if($result){
				foreach($result as $k=>$v){
					$amount += $v['amount'];
				}
				$res[$key]['amount'] = $amount;
				$amount = 0;
			}else{
				$res[$key]['amount'] = 0;
			}

		 }
		 if($res){
		 	returnJson("200","",$res);
		 }
		 else
		 {
		 	returnJson("500","暂无推荐的人");
		 }
	}

	//我推广的商品
	public function extend_goods()
	{
		 $restModel=D('Rest');
		 $res = $restModel->query("select G.* from `jjs_share` S, `jjs_goods` G where S.user_id = ".$_SESSION["user_id"]." and S.goods_id<>'' and S.goods_id = G.id");
		 if($res){
		 	returnJson("200","",$res);
		 }
		 else
		 {
		 	returnJson("500","");
		 }



	}

	//我推广的任务
	public function extend_task()
	{
		 $restModel=D('Rest');
		  $res = $restModel->query("select T.* from `jjs_share` S, `jjs_task` T where S.user_id = ".$_SESSION["user_id"]." and S.goods_id<>'' and S.goods_id = T.id");

		 if($res){
		 	returnJson("200","",$res);
		 }
		 else
		 {
		 	returnJson("500","");
		 }



	}



}
