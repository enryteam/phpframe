	<!-- 头部 -->
		<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->
	<section id="content">
		<section class="vbox">
			<section class="scrollable padder">
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
					<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
					<li><a href="javascript:;">权限组管理</a></li>
					<li><a href="javascript:;">权限组新增</a></li>
				</ul>
				
				<div class="row">
					<div class="col-sm-6">
						<div class="w_98 edit_box">
							<section class="panel panel-default">
								<header class="panel-heading"> <strong>权限组新增</strong> </header>
								<form action="<?php echo pfurl('','group','add');?>" method="post" class="form-horizontal">
								<input type="hidden" name="id" value="<?php echo $detail['id'];?>">
									<div class="edit_cont">
										<div class="cbox">
											<div class="panel-body">
												<div class="form-group">
													<label class="col-sm-3 control-label">管理组名称</label>
													<div class="col-sm-9">
													  <input type="text" name="title" class="form-control" data-required="true" value="<?php echo $detail['title'];?>">
													</div>
												</div>
												
												<div class="line line-dashed line-lg pull-in"></div>
												<div class="form-group">
													<label class="col-sm-3 control-label">管理组权限</label>
													<div class="col-sm-10">
														<?php $arr= explode(',', $detail['rules'])?>
														<?php foreach ($quanxian as $key => $vo) {?>
														<fieldset>
														<legend><?php echo $vo['title']?></legend>
															<?php foreach ($vo['zi'] as $k => $v) {?>
														<label class="checkbox-inline"><input id="inlineCheckbox1" name="rules[]" <?php if(in_array($v['action'], $arr)) echo'checked'?> value="<?php echo $v['action']?>" type="checkbox"><?php echo $v['title']?></label>
														<?php }?>
														</fieldset>
														<?php }?>
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
