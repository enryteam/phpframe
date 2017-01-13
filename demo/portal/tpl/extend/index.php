<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>推广  积交所 JJS.COM</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="description" content="微商平台积交所,基于高频流量入口和资本,发展以微商为核心,依托优质微商全力构建小微企业的超级孵化器,打造社交化和移动电商为主体的交易平台" />
<meta name="keywords" content="积交所（ewabao.com）、积交所网、ewabao、jjs、积交所app、积交所客服、积交所应用、积交所网站注册、积交所小额贷、小贷口子、宝购、积交所应用市场、积交所公益、积交所微商、积交所官网、微商、微商下乡、微商开店、农村电商、在线购物、积交所分销、yiwabao" />
<link href="../attms/css/user_basic.css" rel="stylesheet" media="screen, projection">
<link rel="stylesheet" type="text/css" href="../attms/css/swiper.min.css">
<link rel="stylesheet" href="../attms/css/user_styles.css">
<link rel="stylesheet" href="../attms/css/user_user.css">
<link rel="stylesheet" href="../attms/css/index2.css">
<link rel="stylesheet" href="../attms/css/trading.css">
<link rel="stylesheet" href="../attms/css/shay_confirm.css">
<script src="../attms/js/jquery-1.11.3.js"></script>
<script src="../attms/js/init.js"></script>
<script src="../attms/js/fly.js"></script>
<script src="../attms/js/common.js"></script>
<script src="../attms/js/trading.js"></script>
<script type="text/javascript">
  function fuzhi(){
      var Url2=document.getElementById("fuzhi_content");
  		Url2.select(); // 选择对象
  		document.execCommand("Copy"); // 执行浏览器复制命令
      $('.shay_fuzhi').show();
  }
