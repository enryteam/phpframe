	<!-- 头部 -->
		<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->
	<section id="content">
		<section class="vbox">
			<section class="scrollable padder">
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
					<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
					<li><a href="javascript:;">代理运营中心管理</a></li>
					<li><a href="javascript:;">代理运营编辑</a></li>
				</ul>
				
				<div class="row">
					<div class="col-sm-6">
						<div class="w_98 edit_box">
							<section class="panel panel-default">
								<header class="panel-heading"> <strong>代理运营编辑</strong> </header>
								<form action="<?php echo pfurl('','agent_operation','edit');?>" method="post" class="form-horizontal">
								<input type="hidden" name="id" value="<?php echo $detail['id'];?>">
									<div class="edit_cont">
										<div class="cbox">
											<div class="panel-body">
												<div class="form-group">
													<label class="col-sm-3 control-label">邀请码</label>
													<div class="col-sm-9">
													  <input type="text" name="referral_code" class="form-control" data-required="true" value="<?php echo $detail['referral_code'];?>" readonly>
													</div>
												</div>
												<?php if(!empty($detail['mechanism'])){?>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">申请机构</label>
													<div class="col-sm-9">
													  <input type="text" name="mechanism" class="form-control" data-required="true" value="<?php echo $detail['mechanism'];?>" readonly>
													</div>
												</div>
												<?php }?>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">申请人姓名</label>
													<div class="col-sm-9">
													  <input type="text" name="realname" class="form-control" data-required="true" value="<?php echo $detail['realname'];?>" readonly>
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">联系电话</label>
													<div class="col-sm-9">
													  <input type="text" name="phone" class="form-control" data-required="true" value="<?php echo $detail['phone'];?>" readonly>
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">身份证号</label>
													<div class="col-sm-9">
													  <input type="text" name="idcard" class="form-control" data-required="true" value="<?php echo $detail['idcard'];?>" readonly>
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">联系地址</label>
													<div class="col-sm-9">
													  <input type="text" name="address" class="form-control" data-required="true" value="<?php echo $detail['address'];?>" readonly>
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">电子邮箱</label>
													<div class="col-sm-9">
													  <input type="text" name="email" class="form-control" data-required="true" value="<?php echo $detail['email'];?>" readonly>
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">银行账号</label>
													<div class="col-sm-9">
													  <input type="text" name="bank_card" class="form-control" data-required="true" value="<?php echo $detail['bank_card'];?>" readonly>
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">开户银行</label>
													<div class="col-sm-9">
													  <input type="text" name="bank" class="form-control" data-required="true" value="<?php echo $detail['bank'];?>" readonly>
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">开户名</label>
													<div class="col-sm-9">
													  <input type="text" name="accountname" class="form-control" data-required="true" value="<?php echo $detail['accountname'];?>" readonly>
													</div>
												</div>
												<?php if(!empty($detail['businessname'])){?>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">业务联系人</label>
													<div class="col-sm-9">
													  <input type="text" name="businessname" class="form-control" data-required="true" value="<?php echo $detail['businessname'];?>" readonly>
													</div>
												</div>
												<?php }?>
												<?php if(!empty($detail['businessduties'])){?>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">业务联系人职务</label>
													<div class="col-sm-9">
													  <input type="text" name="businessduties" class="form-control" data-required="true" value="<?php echo $detail['businessduties'];?>" readonly>
													</div>
												</div>
												<?php }?>
												<?php if(!empty($detail['businessphone'])){?>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">业务联系人电话</label>
													<div class="col-sm-9">
													  <input type="text" name="businessphone" class="form-control" data-required="true" value="<?php echo $detail['businessphone'];?>" readonly>
													</div>
												</div>
												<?php }?>
												<?php if(!empty($detail['businessidcard'])){?>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">业务联系人身份证号</label>
													<div class="col-sm-9">
													  <input type="text" name="businessidcard" class="form-control" data-required="true" value="<?php echo $detail['businessidcard'];?>" readonly>
													</div>
												</div>
												<?php }?>
												<?php if(!empty($detail['business_licence'])){?>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">营业执照号</label>
													<div class="col-sm-9">
														<input type="text" name="business_licence" class="form-control" data-required="true" value="<?php echo $detail['business_licence'];?>" readonly>
													</div>
												</div>
												<?php }?>
												<?php if(!empty($detail['organization_code'])){?>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">组织机构代码</label>
													<div class="col-sm-9">
														<input type="text" name="organization_code" class="form-control" data-required="true" value="<?php echo $detail['organization_code'];?>" readonly>
													</div>
												</div>
												<?php }?>
												<?php if(!empty($detail['tax_registration'])){?>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">税务登记证号</label>
													<div class="col-sm-9">
														<input type="text" name="tax_registration" class="form-control" data-required="true" value="<?php echo $detail['tax_registration'];?>" readonly>
													</div>
												</div>
												<?php }?>
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
	$('.top_yunying').addClass('active');
	$('.tabtab8').addClass('active');
	</script>
</body>
</html>
