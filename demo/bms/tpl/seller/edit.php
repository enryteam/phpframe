<!-- 头部 -->
	<?php include("tpl/public/top.php");?>
<!-- 头部结束 -->
			<section id="content">
				<section class="vbox">
					<section class="scrollable padder">
						<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
							<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
							<li><a>卖家管理</a></li>
							<li><a href='<?php echo pfurl("","goods_release","index")?>'>店铺审核</a></li>
						</ul>
						<div class="row">
							<div class="col-sm-6">
								<div class="w_98 edit_box">
									<section class="panel panel-default">
										<header class="panel-heading"> <strong>店铺审核</strong> </header>
										<form action="<?php echo pfurl('','seller','edit');?>" method="post" class="form-horizontal">
										<input type="hidden" name="id" value="<?php echo $detail['id'];?>">
											<div class="edit_cont">
												<div class="cbox">
													<div class="panel-body">
														<div class="form-group">
															<label class="col-sm-3 control-label">申请人姓名</label>
															<div class="col-sm-9">
																<input type="text" name="realname" class="form-control" placeholder="<?php echo $detail['realname'];?>" disabled>
															</div>
														</div>
														<div class="line line-dashed line-lg pull-in"></div>
														<div class="form-group">
															<label class="col-sm-3 control-label">身份证号</label>
															<div class="col-sm-9">
																<input type="text" name="identity" class="form-control" placeholder="<?php echo $detail["identity"];?>" disabled>
															</div>
														</div>
														<div class="line line-dashed line-lg pull-in"></div>
														<div class="form-group">
															<label class="col-sm-3 control-label">手机号</label>
															<div class="col-sm-9">
																<input type="text" name="phone" class="form-control" placeholder="<?php echo $detail["phone"];?>" disabled>
															</div>
														</div>
														<div class="line line-dashed line-lg pull-in"></div>
														<div class="form-group">
															<label class="col-sm-3 control-label">店铺名称</label>
															<div class="col-sm-9">
																<input type="text" name="store_name" class="form-control" placeholder="<?php echo $detail['store_name'];?>" disabled>
															</div>
														</div>
														<div class="line line-dashed line-lg pull-in"></div>
														<div class="form-group">
															<label class="col-sm-3 control-label">QQ</label>
															<div class="col-sm-9">
																<input type="text" name="qq" class="form-control" placeholder="<?php echo $detail['qq'];?>" disabled>
															</div>
														</div>
														
														<div class="line line-dashed line-lg pull-in"></div>
														<div class="form-group">
															<label class="col-sm-3 control-label">申请时间</label>
															<div class="col-sm-9">
																<input type="text" name="ctime" class="form-control" placeholder="<?php echo date('Y-m-d H:i:s',$detail['ctime']);?>" disabled>
															</div>
														</div>
														<div class="line line-dashed line-lg pull-in"></div>
														<div class="form-group">
															<label class="col-sm-3 control-label">身份证正面照</label>
															<div class="col-sm-9">
																<a href="<?php echo $detail['id_front']?>"><img src="<?php echo $detail['id_front']?>"></a>
															</div>
														</div>
														<div class="line line-dashed line-lg pull-in"></div>
														<div class="form-group">
															<label class="col-sm-3 control-label">身份证反面照</label>
															<div class="col-sm-9">
																<a href="<?php echo $detail['id_back']?>"><img src="<?php echo $detail['id_back']?>"></a>
															</div>
														</div>
														<div class="line line-dashed line-lg pull-in"></div>
														<div class="form-group">
															<label class="col-sm-3 control-label">手持身份证照</label>
															<div class="col-sm-9">
																<a href="<?php echo $detail['id_hold']?>"><img src="<?php echo $detail['id_hold']?>"></a>
															</div>
														</div>
														<div class="line line-dashed line-lg pull-in"></div>
														<div class="form-group">
															<label class="col-sm-3 control-label">审核</label>
															<div class="col-sm-9">
																<div class="radio" style="float:left;margin-right:25px;">
																	<label>
																	  <input type="radio" name="status" value="1" <?php if($detail['status'] == 1) echo 'checked';?>>通过 </label>
																</div>
																<div class="radio" style="float:left;">
																	<label>
																	<input type="radio" name="status" value="2" <?php if($detail['status'] == 2) echo 'checked';?>>不通过 </label>
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

	var contents = $("#contents").val();
	var editor = UE.getEditor("ueditor");
	editor.ready(function(){
		editor.setContent(contents);    
	})
</script>
</body>
</html>
