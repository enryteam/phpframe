	<!-- 头部 -->
	<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->

  <div class="shay_pay">
      <h1>充值</h1>
      <div class="con">
          <div class="top">
              <img src="../attms/images/gantan.png" alt="" />
              <div>
                  <h1>充值需知：</h1>
                  <h2>您的充值额度，由您所持银行卡的网上支付额度，以及银行配置给第三方支付平台的额度来决定。如对实时支付额度信息不明，您可咨询银行方面或者第三方支付平台，如果给您带来不便，还请您谅解，谢谢！充值期间，请勿关闭浏览器，待充值成功并返回后，所充资金才能入账，如有问题，请联系客服400-902-2519 寻求解决；若银行卡已扣款，积交所总资产当中未增加对应充值金额，请稍作等待并刷新页面，超过5分钟还未到账，请及时联系客服处理。</h2>
              </div>
              <h6 style="clear:both;"></h6>
          </div>
          <div class="middle">在充值之前请确认您的充值金额，以免出现充值问题；为了您的账户资金安全，请勿使用他人银行卡进行充值。</div>
          <h1>充值账号：<i><?php echo $phone;?></i><img src="../attms/images/queren.png" alt="" /><b>请确认您正在为该积交所帐号充值</b></h1>
          <h1>充值金额：<input type="text" name="name" value="" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" id="amount">元</h1>
          <div class="center">
              <ul>
                  <li>充值方式：</li>
                  <li class="active" id="pay1">新生支付</li>
                  <li id="pay2">微信支付</li>
                  <li id="pay3">线下汇款充值</li>
                  <h6 style="clear:both;"></h6>
              </ul>
          </div>
          <div class="bottom bottom1" style="display:block;">
              <div>
                  <input type="radio" name="name" value="">
                  <img src="../attms/images/pay1.png" alt="" />
                  <h6 style="clear:both;"></h6>
              </div>
              <h1><a href="javascript:;" onclick="pay();">确定使用新生支付</a></h1>
          </div>
          <div class="bottom bottom2">
              <div>
                  <input type="radio" name="name" value="">
                  <img src="../attms/images/pay2.png" alt="" />
                  <h6 style="clear:both;"></h6>
              </div>
              <h1><a href="javascript:;" onclick="pay();">确定使用微信支付</a></h1>
          </div>
          <div class="bottom bottom3">
              <div>
                  <h1>汇款后请用注册手机号发送充值金额到<i>13976982218</i>或者拨打客服电话<i>400-902-2519</i>，感谢您的支持！</h1>
                  <div>
                      <img src="../attms/images/pay4.png" alt="" />
                      <div>
                          <h1>公司名称：积交所商品发售有限公司</h1>
                          <h1>开户银行：中信银行股份有限公司广州分行营业部</h1>
                          <h1>公司账户：81151111213000012782</h1>
                      </div>
                      <h6 style="clear:both;"></h6>
                  </div>
              </div>
          </div>
      </div>
  </div>





    <!-- 尾部 -->
	<?php include("tpl/public/bottom.php");?>
	<!-- 尾部结束 -->
<script type="text/javascript">
$('.shay_pay>.con>.center>ul>li:not(:nth-child(1))').click(function(){
    $(this).addClass('active').siblings('li').removeClass('active');
});
$('#pay1').click(function(){
    $('.bottom1').show();
    $('.bottom2').hide();
    $('.bottom3').hide();
});
$('#pay2').click(function(){
    $('.bottom2').show();
    $('.bottom1').hide();
    $('.bottom3').hide();
});
$('#pay3').click(function(){
    $('.bottom3').show();
    $('.bottom1').hide();
    $('.bottom2').hide();
});

function pay()
{
	var amount = $("#amount").val();
	$.post(RestApi, { c: 'recharge',a: 'pay',amount:amount}, function(response) {
		var responseObj=$.parseJSON(response);
		window.wxc.xcConfirm(responseObj.message,' ');
	});
}
</script>
</body>
</html>
