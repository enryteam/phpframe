<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>商城 积交所 jjs.51daniu.cn</title>
<link href="../attms/css/user_basic.css" rel="stylesheet" media="screen, projection">
<link rel="stylesheet" href="../attms/css/xcConfirm_web.css">
<link rel="stylesheet" href="../attms/css/user_styles.css">
<link rel="stylesheet" href="../attms/css/acenter.css">
<link rel="stylesheet" href="../attms/css/portal.css">
<script src="../attms/js/jquery-1.11.3.js"></script>
<script src="../attms/js/common.js"></script>
<script src="../attms/js/init.js"></script>
<script type="text/javascript" src="../attms/highstock/highstock.js"></script>
<script type="text/javascript" src="../attms/highstock/modules/exporting.js"></script>
<script src="../attms/js/xcConfirm_web.js"></script>
</head>
<body>
	<!-- 头部 -->
	<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->

	<!-- 筛选区 -->
	<div class="baogou_choose">
		<div class="top">
			<a href="index.php?c=mall&a=index&orderby=默认#anchor" class="active" name="anchor" id="anchor">默认</a>
			<a href="index.php?c=mall&a=index&orderby=销量#anchor" id="sold">销量</a>
			<a href="index.php?c=mall&a=index&orderby=最新#anchor" id="new">最新</a>
			<a href="index.php?c=mall&a=index&orderby=价格#anchor" id="price">价格</a>
			<i onclick="javascript:window.location.href='../acenter/index.php?c=user&a=myorder'">我的订单&nbsp;&gt;</i>
		</div>
		<div class="bottom">
		<?php if(!empty($allgoods)){foreach($allgoods as $k=>$v){?>
			<div>
				<?php if(empty($v["img"])){?><img src="../attms/images/dianpu.png" alt="" onClick="javascript:window.location.href='index.php?c=mall&a=detail&goods_id=<?php echo $v['id'];?>'"/><?php }else{?><img src="<?php echo $v["img"];?>" alt="" onClick="javascript:window.location.href='index.php?c=mall&a=detail&goods_id=<?php echo $v['id'];?>'"/><?php }?>
				<h1><img src="../attms/images/dianpu.png" alt="" /><?php echo $v["store_name"];?> <i>销量(<?php echo $v["sold"];?>)</i></h1>
				<h2 onClick="javascript:window.location.href='index.php?c=mall&a=detail&goods_id=<?php echo $v['id'];?>'"><?php echo $v["title"];?></h2>
				<h4><?php echo $v["price"];?> <i>通用积分</i><a href="javascript:;" onClick="buynow(<?php echo $v['id'];?>)">立即购买</a></h4>
			</div>
        <?php }}else{?>
		暂无记录
		<?php }?>
        <h6 style="clear:both;"></h6>
		</div>
		<div class="fenye" style="margin-top:20px;">
			<?php if($count>8){?>
				<?php echo $pages;?>
			<?php }?>
		</div>
	</div>

	<!-- 尾部 -->
	<?php include("tpl/public/bottom.php");?>
	<!-- 尾部结束 -->
<script type="text/javascript">
	//获取浏览器地址
	var attr2 = window.location.href;
	var add2 = decodeURI(attr2.split('c=')[1]);
	if(add2.indexOf("&")!=-1){
		add2 = add2.split('&')[0];
	}
	if(add2 == 'mall'){
		$("#mall").addClass('active');
	}

	//获取浏览器地址
	var attr = window.location.href;
	var add = decodeURI(attr.split('orderby=')[1]);
	if(add.indexOf("&")!=-1){
		add = add.split('&')[0];
	}
	if(add.split('#')[0] == '默认'){
		$("#anchor").addClass('active');
	}else if(add.split('#')[0] == "销量"){
		$("#anchor").removeClass('active');
		$("#sold").addClass('active');
	}else if(add.split('#')[0] == "最新"){
		$("#anchor").removeClass('active');
		$("#new").addClass('active');
	}else if(add.split('#')[0] == "价格"){
		$("#anchor").removeClass('active');
		$("#price").addClass('active');
	}

	//立即购买
	function buynow(goods_id)
	{
		$.post(RestApi, { c: 'login',a: 'login_status'}, function(response){
			console.log(response);
			var responseObj=$.parseJSON(response);
			if(responseObj.code == 200){
				window.location.href = "index.php?c=temp_shopcar&a=confirm&goods_id="+goods_id;
			}else{
				window.wxc.xcConfirm(responseObj.message,'../acenter/index.php?c=index&a=login')
			}
		});
	}

	//商品详情跳转
	function detail(goods_id)
	{
		localStorage.setItem("goods_id", goods_id);
		window.location.href="index.php?c=mall&a=detail&goods_id="+goods_id;
	}

	//购物车跳转
	function shopcar(realname)
	{
		if(realname == '' || realname == "undefined"){
			window.location.href="../acenter/index.php?c=index&a=login";
		}else{
			window.location.href="<?php echo pfurl('','shopcar','index')?>";
		}
	}
</script>
</body>
</html>
