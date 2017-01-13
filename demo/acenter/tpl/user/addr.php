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
					<!-- 右侧tabs开始 -->
					<!-- 我的资料 -->
					<div class="right my_ziliao" data-type="5">
						<div class="ziliao_tab4">
						<?php if(!empty($address)){foreach($address as $k=>$v){?>
							<h1><?php echo $v["name"];?>&nbsp;&nbsp;<?php echo $v["phone"];?>&nbsp;&nbsp;<?php echo $v["address"];?>&nbsp;&nbsp;<?php echo $v["postcode"];?> <a href="javascript:;" onclick="del(<?php echo $v['id'];?>)">删除</a></h1>
						<?php }}?>
							<h2><a href="javascript:;"><img src="../attms/images/shouhuo_add.png" alt="" />新增收货地址</a><i>(最多可新增 <b>3</b> 条)</i></h2>
							<div>
								<h1><i>所在地区</i><input type="text" name="name" value="" id="area"></h1>
								<h1><i>详细地址</i><input type="text" name="name" value="" id="address"></h1>
								<h1><i>邮政编码</i><input type="text" name="name" value="" id="postcode"></h1>
								<h1><i>收货人姓名</i><input type="text" name="name" value="" id="name"></h1>
								<h1><i>手机号码</i><input type="text" name="name" value="" id="phone"></h1>
								<h2><i>&nbsp;</i><input type="radio" name="name" value="1">设置为默认收货地址</h2>
								<h1><i>&nbsp;</i><a href="javascript:;" onclick="saveaddress()">保存地址</a></h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="name" value="<?php echo $userdata["head_img"];?>" id="my_avatar_touxiang" />
	<!-- 尾部 -->
	<?php include("tpl/public/bottom.php");?>
	<!-- 尾部结束 -->
    
<script type="text/javascript">
	$('#left_dl1').show();
	$('#left_dl1').children().last().addClass('active');		

	//新增收货地址
	function saveaddress()
	{
		var area = $("#area").val();
		var name = $("#name").val();
		var address = $("#address").val();
		var phone = $("#phone").val();
		var postcode = $("#postcode").val();
		var is_default = $('input:radio:checked').val();
		if(is_default!=1){
			is_default=0;
		}
		$.post(RestApi, { c: 'user',a: 'add_address',realname:name,phone:phone,postcode:postcode,address:address,area:area,is_default:is_default}, function(response) {
				console.log(response);
				var responseObj=$.parseJSON(response);
				window.wxc.xcConfirm(responseObj.message,' ');
		});
		
		
	}

	//删除收货地址
	function del(id)
	{
		$.post(RestApi, { c: 'user',a: 'del_address',id:id}, function(response) {
			console.log(response);
			var responseObj=$.parseJSON(response);
			window.wxc.xcConfirm(responseObj.message,' ');
		});
	}
</script>
</body>
</html>
