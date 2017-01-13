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
					<!-- tab 3 我的订单 -->
					                  <!-- tab 4 商城管理 -->
					<div class="right my_shop" data-type="">
						<div class="shop_tab2">
								<h1><a href="<?php echo pfurl('','user','store',array("key"=>"ctime"))?>">上架时间排序</a><a href="<?php echo pfurl('','user','store',array("key"=>"sold"))?>">销量排序</a><a href="<?php echo pfurl('','user','store',array("key"=>"stock"))?>">库存排序</a> <i>已有<b><?php echo $count?></b>个商品 <a href="<?php echo pfurl('','user','good_add')?>">添加商品</a></i></h1>
								<ul>
									<?php if($goods){
										foreach ($goods as $key => $vo) {?>
										<li>
												<h1><i>商品名称</i><i>商品单价（通用积分）</i><i>商品库存</i><i>商品状态</i><i>操作</i></h1>
												<h2>
														<i>
															<img src="<?php echo $vo['img']?>" alt="" />
															<span><?php echo $vo['title']?></span>
															<b style="clear:both;"></b>
														</i>
														<i><?php echo $vo['price']?></i>
														<i><?php echo $vo['stock']?></i>
														<i style="color:#e03e3f;">
															<?php 
																if($vo['status']==0) echo '审核中';
																if($vo['status']==1) echo '审核通过';
																if($vo['status']==2) echo '审核不通过';
															?>
														</i>
														<i>
															<h1><a href="<?php echo pfUrl('', 'user', 'good_edit',array('id'=>$vo['id']))?>">编辑商品</a></h1>
															<h1><a href="javascript:;" onclick="javascript:del_goods(<?php echo $vo['id']?>)">删除商品</a></h1>
														</i>
														<div style="clear:both;"></div>
												</h2>
										</li>
										<?php }}else{?>
											您暂时没有商品
										<?php }?>
								</ul>
							<div class="fenye" style="margin-top:20px;">
								<?php if($count>8) echo $pages;?>
							</div>
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
	$('#left_dl4').show();
	$('#left_dl4').children().first().addClass('active');

	//删除商品
	function del_goods(id)
	{
		$.post(RestApi, { c: 'goods',a: 'del_goods',goods_id:id}, function(response) {
			var responseObj=$.parseJSON(response);
			window.wxc.xcConfirm(responseObj.message,' ');
		});
	}
</script>
</body>
</html>
