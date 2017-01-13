<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>积交所——用户中心</title>
<link href="../attms/css/user_basic.css" rel="stylesheet" media="screen, projection">
<link rel="stylesheet" href="../attms/css/xcConfirm_web.css">
<link rel="stylesheet" href="../attms/css/user_styles.css">
<link rel="stylesheet" href="../attms/css/acenter.css">
<link rel="stylesheet" href="../attms/css/portal.css">
<script src="../attms/js/jquery-1.11.3.js"></script>
<script src="../attms/js/common.js"></script>
<script src="../attms/js/init.js"></script>
<script src="../attms/js/xcConfirm_web.js"></script>
<script type="text/javascript" src="../attms/highstock/highstock.js"></script>
<script type="text/javascript" src="../attms/highstock/modules/exporting.js"></script>

</head>
<body>
	<!-- 右边侧导航 
	<div class="right_celan">
		<?php if(empty($userdata['head_img'])){?>
			<img src="../attms/images/user.png" class="img1" style="width:18px;height:19px;" onClick="javascript:window.location.href='../acenter/';"/>
		<?php }else{?>
			<img src="<?php echo $userdata['head_img'];?>" class="img1" style="width:18px;height:19px;" onClick="javascript:window.location.href='../acenter/';"/>
		<?php }?>
		<div>
			<img src="../attms/images/right_shop_car.png" class="img2" />
			<i>购物车</i>
			<b><?php echo intval($shopcar);?></b>
		</div>
		<img src="../attms/images/ques.png" class="img3" onClick="javascript:window.location.href='../portal/index.php?c=helpcenter&a=index';"/>
		<img src="../attms/images/right_qq.png" class="img4" onClick="javascript:window.open('tencent://message/?uin=392732032&Site=ewabao.com&Menu=yes');" />
		<img src="../attms/images/right_erwei.png" class="img5" onclick="javascript:top_erwei();" onMouseOut="$('.xiala_erwei').fadeOut(500);"/>
	</div>-->
	<!-- 右边侧导航结束 -->
	<!-- 头部 -->
	<div class="page-topbar">
		<div class="inside-wrap">
			<div class="topbar-left">
				<div class="small-signin">
					<span><?php echo empty($userdata['phone'])?"<a href='../acenter/index.php?c=index&a=login'>登录</a><a href='../acenter/index.php?c=index&a=register' rel='nofollow'>注册</a>":'<span style="color:#e03e3f;cursor: pointer;" onclick="ucenter()" >'.$userdata['phone'].'&nbsp;&nbsp;&nbsp;</span><a href="javascript:" rel="nofollow" onclick="back()">退出</a>';?></span>
				</div>
			</div>
			<div class="topbar-right">
				<div class="subnav">
					<div class="right-link clearfix">
						<div class="xj-helpcenter-top"><a href="index.php?c=index&a=index"><?php if($userdata['type'] == 0) echo "用户中心";elseif($userdata['type'] == 2) echo "运营中心";elseif($userdata['type'] == 3) echo "代理运营中心";elseif($userdata['type'] == 4) echo "代理商中心";elseif($userdata['type'] == 1) echo "交易商中心";?> <img src="../attms/images/down.png" alt="" style="position:relative;top:-2px;"/> </a></div>
						<!--<div class="xj-helpcenter-top"><a href="javascript:;" onclick="javascript:role(<?php echo $userdata['role']?>);">我是交易商</a></div>-->
						<div class="xj-helpcenter-top"><a href="../portal/index.php?c=index&a=index">网站首页</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="page-header page-header-bg">
		<div class="inner-wrap clearfix">
			<div class="header-left">
				<h1><a href="../portal/index.php?c=index&a=index"><img src="../attms/images/logo.png" alt=""></a></h1>
			</div>
			<div class="header-right">
				<div class="searchbar">
					<form action="../portal/index.php?#anchor" method="post" async="false">
						<select style="cursor:pointer;color:#666666;position:absolute;height:37px;line-height:37px;width:65px;padding-right:5px;padding-left:12px;border:0;background:transparent url('../attms/images/down.png') no-repeat scroll 50px center;-moz-appearance: none;"><option>代码</option><option>名称</option></select>
						<input autocomplete="off" class="x-input" name="search" placeholder="玉米" data-autocompleter="true" type="text"><input type="hidden" name="c" value="mall"/><input type="hidden" name="a" value="index"/>
						<button type="submit" class="btn btn-search"><span><span>搜索</span></span></button>
					</form>
				</div>
			</div>
			<div class="header-main">
				<a href="javascript:;" onClick="shopcar('<?php echo $userdata["realname"];?>')">
					<img src="../attms/images/shop_car.png" alt="" />
					<i><?php echo intval($shopcar);?></i>
				</a>
			</div>
		</div>
	</div>

	<div style="position: ../attms; width: 100%;" class="page-nav">
		<div class="inner-wrap clearfix">
			<ul>
				<li id="default"><a href="../portal/index.php?c=index&a=index">首页</a></li>
				<li id="dealcenter"><a href="../portal/index.php?c=information&a=dealcenter">交易中心</a></li>
				<li id="bulletin"><a href="../portal/index.php?c=information&a=bulletin">信息公告</a></li>
				<li id="industry_information"><a href="../portal/index.php?c=information&a=industry_information">行业资讯</a></li>
				<li id="user_guide"><a href="../portal/index.php?c=information&a=user_guide">用户指导</a></li>
				<li id="related_download"><a href="../portal/index.php?c=information&a=related_download">相关下载</a></li>
				<li id="market_overview"><a href="../portal/index.php?c=information&a=market_overview">市场综述</a></li>
				<li id="entry_apply"><a href="../portal/index.php?c=entry_market&a=entry_apply">挂牌指南</a></li>
				<li id="register"><a href="../portal/index.php?c=barclays&a=register">网上开户</a></li>
				<!--<li id="release"><a href="../portal/index.php?c=goods&a=release">入场登记</a></li>-->
				<li class="last_shop" id="mall"><a href="../portal/index.php?c=mall&a=index">商城</a></li>
				<h6 style="clear:both;"></h6>
			</ul>
		</div>
	</div>
	<!-- 头部结束 -->
	<script type="text/javascript">
		function role(value)
		{
			if(value == 1){
				window.location.href="../portal/index.php?c=entry_market&a=entry_apply";
			}else{
				window.location.href="../acenter/index.php?c=index&a=index";
			}
		}
	</script>