</script>
</head>
<body class="htdg" style="position:relative;">
  <!-- alert 复制弹出框 -->
  <div class="shay_confirm shay_fuzhi">
     <div class="layer"></div>
     <div class="box_alert">
        <img src="../attms/images/popup_f_close.png" onClick="javascript:$('.shay_fuzhi').hide();" />
        <h1>提示</h1>
        <h2 style="text-align:center;top:120px;">复制成功！</h2>
        <h3 style="top:210px;"><a href="javascript:;" onClick="javascript:$('.shay_fuzhi').hide();">确定</a></h3>
     </div>
  </div>

  <!-- 登录提示弹出框 -->
  <div class="shay_confirm shay_need_login">
     <div class="layer"></div>
     <div class="box_lookred">
        <img src="../attms/images/popup_f_close.png" onClick="javascript:$('.shay_need_login').hide();window.location.href='../acenter/index.php?c=index&a=login'" />
        <h1>提示</h1>
        <h2 style="text-align:center;top:120px;">请先登录</h2>
        <h3 style="top:210px;"><a href="../acenter/index.php?c=index&a=login" onClick="javascript:;">登录</a></h3>
     </div>
  </div>

  <!--header-->
  <?php include("tpl/public/top.php");?>

  <div class="expand">
      <div class="top">
          <div class="top1">
              <img src="<?php echo $mydata['image']?>" alt="" />
              <i><?php echo $mydata['nickname']?></i>
          </div>
          <div class="top2">
              <h1>总收益 <img src="../attms/images/expand1.png" alt="" class="wenhao" /><a href="javascript:;" class="tongji">数据统计 <i><?php echo date('Y-m-d',time())?></i></a></h1>
              <h2><i><?php echo $mydata['extend']?></i>金币 <b><?php echo $mydata['amount']?></b>元现金券</h2>
          </div>
          <div class="top3">
              <h1>推广人数</h1>
              <h2><i><?php echo $mydata['tuser_num']?></i>人</h2>
          </div>
          <div class="top4">
              <a href="../acenter/index.php?c=user&a=extend" class="fanhui">我要推广</a>
          </div>
          <h6 style="clear:both;"></h6>
      </div>
  </div>

  <div class="expand_con">
      <ul>
          <li>
              <div class="top">
                  <h1><i>1</i>机密邀请码</h1>
                  <table>
                      <thead>
                          <tr>
                              <td><?php echo substr($mydata['uid'],0,1)?></td>
                              <td><?php echo substr($mydata['uid'],1,1)?></td>
                              <td><?php echo substr($mydata['uid'],2,1)?></td>
                              <td><?php echo substr($mydata['uid'],3,1)?></td>
                              <td><?php echo substr($mydata['uid'],4,1)?></td>
                              <td><?php echo substr($mydata['uid'],5,1)?></td>
                              <td><?php echo substr($mydata['uid'],6,1)?></td>
                              <td><?php echo substr($mydata['uid'],7,1)?></td>
                              <td><?php echo substr($mydata['uid'],8,1)?></td>
                          </tr>
                      </thead>
                  </table>
                  <h2>我的专属邀请码</h2>
              </div>
              <div class="bottom">
                  您的好友在注册时如果填写了您的邀请码，积交所就认为这个会员是你邀请来注册的。
              </div>
          </li>
          <li>
              <div class="top">
                  <h1><i>2</i>万能邀请链接</h1>
                  <h3><input type="text" value="<?php echo $mydata['invite_links']?>" readonly id="fuzhi_content"></h3>
                  <h2 style="cursor:pointer;" onClick="javascript:fuzhi();" id="click_fuzhi">点击复制</h2>
              </div>
              <div class="bottom">
                  邀请链接发给你的好友，好友打开此链接后系统会默认输入你的邀请码。您还可以通过合作账号直接邀请。
              </div>
          </li>
          <li>
              <div class="top">
                  <h1><i>3</i>神秘二维码</h1>
                  <div>
                      <img src="<?php echo $mydata['head_img']?>" alt="" />
                  </div>
              </div>
              <div class="bottom">
                  保存你的二维码，发送给你的朋友，好友通过扫此二维码注册后系统会默认输入你的邀请码。
              </div>
          </li>
          <h6 style="clear:both;"></h6>
      </ul>
  </div>

  <div class="expand_help">
      <div class="con">
          <div class="left">
              <img src="../attms/images/expand_bg.png" alt="" />
              <a href="index.php?c=helpcenter&a=index">查看推广帮助</a>
          </div>
          <div class="right">
              <table>
                  <thead>
                      <tr>
                          <td></td>
                          <td>实际收益</td>
                          <td>收益说明</td>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td><img src="../attms/images/expand_help1.png" alt="" /><h1>宝购</h1></td>
                          <td><i>1000</i>金币 <i>10元</i>现金券</td>
                          <td>将宝购频道的商品分享出去就可以获得推广奖励</td>
                      </tr>
                      <tr>
                          <td><img src="../attms/images/expand_help2.png" alt="" /><h1>任务</h1></td>
                          <td><i>1000</i>金币 <i>10元</i>现金券</td>
                          <td>将宝购频道的商品分享出去就可以获得推广奖励</td>
                      </tr>
                      <tr>
                          <td><img src="../attms/images/expand_help3.png" alt="" /><h1>会员</h1></td>
                          <td>
                              <h1>黄金：<i>1000</i>金币 <i>10元</i>现金券</h1>
                              <h1>铂金：<i>1000</i>金币 <i>10元</i>现金券</h1>
                              <h1>钻石：<i>1000</i>金币 <i>10元</i>现金券</h1>
                          </td>
                          <td>所有的会员数据是从普通会员注册登录开始录入的，若想获取推广奖励则进行升级至少黄金会员级别以上（普通会员不需投资，当然也不在推广奖励范畴）</td>
                      </tr>
                  </tbody>
              </table>
          </div>
          <h6 style="clear:both;"></h6>
      </div>
  </div>

  <div class="expand_paihang">
      <div class="con">
          <ul>
              <li>
                  <img src="../attms/images/expand_paihang1.png" alt="" />
                  <dl>
                      <dt>
                          <img src="../attms/images/expand_no1.png" class="img1" />
                          <img src="<?php echo $paihang['jinbi'][0]['image']?>" class="img2" />
                          <i><?php echo $paihang['jinbi'][0]['phone']?></i>
                          <b><strong><?php echo $paihang['jinbi'][0]['total']?></strong> 金币</b>
                      </dt>
                      <dt>
                          <img src="../attms/images/expand_no2.png" class="img1" />
                          <img src="<?php echo $paihang['jinbi'][1]['image']?>" class="img2" />
                          <i><?php echo $paihang['jinbi'][1]['phone']?></i>
                          <b><strong><?php echo $paihang['jinbi'][1]['total']?></strong> 金币</b>
                      </dt>
                      <dt>
                          <img src="../attms/images/expand_no3.png" class="img1" />
                          <img src="<?php echo $paihang['jinbi'][2]['image']?>" class="img2" />
                          <i><?php echo $paihang['jinbi'][2]['phone']?></i>
                          <b><strong><?php echo $paihang['jinbi'][2]['total']?></strong> 金币</b>
                      </dt>
					  <?php for($i=3;$i<10;$i++) {?>
						  <dt>
							<a><?php echo $i+1?></a>
							<img src="<?php echo $paihang['jinbi'][$i]['image']?>" class="img2" />
							<i><?php echo $paihang['jinbi'][$i]['phone']?></i>
							<b><strong><?php echo $paihang['jinbi'][$i]['total']?></strong> 金币</b>
						</dt>
					  <?php }?>
                  </dl>
              </li>
              <li>
                  <img src="../attms/images/expand_paihang2.png" alt="" />
                  <dl>
                      <dt>
                          <img src="../attms/images/expand_no1.png" class="img1" />
                          <img src="<?php echo $paihang['quan'][0]['image']?>" class="img2" />
                          <i><?php echo $paihang['quan'][0]['phone']?></i>
                          <b><strong><?php echo $paihang['quan'][0]['amount']/100?></strong> 元现金券</b>
                      </dt>
                      <dt>
                          <img src="../attms/images/expand_no2.png" class="img1" />
                          <img src="<?php echo $paihang['quan'][1]['image']?>" class="img2" />
                          <i><?php echo $paihang['quan'][1]['phone']?></i>
                          <b><strong><?php echo $paihang['quan'][1]['amount']/100?></strong> 元现金券</b>
                      </dt>
                      <dt>
                          <img src="../attms/images/expand_no3.png" class="img1" />
                          <img src="<?php echo $paihang['quan'][2]['image']?>" class="img2" />
                          <i><?php echo $paihang['quan'][2]['phone']?></i>
                          <b><strong><?php echo $paihang['quan'][2]['amount']/100?></strong> 元现金券</b>
                      </dt>
					  <?php for($i=3;$i<10;$i++) {?>
						  <dt>
							<a><?php echo $i+1?></a>
							<img src="<?php echo $paihang['quan'][$i]['image']?>" class="img2" />
							<i><?php echo $paihang['quan'][$i]['phone']?></i>
							<b><strong><?php echo $paihang['quan'][$i]['amount']/100?></strong> 元现金券</b>
						</dt>
					  <?php }?>
                  </dl>
              </li>
              <li>
                  <img src="../attms/images/expand_paihang3.png" alt="" />
                  <dl>
                      <dt>
                          <img src="../attms/images/expand_no1.png" class="img1" />
                          <img src="<?php echo $paihang['quan'][0]['image']?>" class="img2" />
                          <i><?php echo $paihang['quan'][0]['phone']?></i>
						  <span><strong><?php echo $paihang['quan'][0]['amount']/100?></strong> 元</span>
                          <b><strong><?php echo $paihang['quan'][0]['amount']+$paihang['jinbi'][0]['total']?></strong> 金币</b>
                      </dt>
                      <dt>
                          <img src="../attms/images/expand_no2.png" class="img1" />
                          <img src="<?php echo $paihang['quan'][1]['image']?>" class="img2" />
                          <i><?php echo $paihang['quan'][1]['phone']?></i>
						  <span><strong><?php echo $paihang['quan'][1]['amount']/100?></strong> 元</span>
                          <b><strong><?php echo $paihang['quan'][1]['amount']+$paihang['jinbi'][1]['total']?></strong> 金币</b>
                      </dt>
                      <dt>
                          <img src="../attms/images/expand_no3.png" class="img1" />
                          <img src="<?php echo $paihang['quan'][2]['image']?>" class="img2" />
                          <i><?php echo $paihang['quan'][2]['phone']?></i>
						  <span><strong><?php echo $paihang['quan'][2]['amount']/100?></strong> 元</span>
                          <b><strong><?php echo $paihang['quan'][2]['amount']+$paihang['jinbi'][2]['total']?></strong> 金币</b>
                      </dt>
					  <?php for($i=3;$i<10;$i++) {?>
						  <dt>
							<a><?php echo $i+1?></a>
							<img src="<?php echo $paihang['quan'][$i]['image']?>" class="img2" />
							<i><?php echo $paihang['quan'][$i]['phone']?></i>
							<span><strong><?php echo $paihang['quan'][$i]['amount']/100?></strong> 元</span>
							<b><strong><?php echo $paihang['quan'][$i]['amount']+$paihang['jinbi'][$i]['total']?></strong> 金币</b>
						</dt>
					  <?php }?>
                  </dl>
              </li>
              <h6 style="clear:both;"></h6>
          </ul>
      </div>
  </div>





  <!-- 尾部 -->
	<?php include("tpl/public/bottom.php");?>
  <!-- 尾部结束 -->
