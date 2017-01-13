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
					<!-- 订单详情 -->
					<div class="right ding_del">
						<div class="ding_del_top">
							<?php if($detail[0]["status"]==0 || $detail[0]["status"]==1 || $detail[0]["status"]==20) echo "<img src='../attms/images/ding_del_top1.png' alt='' />";elseif($detail[0]["status"]==2) echo "<img src='../attms/images/ding_del_top2.png' alt='' />";elseif($detail[0]["status"]>=3) echo "<img src='../attms/images/ding_del_top3.png' alt='' />";?>
							<ul>
								<li><i>确认订单</i><i>发货</i><i>收货</i><i>交易成功</i></li>
							</ul>
							<dl>
								<dt><?php if(substr($detail[0]["single_time"],0,1) != 0)echo $detail[0]["single_time"];?></dt>
								<dt><?php if(substr($detail[0]["deliver_time"],0,1) != 0)echo $detail[0]["deliver_time"];?></dt>
								<dt><?php if(substr($detail[0]["receipt_time"],0,1) != 0)echo $detail[0]["receipt_time"];?></dt>
								<dt><?php if(substr($detail[0]["complete_time"],0,1) != 0)echo $detail[0]["complete_time"];?></dt>
								<h6 style="clear:both;"></h6>
							</dl>
						</div>
						<?php if(!empty($detail[0]["logistics_name"])){?>
						<div class="ding_del_center">
							<h1><i></i>物流信息</h1>
							<table>
								<tbody>
									<tr>
										<td>发货方式：</td>
										<td>快递</td>
									</tr>
									<tr>
										<td>物流公司：</td>
										<td><?php echo $detail[0]["logistics_name"];?></td>
									</tr>
									<tr>
										<td>运单号码：</td>
										<td><?php echo $detail[0]["logistics_sn"];?> </td>
									</tr>
									<tr>
										<td>物流跟踪：</td>
										<td>以下为物流实时数据：</td>
									</tr>
									<?php if(!empty($logistics)){foreach($logistics as $k=>$v){?>
									<tr>
										<td></td>
										<td><?php echo $v["ftime"];?>    <?php echo $v["context"];?> </td>
									</tr>
									<?php }}?>
								</tbody>
							</table>
						</div>
						<?php }?>
						
						<div class="ding_del_bottom">
							<h1><i></i>订单信息</h1>
							<ul>
								<li>
									<h1><b>收货地址：</b><?php echo $detail[0]["consignee"];?>，<?php echo $detail[0]["phone"]?>，<?php echo $detail[0]["address"]?> ，<?php echo $detail[0]["postcode"]?> </h1>
									<h2><b>买家留言：</b><?php echo $detail[0]["demand"];?></h2>
								</li>
								<li>
									<h1><b>交易商信息</b></h1>
									<h1>企业名称：<?php echo $store[0]["company"];?><strong>真实姓名：<?php echo $store[0]["realname"];?></strong><strong>联系电话：<?php echo $store[0]["phone"];?></strong></h1>
								</li>
								<li style="border-bottom:0;">
									<h1><b>订单信息</b></h1>
									<h1>订单编号：<?php echo $detail[0]["order_sn"];?><strong>创建时间：<?php echo $detail[0]["ctime"];?> </strong></h1>
									<h1>付款时间：<?php if(substr($detail[0]["pay_time"],0,1) != 0)echo $detail[0]["pay_time"];else echo "未付款";?><strong>发货时间：<?php if(substr($detail[0]["deliver_time"],0,1) != 0)echo $detail[0]["deliver_time"];else echo "未发货";?> </strong></h1>
								</li>
							</ul>
							<div>
								<h1><?php echo date("Y-m-d",$detail[0]["ctime"]);?> <i>订单号:<?php echo $detail[0]["order_sn"];?></i><b><img src="../attms/images/dianpu2.png" alt="" /><?php echo $store[0]["company"];?></b></h1>
								<i>
									<img src="<?php echo $detail[0]['g_img']?>"/>
									<div class="left">
										<h1><?php echo $detail[0]["g_title"];?></h1>
									</div>
									<h6 style="clear:both;"></h6>
								</i>
								<i><?php echo $detail[0]["g_price"];?></i>
								<i><?php echo $detail[0]["num"];?></i>
								<i><?php echo $detail[0]["total"];?></i>
								<i>
									<?php if($detail[0]["status"]==0){?>
										待付款
									<?php }elseif($detail[0]["status"]==1){?>
										待发货
									<?php }elseif($detail[0]["status"]==2){?>
										待收货
									<?php }elseif($detail[0]["status"]==3){?>
										待评价
									<?php }elseif($detail[0]["status"]==4){?>
										已评价
									<?php }elseif($detail[0]["status"]==5){?>
										订单完成
									<?php }elseif($detail[0]["status"]==6){?>
										交易关闭
									<?php }elseif($detail[0]["status"]==7){?>
										卖家处理中
									<?php }elseif($detail[0]["status"]==8){?>
										卖家同意退款
									<?php }elseif($detail[0]["status"]==9){?>
										卖家拒绝退款
									<?php }elseif($detail[0]["status"]==20){?>
										待发货
									<?php }?>
								</i>
								<i>
								<?php if($detail[0]["status"]==0){?>
									<a href="javascript:;" class="active only_one"  onclick="javascript:$('.shay_confirm_pay1').show();">付款</a><a href="javascript:;" class="only_one" onclick="cancleorder('<?php echo $detail[0]["order_sn"];?>')">取消订单</a>
								<?php }elseif($detail[0]["status"]==1){?>
									<a href="javascript:;" class="active" onclick="javascript:remind('<?php echo $detail[0]["order_sn"];?>')">提醒发货</a></i>
								<?php }elseif($detail[0]["status"]==2){?>
									<a href="javascript:;" class="active" onclick="javascript:$('.shay_confirm_receipt').show();">确认收货</a>
								<?php }elseif($detail[0]["status"]==3){?>
									<a href="javascript:;" class="active" onclick="javascript:$('.shay_confirm_pingjia').show();comment('//<?php echo $detail[0]["order_sn"];?>')">评价</a>
								<?php }elseif($detail[0]["status"]==4){?>
									<!--<a href="javascript:;" class="active" onclick="javascript:$('.shay_confirm_tuihuanhuo').show();returnorder('<?php echo $detail[0]["order_sn"];?>','<?php echo $detail[0]["total"];?>')">换货/退货</a>--><a href="javascript:;" onclick="delorder('<?php echo $detail[0]["order_sn"];?>')">删除订单</a>
								<?php }elseif($detail[0]["status"]==5){?>
									<a href="javascript:;" class="active" onclick="delorder('<?php echo $detail[0]["order_sn"];?>')">删除订单</a>
								<?php }elseif($detail[0]["status"]==6){?>
									<a href="javascript:;" class="active" onclick="delorder('<?php echo $detail[0]["order_sn"];?>')">删除订单</a>
								<?php }elseif($detail[0]["status"]==7){?>
									<a href="javascript:;" class="active" onclick="baogou_jilu('<?php echo $detail[0]["order_sn"];?>');">退货换记录</a>
								<?php }elseif($detail[0]["status"]==8){?>
									<a href="javascript:;" class="active" onclick="baogou_jilu('<?php echo $detail[0]["order_sn"];?>');">退货换记录</a><a href="javascript:;" onclick="delorder('<?php echo $detail[0]["order_sn"];?>')">删除订单</a>
								<?php }elseif($detail[0]["status"]==9){?>
									<a href="javascript:;" class="active">拒绝原因</a><a href="javascript:;" onclick="delorder('<?php echo $detail[0]["order_sn"];?>')">删除订单</a>
								<?php }elseif($detail[0]["status"]==20){?>
									<a href="javascript:;" class="active" onclick="javascript:remind('<?php echo $detail[0]["order_sn"];?>')">提醒发货</a>
								<?php }?>
								</i>
								<h6 style="clear:both;"></h6>
							</div>
							<h2>订单总金额：<i><?php echo $detail[0]["total"];?></i></h2>
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
			<h2><i>订单金额：</i><?php echo $detail[0]["total"];?></h2>
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
	<input type="hidden" value="<?php echo $detail[0]["order_sn"];?>" class="order_sn"/>
	<input type="hidden" value="<?php echo $detail[0]["gid"];?>" class="gid"/>
	<!-- 尾部 -->
	<?php include("tpl/public/bottom.php");?>
	<!-- 尾部结束 -->
