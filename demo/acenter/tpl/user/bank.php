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
					<div class="right my_ziliao" data-type="4">
						<div class="ziliao_tab3">
							<h1><i>真实姓名</i><input type="text" name="name" value="<?php echo $userdata['realname'];?>" id="account_name" readonly></h1>
							<h1><i>开户银行</i><select id="bank">
								<?php foreach($banklist as $k=>$v){?>
									<option value="<?php echo $v["id"];?>" <?php if($bank_id == $v["id"]) echo "selected";?>><?php echo $v["title"];?></option>
								<?php }?>
							</select></h1>
							<h1><i>支行网点</i><input type="text" name="name" value="<?php echo $userdata['branch'];?>" id="branch"></h1>
							<h1><i>银行卡号</i><input type="text" name="name" value="<?php echo $userdata['bank_card'];?>" id="bank_card"></h1>
							<h1><i>&nbsp;</i><a href="javascript:;" onclick="bindcard()">绑定银行卡</a></h1>
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
	$('#left_dl1').children().first().next().next().addClass('active');	
	//绑定银行卡
	function bindcard()
	{
		var bank_id = $("#bank option:selected").val();
		var account_name = $('#account_name').val();
		var bank_card = $('#bank_card').val();
		var branch = $('#branch').val();
		if(account_name == '' || bank_id == '' || bank_card == '' || branch == ''){
			window.wxc.xcConfirm("请将信息填写完整");
		}else{
			$.post(RestApi, { c: 'user',a: 'bindcard',bank_card:bank_card,bank_id:bank_id,branch:branch,realname:account_name}, function(response) {
				console.log(response);
				var responseObj=$.parseJSON(response);
				window.wxc.xcConfirm(responseObj.message,' ');

			});
		} 
	}
</script>
</body>
</html>
