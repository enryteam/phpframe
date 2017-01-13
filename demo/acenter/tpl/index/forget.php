<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>积交所——忘记密码</title>
<link href="../attms/css/user_basic.css" rel="stylesheet" media="screen, projection">
<link rel="stylesheet" href="../attms/css/user_styles.css">
<link rel="stylesheet" href="../attms/css/acenter.css">
<link rel="stylesheet" href="../attms/css/portal.css">
<link rel="stylesheet" href="../attms/css/xcConfirm_web.css">
<script src="../attms/js/jquery-1.11.3.js"></script>
<script src="../attms/js/common.js"></script>
<script src="../attms/js/init.js"></script>
<script src="../attms/js/xcConfirm_web.js"></script>
<script type="text/javascript" src="../attms/highstock/highstock.js"></script>
<script type="text/javascript" src="../attms/highstock/modules/exporting.js"></script>
<style media="screen">
.denglu {
  background: rgba(255, 255, 255, 0.8) none repeat scroll 0 0;
  float: right;
  margin-right: 50px;
  margin-top: 80px;
  width: 370px;
}
.denglu > .content {
  margin: 0 auto;
  padding:20px 0 40px;
  width: 307px;
}
.denglu > .content > h1 {
  color: #e03e3f;
  font-size: 24px;
  margin-bottom: 25px;
  text-align: center;
}
.denglu > .content > h1 > a{
  float:right;
  color:#666;
  font-size: 12px;
  font-weight: normal;
}
.denglu > .content > input[type='text'],.denglu > .content > input[type='password']{
  -webkit-appearance:none;
  -o-appearance:none;
  -moz-appearance:none;
  -ms-appearance:none;
  border:1px solid #cccccc;
  height:40px;
  margin-bottom: 25px;
  padding-left:50px;
  box-sizing:border-box;
  -moz-box-sizing:border-box;
  -webkit-box-sizing:border-box;
  -o-box-sizing:border-box;
  -ms-box-sizing:border-box;
}
.denglu > .content > .input1{
  width:100%;
}
.denglu > .content > .input2{
  width:60%;
}
.denglu > .content > .a1{
  display: inline-block;
  height: 38px;
  background-color: #e03e3f;
  -moz-box-sizing:border-box;
  -webkit-box-sizing:border-box;
  -o-box-sizing:border-box;
  -ms-box-sizing:border-box;
  line-height:38px;
  margin-left: 5px;
  float: right;
  width: 115px;
  border: 0 none;
  color: #ffffff;
}
.denglu > .content > .a2{
  display: inline-block;
  height: 40px;
  width:100%;
  background-color: #e03e3f;
  -moz-box-sizing:border-box;
  -webkit-box-sizing:border-box;
  -o-box-sizing:border-box;
  -ms-box-sizing:border-box;
  line-height: 40px;
  text-align: center;
  color:#fff;
  font-size: 18px;
}
.denglu > .content > .a3{
  display: inline-block;
  height: 40px;
  line-height: 40px;
  -moz-box-sizing:border-box;
  -webkit-box-sizing:border-box;
  -o-box-sizing:border-box;
  -ms-box-sizing:border-box;
  margin-left: 10px;
  color:#666666;
  font-size: 14px;
}
.denglu > .content > h2 > .a3{
  font-size: 16px;
  color: #fff;
}
.denglu > .content > h2 > .a4{
  float:right;
  font-size: 16px;
  color: #fff;
}
</style>
</head>
<body style="position:relative;">
    <div class="" style="width:1200px;margin:0 auto;padding:15px 0;position:relative;">
        <img style="cursor:pointer;" src="../attms/images/logo.png" onclick="javascript:window.location.href='portal_index.html'" />
        <span style="position:absolute;right:120px;top:70px;font-size:14px;color:#666666;">有账号,在此<a href="index.php?c=index&a=login" style="color:#e03e3f;margin-left:5px;">登录</a></span>
    </div>

    <div style="position: ../attms; width: 100%;"></div>

    <div class="beijing" style="width:100%;background:url('../attms/images/login_bg2.png') no-repeat center;height:656px;">
        <div style="width:1200px;margin:0 auto;">
            <div class="denglu">
                <div class="content">
                    <h1>忘记密码</a></h1>
                    <input type="text" placeholder="请输入手机号" class="input1" style="background-image:url('../attms/images/login4.png');background-repeat:no-repeat;" id="phone"/>
                    <input type="text" placeholder="请输入验证码" class="input2" style="background-image:url('../attms/images/login5.png');background-repeat:no-repeat;" id="SmsCheckCode"/>
                    <button type="button" name="button" class="a1" id="btnSendCode">发送验证码</button>
                    <input type="password" placeholder="请输入新密码" class="input1" style="background-image:url('../attms/images/login5.png');background-repeat:no-repeat;" id="newpassword"/>
                    <input type="password" placeholder="请再次输入密码" class="input1" style="background-image:url('../attms/images/login5.png');background-repeat:no-repeat;" id="repassword"/>
                    <a href="javascript:;" class="a2" id="confirmsubmit">确认提交</a>
                </div>
            </div>
        </div>
    </div>

	<!-- 尾部 -->
    <div class="page-helper">
        <div class="inner-wrap">
            <div class="xj-footer-wd clearfix" style="padding-top:0;">
				<div class="footer" style="border-top:0;padding:0;">
					<h6><a href="javascript:;">关于我们</a>&nbsp;|&nbsp;<a href="javascript:;">新手指南</a>&nbsp;|&nbsp;<a href="javascript:;">安全中心</a>&nbsp;|&nbsp;<a href="javascript:;">最新动态</a>&nbsp;|&nbsp;<a href="javascript:;">联系我们</a>&nbsp;|&nbsp;<a href="javascript:;">新生支付</a>&nbsp;|&nbsp;<a href="javascript:;">快递查询</a></h6>
					<h5 style="margin-top:10px;">积交所 ©CopyRight 2016 EWABAO .Inc Rights Reserved.</h5>
					<h5 style="margin-top:10px;">琼ICP备16001137号-1 <img src="../attms/images/foot1.png" style="vertical-align:middle;margin-left:10px;" /><img src="../attms/images/foot2.png" style="margin-left:10px;vertical-align:middle;" /></h5>
				</div>
            </div>
        </div>
    </div>
    <!-- 尾部结束 -->

