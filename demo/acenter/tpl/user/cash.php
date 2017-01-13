	<!-- 头部 -->
	<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->

	<div class="shay_cash">
		<h1>提现</h1>
		<div class="con">
			<div class="top">
				<h1>可提现通用积分</h1>
				<h2><i><?php echo $available;?></i> ( 兑换比例 <b>1 通用积分</b> = <b>1 元</b> )</h2>
			</div>
			<ul>
				<li><i>提现账户：</i><?php if(empty($bank_card)){?><input type="text" name="bank_card" value="" placeholder="暂未绑定银行卡" class="bank_card"><a href="<?php echo pfUrl('', 'user', 'bank')?>">绑定银行卡</a><?php }else{?><input type="text" name="bank_card" value="<?php echo $bank_card;?>" class="bank_card" style="cursor: not-allowed;background-color: #eeeeee;" readonly><?php }?></li>
				<li><i>到账时间：</i><b>1-15个工作日</b></li>
				<li><i>提现金额：</i><input type="text" name="name" value="" id="amount" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">通用积分</li>
				<h3>单笔提现金额必须大于 <i>10000</i> 通用积分，小于 <i>5000000</i> 通用积分</h3>
				<li><i>交易密码：</i><input type="password" name="name" value="" id="tpassword"></li>
				<li><i>安全验证：</i><input type="password" name="name" value="" id="SmsCheckCode"><button type="button" name="button" onclick="javascript:btnSendCode('<?php echo $phone;?>')" id="btnSendCode">获取手机验证码</button></li>
				<h4><a href="javascript:;" onclick="javascript:confirm('<?php echo $phone;?>')">确认提交</a></h4>
			</ul>
		</div>
	</div>

    <!-- 尾部 -->
	<?php include("tpl/public/bottom.php");?>
	<!-- 尾部结束 -->
<script type="text/javascript">

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
				//设置button效果，开始计时
				$("#btnSendCode").attr("disabled", true);
				$("#btnSendCode").html(curCount + "秒后重发");
				InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
				//向后台发送处理数据
				$.post(RestApi, { c: 'login',a: 'captcha',phone:phone }, function(response){
					console.log(response);
					var responseObj=$.parseJSON(response);
					window.wxc.xcConfirm(responseObj.message);
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

	//提交提现申请
	function confirm(phone)
	{
		var bank_card = $(".bank_card").val();
		var amount = $("#amount").val();
		var tpassword = $("#tpassword").val();
		var smscode = $("#SmsCheckCode").val();
		
		$.post(RestApi, { c: 'user',a: 'commit_withdraw', type:'1-15个工作日',amount:amount,tpassword:tpassword,smscode:smscode,bank_card:bank_card,phone:phone}, function(response) {
			console.log(response);
			var responseObj=$.parseJSON(response);
			if(responseObj.code == 200){
				window.wxc.xcConfirm(responseObj.message,'<?php echo pfurl('','user','cash')?>');
			}else{
				window.wxc.xcConfirm(responseObj.message);
			}
		});
		
		

	}
</script>
</body>
</html>
