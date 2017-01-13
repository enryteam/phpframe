<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>确认订单 积交所 jjs.51daniu.cn</title>
<link href="../attms/css/user_basic.css" rel="stylesheet" media="screen, projection">
<link rel="stylesheet" href="../attms/css/user_styles.css">
<link rel="stylesheet" href="../attms/css/acenter.css">
<link rel="stylesheet" href="../attms/css/portal.css">
<link rel="stylesheet" href="../attms/css/xcConfirm_web.css">
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

	<div class="baogou_confirm">
		<h1><a href="../acenter/index.php?c=user&a=personal"><img src="../attms/images/confirm_add.png" alt="" />新增收货地址</a></h1>
		<ul>
		<?php if(!empty($address)){foreach($address as $k=>$v){?>
			<li><i>寄送至</i><input type="radio" name="address" value="<?php echo $v['id'];?>" <?php if($v["is_default"]==1) echo "checked";?>><?php echo $v["realname"];?><em></em><?php echo $v["phone"];?><em></em><?php echo $v["address"];?><em></em><?php echo $v["postcode"]?>  <a href="javascript:;" onClick="del_address(<?php echo $v['id'];?>)">删除</a></li>
		<?php }}else{?>
			暂无记录
		<?php }?>
		</ul>
		<div>
			<h1><i></i>确认订单信息</h1>
			<div>
				<h1><i>商品名称</i><i>单价(通用积分)</i><i>数量</i><i>实付款(通用积分)</i></h1>
				<ul>
				<?php if(!empty($allgoods)){foreach($allgoods as $k=>$v){?>
					<li>
						<i>
							<img src="<?php echo $v['img'];?>" alt="" />
							<div class="left">
								<h1><?php echo mb_substr($v["title"],0,25,'utf-8');?></h1>
							</div>
							<h6 style="clear:both;"></h6>
						</i>
						<b><?php echo $v["price"];?></b>
						<b><?php echo $v['num'];?></b>
						<b><?php echo $v["total"];?></b>
						<h6 style="clear:both;"></h6>
					</li>
				<?php }}else{?>
					暂无记录
				<?php }?>
				</ul>
				<h2>给卖家留言：<input type="text" placeholder="选填：可填写说明建议等" value="" id="demand">运送方式：<b>普通配送快递</b>免邮</h2>
				<h3><b>实付款：<i id="total_price"><?php echo $sum;?></i>通用积分</b></h3>
				<h4><i onClick="return_shopcar()">返回购物车</i><a href="javascript:;" onclick="javascript:$('.baogou_confirm').hide();$('.baogou_pay').show();confirm_order()">提交订单</a></h4>
			</div>
		</div>
	</div>

	<!-- 支付页面 -->
	<div class="baogou_pay">
		<h1></h1>
		<h2><i id="jessietotal">23089</i>通用积分</h2>
		<h3><a href="javascript:;" onclick="javascript:$('.shay_confirm_pay').show();pay()">支付</a></h3>
	</div>
	<!-- 支付弹窗 -->
	<div class="shay_confirm_pay">
		<div class="layer"></div>
		<div class="box">
			<h1>订单支付 <a href="javascript:;" onclick="javascript:$('.shay_confirm_pay').hide();"><img src="../attms/images/cclose.jpg" alt="" /></a></h1>
			<h2><i>订单金额：</i><input type="text" name="name" value="" id="jessieamount" readonly></h2>
			<h2><i>支付密码：</i><input type="password" name="name" value="" placeholder="请输入支付密码" id="jessiepassword"></h2>
			<!--<h2><i>项目三：</i><input type="text" name="name" value="" placeholder="请输入项目三内容"></h2>-->
			<h3><a href="javascript:;" class="a1" onClick="javascript:$('.shay_confirm_pay').hide();payorder()">提交</a><a href="javascript:;" class="a2" onClick="javascript:$('.shay_confirm_pay').hide();">取消</a></h3>
		</div>
	</div>

	<!-- 尾部 -->
	<?php include("tpl/public/bottom.php");?>
	<!-- 尾部结束 -->
	<script type="text/javascript">
		//获取浏览器地址
		var attr = window.location.href;
		var add1 = decodeURI(attr.split('a=')[1]);
		if(add1.indexOf("&")!=-1){
			add1 = add1.split('&')[0];
		}
		if(add1 == "confirm")
		{
			$("#mall").addClass('active');
		}

		//删除收货地址
		function del_address(id)
		{
			$.post(RestApi, { c: 'buy',a: 'del_address',id:id}, function(response) {
				console.log(response);
				var responseObj=$.parseJSON(response);
				if(responseObj.code == 500){
					alert(responseObj.message);
				}else{
					window.location.href="<?php echo pfurl('','shopcar','confirm')?>";
				}
			});
		}

		//返回购物车
		function return_shopcar()
		{
			window.location.href="<?php echo pfurl('','shopcar','index')?>";
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

		//提交订单
		function confirm_order(){
			var demand = $("#demand").val();
			var addressid = $("input[name='address']:checked").val();
			var total_price = $('#total_price').html();
			localStorage.setItem("total_price", total_price);
			$.post(RestApi, { c: 'buy',a: 'commit_order',addressid:addressid,amount:total_price,demand:demand}, function(response) {
				console.log(response);
				var responseObj=$.parseJSON(response);
				if(responseObj.code == 500){
					window.wxc.xcConfirm(responseObj.message);
				}else{
					localStorage.setItem("orderids", responseObj.data);
					$("#jessietotal").html(total_price);
					$('.baogou_pay').show();
				}
			});
		}
		function pay(){
			$(".shay_confirm_pay").show();
			$("#jessieamount").val(localStorage.getItem("total_price")+"通用积分");
		}

		//支付
		function payorder()
		{
			var tpassword = $("#jessiepassword").val();
			$.post(RestApi, { c: 'buy',a: 'checkorder',orderids:localStorage.getItem("orderids"),tpassword:tpassword}, function(response){
				console.log(response);
				var responseObj=$.parseJSON(response);
				if(responseObj.code==200)
				{
					window.location.href="../portal/index.php?c=mall&a=index";

				}else{
					window.wxc.xcConfirm(responseObj.message);
				}
				
			});
		}

	</script>
</body>
</html>
