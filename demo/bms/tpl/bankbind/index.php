	<!-- 头部 -->
		<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->
	<section id="content">
		<section class="vbox">
			<section class="scrollable padder">
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
					<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
					<li>账号管理</li>
					<li>银行卡绑定</li>
				</ul>

				<!--内容区-->
				<section class="panel panel-default">
					<header class="panel-heading"> 银行卡绑定 </header>
					<div class="row text-sm wrapper">
						<form class="form-inline" name="searchform" action="<?php echo pfUrl('','bankbind','index');?>" method="GET" style="margin-left:15px;">
							<input type="hidden" value="bankbind" name="c"> <input type="hidden" value="index" name="a"> <input type="hidden" name="s" value="is_post" />
								手机号&nbsp;&nbsp;<input name="phone" class="input-sm form-control" value="<?php echo $_GET['phone']; ?>" placeholder="手机号" style="margin-right:20px;"/>
								真实姓名&nbsp;&nbsp;<input name="realname" class="input-sm form-control" value="<?php echo $_GET['realname']; ?>" placeholder="真实姓名" style="margin-right:20px;"/>
								审核状态&nbsp;&nbsp;<select name="is_check" class="input-sm form-control input-s-sm inline">
										<option value="">--请选择状态--</option>
										<option value="0">未审核</option>
										<option value="1">已审核</option>
								   </select>
								
								
								<input type="submit" name="search" class="btn btn-sm btn-default" onClick="return check_form();" value="搜索" style="white-space:nowrap;margin-left:20px;"/>
								<a class="btn btn-sm btn-default" href="<?php echo pfUrl('','bankbind','index');?>" style="white-space:nowrap;">重置</a>
								
								
						</form>
					</div>
					<div class="table-responsive">
						<table class="table table-striped b-t b-light text-sm">
							<thead>
								<tr role="row">
									<th width="100" colspan="1" rowspan="1"  tabindex="0" >编号</th>
									<th width="100" colspan="1" rowspan="1">真实姓名</th>
									<th width="100" colspan="1" rowspan="1">身份证号</th>
									<th width="100" colspan="1" rowspan="1">手机号</th>
									<th width="130" colspan="1" rowspan="1">所属银行</th>
									<th width="130" colspan="1" rowspan="1">开户支行</th>
									<th width="100" colspan="1" rowspan="1">卡号</th>
									<th width="100" colspan="1" rowspan="1">绑定时间</th>
									<th width="100" colspan="1" rowspan="1">审核状态</th>
									<th width="100" colspan="1" rowspan="1">操作</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php if(!empty($bankbind)){?>
								<?php foreach($bankbind as $key=>$vo){?>
									<tr>
										<td><?php echo $vo["id"];?></td>
										<td><?php echo $vo["realname"];?></td>
										<td><?php echo strlen($vo["idcard"])==15?substr_replace($vo["idcard"],"********",6,8):(strlen($vo["idcard"])==18?substr_replace($vo["idcard"],"********",6,8):"身份证位数不正常！");?></td>
										<td><?php echo $vo["phone"];?></td>
										<td><?php echo $vo["title"];?></td>
										<td><?php echo $vo["branch"];?></td>
										<td><?php echo $vo["card"];?></td>
										<td><?php echo date("Y-m-d H:i",$vo["ctime"]);?></td>
										<td><?php if($vo["is_check"]==0) echo "<font color='red'>未审核</font>";else echo "<font color='#1abc9c'>已审核</font>";?></td>
										<td>
											<div align="center" style="white-space:nowrap;">
											<?php if($vo["is_check"] == 0){?>
												<a class="btn_change" href="<?php echo pfurl('','bankbind','check',array('id'=>$vo['id']))?>" style="white-space:nowrap;" title="审核实名">审核实名</a>
											<?php }elseif($vo["is_check"] == 1){?>
												<a class='btn_del'  href="javascript: if(window.confirm('确定要删除吗？')) location.href='<?php echo pfUrl("","bankbind","remove",array("id"=>$vo['id']))?>'" style="white-space:nowrap;" title="删除">删除</a>
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
	$('.top_caiwu').addClass('active');
	$('.tabtab4').addClass('active');
	</script>
</body>
</html>
