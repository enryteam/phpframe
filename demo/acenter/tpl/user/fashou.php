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
					<div class="right my_shop" data-type="" >
						<div class="shop_tab22">
								<ul>
									<?php if($goods){
										foreach ($goods as $key => $vo) {?>
										<li>
											<h1><i>商品代号</i><i class="t">商品品类</i><i>发售数量</i><i>市场价</i><i>发售状态</i><i>发售时间</i><i>操作</i></h1>
												<h2>
														<i><?php echo $vo['code']?></i>
														<i class="t"><span><?php echo $vo['title']?></span></i>
														<i><?php echo $vo['num']?></i>
														<i><?php echo $vo['price']?></i>
														<i style="color:#e03e3f;">
															<?php 
																if($vo['release_status']==0) echo '审核中';
																if($vo['release_status']==1) echo '审核通过';
																if($vo['release_status']==2) echo '审核不通过';
															?>
														</i>
														<i><?php echo date('Y-m-d H:i',$vo['ctime'])?></i>
														<i class="d">
															<?php if($vo['release_status']==0){?>
															<a class="only_one" href="javascript:;" onclick="javascript:del_goods(<?php echo $vo['id']?>)">取消发售</a>
															<?php }elseif ($vo['release_status']==1){?>
															<a class="only_one" href="javascript:;" onclick="javascript:del_goods(<?php echo $vo['id']?>)">取消发售</a>
															<!--<a href="javascript:;" onclick="javascript:window.location.href='<?php echo pfUrl('', 'user', 'fashou_edit',array('goods_id'=>$vo['id']))?>'">编辑发售</a>-->
															<?php }elseif ($vo['release_status']==2) {?>
															<a class="only_one" href="javascript:;" onclick="javascript:window.wxc.xcConfirm('<?php if($vo['reason']) echo $vo['reason']; else echo '未填写原因';?>')">查看原因</a>
															<?php }?>
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
	$('#left_dl5').show();
	$('#left_dl5').children().last().addClass('active');

	//取消商品
	function del_goods(id)
	{
		$.post(RestApi, { c: 'goods',a: 'del_release',goods_id:id}, function(response) {
			var responseObj=$.parseJSON(response);
			window.wxc.xcConfirm(responseObj.message,' ');
		});
	}
</script>
</body>
</html>
