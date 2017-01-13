<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>信息公告 积交所 jjs.51daniu.cn</title>
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
		<h1>您现在的位置： <a href="portal_index.html">积交所</a>&nbsp;&gt;&gt;&nbsp;<a href="javascript:;">信息公告</a></h1>
		<div class="center" style="margin-top:0;">
			<div class="left">
				<?php if(!empty($market_dynamics)){?>
				<div class="top">
					<h1><i></i>挂牌动态</h1>
					<ul>
					<?php foreach($market_dynamics as $k=>$v){?>
						<li><strong><i>热烈祝贺</i> <?php echo $v["company"];?> 代号<?php echo $v["code"];?> 挂牌成功</strong><b><?php echo date("Y-m-d",$v["ctime"]);?></b></li>
					<?php }?>
					</ul>
				</div>
				<?php }?>
				<div class="top">
					<h1><i></i>通知公告</h1>
					<ul>
					<?php if(!empty($announcement)){foreach($announcement as $k=>$v){?>
						<li onClick="javascript:detail('<?php echo $v['id']?>','<?php echo $v['cateid'];?>');"><strong>【最新】<?php echo $v["title"];?></strong><b><?php echo date("Y-m-d",$v["ctime"]);?></b></li>
					<?php }}else{?>
						暂无记录
					<?php }?>
					</ul>
				</div>
			</div>
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
	if(add2 == 'bulletin'){
		$("#bulletin").addClass('active');
	}

	//文章详情
	function detail(id,cateid)
	{
		window.location.href="index.php?c=information&a=detail&id="+id+"&cateid="+cateid+"&remark=信息公告";
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