<script type="text/javascript">
   $(function(){
       $(window).scroll(function() {
       	  if($(window).scrollTop()>=200){
       	     $(".expand").addClass("expand_fixed");
       	  }else{
       	     $(".expand").removeClass("expand_fixed");
       	  }
       });
   });
   $(".fanhui").click(function() {
      $("html,body").animate({scrollTop:0}, 500);
	}); 
	$('#tuiguang').addClass('active');
</script>
<script type="text/javascript">
	//购物车跳转
	function shopcar(realname)
	{
		if(realname == '' || realname == "undefined"){
			window.location.href="../acenter/index.php?c=index&a=login";
		}else{
			window.location.href="<?php echo pfurl('','shopcar','index')?>";
		}
	}

	/*退出登录*/
	function back(){
		$.post(RestApi, { c: 'login',a: 'logout'}, function(response) {
			console.log(response);
			var responseObj=$.parseJSON(response);
			window.location.href = '<?php echo pfurl('','index','index');?>';
		});
	}

	//判断是否登录
	$.post(RestApi, { c: 'user',a: 'myData'}, function(response) {
		console.log(response);
		var responseObj=$.parseJSON(response);
		if(responseObj.code == 403){
			$('.shay_need_login').show();
		}
	});

	//头部搜索
	$("#headertype").change(function(){
		var headertype = $("#headertype").val();
		if(headertype == "商品"){
			$("#contro").val('goods');
		}else if(headertype == "任务"){
			$("#contro").val('task');
		}
	})	
</script>
</body>
</html>
