<!DOCTYPE html>
<html lang="zh-CN">
<head>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">  <META HTTP-EQUIV="Expires" CONTENT="0">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>交易 积交所 jjs.51daniu.cn</title>
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
<script type="text/javascript" src="../attms/js/trading.js"></script>
<script type="text/javascript" src="../attms/js/swiper.min.js"></script>
<script src="../attms/js/jquery.animateNumber.min.js"></script>
</head>
<body class="htdg" style="position:relative;">
  <!--header-->
<?php include("tpl/public/top.php");?>

  <input type="hidden" class="user_id" value="<?php echo $_SESSION["user_id"]?>" />
  <input type="hidden" class="dig" value="<?php echo $shuju['dig']?>"/>
  <input type="hidden" class="deal" value="<?php echo $shuju['deal']?>"/>
  <input type="hidden" class="purchase" value="<?php echo $shuju['purchase']?>"/>
  <input type="hidden" class="sold" value="<?php echo $shuju['sold']?>"/>
  <input type="hidden" class="coin" value="<?php echo $my['coin']?>"/>
  <input type="hidden" class="wabao_amount" value="<?php echo $my['wabao_amount']?>"/>
  <input type="hidden" class="jiage" value="<?php echo $biaoge['jiage']?>"/>
  <input type="hidden" class="weituo" value="<?php echo $biaoge['weituo']?>"/>
  <input type="hidden" class="chengjiao" value="<?php echo $biaoge['chengjiao']?>"/>
  <input type="hidden" class="chukuang" value="<?php echo $biaoge['chukuang']?>"/>
  <input type="hidden" class="day" value="<?php echo $biaoge['day']?>"/>
  <input type="hidden" class="phone" value="<?php echo $mydata['phone']?>"/>
  <input type="hidden" class="tpassword" value="<?php echo $mydata['tpassword']?>"/>
  <div class="deal_top">
      <div class="con">
          <ul>
              <li>出矿量 <i><label id="st_1">--</label></i></li>
              <li>成交量 <i><label id="st_2">--</label></i></li>
              <li>委托买入 <i><label id="st_3">--</label></i></li>
              <li>委托卖出 <i><label id="st_4">--</label></i></li>
              <h6 style="clear:both;"></h6>
          </ul>
      </div>
  </div>

  <div class="trading-main clear_shay">
      <div class="trading-main-bd clear_shay">
         <div class="trading-main-left fl"  id="tab_1">
			 <!--<div id="container" style="min-width:1200px;height:520px">图表加载中...</div>-->
             <div class="trading-inout clear_shay" id="enryK" style="height:520px; margin-top:30px;background-color:#f5f5f5 ">
               加载中...
             </div>
             <div class="trading-inout clear_shay" style="position:relative;">
                  <div class="trading-in fl" style="float:left;margin-top:44px;">
                      <h3 class="trading-in-hd " style="color:#b1181a;">买入</h3>
                      <ul>
                          <li style="padding-left:30px;font-size:16px;color:#333333;">金额：<span style="color:#1898d1;margin-left:5px;font-size:16px;color:#b1181a;"  id="wabao_amount">--</span><p style="cursor:pointer;background:#b1181a;color:white;font-size:12px;width:95px;height:23px;display:inline-block;line-height:23px;text-align:center;margin-left:10px" id="val_recharge" class="recharge"  onclick="javascript:$('.shay_confirm_chongzhi').show();">可用资金充值</p></li>
                          <li style="font-size:16px;color:#333333;">买入价格： <input style="color:#ccc" type="text" readonly id="danjia" value="<?php echo $coin_price?> 金币" class="round"> </li>
                          <li style="font-size:16px;color:#333333;">买入数量： <input type="text" value="" class="round" id="bbb" onKeyUp="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"></li>
                          <li style="font-size:16px;color:#333333;">当前总价： <i id="zongjia">0</i> 金币</li>
                          <li style="font-size:16px;color:#333333;position:relative;">交易密码：<input type="password" value="" class="round" id="tpassword0" style="background-image:url('../attms/images/psword.png');background-repeat:no-repeat;background-position:165px 2px;padding-right:40px;width:150px;"><a href="javascript:;" style="position:absolute;display:inline-block;width:40px;height:30px;right:85px;" onClick="mima()"></a></li>
                          <li><a class="btn_sole" id="mai_0" href="javascript:;" style="background-color:#b1181a;">买入</a></li>
                      </ul>
                  </div>
                  <div class="trading-in fl" style="float:left;margin-top:44px;">
                      <h3 class="trading-in-hd" style="color:#fb7625;">卖出</h3>
                      <ul>
                          <li style="padding-left:30px;font-size:16px;color:#333333;">数量：<span style="color:#1898d1;margin-left:5px;font-size:16px;color:#fb7625;" id="coin_num" >--</span></li>
                          <li style="font-size:16px;color:#333333;">卖出价格：<input style="color:#ccc" type="text" readonly id="danjia1" value="<?php echo $coin_price?> 金币" class="round"> </li>
                          <li style="font-size:16px;color:#333333;">卖出数量：<input type="text" value="" class="round" id="bbb1"  onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"> </li>
                          <li style="font-size:16px;color:#333333;">当前总价： <i id="zongjia1">0</i> 金币</li>
                          <li style="font-size:16px;color:#333333;position:relative;">交易密码：<input type="password" value="" class="round" id="tpassword1" style="background-image:url('../attms/images/psword.png');background-repeat:no-repeat;background-position:165px 2px;padding-right:40px;width:150px;"><a href="javascript:;" style="position:absolute;display:inline-block;width:40px;height:30px;right:85px;" onClick="mima()"></a></li>
                          <li><a class="btn_sole" id="mai_1" href="javascript:;" style="background-color:#fb7625;">卖出</a></li>
                      </ul>
                  </div>
                  <div class="trading-main-right fl" style="float:left;min-height:984px;">
                      <ul class="trading-main-rihgt-hd clear_shay">
                          <li>时间</li>
                          <li>类型</li>
                          <li>价格</li>
                          <li>数量</li>
                      </ul>
                      <table class="trading-out-content" id="maichu">
						<?php foreach ($chengjiao as $key => $vo) {?>
							<tr><td><?php echo $vo['ctime']?></td>
								<?php if($vo['cate']==0){?>
								<td style="color:#cb0000;">买入</td>
								<?php }else{?>
								<td style="color:#690;">卖出</td>
								<?php }?>
								<td><?php echo $vo['price']?></td>
								<td><?php echo $vo['quantity']?></td>
							</tr>
						<?php }?>
                      </table>
                  </div>
				  <div class="weituo">
						<div class="weituo_in">
							<h1>买入委托</h1>
							<div>
								<ul style="font-size:16px">
									<li>类型</li>
									<li>价格 <span style="font-size:12px;color:#ccc">(金币)</span></li>
									<li>时间</li>
									<h6 style="clear:both;"></h6>
								</ul>
								<div class="mairu">
								<?php foreach ($weituo['mairu'] as $key => $vo) {?>
									<ul><li>买(<?php echo $vo["quantity"];?>)</li><li><?php echo $vo['price']?></li><li><?php echo $vo['ctime']?></li><h6 style="clear:both;"></h6></ul>
								<?php }?>
								</div>
							</div>
						</div>
						<div class="weituo_out">
							<h1>卖出委托</h1>
							<div>
								<ul style="font-size:16px">
									<li>类型</li>
									<li>价格 <span style="font-size:12px;color:#ccc">(金币)</span></li>
									<li>时间</li>
									<h6 style="clear:both;"></h6>
								</ul>
								<div class="maichu">
								<?php foreach ($weituo['maichu'] as $key => $vo) {?>
									<ul><li>卖(<?php echo $vo["quantity"];?>)</li><li><?php echo $vo['price']?></li><li><?php echo $vo['ctime']?></li><h6 style="clear:both;"></h6></ul>
								<?php }?>
								</div>
							</div>
						</div>
						<h6 class="clear:both;"></h6>
					</div>
                  <h6 class="clear:both;"></h6>
              </div>
         </div>
      </div>
   </div>

