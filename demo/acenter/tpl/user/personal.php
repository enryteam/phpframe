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
					<div class="right my_ziliao" data-type="2">
						<div class="ziliao_tab1">
							<h1><i>头像</i><?php if(empty($userdata["head_img"])){?><img src="../attms/images/moren_tou.png" class="moren_tou" /><?php }else{?><img src="<?php echo $userdata["head_img"];?>" class="moren_tou" /><?php }?><input type="file" name="name" value="" onchange="change_touxiang()" id="scflie_morentou"><b>点击更换头像</b></h1>
							<h1><i>我的昵称</i><input type="text" name="name" value="<?php echo $userdata['nickname'];?>" id="nickname"></h1>
							<h1><i>手机号码</i><input type="text" name="name" value="<?php echo $userdata['phone'];?>" readonly></h1>
							<h1><i>绑定邮箱</i><input type="text" name="name" value="<?php echo $userdata['email'];?>" id="email"></h1>
							<h1><i>身份证号</i><input type="text" name="name" value="<?php echo $userdata['idcard'];?>" id="idcard"></h1>
							<h1><i>&nbsp;</i><a href="javascript:;" onclick="javascript:modifyuserdata()">保存</a></h1>
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
	$('#left_dl1').children().first().addClass('active');

	// 个人资料头像
    function change_touxiang() {
		var file    = document.querySelector('#scflie_morentou').files[0];
		var reader  = new FileReader();
		reader.addEventListener("load", function () {
        //preview.src = reader.result;
			$.ajax ({
				type: 'POST',
				url: 'http://apistore.51daniu.cn/rest/index.php',
				dataType: 'json',
				data: {"c":"upfile","a":"img","img":encodeURIComponent(reader.result)},
				success: function(responsex)
				{
					$('.moren_tou').attr('src',responsex.data);
					$('#my_avatar_touxiang').val(responsex.data);
				},
				error: function (data)
				{
					$(".shay_confirm_tishi").show();
					$(".msg").html(data.message);
				}
			});
		}, false);
		if (file) {
			reader.readAsDataURL(file);
		}
    }

	//修改用户基本信息
	function modifyuserdata()
	{
		$.post(RestApi, { c: 'user',a: 'modify_userdata',image:$('#my_avatar_touxiang').val(),nickname:$("#nickname").val(),email:$("#email").val(),idcard:$("#idcard").val(),}, function(response) {
//			console.log(response);
			var responseObj=$.parseJSON(response);
			window.wxc.xcConfirm(responseObj.message,' ');
		});
	}
</script>
</body>
</html>
