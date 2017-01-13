<!-- 头部 -->
	<?php include("tpl/public/top.php");?>
<!-- 头部结束 -->
			<section id="content">
				<section class="vbox">
					<section class="scrollable padder">
						<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
							<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
							<li>权限组管理</li>
							<li>权限组编辑</li>
						</ul>
						<section class="panel panel-default">
					<header class="panel-heading"> 权限组编辑 </header>
					<div class="table-responsive">
						<table class="table table-striped b-t b-light text-sm">
							<thead>
								<tr role="row">
									<th width="100" colspan="1"  rowspan="1" role="columnheader" tabindex="0" >ID</th>
									<th width="60"colspan="1" rowspan="1" role="columnheader" >名称</th>
									<th width="60" colspan="1" rowspan="1" role="columnheader" aria-label="">管理组状态</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">操作</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php if(!empty($groupStatus)){?>
								<?php foreach($groupStatus as $key=>$vo){?>
									<tr>
										<td><?php echo $vo["id"];?></td>
										<td><?php echo $vo["title"];?></td>
										<td><?php if($vo["status"]==1)echo "<font color='#ff00ff'>正常</font>";else echo "<font color='#4836ef'>禁用</font>";?></td>
										<td>
											<div align="center" style="white-space:nowrap;">
												<a class='btn_change' href="<?php echo pfUrl(" ","group","add",array("id"=>$vo['id']))?>" style="white-space:nowrap;">编辑</a>
												<?php if($vo["status"] == 1){?>
													<a class='btn_change' href="<?php echo pfUrl(" ","group","status",array("id"=>$vo['id'],"status"=>0))?>" style="white-space:nowrap;">禁用</a>
												<?php }else{?>
													<a class='btn_del' href="<?php echo pfUrl(" ","group","status",array("id"=>$vo['id'],"status"=>1))?>" style="white-space:nowrap;">解禁</a>
												<?php }?>
											</div>
										</td>
									</tr>
								<?php }}else{?>
									<tr>
										<td colspan="10" align="center">没有记录！</td>
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
	$('.top_xitong').addClass('active');
	$('.tabtab2').addClass('active');
</script>