<?php include("tpl/public/bottom.php");?>

<!-- 设置交易密码弹窗 -->
     <div class="shay_confirm shay_confirm_jiaoyi" style="display:none">
        <div class="layer"></div>
        <div class="box box_deal">
            <h1>设置支付密码 <a href="javascript:;"><img src="../attms/images/popup_close.png" onClick="javascript:$('.shay_confirm_jiaoyi').hide();" /></a></h1>
            <h2><i>新的支付密码：</i><input type="password" value="" class="pwd1"></h2>
            <h2><i>确认支付密码：</i><input type="password" value="" class="pwd2"></h2>
            <h2><i>手机验证码：</i><input type="text" value="" id="smscode"><button type="button" name="button" onClick="fasong()">发送验证码</button></h2>
            <h3><i>&nbsp;</i>向 <b class="my_phone"><?php echo $mydata['phone']?></b> 发送验证码</h3>
            <h4><a href="javascript:;" id="confirm_yes">提交</a></h4>
        </div>
     </div>
<!-- alert 弹出框 -->
  <div class="shay_confirm shay_confirm_tishi">
	 <div class="layer"></div>
	 <div class="box box_chongzhi" style="height:206px;">
		 <h1>提示 <a href="javascript:;" onClick="javascript:$('.shay_confirm_tishi').hide();"><img src="../attms/images/popup_close.png"/></a></h1>
		 <h2 style="text-align:center;" id="shaypop"></h2>
		 <h4 style="position:absolute;bottom:20px;width:504px;"><a href="javascript:;"  onclick="javascript:$('.shay_confirm_tishi').hide();history.go(0);">确定</a></h4>
	 </div>
  </div>
     <!-- 充值弹窗 -->
     <div class="shay_confirm shay_confirm_chongzhi" style="display:none">
        <div class="layer"></div>
        <div class="box box_chongzhi">
            <h1>挖宝账户充值 <a href="javascript:;"><img src="../attms/images/popup_close.png" onClick="javascript:$('.shay_confirm_chongzhi').hide();" /></a></h1>
            <h2><i>转入金额：</i><input type="text" value="" id="amount"></h2>
            <h2><i>支付密码：</i><input type="password" value="" id="tpassword"></h2>
            <h4><a href="javascript:;" id="confirm_recharge">提交</a></h4>
        </div>
     </div>

