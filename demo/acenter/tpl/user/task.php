  <!-- 头部 -->
  <?php include("tpl/public/top.php");?>
  <!-- 头部结束 -->
  <!-- 取消任务弹窗 -->
  <div class="shay_confirm shay_confirm_task">
     <div class="layer"></div>
     <div class="box box_pay">
         <h1>任务取消处罚金50%<a href="javascript:;"><img src="../attms/images/popup_close.png" onclick="javascript:$('.shay_confirm_task').hide();" /></a></h1>
         <h5></h5>
         <h2><i>支付密码：</i><input type="password" value="" id="tpassword"></h2>
         <h4><a href="javascript:;" onclick="javascript:$('.shay_confirm_task').hide();confirm_cancle()">确认</a></h4>
     </div>
  </div>

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
                  <!-- 进行中的任务 -->
                  <div class="right my_task" data-type="6-1" id="ongoing" style="border:0 none;">
                      <div class="my_task_top">
                          <div>
                              <h1>总收益</h1>
                              <h2><i class="i1"><?php echo $profit;?></i>金币</h2>
                          </div>
                          <div>
                              <h1>今日已完成任务</h1>
                              <h2><i class="i2"><?php echo $todaycompleted;?></i></h2>
                          </div>
                          <div>
                              <h1>今日未完成任务</h1>
                              <h2><i class="i2"><?php echo $todaynocompleted;?></i></h2>
                          </div>
                          <h6 style="clear:both;"></h6>
                      </div>

                      <div class="my_task_bottom" >
                          <ul>
                              <li><i>任务名称</i><i>进度/剩余</i><i>收益<b>(金币)</b></i><i>数量</i><i>全部状态</i><i>操作</i></li>
                              <?php if(!empty($task)){foreach($task as $k=>$v){?>
							  <li>
                                  <h1>领取时间 <?php echo $v["ctime"];?> <i>保证金 <?php echo $v["bond"];?>元</i></h1>
                                  <h2><i><?php echo $v["title"];?></i><i><span><strong style="width:<?php echo $v['progress'];?>;"></strong></span><h1><i style="left:<?php echo $v['progress'];?>;"><?php echo $v['count1'];?>组</i><b>共<?php echo $v["count"];?>组</b></h1></i><i><?php echo $v["reward"];?></i><i><?php echo $v["receive"];?></i><i><?php echo $v["msg"];?></i><i><?php if($v['msg'] == "进行中"){?><a href="<?php echo pfurl('','user','task_detail_begin',array("task_id"=>$v["task_id"],"task_user_id"=>$v["task_user_id"]))?>" class="a1">去做任务</a><?php }else{?><a href="javascript:;" class="a1">今日已完成</a><?php }?><a href="javascript:;" class="a2" onclick="javascript:$('.shay_confirm_task').show();cancle(<?php echo $v['task_id'];?>,<?php echo  $v['task_user_id'];?>)">结束任务</a></i></h2>
                              </li>
                              <?php }}else{?>
								  <img src='../attms/images/null.png' style="width:933px;">
							  <?php }?>
							  <h6 style="clear:both;"></h6>
                              <div class="fenye" style="margin-top:20px;">
                                   <?php if($count>8){?>
										<?php echo $pages;?>
								   <?php }?>
                              </div>
                          </ul>
                      </div>
                  </div>

                  <!-- 已完成的任务 -->
                  <div class="right my_task" data-type="6-2" id="complete" style="border:0 none;">
                      <div class="my_task_top">
                          <div>
                              <h1>总收益</h1>
                              <h2><i class="i1"><?php echo $profit;?></i>金币</h2>
                          </div>
                          <div>
                              <h1>今日已完成任务</h1>
                              <h2><i class="i2"><?php echo $todaycompleted;?></i></h2>
                          </div>
                          <div>
                              <h1>今日未完成任务</h1>
                              <h2><i class="i2"><?php echo $todaynocompleted;?></i></h2>
                          </div>
                          <h6 style="clear:both;"></h6>
                      </div>
                      <div class="my_task_bottom">
                          <ul>
                              <li><i>任务名称</i><i>进度/剩余</i><i>收益<b>(金币)</b></i><i>数量</i><i>全部状态</i><i>操作</i></li>
                              <?php if(!empty($task)){foreach($task as $k=>$v){?>
							  <li>
                                  <h1>领取时间 <?php echo $v["ctime"];?> <i>保证金 <?php echo $v["bond"];?>元</i></h1>
                                  <h2><i><?php echo $v["title"];?></i><i><span><strong style="width:100%;"></strong></span><h1><i style="right:0;"><?php echo $v["count"];?>组</i><b>共<?php echo $v["count"];?>组</b></h1></i><i><?php echo $v["reward"];?></i><i><?php echo $v["receive"];?></i><i>已完成</i><i><a href="javascript:;" class="a3">任务已完成</a></i></h2>
                              </li>
                              <?php }}else{?>
								  <img src='../attms/images/null.png' style="width:933px;">
							  <?php }?>
							  <h6 style="clear:both;"></h6>
                              <div class="fenye" style="margin-top:20px;">
                                   <?php if($count>8){?>
										<?php echo $pages;?>
								   <?php }?>
                              </div>
                          </ul>
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
	/*退出登录*/
	function back(){
		$.post(RestApi, { c: 'login',a: 'logout'}, function(response) {
			console.log(response);
			var responseObj=$.parseJSON(response);
			window.location.href = '../portal/index.php?c=index&a=index';
		});
	}

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

	//获取浏览器地址
	var attr = window.location.href;
	var add1 = decodeURI(attr.split('status=')[1]);

	if(add1.indexOf("&")!=-1){
		add1 = add1.split('&')[0];
	}
	if(add1 == "进行中的任务"){
		$("#img6").attr("src","../attms/images/user6-red.png");
		$('#renwu_choose').addClass('active');
		var task1 = document.getElementById("renwu1");
		var task2 = document.getElementById("renwu2");
		var ongoing = document.getElementById("ongoing");
		var complete = document.getElementById("complete");
		task1.style.display="block";
		task2.style.display="block";
		ongoing.style.display="block";
		complete.style.display="none";

		$('#renwu1').css('color','#c91623');

	}else if(add1 == "已完成的任务"){
		$("#img6").attr("src","../attms/images/user6-red.png");
		$('#renwu_choose').addClass('active');
		var task1 = document.getElementById("renwu1");
		var task2 = document.getElementById("renwu2");
		var ongoing = document.getElementById("ongoing");
		var complete = document.getElementById("complete");
		task1.style.display="block";
		task2.style.display="block";
		ongoing.style.display="none";
		complete.style.display="block";

		$('#renwu2').css('color','#c91623');
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

	//购物车跳转
	function shopcar(realname)
	{
		if(realname == '' || realname == "undefined"){
			window.location.href="../acenter/index.php?c=index&a=login";
		}else{
			window.location.href="../portal/index.php?c=shopcar&a=index";
		}
	}
	//结束任务
	function cancle(task_id,task_user_id)
	{
		localStorage.setItem("task_id",task_id);
		localStorage.setItem("task_user_id",task_user_id);
	}

	//确认取消任务
	function confirm_cancle()
	{
		
		var tpassword = $('#tpassword').val();
		$.post(RestApi, { c: 'task',a: 'cancle_task',task_id:localStorage.getItem("task_id"),task_user_id:localStorage.getItem("task_user_id"),tpassword:tpassword}, function(response) {
			console.log(response);
			var responseObj=$.parseJSON(response);
			$(".shay_confirm_tishi").show();
			$(".msg").html(responseObj.message);
			
		});
	}

	function confirm()
	{
		window.location.href='index.php?c=user&a=task&status=进行中的任务';
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
