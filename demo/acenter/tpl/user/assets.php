	<!-- 头部 -->
	<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->
	<div class="inner-wrap">
    	<!-- 商品列表开始 -->
	    <div class="page-maincontent">
	        <!-- 筛选区 -->
			<div class="filter-container">
      			<h1 style="color: #666666;font-size: 14px;padding: 15px 0;">您现在的位置： <a href="portal_index.html" style="color: #666666;">首页</a>&nbsp;&gt;&gt;&nbsp;<a href="javascript:;" style="color: #666666;">用户中心</a></h1>

				<!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 -->
				<div class="user_content">
					<!-- 左侧导航开始 -->
					<?php include("tpl/public/left.php");?>
					<!-- 左侧导航结束 -->
					<!-- 资产明细 -->
					<div class="right tab_zichan">
						<h3>
							<select id="cate">
							<?php foreach($cates as $k=>$v){?>
								<option><?php echo $v;?></option>
							<?php }?>
							</select>
							<a href="<?php echo pfurl('','user','assets',array("condition"=>"今天"))?>" class="active" id="today">今天</a><a href="<?php echo pfurl('','user','assets',array("condition"=>"最近7天"))?>" id="seven">最近7天</a><a href="<?php echo pfurl('','user','assets',array("condition"=>"最近30天"))?>" id="thirty">最近30天</a><a href="<?php echo pfurl('','user','assets',array("condition"=>"最近3个月"))?>" id="threemonth">最近3个月</a><strong><a href="#1F"></a> 账户明细共<i><?php echo $count;?></i>条</strong>
						</h3>
						<ul class="ul1">
							<li><i>编号</i><i>时间</i><i>金额（通用积分）</i><i>事项</i></li>
						</ul>
						<ul class="ul2">
							<?php if(!empty($res)){foreach($res as $k=>$v){?>
								<li><i><?php echo $v["id"];?></i><i><?php echo $v["ctime"];?></i><i><?php echo $v["amount"];?></i><i><?php echo $v["remark"];?></i></li>
							<?php }}else{?>
							    暂无记录
							<?php }?>
						</ul>
						<div class="fenye" style="margin-top:20px;">
							<?php if($count>8){?>
								<?php echo $pages;?>
							<?php }?>
						</div>
					</div>
				</div>
				<!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 -->
			</div>
		</div>
	</div>
	<!-- 尾部 -->
	<?php include("tpl/public/bottom.php");?>
	<!-- 尾部结束 -->
<script type="text/javascript">
	$('#left_dl2').show();
	$('#left_dl2').children().first().addClass('active');
	//获取浏览器地址
	var attr = window.location.href;
	var add2 = decodeURI(attr.split('condition=')[1]);
	if(add2.indexOf("&")!=-1){
		add2 = add2.split('&')[0];
	}
	if(add2 == '今天'){
		$("#today").addClass('active');
		$("#seven").removeClass('active');
		$("#thirty").removeClass('active');
		$("#threemonth").removeClass('active');
	}else if(add2 == "最近7天"){
		$("#today").removeClass('active');
		$("#seven").addClass('active');
		$("#thirty").removeClass('active');
		$("#threemonth").removeClass('active');
	}else if(add2 == "最近30天"){
		$("#today").removeClass('active');
		$("#seven").removeClass('active');
		$("#thirty").addClass('active');
		$("#threemonth").removeClass('active');
	}else if(add2 == "最近3个月"){
		$("#today").removeClass('active');
		$("#seven").removeClass('active');
		$("#thirty").removeClass('active');
		$("#threemonth").addClass('active');
	}

	//资产类型查询
	$("#cate").change(function(){
		var options=$("#cate option:selected");  //获取选中的项
		var remark = options.val();
		window.location.href="index.php?c=user&a=assets&remark="+remark;
	})
</script>
<script type="text/javascript">
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
