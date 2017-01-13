  <!-- 头部 -->
  <?php include("tpl/public/top.php");?>
  <!-- 头部结束 -->
  <!-- 消息弹出 -->
  <div class="shay_confirm shay_confirm_tishi">
	 <div class="layer"></div>
	 <div class="box box_chongzhi">
		 <h1>提示 <a href="javascript:;" onclick="javascript:$('.shay_confirm_tishi').hide();"><img src="../attms/images/popup_close.png"/></a></h1>
		 <h2 style="text-align:center;" class="msg">提示信息</h2>
		 <h4 style="position:absolute;bottom:20px;width:504px;"><a href="javascript:;" onclick="javascript:$('.shay_confirm_tishi').hide();history.go(0)">确定</a></h4>
	 </div>
  </div>
				<!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 -->
				<div class="user_content">
					<!-- 左侧导航开始 -->
					<?php include("tpl/public/left.php");?>
					<!-- 左侧导航结束 -->

					<!-- 右侧tabs开始 -->
					<div class="right tab_jiaoyi" data-type="3">
                      <h3>
					  <a href="index.php?c=user&a=trade&type=委托记录" class="active" onclick="javascript:$(this).addClass('active').siblings('a').removeClass('active');$('.weituo_jilu').show();$('.jiaoyi_jilu').hide();" id="entrust">委托记录(<?php echo $entrust_num;?>条)</a>
					  <a href="index.php?c=user&a=trade&type=交易记录" onclick="javascript:$(this).addClass('active').siblings('a').removeClass('active');$('.weituo_jilu').hide();$('.jiaoyi_jilu').show();" id="trade">交易记录(<?php echo $trade_num;?>条)</a></h3>
                      <ul class="weituo_jilu">
                          <li><i>委托类型</i><i>委托数量</i><i>元宝价格</i><i>委托时间</i><i>交易进度</i><i>操作</i></li>
						  <?php if(!empty($entrust)){foreach($entrust as $k=>$v){?>
							<li><i><?php echo $v["cate"];?></i><i><?php echo $v["quantity"];?></i><i><?php echo $v["price"];?></i><i><?php echo $v["ctime"];?></i><i style="line-height:20px;"><?php if($v["is_del"]==0){?><img src="../attms/images/jindu3.png" alt="" /><h1><strong>买入</strong><strong>委托中</strong><strong>交易成功</strong></h1></i><i><a href="javascript:;" onclick="del_entrust('<?php echo $v["ctime"];?>')">撤销委托</a><?php }else{?><img src="../attms/images/jindu1.png" alt="" /><h1><strong>买入</strong><strong>委托中</strong><strong>交易成功</strong><img src="../attms/images/wenhao.png" onmouseover="$(this).siblings('div').show();" onmouseout="$(this).siblings('div').hide();" /><div>失败原因：<i>价格变化或余额不足</i></div></h1></i><i><a href="javascript:;" class="active">已撤销</a><?php }?></i></li>
						  <?php }}else{?>
							<img src='../attms/images/null.png' style="width:933px;">
						 <?php }?>
                          <h6 style="clear:both;"></h6>
						  <div class="fenye" style="margin-top:20px;">
                               <?php if($entrust_num>8){?>
									<?php echo $pages_entrust;?>
							   <?php }?>
                          </div>
                      </ul>
                      <ul class="jiaoyi_jilu">
                          <li><i>交易类型</i><i>成交数量</i><i>元宝价格</i><i>成交金额</i><i>转入可用余额</i><i>返还挖宝账户</i><i>交易时间</i></li>
						  <?php if(!empty($trade_record)){foreach($trade_record as $k=>$v){?>
							<li><i><?php echo $v["cate"];?></i><i><?php echo $v["quantity"];?></i><i><?php echo $v["price"];?></i><i><?php echo $v["total"];?></i><i><?php echo $v["poundage"];?></i><i><?php echo $v["return_available"];?></i><i><?php echo $v["ctime"];?></i></li>
						  <?php }}else{?>
							<img src='../attms/images/null.png' style="width:933px;">
						  <?php }?>
						  <h6 style="clear:both;"></h6>
                          <div class="fenye" style="margin-top:20px;">

							   <?php if($trade_num>8){?>
									<?php echo $pages_trade;?>
							   <?php }?>
                          </div>
                      </ul>
                  </div>


				</div>
				<!-- 用户中心结束 --><!-- 用户中心结束 --><!-- 用户中心结束 --><!-- 用户中心结束 --><!-- 用户中心结束 --><!-- 用户中心结束 --><!-- 用户中心结束 -->

			</div>
		</div>
	</div>

    <!-- 尾部 -->
	<?php include("tpl/public/bottom.php");?>
    <!-- 尾部结束 -->
