<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>详情页 积交所 jjs.51daniu.cn</title>
<link href="../attms/css/user_basic.css" rel="stylesheet" media="screen, projection">
<link rel="stylesheet" href="../attms/css/user_styles.css">
<link rel="stylesheet" href="../attms/css/acenter.css">
<link rel="stylesheet" href="../attms/css/portal.css">
<script src="../attms/js/jquery-1.11.3.js"></script>
<script src="../attms/js/common.js"></script>
<script type="text/javascript" src="../attms/highstock/highstock.js"></script>
<script type="text/javascript" src="../attms/highstock/modules/exporting.js"></script>
</head>
<style type="text/css">
    neirong>p>img{ max-width:818px;}
</style>
<body>
	<!-- 头部 -->
	<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->
	<div class="portal_deal_center">
		<h1>您现在的位置： <a href="javascript:;">积交所</a>&nbsp;&gt;&gt;&nbsp;<a href="javascript:;"><?php echo $catename;?></a></h1>
		<div class="center" style="margin-top:0;">
			<div class="left">
				<div class="top">
					<h2><?php echo $detail["title"]?></h2>
					<h3>发布时间：<?php echo date("Y-m-d",$detail["ctime"])?></h3>
					<h4 class="neirong"><?php echo $detail["content"]?></h4>
					<h5><span>上一篇：<a href="javascript:;" class="a1"><?php echo $later;?></a></span><a href="javascript:;" class="a2" id="returnlist">返回列表</a><span style="float:right;">下一篇：<a href="javascript:;" class="a1"><?php echo $former;?></a></span></h5>
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
	var add1 = decodeURI(attr.split('remark=')[1]);
	var add2 = decodeURI(attr.split('cateid=')[1]);
	if(add2.indexOf("&")!=-1){
		add2 = add2.split('&')[0];
	}
	if(add2 == '9' || add2 == '10'){
		$("#returnlist").attr("href","index.php?c=index&a=index");
	}
	if(add2 == '7' || add2 == '8'){
		$("#default").addClass('active');
		$("#returnlist").attr("href","index.php?c=index&a=index");
	}
	if(add1 == '交易中心'){
		$("#dealcenter").addClass('active');
		$("#returnlist").attr("href","index.php?c=information&a=dealcenter");
	}else if(add1 == '信息公告'){
		$("#bulletin").addClass('active');
		$("#returnlist").attr("href","index.php?c=information&a=bulletin");
	}else if(add1 == '行业资讯'){
		$("#industry_information").addClass('active');
		$("#returnlist").attr("href","index.php?c=information&a=industry_information");
	}else if(add1 == '用户指导'){
		$("#user_guide").addClass('active');
		$("#returnlist").attr("href","index.php?c=information&a=user_guide");
	}else if(add1 == '相关下载'){
		$("#related_download").addClass('active');
		$("#returnlist").attr("href","index.php?c=information&a=related_download");
	}else if(add1 == '市场综述'){
		$("#market_overview").addClass('active');
		$("#returnlist").attr("href","index.php?c=information&a=market_overview");
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
