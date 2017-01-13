<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>用户指导 积交所 jjs.51daniu.cn</title>
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
		<h1>您现在的位置： <a href="javascript:;">积交所</a>&nbsp;&gt;&gt;&nbsp;<a href="javascript:;">用户指导</a></h1>
		<div class="center" style="margin-top:0;">
			<div class="left">
				<div class="top">
					<h1><i></i>相关流程 <a href="index.php?c=information&a=more&cateid=<?php echo $related_process[0]['cateid'];?>">更多&gt;</a></h1>
					<dl>
					<?php if(!empty($related_process)){foreach($related_process as $k=>$v){?>
						<dt>
							<div class="left">
								<img src="<?php echo $v['image'];?>" alt="" />
							</div>
							<div class="right">
								<h1><?php echo $v["title"];?></h1>
								<h2><?php echo mb_substr(strip_tags($v["content"]),0,80,'utf-8');?> <i style="cursor:pointer;" onclick="javascript:detail('<?php echo $v['id']?>','<?php echo $related_process[0]['cateid'];?>');">[详细]</i></h2>
								<h3><?php echo date("Y-m-d",$v["ctime"]);?></h3>
							</div>
							<h6 style="clear:both;"></h6>
						</dt>
					<?php }}else{?>
						暂无记录
					<?php }?>
					</dl>
				</div>

				<div class="top">
					<h1><i></i>问题解答 <a href="index.php?c=information&a=more&cateid=<?php echo $problem_solving[0]['cateid'];?>">更多&gt;</a></h1>
					<dl>
					<?php if(!empty($problem_solving)){foreach($problem_solving as $k=>$v){?>
					   <dt>
						 <div class="left">
							<img src="<?php echo $v['image'];?>" alt="" />
						 </div>
						 <div class="right">
							<h1><?php echo $v["title"];?></h1>
							<h2><?php echo mb_substr(strip_tags($v["content"]),0,70,'utf-8');?> <i style="cursor:pointer;" onclick="javascript:detail('<?php echo $v['id']?>','<?php echo $problem_solving[0]['cateid'];?>');">[详细]</i></h2>
							<h3><?php echo date("Y-m-d",$v["ctime"]);?></h3>
						 </div>
						 <h6 style="clear:both;"></h6>
					   </dt>
					<?php }}?>  
					</dl>
				</div>
			</div>
			<div class="right">
				<div>
					<h1>热门商品</h1>
					<ul>
					<?php if(!empty($goods)){foreach($goods as $k=>$v){?>
						<li onClick="javascript:window.location.href='index.php?c=mall&a=detail&goods_id=<?php echo $v['id'];?>'">
							<img src="<?php echo $v['img'];?>" alt="" />
							<h1><?php echo mb_substr(strip_tags($v["title"]),0,16,'utf-8');?></h1>
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
		if(add2 == 'user_guide'){
			$("#user_guide").addClass('active');
		}

		//文章详情
		function detail(id,cateid)
		{
			window.location.href="index.php?c=information&a=detail&id="+id+"&cateid="+cateid+"&remark=用户指导";
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