<script type="text/javascript">
    $('.left ul li').click(function(){
        $(this).addClass('active').siblings().removeClass('active').parent().parent().siblings('.left').children().children('li').removeClass('active');
        $('#renwu1').css('color','#666666');
        $('#renwu2').css('color','#666666');
    });
    $('.dhl').click(function(){
        var data = $(this).attr('data');
        var objs = $(".right");
        $.each(objs, function () {
           var x = $(this).attr("data-type");
           if(data == x){
              $(this).show();
           }else{
              $(this).hide();
           }
        });
    });
    $('#renwu1').click(function(){
        $('#renwu_choose').addClass('active').siblings().removeClass('active').parent().parent().siblings('.left').children().children('li').removeClass('active');
        $(this).css('color','#c91623');
        $('#renwu2').css('color','#666666');
    });
    $('#renwu2').click(function(){
        $('#renwu_choose').addClass('active').siblings().removeClass('active').parent().parent().siblings('.left').children().children('li').removeClass('active');
        $(this).css('color','#c91623');
        $('#renwu1').css('color','#666666');
    });
</script>
<script type="text/javascript">
$("#jy").addClass("active");
$("#img3").attr("src","../attms/images/user3-red.png");
	/*退出登录*/
	function back(){
		$.post(RestApi, { c: 'login',a: 'logout'}, function(response) {
			console.log(response);
			var responseObj=$.parseJSON(response);
			window.location.href = '../portal/index.php?c=index&a=index';
		});
	}


