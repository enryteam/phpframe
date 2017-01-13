<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>商品详情 积交所 jjs.51daniu.cn</title>
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
<!-- 加入购物车 -->
<script src="../attms/js/fly.js"></script>
<style>
	.Kcon>p>img{
		width:1100px;
	}
</style>
</head>
<body>
	<!-- 头部 -->
	<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->

	<div class="baogou_del">
		<div class="top">
			<div class="left">
				<div class="top">
					<img src="<?php echo $detail["img"];?>" id="fly_img" />
				</div>
			</div>
			<div class="right">
				<h1><?php echo mb_substr(strip_tags($detail["title"]),0,16,'utf-8');?> <i></i></h1>
				<h2><?php echo $detail["intro"];?> </h2>
				<a href="javascript:;" class="share" onclick="javascript:$('.ic-share').show();"><img src="../attms/images/share.png" alt="" /><i>分享</i></a>
				<div class="ic-share" onmouseleave="javascript:$('.ic-share').hide();"> <b id="ut144"></b> <a href="http://service.weibo.com/share/share.php?&title=aaaaaa" target="_blank" id="share_weibo"><em>新浪微博</em></a> <a href="http://share.v.t.qq.com/index.php?c=share&a=index&title=aaaaaa" target="_blank" id="share_tx"><em>腾讯微博</em></a> <a href="http://connect.qq.com/widget/shareqq/index.html?url=http://ewb.51daniu.cn/portal/index.php?c=dig&a=index&title=aaaaaa" target="_blank" id="share_qq"><em>QQ</em></a> <a href="javascript:;" id="share_weixin" onclick="javascript:$('#wechat_saoma').show();generateQRCode('#share_wechat');$('.ic-share').hide();"><em>微信</em></a> </div>
				<div id="wechat_saoma" style="box-shadow: 0 0 11px rgba(0, 0, 0, 0.22);background-color:#ffffff;position:fixed;border-radius: 3px;display: none;left: 50%;margin-left: -180px;margin-top: -145px;top: 50%;width: 360px;z-index: 9999;">
					<h3 style="border-bottom: 1px solid #ddd;height: 40px;line-height: 40px;position: relative;text-indent: 10px;">分享到微信朋友圈<i style="background: rgba(0, 0, 0, 0) url('../attms/images/dialog_close.4a0d334d.png') no-repeat scroll 0 0;cursor: pointer;display: block;height: 22px;position: absolute;right: 10px;top: 10px;width: 22px;" onclick="javascript:$('#wechat_saoma').hide();"></i></h3>
					<p style="padding: 10px;text-align: center;">
						<img src="" style="height: 180px;width: 180px;" id="share_wechat">
					</p>
					<span style="color: #666;display: block;line-height: 20px;padding: 0 10px 10px;">打开微信，点击底部的“发现”，使用 “扫一扫” 即可将网页分享到我的朋友圈。</span>
				</div>
				<script type="text/javascript">
					function generateQRCode(selector){
						var url = "http://qr.liantu.com/api.php?";
						url += "&text="+encodeURI(location.href);//背景颜色,bg=颜色代码，例如：bg=ffffff
						url += "&bg=fcfcfc";//背景颜色,bg=颜色代码，例如：bg=ffffff
						url += "&fg=000000";//前景颜色,fg=颜色代码，例如：fg=cc0000
						url += "&gc=000000";//渐变颜色,gc=颜色代码，例如：gc=cc00000
						url += "&el=Q";//纠错等级,el可用值：h\q\m\l，例如：el=h
						url += "&w=300";//尺寸大小,w=数值（像素），例如：w=300
						url += "&m=30";//静区（外边距）,m=数值（像素），例如：m=30
						url += "&pt=000000";//定位点颜色（外框）,pt=颜色代码，例如：pt=00ff00
						url += "&inpt=000000";//定位点颜色（内点）,inpt=颜色代码，例如：inpt=000000
						url += "&logo=http://www.91liren.com/images/91liren_logo.png";//logo图片,logo=图片地址，例如：http://www.liantu.com/images/2013/sample.jpg
						$(selector).attr("src",url);
					}
				</script>

				<div class="title">商品价<strong><?php echo $detail["price"];?></strong> (通用积分)</div>
				<div class="buy">
					<div class="left">
						<h2>数量：<a href="javascript:;" id="down">-</a><input type="text" value="1" id="num"><a href="javascript:;" id="up">+</a> <b><?php echo $detail["stock"];?></b>件库存</h2>
						<h3><a class="a1" href="javascript:;" onclick="javascript:buynow(<?php echo $detail["id"];?>);">立即购买</a><a class="a2" href="javascript:;" onclick="javascript:shay_fly(<?php echo $detail["id"]?>);">加入购物车</a></h3>
						<h4>
							<span><img src="../attms/images/shop_del1.png" alt="" />买的放心，交易无忧</span>
							<span><img src="../attms/images/shop_del2.png" alt="" />客服MM电话：400-902-2519</span>
						</h4>
					</div>
					<div class="right">
						<h1><img src="../attms/images/dianpu2.png" alt="" /><?php echo mb_substr(strip_tags($detail["store_name"]),0,8,'utf-8');?></h1>
						<h2>掌柜：<?php echo $detail["realname"];?></h2>
						<h2>认证：<i>商家已认证</i></h2>
						<div>
							<img src="../attms/images/shop_del_erwei.png" class="img1" onmouseover="javascript:$('.img2-1').fadeIn(1000);" onmouseout="javascript:$('.img2-1').fadeOut(1000);"/>
							<div>
								<h1>扫码联系卖家</h1>
								<h2>(手机QQ扫码)</h2>
							</div>
							<span style="clear:both;"></span>
							<img src="../attms/images/erweima1.png" class="img2-1" />
						</div>
						<a href="tencent://message/?uin=<?php echo $detail["qq"];?>&Site=ewabao.com&Menu=yes"><img src="../attms/images/shop_del_lianxi.png" alt="" />联系买家</a>
					</div>
					<h6 style="clear:both;"></h6>
				</div>
			</div>
			<h6 style="clear:both;"></h6>
		</div>

		<div class="center">
			<a href="javascript:;" class="active" id="xiangqing">商品详情</a>
		</div>

		<div class="xiangqing">
			<div class="Kcon">
				<?php echo $detail["details"];?>
			</div>
			<!--<img src="../attms/images/baogou_del_xiangqing.png" alt="" />-->
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

	$('.Kxian>h1>a').click(function(){
		$(this).addClass('active').siblings('a').removeClass('active');
	});
	
	$("#up").click(function(){
		$("#num").val(parseInt($("#num").val())+1);
	});
	$("#down").click(function(){
		if(parseInt($("#num").val())>1){
			$("#num").val(parseInt($("#num").val())-1);
		}
	});

	

