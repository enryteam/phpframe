<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_sys_class('BaseAction');

class goods extends BaseAction
{
	public function __construct()
	{
		parent::__construct();

	}

	public function index()
	{
		returnJson('200');
	}

	//商品添加
	public function add_goods()
	{
		if(empty($_SESSION["user_id"])){
			returnJson("403","请先登录");
		}
		$title = getgpc("title");
		$intro=  getgpc('intro');
		$stock=  getgpc('stock');
		$cid=  getgpc('cid');
		$price=  getgpc('price');
		$img=  getgpc('img');
		$details=  getgpc('detail');
		$goods_status=  getgpc('goods_status');
		
		$res = D("Rest")->querySql("insert into `jjs_goods`(user_id,cid,title,intro,img,stock,price,details,thumb,goods_status,ctime) values ('".$_SESSION["user_id"]."','".$cid."', '".$title."', '".$intro."', '".$img."', '".$stock."', '".$price."', '".$details."', '".$img."', '".$goods_status."', '".time()."')");
		if($res){
			returnJson("200","添加成功,等待后台审核");
		}
		else
		{
			returnJson("500","添加失败");
		}
	}

	//入场登记
	public function release()
	{
		$title = getgpc("title");
		$price = getgpc("price");
		$up = $price*(1+0.3);
		$down = $price*(1-0.3);
		$num = getgpc("num");
		$holdnum = getgpc("holdnum");
		$natural_name = getgpc("natural_name");
		$natural_idcard = getgpc("natural_idcard");
		$natural_account = getgpc("natural_account");
		$natural_phone = getgpc("natural_phone");
		$natural_email = getgpc("natural_email");
		$code = '';
		for($i=1;$i<=4;$i++){
			$code .= chr(rand(65,90));
		}
		$account = $code.rand(100000,999999);

		$res = D("Rest")->query("select * from `jjs_goods_release` where user_id = ".$_SESSION["user_id"]." and title = '".$title."' and release_status in (0,1)");
		if($res)
		{
			returnJson("500","商品品类正在审核中或发售中");
		}
		else
		{
			$result = D("Rest")->querySql("insert into `jjs_goods_release` (user_id,code,title,price,up,down,holdnum,num,natural_name,natural_idcard,natural_phone,natural_email,ctime) values ('".$_SESSION["user_id"]."', '".$account."', '".$title."', '".$price."', '".$up."', '".$down."', '".$holdnum."', '".$num."', '".$natural_name."','".$natural_idcard."','".$natural_phone."','".$natural_email."','".time()."')");
			$rs_pt = D("Rest")->query("select last_insert_id()");//获取当前的记录id
			if($result)
			{
				file_put_contents("CAS.txt",'http://apistore.51daniu.cn/rest/index.php?c=mxroom&a=make&pc=jjs&tradeid='.$rs_pt[0]["last_insert_id()"]);
				$ret = json_decode(file_get_contents('http://apistore.51daniu.cn/rest/index.php?c=mxroom&a=make&pc=jjs&tradeid='.$rs_pt[0]["last_insert_id()"]),true);
				returnJson("200","提交成功");
			}
			else
			{
				returnJson("500","提交失败");
			}
		}
	}

	//取消入场登记
	public function del_release()
	{
		$goods_id = getgpc("goods_id");
		if($goods_id){
			$r1 = D("Rest")->querysql("delete `jjs_goods_release` where id = ".$goods_id);
		}
		if($r1)
		{
			returnJson("200","取消成功");
		}
		else
		{
			returnJson("500","取消失败");
		}

	}

	//删除商品
	public function del_goods()
	{
		$goods_id = getgpc("goods_id");
		$res = D("Rest")->querysql("delete from `jjs_goods` where id = ".$goods_id);
		if($res)
		{
			returnJson("200","删除成功");
		}
		else
		{
			returnJson("500","删除失败");
		}

	}

	//编辑商品
	public function edit_goods()
	{
		$goods_id = getgpc("goods_id");
		$title = getgpc("title");
		$intro=  getgpc('intro');
		$stock=  getgpc('stock');
		$cid=  getgpc('cid');
		$price=  getgpc('price');
		$img=  getgpc('img');
		$detail=  getgpc('detail');
		$goods_status=  getgpc('goods_status');
		
		$res = D("Rest")->querysql("update `jjs_goods` set title = '".$title."',intro = '".$intro."',stock = '".$stock."',cid = '".$cid."',price = '".$price."', img = '".$img."',details = '".$detail."',goods_status = '".$goods_status."' where id = ".$goods_id);
		if($res){
			returnJson("200","编辑成功");
		}
		else
		{
			returnJson("500","编辑失败");
		}
	}

	public function test()
	{
		$d = D("Rest")->query("select * from jjs_goods_release ");
		foreach($d as $k=>$v){
			
			file_put_contents("CAS.txt",'http://apistore.51daniu.cn/rest/index.php?c=mxroom&a=make&pc=jjs&tradeid='.$v["id"]);
			$ret = json_decode(file_get_contents('http://apistore.51daniu.cn/rest/index.php?c=mxroom&a=make&pc=jjs&tradeid='.$v["id"]),true);
			
		}
		returnJson("200","");
	}

	
}
