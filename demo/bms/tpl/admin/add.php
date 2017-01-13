	<!-- 头部 -->
		<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->
	<!-- 左侧菜单 -->
	<section id="content">
		<section class="vbox">
			<section class="scrollable padder">
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
					<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
					<li><a href="javascript:;">操作员管理</a></li>
					<li><a href="javascript:;">操作员新增</a></li>
				</ul>
				
				<div class="row">
					<div class="col-sm-6">
						<div class="w_98 edit_box">
							<section class="panel panel-default">
								<header class="panel-heading"> <strong>操作员新增</strong> </header>
								<form action="<?php echo pfurl('','admin','add');?>" method="post" class="form-horizontal">
								<input type="hidden" name="id" value="<?php echo $detail['id'];?>">
									<div class="edit_cont">
										<div class="cbox">
											<div class="panel-body">
												<div class="form-group">
													<label class="col-sm-3 control-label">操作员</label>
													<div class="col-sm-9">
													  <input type="text" name="name" class="form-control" data-required="true" value="<?php echo $detail['name'];?>">
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">密码</label>
													<div class="col-sm-9">
													  <input type="password" name="pwd" class="form-control" data-required="true" value="">
													</div>
												</div>
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">手机号</label>
													<div class="col-sm-9">
													  <input type="text" name="phone" class="form-control" data-required="true" value="<?php echo $detail['phone'];?>">
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">操作员分组</label>
													<div class="col-sm-9">
													  <select name="gid" class="input-sm form-control input-s-sm inline">
															<option value="">请选择分类</option>
															<?php foreach($groupStatus as $k=>$v){?>
																<option value="<?php echo $v["id"];?>" <?php if($detail['gid'] == $v["id"]) echo 'selected';?>><?php echo $v["title"];?></option>
															<?php }?>
														</select>
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
		$('.top_xitong').addClass('active');
		$('.tabtab2').addClass('active');
	</script>
</body>
</html>
