	<!-- 头部 -->
		<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->
	<section id="content">
		<section class="vbox">
			<section class="scrollable padder">
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
					<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
					<li><a href="javascript:;">客户管理</a></li>
					<li><a href="javascript:;">客户编辑</a></li>
				</ul>
				
				<div class="row">
					<div class="col-sm-6">
						<div class="w_98 edit_box">
							<section class="panel panel-default">
								<header class="panel-heading"> <strong>客户编辑</strong> </header>
								<form action="<?php echo pfurl('','user','edit');?>" method="post" class="form-horizontal">
								<input type="hidden" name="id" value="<?php echo $detail['id'];?>">
									<div class="edit_cont">
										<div class="cbox">
											<div class="panel-body">
												<div class="form-group">
													<label class="col-sm-3 control-label">真实姓名</label>
													<div class="col-sm-9">
													  <input type="text" name="realname" class="form-control" data-required="true" value="<?php echo $detail['realname'];?>">
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">身份证号</label>
													<div class="col-sm-9">
													  <input type="text" name="idcard" class="form-control" data-required="true" value="<?php echo $detail['idcard'];?>">
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">邮箱</label>
													<div class="col-sm-9">
													  <input type="text" name="email" class="form-control" data-required="true" value="<?php echo $detail['email'];?>">
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">EG姓名</label>
													<div class="col-sm-9">
													  <input type="text" name="emergency_contact" class="form-control" data-required="true" value="<?php echo $detail['emergency_contact'];?>">
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">EG手机号</label>
													<div class="col-sm-9">
													  <input type="text" name="emergency_contact_phone" class="form-control" data-required="true" value="<?php echo $detail['emergency_contact_phone'];?>">
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">用户角色</label>
													<div class="col-sm-9">
														<div class="radio" style="float:left;margin-right:25px;">
															<label>
															  <input type="radio" name="role" value="1" <?php if($detail['role'] == 1) echo 'checked';?>>普通用户 </label>
														</div>
														<div class="radio" style="float:left;">
															<label>
															<input type="radio" name="role" value="2" <?php if($detail['role'] == 2) echo 'checked';?>>交易商</label>
														</div>
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">身份证正面照</label>
													<div class="col-sm-9">
														<a href=""><img src="<?php echo $detail['id_front_img']?>" width="200px"></a>
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">身份证反面照</label>
													<div class="col-sm-9">
														<a href=""><img src="<?php echo $detail['id_back_img']?>" width="200px"></a>
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">手持身份证照</label>
													<div class="col-sm-9">
														<a href=""><img src="<?php echo $detail['id_hold_img']?>" width="200px"></a>
													</div>
												</div>
												<?php if($detail['is_check'] == 0){?>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">认证</label>
													<div class="col-sm-9">
														<div class="radio" style="float:left;margin-right:25px;">
															<label>
															  <input type="radio" name="is_check" value="1" <?php if($detail['is_check'] == 1) echo 'checked';?>>通过 </label>
														</div>
														<div class="radio" style="float:left;">
															<label>
															<input type="radio" name="is_check" value="2" <?php if($detail['is_check'] == 2) echo 'checked';?>>不通过 </label>
														</div>
													</div>
												</div>
												<?php }?>
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
