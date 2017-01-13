	<!-- 头部 -->
		<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->
	<section id="content">
		<section class="vbox">
			<section class="scrollable padder">
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
					<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
					<li>友情链接管理</li>
					<li>友情链接编辑</li>
				</ul>
				<div class="row">
					<div class="col-sm-6">
						<div class="w_98 edit_box">
							<section class="panel panel-default">
								<header class="panel-heading"> <strong>友情链接编辑</strong> </header>
								<form action="<?php echo pfurl('','link','edit');?>" method="post" class="form-horizontal">
								<input type="hidden" name="id" value="<?php echo $detail['id'];?>">
									<div class="edit_cont">
										<div class="cbox">
											<div class="panel-body">
												<div class="form-group">
													<label class="col-sm-3 control-label">名称</label>
													<div class="col-sm-9">
														<input type="text" name="title" class="form-control" value="<?php echo $detail['title'];?>">
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">链接</label>
													<div class="col-sm-9">
														<input type="text" name="link" class="form-control" value="<?php echo $detail['link'];?>">
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">是否显示</label>
													<div class="col-sm-9">
														<div class="radio" style="float:left;margin-right:25px;">
															<label>
															  <input type="radio" name="is_show" value="1" <?php if($detail['is_show'] == 1) echo 'checked';?>>是 </label>
														</div>
														<div class="radio" style="float:left;">
															<label>
															<input type="radio" name="is_show" value="0" <?php if($detail['is_show'] == 0) echo 'checked';?>>否 </label>
														</div>
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
	$('.top_neirong').addClass('active');
	$('.tabtab6').addClass('active');
	</script>
	<script type="text/javascript">
		if(window.attachEvent){ 
			document.getElementById('s_cover').style.display = 'block';
			document.getElementById('datamsg').style.display = 'none';
		}
		
	</script>
</body>
</html>
