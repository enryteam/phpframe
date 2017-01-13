<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>首页 积交所 jjs.51daniu.cn</title>
<link href="../attms/css/user_basic.css" rel="stylesheet" media="screen, projection">
<link rel="stylesheet" href="../attms/css/user_styles.css">
<link rel="stylesheet" href="../attms/css/acenter.css">
<link rel="stylesheet" href="../attms/css/portal.css">
<script src="../attms/js/jquery-1.11.3.js"></script>
<script src="../attms/js/common.js"></script>
<script src="../attms/js/init.js"></script>
<script type="text/javascript" src="../attms/highstock/highstock.js"></script>
<script type="text/javascript" src="../attms/highstock/modules/exporting.js"></script>
</head>
<body>
	<!-- 头部 -->
	<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->

	<div class="portal_index">
		<div class="top"></div>
		<div class="center">
			<div class="top">
				<a href="index.php?c=barclays&a=register" class="y"><img src="../attms/images/p1.png" alt="" />在线开户</a><a href="index.php?c=information&a=related_download" class="g"><img src="../attms/images/p2.png" alt="" />软件下载</a><a href="index.php?c=information&a=user_guide" class="b"><img src="../attms/images/p3.png" alt="" />问题相关</a><a href="../acenter/index.php?c=user&a=bank" class="r"><img src="../attms/images/p4.png" alt="" />银行卡绑定</a>
			</div>

			<div class="center">
				<h1><i></i>热门商品 <a href="<?php echo pfurl('','mall','index');?>" >更多&gt;&gt;</a></h1>
				<ul class="ul1">
					<?php if(!empty($goods)){foreach($goods as $k=>$v){?>
						<li onClick="javascript:window.location.href='index.php?c=mall&a=detail&goods_id=<?php echo $v['id'];?>'"><img src="<?php echo $v['img'];?>" alt="" /><div>
						  <?php echo $v['title'];?>
						</div></li>
					<?php }}else{?>
						暂无记录
					<?php }?>
					<h6 style="clear:both;"></h6>
				</ul>
				<h1><i></i>信息公告</h1>
				<ul class="ul2">
					<li>
						<h1>通知公告 <a href="index.php?c=information&a=more&cateid=<?php echo $announcement[0]['cateid'];?>">更多&gt;&gt;</a></h1>
						<dl>
							<?php if(!empty($announcement)){foreach($announcement as $k=>$v){?>
								<dt onclick="javascript:detail('<?php echo $v['id'];?>','<?php echo $v['cateid'];?>')"><span><?php echo $v['title'];?></span> <i><?php echo date("m-d",$v['ctime']);?></i></dt>
							<?php }}else{?>
								暂无记录
							<?php }?>
						</dl>
					</li>
					<li>
						<h1>市场动态</h1>
						<dl>
							<?php if(!empty($market_dynamics)){foreach($market_dynamics as $k=>$v){?>
								<dt onclick="javascript:detail('<?php echo $v['id'];?>','<?php echo $v['cateid'];?>')"><span><?php echo $v['title'];?></span> <i><?php echo date("m-d",$v['ctime']);?></i></dt>
							<?php }}else{?>
								暂无记录
							<?php }?>
						</dl>
					</li>
					<h6 style="clear:both;"></h6>
				</ul>
				<?php if(!empty($realtime_quotes)){?>
				<h1><i></i>实时行情</h1>
              <!-- <div id="container" style="min-width:400px;height:400px"></div> -->
              <ul class="ul3">
                  <li class="li1">
                      <i class="i1">序号</i>
                      <i class="i2">商品代码</i>
                      <i class="i3">商品名称</i>
                      <i class="i4">昨收盘</i>
                      <i class="i4">今开盘</i>
                      <i class="i4">最新价</i>
                      <i class="i4">涨跌幅</i>
                      <i class="i4">成交量</i>
                      <i class="i4">成交金额</i>
                      <i class="i4">最高价</i>
                      <i class="i4">最低价</i>
                  </li>
				  <?php foreach($realtime_quotes as $k=>$v){?>
                  <li>
                      <i class="i1"><?php echo $v["id"]?></i>
                      <i class="i2"><?php echo $v["code"]?></i>
                      <i class="i3"><?php echo mb_substr(strip_tags($v["title"]),0,15,'utf-8');?></i>
                      <i class="i4"><?php echo $v["closeprice"]?></i>
                      <i class="i4"><?php echo $v["openprice"]?></i>
                      <i class="i4"><?php echo $v["newprice"]?></i>
                      <i class="i4 red"><?php echo $v["range"]?></i>
                      <i class="i4"><?php echo $v["dealnum"]?></i>
                      <i class="i4"><?php echo $v["totalprice"]?></i>
                      <i class="i4"><?php echo $v["highestprice"]?></i>
                      <i class="i4"><?php echo $v["lowestprice"]?></i>
                  </li>
                  <?php }?>
              </ul>
			  <?php }?>
			</div>
		</div>
	</div>
	
	<!-- 尾部 -->
	<?php include("tpl/public/bottom.php");?>
	<!-- 尾部结束 -->

<script type="text/javascript">
	/*退出登录*/
	function back(){
		$.post(RestApi, { c: 'login',a: 'logout'}, function(response) {
			console.log(response);
			var responseObj=$.parseJSON(response);
			window.location.href = '../portal/index.php?c=index&a=index';
		});
	}

	//获取浏览器地址
	var attr = window.location.href;
	var add2 = decodeURI(attr.split('a=')[1]);
	if(add2.indexOf("&")!=-1){
		add2 = add2.split('&')[0];
	}
	if(add2 == 'index'){
		$("#default").addClass('active');
	}

	//文章详情页
	function detail(id,cateid)
	{
		window.location.href="index.php?c=information&a=detail&id="+id+"&cateid="+cateid;
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
