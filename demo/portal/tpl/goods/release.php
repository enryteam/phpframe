<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>入场登记 积交所 jjs.51daniu.cn</title>
<link href="../attms/css/user_basic.css" rel="stylesheet" media="screen, projection">
<link rel="stylesheet" href="../attms/css/xcConfirm_web.css">
<link rel="stylesheet" href="../attms/css/user_styles.css">
<link rel="stylesheet" href="../attms/css/acenter.css">
<link rel="stylesheet" href="../attms/css/portal.css">
<link rel="stylesheet" href="../attms/css/lyz.calendar.css" type="text/css" />
<script src="../attms/js/jquery-1.11.3.js"></script>
<script src="../attms/js/common.js"></script>
<script type="text/javascript" src="../attms/highstock/highstock.js"></script>
<script type="text/javascript" src="../attms/highstock/modules/exporting.js"></script>
<script type="text/javascript" src="../attms/js/lyz.calendar.min.js"></script>
<script src="../attms/js/xcConfirm_web.js"></script>
<script src="../attms/js/init.js"></script>

</head>
<body>
	<!-- 头部 -->
	<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->

  <div class="portal_deal_center portal_deal_rushi">
    <h1>您现在的位置： <a href="portal_index.html">积交所</a>&nbsp;&gt;&gt;&nbsp;<a href="javascript:;">入场登记</a></h1>
    <div class="rushi">
        <h1><i></i>基本信息</h1>
        <div class="ul">
            <div class="left">
                <h1><i>商品品类：</i><input type="text" name="title" value="" placeholder="请输入商品名称" id="title"></h1>
                <h1><i>市&nbsp;场&nbsp;价：</i><input type="text" name="name" value="" placeholder="请输挂牌场价" id="price"></h1>
            </div>
            <div class="right">
								<h1><i>持仓上限：</i><input type="text" name="name" value="" placeholder="请输入持仓上限" id="holdnum"></h1>
                <h1><i>发售数量：</i><input type="text" name="name" value="" placeholder="请输入发售数量" id="num"></h1>
            </div>
            <h6 style="clear:both;"></h6>
        </div>
        <h1><i></i>申请人基本信息</h1>
        <div class="ul">
            <div class="left">
                <h1><i>姓<em></em>名：</i><input type="text" name="name" value="" placeholder="请输入自然人姓名" id="natural_name"></h1>
                <h1><i>身份证号：</i><input type="text" name="name" value="" placeholder="请输入自然人身份证号" id="natural_idcard"></h1>
            </div>
            <div class="right">
                <h1><i>联系电话：</i><input type="text" name="name" value="" placeholder="请输入自然人联系电话" id="natural_phone"></h1>
                <h1><i>EMAIL：</i><input type="text" name="name" value="" placeholder="请输入自然人邮箱" id="natural_email"></h1>
            </div>
            <h6 style="clear:both;"></h6>
        </div>
        <h1><i></i>申请人承诺</h1>
        <div class="bottom">
            <h1>本人保证所提供的个人资料信息真实、有效、完整，并承诺：已阅读并同意遵守<i>《交易规则》</i>及其他规定。对因违反规定而造成的损失和后果，本人愿意承担相应法律责任。无论申请是否成功，本人均不要求退回申请单及相关资料。</h1>
            <h2><input type="checkbox" name="yes" value="" checked>我已认真阅读并完全理解《积交所发售交易中心交易管理办法》，并已对交易市场其他交易制度和规则有了全面了解，同意遵守交易市场各项管理制度。</h2>
            <h3><a href="javascript:;" onclick="javascript:commit();">提交</a></h3>
            <h4>如有疑问，详情请咨询 <i>400- 352-1020</i></h4>
        </div>
    </div>
  </div>
	<!-- 尾部 -->
	<?php include("tpl/public/bottom.php");?>
	<!-- 尾部结束 -->

<script type="text/javascript">
	//获取浏览器地址
	var attr = window.location.href;
	var add2 = decodeURI(attr.split('a=')[1]);
	if(add2.indexOf("&")!=-1){
		add2 = add2.split('&')[0];
	}
	if(add2 == 'release'){
		$("#release").addClass('active');
	}

	//提交
	function commit()
	{
		var title = $("#title").val();
		var price = $("#price").val();
		var holdnum = $("#holdnum").val();
		var num = $("#num").val();
		var natural_name = $("#natural_name").val();
		var natural_idcard = $("#natural_idcard").val();
		var natural_phone = $("#natural_phone").val();
		var natural_email = $("#natural_email").val();
		var tag=0;
		$(".rushi input[type='text']").each(function () {
			if ($(this).val() == "") {
				tag = 1;
			}
		})
		if(tag==1){
			window.wxc.xcConfirm("信息不能为空，请填写完整！");
		}else{
			if($("input[name='yes']:checked").length){
				$.post(RestApi, { c: 'goods',a: 'release',title:title,price:price,holdnum:holdnum,num:num,natural_name:natural_name,natural_idcard:natural_idcard,natural_phone:natural_phone,natural_email:natural_email}, function(response) {
					console.log(response);
					var responseObj=$.parseJSON(response);
					if(responseObj.code==200){
						window.wxc.xcConfirm(responseObj.message,' ');
					}else{
						window.wxc.xcConfirm(responseObj.message);
					}
				});
			}else{
				window.wxc.xcConfirm("请先阅读开户协议");
			}
		}
	}
</script>
</body>
</html>
