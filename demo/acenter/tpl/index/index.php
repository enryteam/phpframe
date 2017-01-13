	<!-- 头部 -->
	<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->

	<div class="inner-wrap">
    	<!-- 商品列表开始 -->
	    <div class="page-maincontent">
	        <!-- 筛选区 -->
			<div class="filter-container">
      			<h1 style="color: #666666;font-size: 14px;padding: 15px 0;">您现在的位置： <a href="portal_index.html" style="color: #666666;">首页</a>&nbsp;&gt;&gt;&nbsp;<a href="javascript:;" style="color: #666666;"><?php if($userdata['type'] == 0) echo "用户中心";elseif($userdata['type'] == 2) echo "运营中心";elseif($userdata['type'] == 3) echo "代理运营中心";elseif($userdata['type'] == 4) echo "代理商中心";elseif($userdata['type'] == 1) echo "卖家中心";?></a></h1>

				<!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 -->
				<div class="user_content">
					<!-- 左侧导航开始 -->
					<?php include("tpl/public/left.php");?>
					<!-- 左侧导航结束 -->
					<!-- 右侧tabs开始 -->
					<!-- tab 1 我的主页 -->
					<div class="right my_index" data-type="1" style="border:1px solid transparent;padding:0;">
						<div class="center">
							<div class="top">
								<div class="left">
									<?php if(empty($userdata["head_img"])){?><img src="../attms/images/touxiang.png" alt="" /><?php }else{?><img src="<?php echo $userdata["head_img"];?>" alt="" /><?php }?>
									
									<h1><?php echo $userdata["realname"];?></h1>
									<h2><img src="../attms/images/huiyuan.png" alt="" /><?php if($userdata["role"] == 1) echo "普通用户";else echo "交易商";?></h2>
									<div><img src="../attms/images/muji.png" alt="" />总通用积分 <i><?php echo intval($assets);?></i></div>
								</div>
								<div class="right1">
									<div class="top">
										<h1>我的等级信息</h1>
										<h2>当前等级：<?php if($userdata["role"] == 1) echo "普通用户";else echo "交易商";?></h2>
										<h3><?php if($userdata["role"] == 1) echo "普通用户，能够购买商品";else echo "交易商，能够发售商品";?></h3>
									</div>
									<div class="bottom">
										<h1>我的账户信息</h1>
										<h2>个人信息：未完善 <a href="<?php echo pfurl('','user','personal')?>">去填写</a></h2>
										<h2>挂牌认证：<?php if(empty($is_entry)){?>未认证 <a href="../portal/index.php?c=entry_market&a=index">去认证</a><?php }elseif($is_entry[0]["status"] == 0){?><font color="#c91623">待后台管理员审核</font><?php }elseif($is_entry[0]["status"] == 1){?><font color="#c91623"><?php echo $is_entry[0]["company"]?></font><?php }else{?><font color="#c91623">认证不通过</font><?php }?></h2>
									</div>
								</div>
								<h6 style="clear:both;"></h6>
							</div>

							<div class="bottom">
								<h1><i></i>我的资产 <a href="<?php echo pfurl('','user','cash')?>" class="a1">出 金</a><a href="<?php echo pfurl('','user','pay')?>" class="a2">入 金</a></h1>
								<div class="zichan">
									<ul>
										<li>
											<h1><?php echo $assets;?></h1>
											<h2><img src="../attms/images/user11.png" alt="" />账户余额</h2>
											<h3>（通用积分）</h3>
										</li>
										<li>
											<h1><?php echo $disperity;?></h1>
											<h2><img src="../attms/images/user12.png" alt="" />可用余额</h2>
											<h3>（通用积分）</h3>
										</li>
										<li>
											<h1><?php echo $account[0]["bond"];?></h1>
											<h2><img src="../attms/images/user13.png" alt="" />申购总额</h2>
											<h3>（通用积分）</h3>
										</li>
										<li>
											<h1><?php echo $account[0]["frozen"];?></h1>
											<h2><img src="../attms/images/user14.png" alt="" />冻结资金</h2>
											<h3>（通用积分）</h3>
										</li>
										<h6 style="clear:both;"></h6>
									</ul>
								</div>
								<h1><i></i>我的订单 <strong id="nocomment">待评价（<i><?php echo $nocomment;?></i>）</strong><strong id="noreceived">待收货（<i><?php echo $noreceived;?></i>）</strong><strong id="nodeliver">待发货（<i><?php echo $nodeliver;?></i>）</strong><strong id="nopay">待付款（<i><?php echo $nopay;?></i>）</strong><strong id="all" style="color:#e62633;">全部（<i><?php echo $all;?></i>）</strong></h1>
								<div class="baogou">
									<ul>
										<li><i>订单号</i><i>下单时间</i><i>订单金额</i><i>订单状态</i></li>
										<?php if(!empty($orders)){foreach($orders as $k=>$v){?>
											<li><i><?php echo $v["order_sn"];?></i><i><?php echo $v["single_time"];?></i><i><?php echo $v["total"];?>&nbsp;通用积分</i><i>
											<?php if($v["status"]==0){?>
											待付款
											<?php }elseif($v["status"]==1){?>
											待发货
											<?php }elseif($v["status"]==2){?>
											待收货
											<?php }elseif($v["status"]==3){?>
											待评价
											<?php }elseif($v["status"]==4){?>
											已评价
											<?php }elseif($v["status"]==5){?>
											订单完成
											<?php }elseif($v["status"]==6){?>
											交易关闭
											<?php }elseif($v["status"]==7){?>
											卖家处理中
											<?php }elseif($v["status"]==8){?>
											卖家同意退款
											<?php }elseif($v["status"]==9){?>
											卖家拒绝退款
											<?php }elseif($v["status"]==20){?>
											待发货
											<?php }?>
											</i></li>
										<?php }}else{?>
											暂无记录
										<?php }?>
									</ul>
								</div>
							</div>
						</div>
						<?php if($userdata["type"]<2){?>
						<div class="index_right">
							<h1><i></i>我的购物车</h1>
							<ul>
								<?php if(!empty($myshopcar)){foreach($myshopcar as $k=>$v){?>
									<li onclick="detail(<?php echo $v["gid"]?>);"><img src="<?php echo $v["img"];?>" alt="" /><h1><?php echo $v["price"];?></h1></li>
								<?php }}else{?>
									暂无记录
								<?php }?>
								<h6 style="clear:both;"></h6>
							</ul>
							<h2 onclick="shopcars()">查看购物车（<i><?php echo intval($shopcar);?></i>）</h2>
						</div>
						<?php }?>
						<h6 style="clear:both;"></h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 尾部 -->
	<?php include("tpl/public/bottom.php");?>
	<!-- 尾部结束 -->
    
