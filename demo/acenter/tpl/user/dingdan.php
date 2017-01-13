	<!-- 头部 -->
	<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->
	<div class="inner-wrap">
    	<!-- 商品列表开始 -->
	    <div class="page-maincontent">
	        <!-- 筛选区 -->
			<div class="filter-container">
      			<h1 style="color: #666666;font-size: 14px;padding: 15px 0;">您现在的位置： <a href="portal_index.html" style="color: #666666;">首页</a>&nbsp;&gt;&gt;&nbsp;<a href="javascript:;" style="color: #666666;">用户中心</a></h1>

				<!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 -->
				<div class="user_content">
					<!-- 左侧导航开始 -->
					<?php include("tpl/public/left.php");?>
					<!-- 左侧导航结束 -->
					<!-- tab 3 我的订单 -->
					<div class="right tab_baogou" data-type="">
						<ul class="my_baogou">
							<li><i>商品名称</i><i>单价(通用积分)</i><i>数量</i><i>实付款(通用积分)</i><i>交易状态</i><i>交易操作</i></li>
						</ul>
						<ul class="my_baogou_list">
							<?php if(!empty($orders)){foreach($orders as $k=>$v){?>
							<li>
								<h1><?php echo $v["single_time"];?> <i>订单号:<?php echo $v["order_sn"];?></i></h1>
								<i>
										<img src="<?php echo $v["g_img"];?>" onclick="javascript:window.location.href='index.php?c=user&a=order_sn&order_sn=<?php echo $v["order_sn"];?>'" />
										<div class="left" onclick="javascript:window.location.href='index.php?c=user&a=order_sn&order_sn=<?php echo $v["order_sn"];?>'">
											<h1><?php echo $v["g_title"];?></h1>
										</div>
										<h6 style="clear:both;"></h6>
								</i>
								<i><?php echo $v["g_price"];?></i>
								<i><?php echo $v["num"];?></i>
								<i><?php echo $v["total"];?></i>
								<i>
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
								</i>
								<i>
								<?php if($v["status"]==0){?>
									<a href="javascript:;" class="">等待买家付款</a>
								<?php }elseif($v["status"]==1){?>
									<a href="javascript:;" class="active only_one" onclick="javascript:$('.shay_confirm_receipt').show();fahuo1('<?php echo $v["order_sn"];?>')">商品发货</a>
								<?php }elseif($v["status"]==2){?>
									<a href="javascript:;" class="only_one">等待买家收货</a>
								<?php }elseif($v["status"]==3){?>
									<a href="javascript:;" class="only_one">等待买家评价</a>
								<?php }elseif($v["status"]==4){?>
									<a href="javascript:;" class="active only_one" onclick="javascript:$('.shay_confirm_tuihuanhuo').show();returnorder('<?php echo $v["order_sn"];?>','<?php echo $v["total"];?>')">换货/退货</a><a href="javascript:;" onclick="delorder('<?php echo $v["order_sn"]?>')">删除订单</a>
								<?php }elseif($v["status"]==5){?>
									<a href="javascript:;" class="only_one">已完成</a>
								<?php }elseif($v["status"]==6){?>
									<a href="javascript:;" class="only_one">已完成</a>
								<?php }elseif($v["status"]==7){?>
									<a href="javascript:;" class="only_one">退换货记录</a>
								<?php }elseif($v["status"]==8){?>
									<a href="javascript:;" class="only_one">退换货记录</a><a href="javascript:;" onclick="delorder('<?php echo $v["order_sn"]?>')">删除订单</a>
								<?php }elseif($v["status"]==9){?>
									<a href="javascript:;" class="active">拒绝原因</a>
								<?php }elseif($v["status"]==20){?>
									<a href="javascript:;" class="active only_one" onclick="javascript:$('.shay_confirm_receipt').show();fahuo1('<?php echo $v["order_sn"]?>')">商品发货</a>
								<?php }?>
								</i>
								<h6 style="clear:both;"></h6>
							</li>
							<?php }}else{?>
								暂无订单
							<?php }?>
						</ul>
						<h6 style="clear:both;"></h6>
						<div class="fenye" style="margin-top:20px;">
							<?php if($count>8){?>
								<?php echo $pages;?>
							<?php }?>
						</div>
					</div>
				</div>
				<!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 -->
			</div>
		</div>
	</div>
		<!-- 确认收货弹窗 -->
	<div class="shay_confirm_pay shay_confirm_receipt" style="display:none">
		<div class="layer"></div>
		<div class="box">
			<h1>确认发货 <a href="javascript:;" onclick="javascript:$('.shay_confirm_receipt').hide();"><img src="../attms/images/cclose.jpg" alt="" /></a></h1>
			<h2><i>快递公司：</i><input type="text" name="name" value="" placeholder="请输入快递公司名称" id="kuaidi"></h2>
			<h2><i>物流单号：</i><input type="text" name="name" value="" placeholder="请输入快递单号" id="danhao"></h2>
			<h3><a href="javascript:;" class="a1" onClick="javascript:$('.shay_confirm_receipt').hide();fahuo()">提交</a><a href="javascript:;" class="a2" onClick="javascript:$('.shay_confirm_receipt').hide();">取消</a></h3>
		</div>
	</div>
	<!-- 尾部 -->
	<?php include("tpl/public/bottom.php");?>
	<!-- 尾部结束 -->
<script type="text/javascript">
	$('#left_dl4').show();
	$('#left_dl4').children().first().next().addClass('active');

	//确认收货
	function fahuo1(order_sn){
		localStorage.setItem("order_sn", order_sn);
	}
	function fahuo()
	{
		var logistics_name =$('#kuaidi').val();
		var logistics_sn = $('#danhao').val();
		var tpassword = $("#jessiepassword1").val();
		$.post(RestApi, { c: 'order',a: 'delivery_goods',order_sn:localStorage.getItem("order_sn"),logistics_name:logistics_name,logistics_sn:logistics_sn}, function(response){
			console.log(response);
			var responseObj=$.parseJSON(response);
			if(responseObj.code==200)
			{
				$('.shay_confirm_receipt').hide();
				window.wxc.xcConfirm(responseObj.message,' ');
			}
			else
			{
				$('.shay_confirm_receipt').hide();
				window.wxc.xcConfirm(responseObj.message);
			}
		});
	}
</script>
</body>
</html>
