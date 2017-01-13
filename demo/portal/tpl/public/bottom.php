<!-- 尾部 -->
<div class="page-helper" style="margin-top:20px;background-color:#f1f1f1;">
	<div class="inner-wrap">
		<div class="xj-footer-wd clearfix">
			<div class="footer">
				<h6><a href="javascript:;">关于我们</a>&nbsp;|&nbsp;<a href="javascript:;">新手指南</a>&nbsp;|&nbsp;<a href="javascript:;">安全中心</a>&nbsp;|&nbsp;<a href="javascript:;">最新动态</a>&nbsp;|&nbsp;<a href="javascript:;">联系我们</a>&nbsp;|&nbsp;<a href="javascript:;">新生支付</a>&nbsp;|&nbsp;<a href="javascript:;">快递查询</a></h6>
				<h5 style="margin-top:10px;">积交所 ©CopyRight 2016 JJS .Inc Rights Reserved.</h5>
				<h5 style="margin-top:10px;">琼ICP备16001137号-1 <img src="../attms/images/foot1.png" style="vertical-align:middle;margin-left:10px;" /><img src="../attms/images/foot2.png" style="margin-left:10px;vertical-align:middle;" /></h5>
			</div>
		</div>
	</div>
</div>
<script>
$('.left ul li>a').click(function(){
	$(this).siblings('dl').animate({height: 'toggle', opacity: 'toggle'}, "1000");
	$(this).parents('li').siblings('li').children('dl').hide();
});
	/*退出登录*/
	function back(){
		$.post(RestApi, { c: 'login',a: 'logout'}, function(response) {
			console.log(response);
			var responseObj=$.parseJSON(response);
			window.location.href = '../portal/index.php?c=index&a=index';
		});
	}
		//购物车跳转
	function shopcar(realname)
	{
		if(realname == '' || realname == "undefined"){
			window.location.href="../acenter/index.php?c=index&a=login";
		}else{
			window.location.href="../portal/index.php?c=shopcar&a=index";
		}
	}
</script>
<!-- 尾部结束 -->