</script>

<script type="text/javascript">
	//加入购物车
	var x = $("#end").html();
	var y = $("#shopcar").html();
	function shay_fly(n){
		$.post(RestApi, { c: 'login',a: 'login_status'}, function(response){
			var responseObj=$.parseJSON(response);
			if(responseObj.code == 200){
				var str = '#fly_img';
				var img = $(str).attr('src');
				var flyer = $('<img class="u-flyer" style="z-index:99999999999;" src="'+img+'">');
				flyer.fly({
					start: {
						left: $(str).offset().left,
						top: $(str).offset().top - $(document).scrollTop()
					},
					end: {
						left:$('#shopcar').offset().left,
						top:$('#shopcar').offset().top - $(document).scrollTop(),
						width: 0,
						height: 0
					},
					onEnd: function(){
						$("#msg").show().animate({width: '150px'}, 200).fadeOut(1000);
					}
				});
				x++;
				y++;
				$('#end').html(x);
				$('#shopcar').html(y);
				$.post(RestApi, { c: 'buy',a: 'add_shopcar',gid:n,num:$("#num").val()}, function(response){
					console.log(response);
					var responseObj=$.parseJSON(response);
				});
			}else{
				window.wxc.xcConfirm(responseObj.message,'../acenter/index.php?c=index&a=login')
			}
		});
	}

	//购物车跳转
	function shopcar(realname)
	{
		$.post(RestApi, { c: 'login',a: 'login_status'}, function(response){
			var responseObj=$.parseJSON(response);
			if(responseObj.code == 200){
				window.location.href="<?php echo pfurl('','shopcar','index')?>";
			}else{
				window.wxc.xcConfirm(responseObj.message,'../acenter/index.php?c=index&a=login')
			}
		});
	}

	//立即购买
	function buynow(goods_id)
	{
		$.post(RestApi, { c: 'login',a: 'login_status'}, function(response){
			var responseObj=$.parseJSON(response);
			if(responseObj.code == 200){
				window.location.href = "index.php?c=temp_shopcar&a=confirm&goods_id="+goods_id+"&num="+$("#num").val();
			}else{
				window.wxc.xcConfirm(responseObj.message,'../acenter/index.php?c=index&a=login')
			}
		});
	}
</script>
</body>
</html>