<!-- 交易K线图 -->
<script src="http://cdn.51daniu.cn/chart/dist/echarts.js"></script>
<script type="text/javascript">
var user_id=$('.user_id').val();
//获取用户信息
	phone=$('.phone').val();
	tpassword=$('.tpassword').val();
//挖宝账户充值
	$('#confirm_recharge').click(function() {
		if(user_id==''||user_id==null){
			window.location.href="/acenter/index.php?c=index&a=login";
		}
        var amount = $('#amount').val();
        var tpassword = $('#tpassword').val();
		$.post(RestApi, { c: 'trade',a: 'wabao_recharge',amount:amount,tpassword:tpassword}, function(response) {
			$('.shay_confirm_chongzhi').hide();
			console.log(response);
			var responseObj=$.parseJSON(response);
			$('#shaypop').html(responseObj.message);
			$('.shay_confirm_tishi').show();
		});
	});


//密码弹窗
	function mima(){
		if(user_id==''||user_id==null){
			window.location.href="/acenter/index.php?c=index&a=login";
		}
		if(tpassword=='' || tpassword==null){
			$('.shay_confirm_jiaoyi').show();
		}else{
			$('#shaypop').html('您已有支付密码');
			$('.shay_confirm_tishi').show();
		}

	}

//发送验证码
	function fasong(){
        var count = 60; //间隔函数，1秒执行
        var i;//当前剩余秒数
        i = count;
        if(phone != ""){
            //产生验证码
            if(phone.match(/^[1][0-9]{10}$/)) {

                if(i != 0){
                    var timer = setInterval(function(){
                        if(i == -1){
                            clearInterval(timer);
                            $("#btnSendCode").attr("onclick",'fasong()');//启用按钮
                            $("#btnSendCode").text("重新发送验证码");
                        }else{
                            $("#btnSendCode").attr('onclick','');
                            $("#btnSendCode").text(i + "秒后重发");
                            --i;
                        }
                    },1000);
                }
                $.post(RestApi, { c: 'login',a: 'captcha',login_phone:phone }, function(response){
                    console.log(response);
                    var responseObj=$.parseJSON(response);
                    $('#shaypop').html(responseObj.message);
					$('.shay_confirm_tishi').show();
                });
            }else{
                     $('#shaypop').html('手机号码格式不正确！');
					$('.shay_confirm_tishi').show();
            }
        }else{
                window.location.href="/acenter/index.php?c=index&a=login";
        }
    }
//确认修改交易密码
	$("#confirm_yes").click(function(){
		var pwd1=$('.pwd1').val();
		var pwd2=$('.pwd2').val();
		var smscode = $("#smscode").val();
		if(pwd1==pwd2){
			$.post(RestApi, { c: 'user',a: 'forgetpwd',update_tpassword:pwd1,smscode:smscode}, function(response){
				console.log(response);
				var responseObj=$.parseJSON(response);
				$('#shaypop').html(responseObj.message);
				$('.shay_confirm_tishi').show();
				$('.shay_confirm_jiaoyi').hide();
			});
		}else{
			$('#shaypop').html('输入的密码不一致,请重新输入');
			$('.shay_confirm_tishi').show();
			$('.pwd1').val('');
			$('.pwd1').va2('');
		}
	});

//计算买入总价
$('#bbb').blur(function(){
	var danjia=parseInt($('#danjia').val());
	var num=$('#bbb').val();
	var zong=danjia*num;
	$('#zongjia').html(zong);
})
//计算卖出总价
$('#bbb1').blur(function(){
	var danjia=parseInt($('#danjia1').val());
	var num=$('#bbb1').val();
	var zong=danjia*num;
	$('#zongjia1').html(zong);
})



