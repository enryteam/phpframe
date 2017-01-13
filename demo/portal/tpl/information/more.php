<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>列表页 积交所 jjs.51daniu.cn</title>
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
		<h1>您现在的位置： <a href="portal_index.html">积交所</a>&nbsp;&gt;&gt;&nbsp;<a href="index.php?c=information&a=user_guide"><?php if($cateid == 7) echo "通知公告";elseif($cateid == 9) echo "相关流程"; elseif($cateid == 10) echo "问题解答";?></a></h1>
		<div class="center" style="margin-top:0;">
			<div class="left">
				<ul>
				<?php if($cateid == 7){?>
					<?php if(!empty($more)){foreach($more as $k=>$v){?>
						<li onclick="javascript:detail('<?php echo $v['id']?>','<?php echo $cateid;?>');"><a href="javascript:;"><span><?php echo $v["title"];?> </span><i><?php echo date("m-d",$v["ctime"]);?></i></a></li>
					<?php }}else{?>
						暂无记录
					<?php }?>
					<div class="fenye" style="margin-top:20px;">
						<?php if($count>8){?>
							<?php echo $pages;?>
						<?php }?>
					</div>
				<?php }elseif($cateid == 9 || $cateid == 10){?>
					<?php if(!empty($more)){foreach($more as $k=>$v){?>
						<dt style="border-bottom: 1px solid #cccccc;padding: 20px;">
							<div style="width: 126px;margin-right: 20px;height: 112px;float: left;">
								<img src="<?php echo $v['image'];?>" alt="" style="width: 126px;height: 112px;"/>
							</div>
							<div style="width: 692px;">
								<h1 style="font-size: 16px;color: #333333;line-height: 25px;height: 25px;font-family: 'Helvetica Neue',Helvetica,Arial,'Hiragino Sans GB',微软雅黑,tahoma,simsun,宋体;"><?php echo $v["title"];?></h1>
								<h2 style="min-height: 69px;line-height: 23px;font-size: 14px;color: #666666;font-family: 'Helvetica Neue',Helvetica,Arial,'Hiragino Sans GB',微软雅黑,tahoma,simsun,宋体;"><?php echo mb_substr(strip_tags($v["content"]),0,70,'utf-8');?> <i style="color: #e03e3f;font-style: normal;cursor:pointer;" onclick="javascript:detail(<?php echo $v['id']?>,<?php echo $cateid;?>);">[详细]</i></h2>
								<h3 style="height: 18px;line-height: 18px;font-size: 12px;color: #999999;"><?php echo date("Y-m-d",$v["ctime"]);?></h3>
							</div>
							<h6 style="clear:both;"></h6>
						</dt>
					<?php }}else{?>
						暂无记录
					<?php }?>
					<div class="fenye" style="margin-top:20px;">
						<?php if($count>8){?>
							<?php echo $pages;?>
						<?php }?>
					</div>
				<?php }?>
					
				</ul>
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
  <div class="page-helper" style="margin-top:20px;background-color:#f1f1f1;">
      <div class="inner-wrap">
          <div class="xj-footer-wd clearfix">
          <div class="footer">
              <h6><a href="javascript:;">关于我们</a>&nbsp;|&nbsp;<a href="javascript:;">新手指南</a>&nbsp;|&nbsp;<a href="javascript:;">安全中心</a>&nbsp;|&nbsp;<a href="javascript:;">最新动态</a>&nbsp;|&nbsp;<a href="javascript:;">联系我们</a>&nbsp;|&nbsp;<a href="javascript:;">新生支付</a>&nbsp;|&nbsp;<a href="javascript:;">快递查询</a></h6>
              <h5 style="margin-top:10px;">积交所 ©CopyRight 2016 EWABAO .Inc Rights Reserved.</h5>
              <h5 style="margin-top:10px;">琼ICP备16001137号-1 <img src="../attms/images/foot1.png" style="vertical-align:middle;margin-left:10px;" /><img src="../attms/images/foot2.png" style="margin-left:10px;vertical-align:middle;" /></h5>
          </div>
       </div>
    </div>
  </div>
 <!-- 尾部结束 -->
<script type="text/javascript">
	//获取浏览器地址
	var attr = window.location.href;
	var add2 = decodeURI(attr.split('cateid=')[1]);
	if(add2.indexOf("&")!=-1){
		add2 = add2.split('&')[0];
	}
	if(add2 == '9' || add2 == '10'){
		$("#user_guide").addClass('active');
	}else if(add2 == 12){
		$("#dealcenter").addClass('active');
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
