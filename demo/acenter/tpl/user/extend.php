  <!-- 头部 -->
  <?php include("tpl/public/top.php");?>
  <!-- 头部结束 -->
  <!-- 消息弹出 -->
  <div class="shay_confirm shay_confirm_tishi">
	 <div class="layer"></div>
	 <div class="box box_chongzhi">
		 <h1>提示 <a href="javascript:;" onclick="javascript:$('.shay_confirm_tishi').hide();"><img src="../attms/images/popup_close.png"/></a></h1>
		 <h2 style="text-align:center;" class="msg">提示信息</h2>
		 <h4 style="position:absolute;bottom:20px;width:504px;"><a href="javascript:;" onclick="javascript:$('.shay_confirm_tishi').hide();history.go(0);">确定</a></h4>
	 </div>
  </div>
         <!-- 用户中心开始 --><!-- 用户中心开始 --><!-- 用户中心开始 --><!-- 用户中心开始 --><!-- 用户中心开始 --><!-- 用户中心开始 --><!-- 用户中心开始 -->
              <div class="user_content">
              <!-- 左侧导航开始 -->
			  <?php include("tpl/public/left.php");?>
			  <!-- 左侧导航结束 -->

              <!-- 右侧tabs开始 -->
                  <!--我的推广-->
                  <div class="right my_tuiguang" data-type="8">
                      <img src="../attms/images/my_tuiguang1.png" alt="" />
                      <h2>我已邀请 <i><?php echo $invitenum;?></i> 位好友</h2>
                      <h3>邀请方法</h3>
                      <div>
                          <div>
                              <img src="../attms/images/fangfa1.png" alt="" />
                              <h1>邀请码</h1>
                              <h2>我的邀请码：<i><?php echo $uid;?></i></h2>
                              <h3>你的好友在注册时如果填写了你的邀请码，积交所就认为这个会员是你邀请来注册的。</h3>
                          </div>
                          <div>
                              <img src="../attms/images/fangfa2.png" alt="" />
                              <h1>邀请链接</h1>
                              <h4><input type="text" name="name" value="<?php echo $invite_links;?>" id="invite_links" ><button type="button" name="button" onclick="copyUrl2()">复制</button></h4>
                              <h3>把专属于你的邀请链接发给你的好友，好友打开此链接后系统会默认输入你的邀请码</h3>
                          </div>
                          <div>
                              <img src="../attms/images/fangfa3.png" alt="" />
                              <h1>邀请扫码</h1>
                              <h3>邀请你的好友来扫码，好友扫此二维码后系统会默认输入你的邀请码<img src="<?php echo $head_img;?>" alt="" /></h3>
                          </div>
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
	$("#extend").addClass("active");
	$("#img8").attr("src","../attms/images/user8-red.png");
   
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

	
	function copyUrl2(){
		var Url2=document.getElementById("invite_links");
		Url2.select(); // 选择对象
		document.execCommand("Copy"); // 执行浏览器复制命令
		$(".shay_confirm_tishi").show();
		$(".msg").html("已复制好，可贴粘。");
	 }

	
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
</script>
<script type="text/javascript">
	
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
