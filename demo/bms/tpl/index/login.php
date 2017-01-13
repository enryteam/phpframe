<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>积交所——BMS后台管理系统</title>
<link rel="stylesheet" type="text/css" href="attms/css/style.css" />
<style>
body{height:100%;background:#16a085;overflow:hidden;}
canvas{z-index:-1;position:absolute;}
</style>
<script src="attms/js/jquery.js"></script>
<script src="attms/js/Particleground.js"></script>
<script>
$(document).ready(function() {
  //粒子背景特效
  $('body').particleground({
    dotColor: '#5cbdaa',
    lineColor: '#5cbdaa'
  });
  
});
</script>
<script type="text/javascript" src="attms/js/jquery.form.js"></script>
<script type="text/javascript" src="attms/js/pan_jquery.js"></script>
<script type="text/javascript" src="attms/js/artDialog4.1.7/artDialog.js?skin=twitter"></script>
</head>
<body>
<dl class="admin_login">
<form action="index.php?c=index&a=login" method="post">
 <dt>
  <strong>BMS业务管理系统</strong>
  <em>Business Management System</em>
 </dt>
 <dd class="user_icon">
  <input type="text" placeholder="请输入账号" name="name" class="login_txtbx"/>
 </dd>
 <dd class="pwd_icon">
  <input type="password" placeholder="请输入密码" name="pwd" class="login_txtbx"/>
 </dd>
 <dd>
  <input type="submit" value="立即登陆" class="submit_btn"/> 
 </dd>
</form>
</dl>
</body>
</html>