<script type="text/javascript">
        
	var InterValObj; //timer变量，控制时间
	var count = 60; //间隔函数，1秒执行
	var curCount;//当前剩余秒数
	var code = ""; //验证码
	var codeLength = 6;//验证码长度
	$('#btnSendCode').click(function() {
		curCount = count;
		var phone=$("#phone").val();//手机号码
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
								$("#btnSendCode").style.background="#b7b7b7";
								InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
							}
					});
			}else{
				window.wxc.xcConfirm("手机号码格式不正确！");
			}
		}else{
			window.wxc.xcConfirm("手机号码不能为空！");
		}
		
	});


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
	};/**/
	window.onload = function () {
		var url = window.location.href;
		var url = window.location.href;
		var code = url.substring(url.length-9);
		if(code=='ster.html'){ code = '191835919';}
		$('#yaoqingma').val(code);

	}

	//修改密码
	$('#confirmsubmit').click(function() {
		var phone = $("#phone").val();
		var newpassword = $("#newpassword").val();
		var repassword = $("#repassword").val();
		var SmsCheckCodeVal = $("#SmsCheckCode").val();
		if(phone!="" && repassword != "" && newpassword != "" && SmsCheckCodeVal != ""){
			$.post(RestApi, { c: 'login',a: 'refund',phone:phone,smscode:SmsCheckCodeVal,password:newpassword,repassword:repassword}, function(response){
				console.log(response);
				var responseObj=$.parseJSON(response);
				if(responseObj.code==200){
					window.wxc.xcConfirm(responseObj.message);
					localStorage.setItem("user_id",responseObj.data.user_id);
				}else{

					window.wxc.xcConfirm(responseObj.message);
				};
			});
		}else{
			window.wxc.xcConfirm("请正确完整");
		}
	});

	
	//点击信息提示
	function confirm()
	{
		window.location.href="index.php?c=index&a=login";
	}
</script>
</body>
</html>