<script type="text/javascript">
	$("#li1").addClass("active");
	$("#img1").attr("src","../attms/images/user1-red.png");
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
	var add1 = decodeURI(attr.split('orderremark=')[1]);
	if(add1 == "全部"){
		var all = document.getElementById('all');
		var nopay = document.getElementById('nopay');
		var nodeliver = document.getElementById('nodeliver');
		var noreceived = document.getElementById('noreceived');
		var nocomment = document.getElementById('nocomment');
		all.style.color='#e62633';
		nopay.style.color='#666666';
		nodeliver.style.color='#666666';
		noreceived.style.color='#666666';
		nocomment.style.color='#666666';

	}
	else if(add1 == "待付款"){
		var all = document.getElementById('all');
		var nopay = document.getElementById('nopay');
		var nodeliver = document.getElementById('nodeliver');
		var noreceived = document.getElementById('noreceived');
		var nocomment = document.getElementById('nocomment');
		all.style.color='#666666';
		nopay.style.color='#e62633';
		nodeliver.style.color='#666666';
		noreceived.style.color='#666666';
		nocomment.style.color='#666666';

	}
	else if(add1 == "待发货"){
		var all = document.getElementById('all');
		var nopay = document.getElementById('nopay');
		var nodeliver = document.getElementById('nodeliver');
		var noreceived = document.getElementById('noreceived');
		var nocomment = document.getElementById('nocomment');
		all.style.color='#666666';
		nopay.style.color='#666666';
		nodeliver.style.color='#e62633';
		noreceived.style.color='#666666';
		nocomment.style.color='#666666';
	}
	else if(add1 == "待收货"){
		var all = document.getElementById('all');
		var nopay = document.getElementById('nopay');
		var nodeliver = document.getElementById('nodeliver');
		var noreceived = document.getElementById('noreceived');
		var nocomment = document.getElementById('nocomment');
		all.style.color='#666666';
		nopay.style.color='#666666';
		nodeliver.style.color='#666666';
		noreceived.style.color='#e62633';
		nocomment.style.color='#666666';
	}
	else if(add1 == "待评价"){
		var all = document.getElementById('all');
		var nopay = document.getElementById('nopay');
		var nodeliver = document.getElementById('nodeliver');
		var noreceived = document.getElementById('noreceived');
		var nocomment = document.getElementById('nocomment');
		all.style.color='#666666';
		nopay.style.color='#666666';
		nodeliver.style.color='#666666';
		noreceived.style.color='#666666';
		nocomment.style.color='#e62633';
	}

	//全部
	$("#all").click(function(){
		window.location.href="<?php echo pfurl('','index','index')?>";
	})
	//待付款
	$("#nopay").click(function(){
		window.location.href="<?php echo pfurl('','index','index',array('orderremark'=>'待付款'))?>";
	})
	//待发货
	$("#nodeliver").click(function(){
		window.location.href="<?php echo pfurl('','index','index',array('orderremark'=>'待发货'))?>";
	})
	//待收货
	$("#noreceived").click(function(){
		window.location.href="<?php echo pfurl('','index','index',array('orderremark'=>'待收货'))?>";
	})
	//待评价
	$("#nocomment").click(function(){
		window.location.href="<?php echo pfurl('','index','index',array('orderremark'=>'待评价'))?>";
	})

	//查看购物车
	function shopcars()
	{
		window.location.href="../portal/index.php?c=shopcar&a=index";
	}
</script>
</body>
</html>