//买入
    $('#mai_0').click(function() {
		if(user_id==''||user_id==null){
			window.location.href="/acenter/index.php?c=index&a=login";
		}
        var quantity = $('#bbb').val();
		if(quantity==0||quantity==''||quantity==null){
			$('#shaypop').html('请填写交易数量');
			$('.shay_confirm_tishi').show();
		}else{
			var price = parseInt($('#danjia').val());
			var tpassword = $('#tpassword0').val();
			if(tpassword != ''){
				$.post(RestApi, { c: 'trade',a: 'purchase',quantity:quantity,price:price,tpassword:tpassword}, function(response) {
					console.log(response);
					var responseObj=$.parseJSON(response);
					$('#shaypop').html(responseObj.message);
					$('.shay_confirm_tishi').show();
					
				});
			}else{
				$('#shaypop').html('请填写交易密码');
				$('.shay_confirm_tishi').show();
			}
		}
        
    });
//卖出
    $('#mai_1').click(function() {
		if(user_id==''||user_id==null){
			window.location.href="/acenter/index.php?c=index&a=login";
		}
        var quantity = $('#bbb1').val();
		if(quantity==0||quantity==''||quantity==null){
			$('#shaypop').html('请填写交易数量');
			$('.shay_confirm_tishi').show();
		}else{
			var price = parseInt($('#danjia1').val());
			var tpassword = $('#tpassword1').val();
			if(tpassword != ''){
				$.post(RestApi, { c: 'trade',a: 'sold',quantity:quantity,price:price,tpassword:tpassword}, function(response) {
					console.log(response);
					var responseObj=$.parseJSON(response);
					$('#shaypop').html(responseObj.message);
					$('.shay_confirm_tishi').show();
				});
			}else{
				$('#shaypop').html('请填写交易密码');
				$('.shay_confirm_tishi').show();
			}
		}
    });

//顶部4个数据
	$('#st_1').animateNumber({ number: $('.dig').val()},3000);
	$('#st_2').animateNumber({ number: $('.deal').val() },3000);
	$('#st_3').animateNumber({ number: $('.purchase').val() },3000);
	$('#st_4').animateNumber({ number: $('.sold').val() },3000);
//我的元宝币和总金币
    $('#coin_num').html($('.coin').val());
    $('#wabao_amount').html($('.wabao_amount').val()+'    金币');



</script>
<script src="http://cdn.51daniu.cn/chart/dist/echarts.js"></script>
<script type="text/javascript">

var weituo = $('.weituo').val().split(',');
var chengjiao = $('.chengjiao').val().split(',');
var chukuang = $('.chukuang').val().split(',');
var day = $('.day').val().split(',');
var jiage = $('.jiage').val().split(',');
var data=new Array();
for(var i=0;i<30;i++){
	var data1=new Array();
	data1.push(chukuang[i],jiage[i],weituo[i],chengjiao[i]);
	data.push(data1);
}

//配置路由
	require.config({
       paths: {
           echarts: 'http://cdn.51daniu.cn/chart/dist'
       }
	});
	require(
		[
			'echarts',
			'echarts/chart/line',
			'echarts/chart/bar'// 使用柱状图就加载bar模块，按需加载
		],
		function (ec) {
			// 基于准备好的dom，初始化echarts图表
			var myChart = ec.init(document.getElementById('enryK'));
			var option = {
				tooltip : {
					trigger: 'axis'
				},
				legend: {
					data:['价格','出矿','委托','成交']
				},
				toolbox: {
					show : true,
					feature : {
						mark : {show: true},
						dataView : {show: true, readOnly: false},
						magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
						restore : {show: true},
						saveAsImage : {show: true}
					}
				},
				calculable : true,
				backgroundColor: '#f5f5f5',
				xAxis : [
					{
						type : 'category',
						boundaryGap : false,
						data : day
					}
				],
				yAxis : [
					{
						type : 'value'
					}
				],
				series : [
					{
						name:'价格',
						type:'line',
						stack: '总量',
						itemStyle: {normal: {areaStyle: {type: 'default'}}},
						data:jiage
					},
					{
						name:'出矿',
						type:'line',
						stack: '总量',
						itemStyle: {normal: {areaStyle: {type: 'default'}}},
						data:chukuang
					},
					{
						name:'委托',
						type:'line',
						stack: '总量',
						itemStyle: {normal: {areaStyle: {type: 'default'}}},
						data:weituo
					},
					{
						name:'成交',
						type:'line',
						stack: '总量',
						itemStyle: {normal: {areaStyle: {type: 'default'}}},
						data:chengjiao
					}
				]
			};

                   // 为echarts对象加载数据
                   myChart.setOption(option);
               }
           );
	$('#jiaoyi').addClass('active');

	//购物车跳转
	function shopcar(realname)
	{
		if(realname == '' || realname == "undefined"){
			window.location.href="../acenter/index.php?c=index&a=login";
		}else{
			window.location.href="<?php echo pfurl('','shopcar','index')?>";
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
</script>
</body>
</html>
