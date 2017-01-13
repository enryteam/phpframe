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
					<div class="right my_ziliao" data-type="3">
						<div class="ziliao_tab2">
							<h1><i>支付密码</i><input type="password" name="name" value="" id="tpassword"></h1>
							<h1><i>确认支付密码</i><input type="password" name="name" value="" id="retpassword"></h1>
							<h1 style="margin-bottom:10px;"><i>验证码</i><input type="text" name="name" value="" id="SmsCheckCode"><button type="button" name="button" onclick="btnSendCode('<?php echo $userdata['phone'];?>')" id="btnSendCode">发送验证码</button></h1>
							<h3><i>&nbsp;</i>向 <b><?php echo $hiddenphone;?></b> 发送验证码</h3>
							<h1><i>&nbsp;</i><a href="javascript:;" onclick="modifytpassword('<?php echo $userdata['phone'];?>')">保存</a></h1>
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
	$('#left_dl1').children().first().next().addClass('active');
	//获取短信验证码
	var InterValObj; //timer变量，控制时间
	var count = 60; //间隔函数，1秒执行
	var curCount;//当前剩余秒数
	var code = ""; //验证码
	var codeLength = 6;//验证码长度
	function btnSendCode(phone){
		curCount = count;
		if(phone != ""){
			//产生验证码
			if(phone.match(/^[1][0-9]{10}$/)) {
				for (var i = 0; i < codeLength; i++) {
					code += parseInt(Math.random() * 9).toString();
				}
				
				//向后台发送处理数据
				$.post(RestApi, { c: 'login',a: 'captcha',phone:phone }, function(response){
					console.log(response);
					var responseObj=$.parseJSON(response);
					if(responseObj.code == 200){
						window.wxc.xcConfirm(responseObj.message);
						//设置button效果，开始计时
						$("#btnSendCode").attr("disabled", true);
						$("#btnSendCode").html(curCount + "秒后重发");
						InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
					}
					
				});
			}else{
				window.wxc.xcConfirm("手机号码格式不正确！");
			}
		}else{
			window.wxc.xcConfirm("手机号码不能为空！");
		}
			
	}


	//timer处理函数
	function SetRemainTime() {
			if (curCount == 0) {
					window.clearInterval(InterValObj);//停止计时器
					$("#btnSendCode").removeAttr("disabled");//启用按钮
					$("#btnSendCode").html("重新发送验证码");
					code = ""; //清除验证码。如果不清除，过时间后，输入收到的验证码依然有效
			}
			else {
					curCount--;
					$("#btnSendCode").html(curCount + "秒后重发");
			}
	};

	//设置支付密码
	function modifytpassword(phone)
	{
		if($("#tpassword").val() && $("#retpassword").val() && $("#SmsCheckCode").val()){
			$.post(RestApi, { c: 'user',a: 'tpassword',phone:phone,tpassword:$("#tpassword").val(),retpassword:$("#retpassword").val(),smscode:$("#SmsCheckCode").val() }, function(response){
				console.log(response);
				var responseObj=$.parseJSON(response);
				window.wxc.xcConfirm(responseObj.message,' ');
			});
		}else{
			window.wxc.xcConfirm("请填写完整");
		}
	}
</script>
</body>
</html>
