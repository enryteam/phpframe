<?php include("tpl/public/top.php");?>
  <!-- 头部结束 -->
<!-- 消息弹出 -->
  <div class="shay_confirm shay_confirm_tishi">
	 <div class="layer"></div>
	 <div class="box box_chongzhi">
		 <h1>提示 <a href="javascript:;" onclick="javascript:$('.shay_confirm_tishi').hide();"><img src="../attms/images/popup_close.png"/></a></h1>
		 <h2 style="text-align:center;" class="msg">提示信息</h2>
		 <h4 style="position:absolute;bottom:20px;width:504px;"><a href="javascript:;" onclick="javascript:$('.shay_confirm_tishi').hide();">确定</a></h4>
	 </div>
  </div>
  <div class="inner-wrap">
    	 <!-- 商品列表开始 -->
	     <div class="page-maincontent">
	         <!-- 筛选区 -->
           <div class="filter-container">
      	      <div class="filter-title clearfix">
    	           <span style="position:relative; overflow:visible;" class="filter-item">
	                  <a href="index.html" style="color:#666666;">首页</a>&nbsp;&gt;&nbsp;
	                  <a class="handle action-cat-filter" href="user_order.html">用户中心</a>&nbsp;&gt;&nbsp;
					  <a class="handle action-cat-filter" href="user_order.html">我的积交所</a>
                 </span>
              </div>

        <!-- 用户中心开始 --><!-- 用户中心开始 --><!-- 用户中心开始 --><!-- 用户中心开始 --><!-- 用户中心开始 --><!-- 用户中心开始 --><!-- 用户中心开始 -->
              <div class="user_content">
              <!-- 左侧导航开始 -->
			  <?php include("tpl/public/left.php");?>
			  <!-- 左侧导航结束 -->

              <!-- 右侧tabs开始 -->
                  <!--帮助中心-->
                        <div class="tab_datelis_7" id="tab_datelis_7" style="width:70%">
                            <span>
                                <b>帮助中心</b>
                                <a href="javascript:" onclick="tab_list_7_1()">问题反馈</a>
                            </span>
                            <div class="tab_7_content">
                                <ul id="help">


                                </ul>
                            </div>
							<div class="tab_datelis_7_1" id="tab_datelis_7_1">
								<span>问题反馈</span>
								<textarea name="" id="" class="text_1" placeholder="请填写您的问题" id="problem"></textarea>
								<br>
								<textarea name="" id="" class="text_2" placeholder="请输入您的联系方式（QQ,电话，邮箱）" id="contact"></textarea>
								<a href="javascript:" id="feedback">提交</a>
							</div>
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
    $('#xinzeng').click(function(){
        $('.shouhuo').hide();
        $('.xinzeng').show();
    });

    //性别单选框
    $('.sex').click(function(){
        $(this).addClass('active').siblings('.sex').removeClass('active');
    });

    //优惠券tabs
    $('.shiyong1').click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        $('.list1').show();
        $('.list2').hide();
        $('.list3').hide();
    });
    $('.shiyong2').click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        $('.list2').show();
        $('.list1').hide();
        $('.list3').hide();
    });
    $('.shiyong3').click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        $('.list3').show();
        $('.list2').hide();
        $('.list1').hide();
    });

	// 帮助中心
        $.post(RestApi, { c: 'help',a: 'helpCenter'}, function(response) {
            console.log(response);
            var responseObj=$.parseJSON(response);
            var item = '';
            for (var i = 0; i < responseObj.data.length; i++) {
                item +='<li onclick="help_show()"><span><b>'+responseObj.data[i].title+'<\/b><i>'+(responseObj.data[i].ctime).substring(0,10)+'<\/i><\/span><b>回复：<i>'+responseObj.data[i].content+'<\/i><\/b><\/li>';
            }
            $('#help').html(item);
        });
        //问题反馈
        $('#feedback').click(function() {
            var problem = $('#problem').val();
            var contact = $('#contact').val();
            if(problem!=''){
                $.post(RestApi, { c: 'help',a: 'feedback',problem:problem,contact:contact}, function(response) {
                console.log(response);
                var responseObj=$.parseJSON(response);
                $(".shay_confirm_tishi").show();
				$(".msg").html(responseObj.message);
            });
            }else{
				$(".shay_confirm_tishi").show();
				$(".msg").html('问题不能为空');
            }
        });
</script>

<script type="text/javascript">
$('.left ul li').click(function(){
        $(this).addClass('active').siblings().removeClass('active').parent().parent().siblings('.left').children().children('li').removeClass('active');
        $('#renwu1').css('color','#666666');
        $('#renwu2').css('color','#666666');
        $('#more1').css('color','#666666');
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

	//购物车跳转
	function shopcar(realname)
	{
		if(realname == '' || realname == "undefined"){
			window.location.href="../acenter/index.php?c=index&a=login";
		}else{
			window.location.href="../portal/index.php?c=shopcar&a=index";
		}
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
