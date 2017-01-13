	<!-- 头部 -->
		<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->
	<section id="content">
		<section class="vbox">
			<section class="scrollable padder">
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
					<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
					<li>银行管理</li>
					<li>银行新增</li>
				</ul>
				<div class="row">
					<div class="col-sm-6">
						<div class="w_98 edit_box">
							<section class="panel panel-default">
								<header class="panel-heading"> <strong>银行新增</strong> </header>
								<form action="<?php echo pfurl('','bank','add');?>" method="post" class="form-horizontal">
									<div class="edit_cont">
										<div class="cbox">
											<div class="panel-body">
												<div class="form-group">
													<label class="col-sm-3 control-label">银行名称</label>
													<div class="col-sm-9">
														<input type="text" name="title" class="form-control" value="">
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">银行标识</label>
													<div class="col-sm-9">
														<input type="text" name="code" class="form-control" value="">
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">图片</label>
													<div class="col-sm-9">
														<img src="<?php echo $image;?>" class="moren_tou" width="80px;" style="margin-bottom:10px;border:1px solid #dfdfdf;"/><input type="file" name="name" value="" onChange="change_touxiang()" id="scflie_morentou">
														<input type="hidden" name="image" value="" id="my_avatar_touxiang" />
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">支持卡类型</label>
													<div class="col-sm-9">
														<div class="radio" style="float:left;margin-right:25px;">
															<label>
																<input type="radio" name="status" checked value="1">储蓄卡 </label>
														</div>
														<div class="radio" style="float:left;">
															<label>
																<input type="radio" name="status" value="2">信用卡 </label>
														</div>
														<div class="radio" style="float:left;">
															<label>
																<input type="radio" name="status" value="3">全部 </label>
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
		function change_touxiang() {
			var file    = document.querySelector('#scflie_morentou').files[0];
			var reader  = new FileReader();
			reader.addEventListener("load", function () {
				//preview.src = reader.result;
				$.ajax ({
					type: 'POST',
					url: 'http://apistore.51daniu.cn/rest/index.php',
					dataType: 'json',
					data: {"c":"upfile","a":"img","img":encodeURIComponent(reader.result)},
					success: function(responsex)
					{
						$('.moren_tou').attr('src',responsex.data);
						$('#my_avatar_touxiang').val(responsex.data);
					},
					error: function (data)
					{
						$(".shay_confirm_tishi").show();
						$(".msg").html(data.message);
					}
				});
			}, false);
			if (file) {
				reader.readAsDataURL(file);
			}
		}

	</script>
</body>
</html>
