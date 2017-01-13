	<!-- 头部 -->
		<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->
	<section id="content">
		<section class="vbox">
			<section class="scrollable padder">
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
					<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
					<li><a href="<?php echo pfurl('','user','index')?>">交易参数</a></li>
					<li><a href="javascript:;">参数设置</a></li>
				</ul>
				
				<div class="row">
					<div class="col-sm-6">
						<div class="w_98 edit_box">
							<section class="panel panel-default">
								<header class="panel-heading"> <strong>参数设置</strong> </header>
								<form action="<?php echo pfurl('','deal','parameter');?>" method="post" class="form-horizontal">
								<input type="hidden" name="id" value="<?php echo $detail['id'];?>">
									<div class="edit_cont">
										<div class="cbox">
											<div class="panel-body">
												<div class="form-group">
													<label class="col-sm-3 control-label">手续费</label>
													<div class="col-sm-9">
													  <input type="text" name="fee" class="form-control" data-required="true" value="<?php echo $detail['fee'];?>"><span class="help-block m-b-none">双边手续费</span>
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">运营中心</label>
													<div class="col-sm-9">
													  <input type="text" name="operate_rate" class="form-control" data-required="true" value="<?php echo $detail['operate_rate'];?>">
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">代理商</label>
													<div class="col-sm-9">
													  <input type="text" name="agent_rate" class="form-control" data-required="true" value="<?php echo $detail['agent_rate'];?>">
													</div>
												</div>
												
											</div>  
											<footer class="panel-footer bg-light lter">
												<button type="submit" class="btn btn-success btn-s-xs text-left">提交</button>
											</footer>
										</div>
									</div>
								</form>
							</section>
						</div>
					</div>
				</div>
			</section>
		</section>
	</section>
		

	<!-- 尾部 -->
		<?php include("tpl/public/bottom.php");?>
	<!-- 尾部结束 -->
	<script type="text/javascript">
	$('.top_jiaoyi').addClass('active');
	$('.tabtab5').addClass('active');
	</script>
</body>
</html>
