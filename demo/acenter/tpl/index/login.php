<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>积交所——登录页</title>
<link href="../attms/css/user_basic.css" rel="stylesheet" media="screen, projection">
<link rel="stylesheet" href="../attms/css/xcConfirm_web.css">
<link rel="stylesheet" href="../attms/css/user_styles.css">
<link rel="stylesheet" href="../attms/css/acenter.css">
<link rel="stylesheet" href="../attms/css/portal.css">
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
  height: 332px;
  margin-right: 50px;
  margin-top: 80px;
  width: 370px;
}
.denglu > .content {
  margin: 0 auto;
  padding:20px 0;
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
  background-color: #f3fbfe;
  -moz-box-sizing:border-box;
  -webkit-box-sizing:border-box;
  -o-box-sizing:border-box;
  -ms-box-sizing:border-box;
  line-height:38px;
  margin-left: 5px;
  float: right;
  width: 115px;
}
.denglu > .content > .a1>img{
  width: 115px;
  height: 38px;
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
.denglu > .content > h2{
  text-align: center;
}
.denglu > .content > h2 > .a4{
  font-size: 16px;
  color: #e03e3f;
}
</style>
</head>
<body style="position:relative;">
    <div class="" style="width:1200px;margin:0 auto;padding:15px 0;">
        <img style="cursor:pointer;" src="../attms/images/logo.png" onclick="javascript:window.location.href='../portal/index.php?c=index&a=index'" />
    </div>

    <div style="position: ../attms; width: 100%;"></div>

    <div class="beijing" style="width:100%;background:url('../attms/images/login_bg1.png') no-repeat center;height:656px;">
        <div style="width:1200px;margin:0 auto;">
            <div class="denglu">
                <div class="content">
                    <h1>登录积交所</a></h1>
                    <input type="text" placeholder="请输入手机号、账号或邮箱" class="input1" id="loginmode" style="background-image:url('../attms/images/login4.png');background-repeat:no-repeat;"/>
                    <input type="password" placeholder="请输入密码" class="input1" id="password" style="background-image:url('../attms/images/login5.png');background-repeat:no-repeat;"/>
                    <a href="javascript:;" class="a2" id="login">登 录</a>
                    <h2 style="margin-top:15px;"><a href="<?php echo pfUrl("","index","forget")?>" class="a4">忘记密码</a></h2>
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
					<h5 style="margin-top:10px;">积交所 ©CopyRight 2016 JJS .Inc Rights Reserved.</h5>
					<h5 style="margin-top:10px;">琼ICP备16001137号-1 <img src="../attms/images/foot1.png" style="vertical-align:middle;margin-left:10px;" /><img src="../attms/images/foot2.png" style="margin-left:10px;vertical-align:middle;" /></h5>
				</div>
            </div>
        </div>
    </div>
    <!-- 尾部结束 -->
	<script type="text/javascript">
	
		/*if(window.attachEvent){ 
			$('.shay_confirm_tishi1').show();
			$('.msg1').html('当前使用的浏览器版本过低，请升级');
		}*/
		//验证并登录
		$('#login').click(function() {
			var loginmode=$("#loginmode").val();
			var password = $("#password").val();
			
			if(password != "" && loginmode != ""){
				$.post(RestApi, { c: 'login',a: 'dologin',loginmode:loginmode,password:password}, function(response){
					console.log(response);
					var responseObj=$.parseJSON(response);
					if(responseObj.code==200){
						localStorage.setItem("user_id",responseObj.data);
						window.location.href='../portal/index.php?c=index&a=index';
					}else{
						window.wxc.xcConfirm(responseObj.message);
					};
				});
			}else{
				window.wxc.xcConfirm("请正确填写用户名和密码");
			}
		});

	</script>
</body>
</html>