<script type="text/javascript">
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
			if(responseObj.code==200){
				window.wxc.xcConfirm(responseObj.message,' ');
			}else{
				window.wxc.xcConfirm(responseObj.message);
			}
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

	function link(id)
	{
		window.location.href="index.php?c=user&a=order_sn&order_sn="+id;
	}

	//确认收货
	function confirm_receipt(){
		var tpassword = $("#jessiepassword1").val();
		var order_sn = $(".order_sn").val();
		$.post(RestApi, { c: 'order',a: 'confirm_receipt',order_sn:order_sn,tpassword:tpassword}, function(response){
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
	function payorder()
	{
		var tpassword = $("#jessiepassword2").val();
		var order_sn = $(".order_sn").val();
		$.post(RestApi, { c: 'buy',a: 'checkorder',orderids:order_sn,tpassword:tpassword}, function(response){
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
//
//	//订单评价
//	function comment(id)
//	{
//
//		$.post(RestApi, { c: 'order',a: 'evaluate',order_sn:id}, function(response){
//			console.log(response);
//			var responseObj=$.parseJSON(response);
//			$("#g_img").attr("src",responseObj.data.g_img);
//			$("#g_title").html(responseObj.data.g_title);
//			$("#total").html(responseObj.data.total);
//
//			localStorage.setItem("order_sn", id);
//			localStorage.setItem("goods_id", responseObj.data.goods_id);
//		});
//	}
//
//	//提交评价
//	function submit_comment()
//	{
//		var content = $("#jessiepassword3").val();
//		$.post(RestApi, { c: 'order',a: 'evaluate_button',order_sn:localStorage.getItem("order_sn"),evaluate:content}, function(response) {
//			console.log(response);
//			var responseObj=$.parseJSON(response);
//			$(".shay_confirm_tishi").show();
//			$(".msg").html(responseObj.message);
//		});
//	}
//
//	//退换货记录
//	function baogou_jilu(id)
//	{
//		window.location.href='index.php?c=user&a=order&return_ordersn='+id;
//	}
//
//	//返回我的宝购
//	function baogou_jilu_back()
//	{
//		window.location.href='index.php?c=user&a=myorder';
//	}
//
//	//退货
//	function delivery(id)
//	{
//		localStorage.setItem("order_sn", id);
//	}
//
//	//确认退货
//	function deliver_goods()
//	{
//		var logistics_name = $("#logistics_name option:selected").val();
//		var logistics_sn = $("#logistics_sn").val();
//		if(logistics_sn == '' || logistics_name == ''){
//			$(".shay_confirm_tishi").show();
//			$(".msg").html("请将退货信息填写完整");
//		}else{
//			$.post(RestApi, { c: 'order',a: 'returngoods',order_sn:localStorage.getItem("order_sn"),logistics_name:logistics_name,logistics_sn:logistics_sn}, function(response){
//				console.log(response);
//				var responseObj=$.parseJSON(response);
//				$(".shay_confirm_tishi").show();
//				$(".shay_confirm_tishi").show();
//				$(".msg").html(responseObj.message);
//
//			});
//		}
//	}
</script>
</body>
</html>
