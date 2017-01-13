<!-- 头部 -->
	<?php include("tpl/public/top.php");?>
<!-- 头部结束 -->
			<section id="content">
				<section class="vbox">
					<section class="scrollable padder">
						<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
							<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
							<li>操作员管理</li>
							<li>操作员编辑</li>
						</ul>
						<section class="panel panel-default">
					<header class="panel-heading"> 操作员编辑 </header>
					<div class="row text-sm wrapper">
						<form class="form-inline" name="searchform" action="<?php echo pfUrl('','admin','index');?>" method="GET" style="margin-left:15px;">
							<input type="hidden" value="admin" name="c"> <input type="hidden" value="index" name="a"> <input type="hidden" name="s" value="is_post" />
								手机号&nbsp;&nbsp;<input name="phone" class="input-sm form-control" value="<?php echo $_GET['phone']; ?>" placeholder="手机号" style="margin-right:20px;"/>
								操作员&nbsp;&nbsp;<input name="name" class="input-sm form-control" value="<?php echo $_GET['name']; ?>" placeholder="操作员" style="margin-right:20px;"/>
								操作员状态&nbsp;&nbsp;<select name="status" class="input-sm form-control input-s-sm inline" style="margin-right:20px;">
										<option value="">--请选择状态--</option>
										<option value="0">禁用</option>
										<option value="1">正常</option>
								   </select>
								<input type="submit" name="search" class="btn btn-sm btn-default" onClick="return check_form();" value="搜索" style="white-space:nowrap;margin-left:20px;"/>
								<a class="btn btn-sm btn-default" href="<?php echo pfUrl('','admin','index');?>" style="white-space:nowrap;">重置</a>
								
								
						</form>
					</div>
					<div class="table-responsive">
						<table class="table table-striped b-t b-light text-sm">
							<thead>
								<tr role="row">
									<th width="100" colspan="1"  rowspan="1" role="columnheader" tabindex="0" >ID</th>
									<th width="60"colspan="1" rowspan="1" role="columnheader" >操作员</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" >手机号</th>
									<th width="60" colspan="1" rowspan="1" role="columnheader" aria-label="">操作员状态</th>
									<th width="60" colspan="1" rowspan="1" role="columnheader" aria-label="">操作员分组</th>
									<th width="120" colspan="1" rowspan="1" role="columnheader" >登录次数</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">操作</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php if(!empty($admin)){?>
								<?php foreach($admin as $key=>$vo){?>
									<tr>
										<td><?php echo $vo["id"];?></td>
										<td><?php echo $vo["name"];?></td>
										<td><?php echo $vo["phone"];?></td>
										<td><?php if($vo["status"]==1)echo "<font color='#ff00ff'>正常</font>";else echo "<font color='#4836ef'>锁定</font>";?></td>
										<td>
											<?php 
												$sql="select * from `jjs_auth_group` where status = 1 and id =".$vo["gid"];
												$group = D('bms')->query($sql);
												echo $group[0]['title'];
											?>
										</td>
										<td><?php echo$vo["logincount"];?></td>
										<td>
											<div align="center" style="white-space:nowrap;">
												<a class='btn_change' href="<?php echo pfUrl(" ","admin","add",array("id"=>$vo['id']))?>" style="white-space:nowrap;">编辑</a>
												<?php if($vo["status"] == 1){?>
													<a class='btn_change' href="<?php echo pfUrl(" ","admin","status",array("id"=>$vo['id'],"status"=>0))?>" style="white-space:nowrap;">禁用</a>
												<?php }else{?>
													<a class='btn_del' href="<?php echo pfUrl(" ","admin","status",array("id"=>$vo['id'],"status"=>1))?>" style="white-space:nowrap;">解禁</a>
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
