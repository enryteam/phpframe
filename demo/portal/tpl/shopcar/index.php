<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>购物车 积交所 jjs.51daniu.cn</title>
<link href="../attms/css/user_basic.css" rel="stylesheet" media="screen, projection">
<link rel="stylesheet" href="../attms/css/user_styles.css">
<link rel="stylesheet" href="../attms/css/xcConfirm_web.css">
<link rel="stylesheet" href="../attms/css/acenter.css">
<link rel="stylesheet" href="../attms/css/portal.css">
<script src="../attms/js/jquery-1.11.3.js"></script>
<script src="../attms/js/common.js"></script>
<script src="../attms/js/init.js"></script>
<script src="../attms/js/xcConfirm_web.js"></script>
<script type="text/javascript" src="../attms/highstock/highstock.js"></script>
<script type="text/javascript" src="../attms/highstock/modules/exporting.js"></script>
</head>
<body>
	<!-- 头部 -->
	<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->
	
	<div class="shop_car">
		<div>
			<h1><i class="i1">商品信息</i><i class="i2">价格</i><i class="i3">数量</i><i class="i4">总计</i><i class="i5">操作</i></h1>
			<ul>
			<?php if(!empty($allgoods)){foreach($allgoods as $k=>$v){?>
				<li>
					<i class="i1">
						<div class="left">
							<img src="<?php echo $v['img'];?>" alt="" />
						</div>
						<div class="right">
							<h1><?php echo $v["title"];?></h1>
							<h2><?php echo mb_substr($v["intro"],0,30,'utf-8');?></h2>
						</div>
						<h6 style="clear:both;"></h6>
					</i>
					<i class="i2 price"><?php echo $v["price"];?></i>
					<i class="i3"><a href="javascript:;" onClick="down(this)">-</a><input type="text" name="name" value="<?php echo $v['num'];?>" onChange="setTotal(this)" class="input_num" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"><a href="javascript:;" onClick="up(this)">+</a></i>
					<i class="i4 total_all"><?php echo $v["total"];?></i>
					<i class="i5"><a href="javascript:;" onClick="del(<?php echo $v['id'];?>)">删除</a></i>
					<h6 style="clear:both;"></h6>
				</li>
			<?php }}else{?>
				暂无记录
			<?php }?> 
			  
			</ul>
			<h2>合计：<i id="consult">￥<?php echo $sum;?></i><a href="javascript:;" onClick="javascript:gopay();">去结算</a></h2>
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
				window.location.href = '<?php echo pfUrl("","index","index");?>';
			});
		}

		function up(e){
			$(e).siblings('input').val(parseInt($(e).siblings('input').val())+1);
			$(e).parents('i').siblings('.i4').html($(e).parents('i').siblings('.i2').html()*$(e).siblings('input').val());
			$('#consult').html('￥'+parseInt(parseInt($('#consult').html().split('￥')[1])+parseInt($(e).parents('i').siblings('.i2').html())));
		}
		function down(e){
			if($(e).siblings('input').val()>1){
				$(e).siblings('input').val(parseInt($(e).siblings('input').val())-1);
				$(e).parents('i').siblings('.i4').html($(e).parents('i').siblings('.i2').html()*$(e).siblings('input').val());
				$('#consult').html('￥'+parseInt(parseInt($('#consult').html().split('￥')[1])-parseInt($(e).parents('i').siblings('.i2').html())));
			}
		}
		//手动输入价格变动
		function setTotal(e)
		{
			$('#consult').html('￥'+<?php echo $sum;?>);
			var num = $(e).val();
			if(num==null||num=='')
			{
			num = 0;
			$(e).val(0)
			}
			if(/\D/.test($(e).val())){//检查用户输入的值是否是数字
				
				$("#shaypop").html("请您输入正确的数量");
				$('.shay_confirm_tishi').show();
			}
			else{//如果输入合法
				if($(e).val() > 10){
					//confirm("您真的准备一次购买这么多？");
					window.wxc.xcConfirm("您真的准备一次购买这么多？");
				}else{
					$(e).parents('h1').siblings('b').html($(e).parents('h1').siblings('i').html()*$(e).val());
					var total = 0;
					$('.total_all').each(function(){
						total += parseInt($(this).html());
					});
					$('#consult').html(total);

				}
			}
		}


		//去结算更新购物车
		function gopay(){
			var arr = [];
			var item = '';
			$('.input_num').each(function(){
				arr.push($(this).val());
			});
			for(var i=0;i<arr.length;i++){
				item += arr[i] + ',';
			}
			$.post(RestApi, { c: 'buy',a: 'update_shopcar',arr:item}, function(response) {
				console.log(response);
				var responseObj=$.parseJSON(response);
				if(responseObj.code == 500){
					
					window.wxc.xcConfirm(responseObj.message);
				}else{
					window.location.href="<?php echo pfurl('','shopcar','confirm')?>";
				}
			});
		}
		//删除购物车宝贝
		function del(id)
		{
			$.post(RestApi, { c: 'buy',a: 'del_goods',id:id}, function(response) {
				console.log(response);
				var responseObj=$.parseJSON(response);
				if(responseObj.code == 500){
					window.wxc.xcConfirm(responseObj.message);
					
				}else{
					window.location.href="<?php echo pfurl('','shopcar','index')?>";
				}
			});
		}

		//购物车跳转
		function shopcar(realname)
		{
			if(realname == '' || realname == "undefined"){
				window.location.href="../acenter/index.php?c=index&a=login";
			}else{
				window.location.href="<?php echo pfurl('','shopcar','index')?>";
			}
		}
	</script>
</body>
</html>