</script>
<script type="text/javascript">
//任务切换
$('#renwu_choose').click(function(){
        $('#renwu1').css('display','block');
        $('#renwu2').css('display','block');
        $('#more1').css('display','none');
    });
    $('#more_choose').click(function(){
        $('#more1').css('display','block');
        $('#renwu1').css('display','none');
        $('#renwu2').css('display','none');
    });
    $('#renwu1').click(function(){
        $('#renwu_choose').addClass('active').siblings().removeClass('active').parent().parent().siblings('.left').children().children('li').removeClass('active');
        $('#renwu_choose').children('a').children('img').attr('src','../attms/images/user6-red.png');
        $('.user_content>div>.left>ul>li:nth-child(1)').children('a').children('img').attr('src','../attms/images/user1.png');
        $('.user_content>div>.left>ul>li:nth-child(3)').children('a').children('img').attr('src','../attms/images/user3.png');
        $('.user_content>div>.left>ul>li:nth-child(2)').children('a').children('img').attr('src','../attms/images/user2.png');
        $('.user_content>div>.left>ul>li:nth-child(5)').children('a').children('img').attr('src','../attms/images/user5.png');
        $('.user_content>div>.left>ul>li:nth-child(4)').children('a').children('img').attr('src','../attms/images/user4.png');
        $('.user_content>div>.left>ul>li:nth-child(9)').children('a').children('img').attr('src','../attms/images/user7.png');
        $('.user_content>div>.left>ul>li:nth-child(10)').children('a').children('img').attr('src','../attms/images/user8.png');
        $('.user_content>div>.left>ul>li:nth-child(11)').children('a').children('img').attr('src','../attms/images/user9.png');
        $(this).css('color','#c91623');
        $('#renwu2').css('color','#666666');
        $('#more1').css('color','#666666');
    });
    $('#renwu2').click(function(){
        $('#renwu_choose').addClass('active').siblings().removeClass('active').parent().parent().siblings('.left').children().children('li').removeClass('active');
        $('#renwu_choose').children('a').children('img').attr('src','../attms/images/user6-red.png');
        $('.user_content>div>.left>ul>li:nth-child(1)').children('a').children('img').attr('src','../attms/images/user1.png');
        $('.user_content>div>.left>ul>li:nth-child(3)').children('a').children('img').attr('src','../attms/images/user3.png');
        $('.user_content>div>.left>ul>li:nth-child(2)').children('a').children('img').attr('src','../attms/images/user2.png');
        $('.user_content>div>.left>ul>li:nth-child(5)').children('a').children('img').attr('src','../attms/images/user5.png');
        $('.user_content>div>.left>ul>li:nth-child(4)').children('a').children('img').attr('src','../attms/images/user4.png');
        $('.user_content>div>.left>ul>li:nth-child(9)').children('a').children('img').attr('src','../attms/images/user7.png');
        $('.user_content>div>.left>ul>li:nth-child(10)').children('a').children('img').attr('src','../attms/images/user8.png');
        $('.user_content>div>.left>ul>li:nth-child(11)').children('a').children('img').attr('src','../attms/images/user9.png');
        $(this).css('color','#c91623');
        $('#renwu1').css('color','#666666');
        $('#more1').css('color','#666666');
    });
    $('#more1').click(function(){
        $('#more_choose').addClass('active').siblings().removeClass('active').parent().parent().siblings('.left').children().children('li').removeClass('active');
        $('#more_choose').children('a').children('img').attr('src','../attms/images/user9-red.png');
        $('.user_content>div>.left>ul>li:nth-child(1)').children('a').children('img').attr('src','../attms/images/user1.png');
        $('.user_content>div>.left>ul>li:nth-child(3)').children('a').children('img').attr('src','../attms/images/user3.png');
        $('.user_content>div>.left>ul>li:nth-child(2)').children('a').children('img').attr('src','../attms/images/user2.png');
        $('.user_content>div>.left>ul>li:nth-child(5)').children('a').children('img').attr('src','../attms/images/user5.png');
        $('.user_content>div>.left>ul>li:nth-child(4)').children('a').children('img').attr('src','../attms/images/user4.png');
        $('.user_content>div>.left>ul>li:nth-child(6)').children('a').children('img').attr('src','../attms/images/user6.png');
        $('.user_content>div>.left>ul>li:nth-child(9)').children('a').children('img').attr('src','../attms/images/user7.png');
        $('.user_content>div>.left>ul>li:nth-child(10)').children('a').children('img').attr('src','../attms/images/user8.png');
        $(this).css('color','#c91623');
        $('#renwu1').css('color','#666666');
        $('#renwu2').css('color','#666666');
    });
    $('.user_content>div>.left>ul>li:nth-child(1)').click(function(){
        $(this).children('a').children('img').attr('src','../attms/images/user1-red.png');
        $('.user_content>div>.left>ul>li:nth-child(2)').children('a').children('img').attr('src','../attms/images/user2.png');
        $('.user_content>div>.left>ul>li:nth-child(3)').children('a').children('img').attr('src','../attms/images/user3.png');
        $('.user_content>div>.left>ul>li:nth-child(4)').children('a').children('img').attr('src','../attms/images/user4.png');
        $('.user_content>div>.left>ul>li:nth-child(5)').children('a').children('img').attr('src','../attms/images/user5.png');
        $('.user_content>div>.left>ul>li:nth-child(6)').children('a').children('img').attr('src','../attms/images/user6.png');
        $('.user_content>div>.left>ul>li:nth-child(9)').children('a').children('img').attr('src','../attms/images/user7.png');
        $('.user_content>div>.left>ul>li:nth-child(10)').children('a').children('img').attr('src','../attms/images/user8.png');
        $('.user_content>div>.left>ul>li:nth-child(11)').children('a').children('img').attr('src','../attms/images/user9.png');
        $('#more1').css('display','none');
        $('#renwu1').css('display','none');
        $('#renwu2').css('display','none');
    });
    $('.user_content>div>.left>ul>li:nth-child(2)').click(function(){
        $(this).children('a').children('img').attr('src','../attms/images/user2-red.png');
        $('.user_content>div>.left>ul>li:nth-child(1)').children('a').children('img').attr('src','../attms/images/user1.png');
        $('.user_content>div>.left>ul>li:nth-child(3)').children('a').children('img').attr('src','../attms/images/user3.png');
        $('.user_content>div>.left>ul>li:nth-child(4)').children('a').children('img').attr('src','../attms/images/user4.png');
        $('.user_content>div>.left>ul>li:nth-child(5)').children('a').children('img').attr('src','../attms/images/user5.png');
        $('.user_content>div>.left>ul>li:nth-child(6)').children('a').children('img').attr('src','../attms/images/user6.png');
        $('.user_content>div>.left>ul>li:nth-child(9)').children('a').children('img').attr('src','../attms/images/user7.png');
        $('.user_content>div>.left>ul>li:nth-child(10)').children('a').children('img').attr('src','../attms/images/user8.png');
        $('.user_content>div>.left>ul>li:nth-child(11)').children('a').children('img').attr('src','../attms/images/user9.png');
        $('#more1').css('display','none');
        $('#renwu1').css('display','none');
        $('#renwu2').css('display','none');
    });
    $('.user_content>div>.left>ul>li:nth-child(3)').click(function(){
        $(this).children('a').children('img').attr('src','../attms/images/user3-red.png');
        $('.user_content>div>.left>ul>li:nth-child(1)').children('a').children('img').attr('src','../attms/images/user1.png');
        $('.user_content>div>.left>ul>li:nth-child(2)').children('a').children('img').attr('src','../attms/images/user2.png');
        $('.user_content>div>.left>ul>li:nth-child(4)').children('a').children('img').attr('src','../attms/images/user4.png');
        $('.user_content>div>.left>ul>li:nth-child(5)').children('a').children('img').attr('src','../attms/images/user5.png');
        $('.user_content>div>.left>ul>li:nth-child(6)').children('a').children('img').attr('src','../attms/images/user6.png');
        $('.user_content>div>.left>ul>li:nth-child(9)').children('a').children('img').attr('src','../attms/images/user7.png');
        $('.user_content>div>.left>ul>li:nth-child(10)').children('a').children('img').attr('src','../attms/images/user8.png');
        $('.user_content>div>.left>ul>li:nth-child(11)').children('a').children('img').attr('src','../attms/images/user9.png');
        $('#more1').css('display','none');
        $('#renwu1').css('display','none');
        $('#renwu2').css('display','none');
    });
    $('.user_content>div>.left>ul>li:nth-child(4)').click(function(){
        $(this).children('a').children('img').attr('src','../attms/images/user4-red.png');
        $('.user_content>div>.left>ul>li:nth-child(1)').children('a').children('img').attr('src','../attms/images/user1.png');
        $('.user_content>div>.left>ul>li:nth-child(3)').children('a').children('img').attr('src','../attms/images/user3.png');
        $('.user_content>div>.left>ul>li:nth-child(2)').children('a').children('img').attr('src','../attms/images/user2.png');
        $('.user_content>div>.left>ul>li:nth-child(5)').children('a').children('img').attr('src','../attms/images/user5.png');
        $('.user_content>div>.left>ul>li:nth-child(6)').children('a').children('img').attr('src','../attms/images/user6.png');
        $('.user_content>div>.left>ul>li:nth-child(9)').children('a').children('img').attr('src','../attms/images/user7.png');
        $('.user_content>div>.left>ul>li:nth-child(10)').children('a').children('img').attr('src','../attms/images/user8.png');
        $('.user_content>div>.left>ul>li:nth-child(11)').children('a').children('img').attr('src','../attms/images/user9.png');
        $('#more1').css('display','none');
        $('#renwu1').css('display','none');
        $('#renwu2').css('display','none');
    });
    $('.user_content>div>.left>ul>li:nth-child(5)').click(function(){
        $(this).children('a').children('img').attr('src','../attms/images/user5-red.png');
        $('.user_content>div>.left>ul>li:nth-child(1)').children('a').children('img').attr('src','../attms/images/user1.png');
        $('.user_content>div>.left>ul>li:nth-child(3)').children('a').children('img').attr('src','../attms/images/user3.png');
        $('.user_content>div>.left>ul>li:nth-child(2)').children('a').children('img').attr('src','../attms/images/user2.png');
        $('.user_content>div>.left>ul>li:nth-child(4)').children('a').children('img').attr('src','../attms/images/user4.png');
        $('.user_content>div>.left>ul>li:nth-child(6)').children('a').children('img').attr('src','../attms/images/user6.png');
        $('.user_content>div>.left>ul>li:nth-child(9)').children('a').children('img').attr('src','../attms/images/user7.png');
        $('.user_content>div>.left>ul>li:nth-child(10)').children('a').children('img').attr('src','../attms/images/user8.png');
        $('.user_content>div>.left>ul>li:nth-child(11)').children('a').children('img').attr('src','../attms/images/user9.png');
        $('#more1').css('display','none');
        $('#renwu1').css('display','none');
        $('#renwu2').css('display','none');
    });
    $('.user_content>div>.left>ul>li:nth-child(6)').click(function(){
        $(this).children('a').children('img').attr('src','../attms/images/user6-red.png');
        $('.user_content>div>.left>ul>li:nth-child(1)').children('a').children('img').attr('src','../attms/images/user1.png');
        $('.user_content>div>.left>ul>li:nth-child(3)').children('a').children('img').attr('src','../attms/images/user3.png');
        $('.user_content>div>.left>ul>li:nth-child(2)').children('a').children('img').attr('src','../attms/images/user2.png');
        $('.user_content>div>.left>ul>li:nth-child(5)').children('a').children('img').attr('src','../attms/images/user5.png');
        $('.user_content>div>.left>ul>li:nth-child(4)').children('a').children('img').attr('src','../attms/images/user4.png');
        $('.user_content>div>.left>ul>li:nth-child(9)').children('a').children('img').attr('src','../attms/images/user7.png');
        $('.user_content>div>.left>ul>li:nth-child(10)').children('a').children('img').attr('src','../attms/images/user8.png');
        $('.user_content>div>.left>ul>li:nth-child(11)').children('a').children('img').attr('src','../attms/images/user9.png');
    });
    $('.user_content>div>.left>ul>li:nth-child(9)').click(function(){
        $(this).children('a').children('img').attr('src','../attms/images/user7-red.png');
        $('.user_content>div>.left>ul>li:nth-child(1)').children('a').children('img').attr('src','../attms/images/user1.png');
        $('.user_content>div>.left>ul>li:nth-child(3)').children('a').children('img').attr('src','../attms/images/user3.png');
        $('.user_content>div>.left>ul>li:nth-child(2)').children('a').children('img').attr('src','../attms/images/user2.png');
        $('.user_content>div>.left>ul>li:nth-child(5)').children('a').children('img').attr('src','../attms/images/user5.png');
        $('.user_content>div>.left>ul>li:nth-child(4)').children('a').children('img').attr('src','../attms/images/user4.png');
        $('.user_content>div>.left>ul>li:nth-child(6)').children('a').children('img').attr('src','../attms/images/user6.png');
        $('.user_content>div>.left>ul>li:nth-child(10)').children('a').children('img').attr('src','../attms/images/user8.png');
        $('.user_content>div>.left>ul>li:nth-child(11)').children('a').children('img').attr('src','../attms/images/user9.png');
        $('#more1').css('display','none');
        $('#renwu1').css('display','none');
        $('#renwu2').css('display','none');
    });
    $('.user_content>div>.left>ul>li:nth-child(10)').click(function(){
        $(this).children('a').children('img').attr('src','../attms/images/user8-red.png');
        $('.user_content>div>.left>ul>li:nth-child(1)').children('a').children('img').attr('src','../attms/images/user1.png');
        $('.user_content>div>.left>ul>li:nth-child(3)').children('a').children('img').attr('src','../attms/images/user3.png');
        $('.user_content>div>.left>ul>li:nth-child(2)').children('a').children('img').attr('src','../attms/images/user2.png');
        $('.user_content>div>.left>ul>li:nth-child(5)').children('a').children('img').attr('src','../attms/images/user5.png');
        $('.user_content>div>.left>ul>li:nth-child(4)').children('a').children('img').attr('src','../attms/images/user4.png');
        $('.user_content>div>.left>ul>li:nth-child(6)').children('a').children('img').attr('src','../attms/images/user6.png');
        $('.user_content>div>.left>ul>li:nth-child(9)').children('a').children('img').attr('src','../attms/images/user7.png');
        $('.user_content>div>.left>ul>li:nth-child(11)').children('a').children('img').attr('src','../attms/images/user9.png');
        $('#more1').css('display','none');
        $('#renwu1').css('display','none');
        $('#renwu2').css('display','none');
    });
    $('.user_content>div>.left>ul>li:nth-child(11)').click(function(){
        $(this).children('a').children('img').attr('src','../attms/images/user9-red.png');
        $('.user_content>div>.left>ul>li:nth-child(1)').children('a').children('img').attr('src','../attms/images/user1.png');
        $('.user_content>div>.left>ul>li:nth-child(3)').children('a').children('img').attr('src','../attms/images/user3.png');
        $('.user_content>div>.left>ul>li:nth-child(2)').children('a').children('img').attr('src','../attms/images/user2.png');
        $('.user_content>div>.left>ul>li:nth-child(5)').children('a').children('img').attr('src','../attms/images/user5.png');
        $('.user_content>div>.left>ul>li:nth-child(4)').children('a').children('img').attr('src','../attms/images/user4.png');
        $('.user_content>div>.left>ul>li:nth-child(6)').children('a').children('img').attr('src','../attms/images/user6.png');
        $('.user_content>div>.left>ul>li:nth-child(9)').children('a').children('img').attr('src','../attms/images/user7.png');
        $('.user_content>div>.left>ul>li:nth-child(10)').children('a').children('img').attr('src','../attms/images/user8.png');
    });
    $('.tab_zichan>h3>a').click(function(){
        $(this).addClass('active').siblings('a').removeClass('active');
    });

    var ue = UE.getEditor('editor');
	//撤销委托
	function del_entrust(ctime){

		$.post(RestApi, { c: 'user',a: 'del_entrust',ctime:ctime}, function(response) {
			console.log(response);
			var responseObj=$.parseJSON(response);
			$(".shay_confirm_tishi").show();
			$(".msg").html(responseObj.message);
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

	//获取浏览器地址
	var attr = window.location.href;
	var add = decodeURI(attr.split('type=')[1]);
	if(add.split('&')[0] == '交易记录')
	{
		$(".weituo_jilu").hide();
		$(".jiaoyi_jilu").show();
		$("#trade").addClass('active');
		$("#entrust").removeClass('active');
	}else if(add.split('&')[0] == "委托记录")
	{
		$(".weituo_jilu").show();
		$(".jiaoyi_jilu").hide();
		$("#entrust").addClass('active');
		$("#trade").removeClass('active');
	}

	//头部搜索
	$("#headertype").change(function(){
		var headertype = $("#headertype").val();
		if(headertype == "商品"){
			$("#contro").val('goods');
		}else if(headertype == "任务"){
			$("#contro").val('task');
		}
	})

	//店铺判断
	$("#store").click(function(){
		var is_store = <?php echo $is_store;?>;
		if(is_store == 0){
			$(".shay_confirm_tishi").show();
			$(".msg").html("店铺正在审核中……");
		}else{
			window.location.href="<?php echo pfurl('','user','store')?>";
		}
	})
</script>
</body>
</html>
