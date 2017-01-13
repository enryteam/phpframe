	<!-- 头部 -->
		<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->
	<section id="content">
		<section class="vbox">
			<section class="scrollable padder">
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
					<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
					<li><a href="javascript:;">交易商管理</a></li>
					<li><a href="javascript:;">批量挂牌</a></li>
				</ul>
				
				<div class="row">
					<div class="col-sm-6">
						<div class="w_98 edit_box">
							<section class="panel panel-default">
								<header class="panel-heading"> <strong>批量挂牌</strong> </header>
								<form action="<?php echo pfurl('','dealer','batchimport');?>" method="post"  enctype="multipart/form-data" class="form-horizontal">
									<div class="edit_cont">
										<div class="cbox">
											<div class="panel-body">
												<div class="form-group">
													<label class="col-sm-3 control-label">导入文件</label>
													<div class="col-sm-10">
														<input id="filestyle-0" class="filestyle" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline input-s" style="position: fixed; left: -500px;" type="file" name="inputExcel" accept="application/vnd.ms-excel">
														<div class="bootstrap-filestyle" style="display: inline;">
															<label class="btn btn-default">
																<span onclick="javascript:window.location.href='../attms/guapai.xls'">下载模板</span>
															</label>
															<span style="color:#aaa">请先下载模板,然后按模板文件填写资料生成文件,最后导入文件</span>
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
	$('.top_yonghu').addClass('active');
	$('.tabtab3').addClass('active');
	</script>
</body>
</html>
