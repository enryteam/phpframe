<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>交易中心 积交所 jjs.51daniu.cn</title>
<link href="../attms/css/user_basic.css" rel="stylesheet" media="screen, projection">
<link rel="stylesheet" href="../attms/css/user_styles.css">
<link rel="stylesheet" href="../attms/css/acenter.css">
<link rel="stylesheet" href="../attms/css/portal.css">
<script src="../attms/js/jquery-1.11.3.js"></script>
<script src="../attms/js/common.js"></script>
<script type="text/javascript" src="../attms/highstock/highstock.js"></script>
<script type="text/javascript" src="../attms/highstock/modules/exporting.js"></script>
</head>
<body>
	<!-- 头部 -->
	<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->	

	<div class="portal_deal_center">
		<h1>您现在的位置： <a href="portal_index.html">积交所</a>&nbsp;&gt;&gt;&nbsp;<a href="javascript:;">交易中心</a></h1>
		<div class="top">
			<div>
			  <h1><?php echo $dealdata["dealtotal"];?></h1>
			  <h2><img src="../attms/images/c1.png" alt="" />累计交易总额（元）</h2>
			</div>
			<div>
			  <h1><?php echo $dealdata["soldtotal"];?></h1>
			  <h2><img src="../attms/images/c2.png" alt="" />卖出总额（元）</h2>
			</div>
			<div style="border-right:0;">
			  <h1><?php echo $dealdata["buytotal"];?></h1>
			  <h2><img src="../attms/images/c3.png" alt="" />买入总额（元）</h2>
			</div>
			<h6 style="clear:both;"></h6>
		</div>
		<div class="center">
			<?php if(!empty($trading_dynamics)){?>
			<div class="left">
				<div class="top">
					<h1><i></i>交易动态</h1>
					<ul>
					<?php foreach($trading_dynamics as $k=>$v){?>
						<li><strong>用户<?php echo $v["account"]?> 成功<?php if($v["cate"]==0) echo "买入";else echo "卖出";?> 代码<?php echo $v["g_code"];?>  交易价格：<i><?php echo $v["t_price"];?></i>通用积分</strong><b><?php echo date("Y-m-d",strtotime($v["deal_time"]))?></b></li>
					<?php }?>
					</ul>
				</div>
				<div class="bottom">
					<h1><i></i>交易指南</h1>
					<ul>
					<?php if(!empty($trading_guide)){foreach($trading_guide as $k=>$v){?>
						<li onclick="javascript:detail('<?php echo $v['id']?>','<?php echo $v['cateid'];?>');"><a></a><strong><?php echo $v["title"];?></strong><b><?php echo date("Y-m-d",$v["ctime"]);?></b></li>
					<?php }}else{?>
						暂无记录
					<?php }?>
					</ul>
				</div>
			</div>
			<?php }?>
			<div class="right">
				<div>
					<h1>热门商品</h1>
					<ul>
					<?php if(!empty($goods)){foreach($goods as $k=>$v){?>
						<li onClick="javascript:window.location.href='index.php?c=mall&a=detail&goods_id=<?php echo $v['id'];?>'">
							<img src="<?php echo $v['img'];?>" alt="" />
							<h1><?php echo mb_substr($v["title"],0,16,'utf-8');?></h1>
						</li>
					<?php }}else{?>
						暂无记录
					<?php }?>
					<h6 style="clear:both;"></h6>
					</ul>
				</div>
			</div>
			<h6 style="clear:both;"></h6>
		</div>
	</div>
	<!-- 尾部 -->
	<?php include("tpl/public/bottom.php");?>
	<!-- 尾部结束 -->
<script type="text/javascript">
	//获取浏览器地址
	var attr = window.location.href;
	var add2 = decodeURI(attr.split('a=')[1]);
	if(add2.indexOf("&")!=-1){
		add2 = add2.split('&')[0];
	}
	if(add2 == 'dealcenter'){
		$("#dealcenter").addClass('active');
	}

	//文章详情
	function detail(id,cateid)
	{
		window.location.href="index.php?c=information&a=detail&id="+id+"&cateid="+cateid+"&remark=交易中心";
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
