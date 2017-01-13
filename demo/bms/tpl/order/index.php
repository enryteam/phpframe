<!-- 头部 -->
	<?php include("tpl/public/top.php");?>
<!-- 头部结束 -->
			<section id="content">
				<section class="vbox">
					<section class="scrollable padder">
						<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
							<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
							<li>商品订单管理</li>
							<li>订单浏览</li>
						</ul>
	  
						<!--内容区-->
						<section class="panel panel-default">
							<header class="panel-heading"> 订单浏览 </header>
							<div class="row text-sm wrapper">
								<form class="form-inline" name="searchform" action="<?php echo pfUrl('','order','index');?>" method="GET" style="margin-left:15px;">
									<input type="hidden" value="order" name="c"> <input type="hidden" value="index" name="a"> <input type="hidden" name="s" value="is_post" />
										
										订单编号&nbsp;&nbsp;<input name="order_sn" class="input-sm form-control" value="<?php echo $_GET['code']; ?>" style="width:150px;margin-right:25px;" placeholder="订单编号"/>
										订单状态&nbsp;&nbsp;<select name="status" class="input-sm form-control input-s-sm inline" style="width:105px;">
											<option value="">--请选择--</option>
											<option value="all">全部</option>
											<option value="no">待付款</option>
											<option value="1">待发货</option>
											<option value="2">待收货</option>
											<option value="completed">已完成</option>
										</select>
										<input type="submit" name="search" class="btn btn-sm btn-default" onClick="return check_form();" value="搜索" style="white-space:nowrap;margin-left:20px;"/>
										<a class="btn btn-sm btn-default" href="<?php echo pfUrl('','order','index');?>" style="white-space:nowrap;">重置</a>
										
								</form>
							</div>
							<div class="table-responsive">
								<table class="table table-striped b-t b-light text-sm">
									<thead>
										<tr role="row">
											<th width="100" colspan="1"  rowspan="1">ID</th>
											<th width="150" colspan="1" rowspan="1">订单编号</th>
											<th colspan="1" rowspan="1">商品名称</th>
											<th width="160" colspan="1" rowspan="1" >订单总额（通用积分）</th>
											<th width="140" colspan="1" rowspan="1">购买数量</th>
											<th width="120" colspan="1" rowspan="1">购买用户</th>
											<th width="120" colspan="1" rowspan="1" >订单状态</th>
											<th width="200" colspan="1" rowspan="1" >下单时间</th>
										</tr>
									</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
									<?php if(!empty($order)){?>
										<?php foreach($order as $key=>$vo){?>
											<tr>
												<td><?php echo $vo["id"];?></td>
												<td><?php echo $vo["order_sn"];?></td>
												<td><?php echo $vo["title"];?></td>
												<td><?php echo $vo["total"];?></td>
												<td><?php echo $vo["num"];?></td>
												<td><?php echo $vo["realname"];?></td>
												<td>
													<?php if($vo["status"]==0){?>
														待付款
													<?php }elseif($vo["status"]==1){?>
														待发货
													<?php }elseif($vo["status"]==2){?>
														待收货
													<?php }elseif($vo["status"]==3){?>
														待评价
													<?php }elseif($vo["status"]==4){?>
														已评价
													<?php }elseif($vo["status"]==5){?>
														订单完成
													<?php }elseif($vo["status"]==6){?>
														交易关闭
													<?php }elseif($vo["status"]==7){?>
														卖家处理中
													<?php }elseif($vo["status"]==8){?>
														卖家同意退款
													<?php }elseif($vo["status"]==9){?>
														卖家拒绝退款
													<?php }elseif($vo["status"]==20){?>
														待发货
													<?php }?>
												</td>
												<td><?php echo date("Y-m-d H:i",$vo["ctime"]);?></td>
											</tr>
										<?php }}else{?>
											<tr>
												<td colspan="12" align="center">没有记录！</td>
											</tr>
									<?php }?>

									</tbody>
								</table>
							</div>
							<footer class="panel-footer">
								<div class="row">
									<div class="col-sm-4 hidden-xs" style="color:#1abc9c;">共&nbsp;<?php echo $count;?>&nbsp;条记录</div>
									<div class="col-sm-4 text-center"> </div>
									<div class="col-sm-4 text-right text-center-xs">
										<ul class="pagination pagination-sm m-t-none m-b-none">
										  <?php if($count>8){?>
											<?php echo $pages;?>
										  <?php }?>
										</ul>
									</div>
								</div>
							</footer>
						</section>
					</section>
				</section>
			</section>
<!-- 尾部 -->
  <?php include("tpl/public/bottom.php");?>
<!-- 尾部结束 -->
<script type="text/javascript">
  $('.top_shangcheng').addClass('active');
	$('.tabtab7').addClass('active');
</script>
</body>
</html>
