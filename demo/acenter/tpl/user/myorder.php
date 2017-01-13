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
									<a href="javascript:;" class="active" onclick="javascript:$('.shay_confirm_pay1').show();pay('<?php echo $v["id"];?>','<?php echo $v["total"];?>')">付款</a><a href="javascript:;" onclick="cancleorder('<?php echo $v["order_sn"];?>')">取消订单</a>
								<?php }elseif($v["status"]==1){?>
									<a href="javascript:;" class="active only_one" onclick="javascript:remind('<?php echo $v["order_sn"];?>')">提醒发货</a>
								<?php }elseif($v["status"]==2){?>
									<a href="javascript:;" class="active only_one" onclick="javascript:$('.shay_confirm_receipt').show();receipt('<?php echo $v["order_sn"];?>','<?php echo $v["total"];?>')">确认收货</a>
								<?php }elseif($v["status"]==3){?>
									<a href="javascript:;" class="active only_one" onclick="javascript:$('.shay_confirm_pingjia').show();comment('<?php echo $v["order_sn"];?>')">评价</a>
								<?php }elseif($v["status"]==4){?>
									<a href="javascript:;" class="active only_one" onclick="javascript:$('.shay_confirm_tuihuanhuo').show();returnorder('<?php echo $v["order_sn"];?>','<?php echo $v["total"];?>')">换货/退货</a><a href="javascript:;" onclick="delorder('<?php echo $v["order_sn"]?>')">删除订单</a>
								<?php }elseif($v["status"]==5){?>
									<a href="javascript:;" class="active only_one" onclick="delorder('<?php echo $v["order_sn"]?>')">删除订单</a>
								<?php }elseif($v["status"]==6){?>
									<a href="javascript:;" class="active only_one" onclick="delorder('<?php echo $v["order_sn"]?>')">删除订单</a>
								<?php }elseif($v["status"]==7){?>
									<a href="javascript:;" class="active only_one" onclick="baogou_jilu('<?php echo $v["order_sn"];?>');">退换货记录</a>
								<?php }elseif($v["status"]==8){?>
									<a href="javascript:;" class="active only_one" onclick="baogou_jilu('<?php echo $v["order_sn"];?>');">退换货记录</a><a href="javascript:;" onclick="delorder('<?php echo $v["order_sn"]?>')">删除订单</a>
								<?php }elseif($v["status"]==9){?>
									<a href="javascript:;" class="active">拒绝原因</a><a href="javascript:;" onclick="delorder('<?php echo $v["order_sn"]?>')">删除订单</a>
								<?php }elseif($v["status"]==20){?>
									<a href="javascript:;" class="active only_one" onclick="javascript:$('.shay_confirm_tishi').show();remind('<?php echo $v["order_sn"]?>')">提醒发货</a>
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
			<h1>确认收货 <a href="javascript:;" onclick="javascript:$('.shay_confirm_receipt').hide();"><img src="../attms/images/cclose.jpg" alt="" /></a></h1>
			<h2><i>订单金额：</i><span class="jine"></span></h2>
			<h2><i>支付密码：</i><input type="password" name="name" value="" placeholder="请输入支付密码" id="jessiepassword1"></h2>
			<!--<h2><i>项目三：</i><input type="text" name="name" value="" placeholder="请输入项目三内容"></h2>-->
			<h3><a href="javascript:;" class="a1" onClick="javascript:$('.shay_confirm_receipt').hide();confirm_receipt()">提交</a><a href="javascript:;" class="a2" onClick="javascript:$('.shay_confirm_receipt').hide();">取消</a></h3>
		</div>
	</div>
	<!-- 支付弹窗 -->
	<div class="shay_confirm_pay shay_confirm_pay1" style="display:none">
		<div class="layer"></div>
		<div class="box">
			<h1>订单支付 <a href="javascript:;" onclick="javascript:$('.shay_confirm_pay').hide();"><img src="../attms/images/cclose.jpg" alt="" /></a></h1>
			<h2><i>订单金额：</i><input type="text" name="name" value="<?php echo $detail[0]["total"];?>" id="jessieamount" readonly></h2>
			<h2><i>支付密码：</i><input type="password" name="name" value="" placeholder="请输入支付密码" id="jessiepassword2"></h2>
			<!--<h2><i>项目三：</i><input type="text" name="name" value="" placeholder="请输入项目三内容"></h2>-->
			<h3><a href="javascript:;" class="a1" onClick="javascript:$('.shay_confirm_pay').hide();payorder()">提交</a><a href="javascript:;" class="a2" onClick="javascript:$('.shay_confirm_pay').hide();">取消</a></h3>
		</div>
	</div>
	<!-- 尾部 -->
	<?php include("tpl/public/bottom.php");?>
	<!-- 尾部结束 -->
<script type="text/javascript">
	$('#left_dl3').show();
	$('#left_dl3').children().first().addClass('active');

	//删除订单
	function delorder(id)
	{
		$.post(RestApi, { c: 'order',a: 'del_order',order_sn:id}, function(response) {
			console.log(response);
			var responseObj=$.parseJSON(response);
			window.location.href = '<?php echo pfUrl("","user","myorder")?>';
		});
	}
	//取消订单
	function cancleorder(id)
	{
		$.post(RestApi, { c: 'order',a: 'cancel_order',order_sn:id}, function(response) {
			console.log(response);
			var responseObj=$.parseJSON(response);
			window.location.href = '<?php echo pfUrl("","user","myorder")?>';
		});
	}
	//提醒发货
	function remind(id){
		$.post(RestApi, { c: 'order',a: 'remind_delivery',order_sn:id}, function(response) {
			console.log(response);
			var responseObj=$.parseJSON(response);
			window.wxc.xcConfirm(responseObj.message);
		});
	}

//	//换货、退货
//	function returnorder(id,total){
//		localStorage.setItem("order_sn",id);
//		localStorage.setItem("amount",total);
//	}
//
//	//提交退换货申请
//	function submitreturn()
//	{
//		var type = $('input:radio:checked').val();
//		var reason = $("#reason").val();
//		if(type == '' || reason == ''){
//			$(".shay_confirm_tishi").show();
//			$(".msg").html("请填写完必填项");
//		}else{
//			$.post(RestApi, { c: 'order',a: 'returnorder',order_sn:localStorage.getItem("order_sn"),type:type,reason:reason,amount:localStorage.getItem("amount")}, function(response) {
//				console.log(response);
//				var responseObj=$.parseJSON(response);
//				$(".shay_confirm_tishi").show();
//				$(".msg").html(responseObj.message);
//
//			});
//		}
//	}

	//确认收货
	function receipt(order_sn,total){
		localStorage.setItem("order_sn", order_sn);
		$('.jine').html(total);
	}
	function confirm_receipt(){
		var tpassword = $("#jessiepassword1").val();
		$.post(RestApi, { c: 'order',a: 'confirm_receipt',order_sn:localStorage.getItem("order_sn"),tpassword:tpassword}, function(response){
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



	//订单支付
	function pay(order_sn,total)
	{
		localStorage.setItem("order_sn", order_sn);
		$("#jessieamount").val(total);
	}
	//订单支付
	function payorder()
	{
		var tpassword = $("#jessiepassword2").val();
		$.post(RestApi, { c: 'buy',a: 'checkorder',orderids:localStorage.getItem("order_sn"),tpassword:tpassword}, function(response){
			console.log(response);
			var responseObj=$.parseJSON(response);
			if(responseObj.code==200)
			{
				window.wxc.xcConfirm(responseObj.message,' ');
			}else{
				window.wxc.xcConfirm(responseObj.message);
			}

		});
	}
	//订单评价
	function comment(id)
	{

		$.post(RestApi, { c: 'order',a: 'evaluate',order_sn:id}, function(response){
			console.log(response);
			var responseObj=$.parseJSON(response);
			$("#g_img").attr("src",responseObj.data.g_img);
			$("#g_title").html(responseObj.data.g_title);
			$("#total").html(responseObj.data.total);

			localStorage.setItem("order_sn", id);
			localStorage.setItem("goods_id", responseObj.data.goods_id);
		});
	}

	//提交评价
	function submit_comment()
	{
		var content = $("#content").val();
		$.post(RestApi, { c: 'order',a: 'evaluate_button',order_sn:localStorage.getItem("order_sn"),evaluate:content}, function(response) {
			console.log(response);
			var responseObj=$.parseJSON(response);
			$(".shay_confirm_tishi").show();
			$(".msg").html(responseObj.message);
		});
	}

	//退换货记录
	function baogou_jilu(id)
	{
		window.location.href='index.php?c=user&a=order&return_ordersn='+id;
	}

	//返回我的宝购
	function baogou_jilu_back()
	{
		window.location.href='index.php?c=user&a=order';
	}

    // 订单详情页
    function ding_del(){
        $('.right').hide();
        $('.ding_del').show();
    }

	//退货
	function delivery(id)
	{
		localStorage.setItem("order_sn", id);
	}

	//确认退货
	function deliver_goods()
	{
		var logistics_name = $("#logistics_name option:selected").val();
		var logistics_sn = $("#logistics_sn").val();
		if(logistics_sn == '' || logistics_name == ''){
			$(".shay_confirm_tishi").show();
			$(".msg").html("请将退货信息填写完整");
		}else{
			$.post(RestApi, { c: 'order',a: 'returngoods',order_sn:localStorage.getItem("order_sn"),logistics_name:logistics_name,logistics_sn:logistics_sn}, function(response){
				console.log(response);
				var responseObj=$.parseJSON(response);
				$(".shay_confirm_tishi").show();
				$(".shay_confirm_tishi").show();
				$(".msg").html(responseObj.message);

			});
		}
	}
</script>
</body>
</html>
