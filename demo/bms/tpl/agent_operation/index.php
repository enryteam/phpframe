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

				<!--内容区-->
				<section class="panel panel-default">
					<header class="panel-heading"> 代理运营编辑 </header>
					<div class="row text-sm wrapper">
						<form class="form-inline" name="searchform" action="<?php echo pfUrl('','agent_operation','index');?>" method="GET" style="margin-left:15px;">
							<input type="hidden" value="agent_operation" name="c"> <input type="hidden" value="index" name="a"> <input type="hidden" name="s" value="is_post" />
								联系电话&nbsp;&nbsp;<input name="phone" class="input-sm form-control" value="<?php echo $_GET['phone']; ?>" placeholder="联系电话" style="margin-right:20px;"/>
								申请人姓名&nbsp;&nbsp;<input name="realname" class="input-sm form-control" value="<?php echo $_GET['realname']; ?>" placeholder="申请人姓名" style="margin-right:20px;"/>
								开户状态&nbsp;&nbsp;<select name="is_check" class="input-sm form-control input-s-sm inline" style="margin-right:20px;">
										<option value="">--请选择状态--</option>
										<option value="0">未认证</option>
										<option value="1">认证通过</option>
										<option value="2">认证不通过</option>
								   </select>
								
								<input type="submit" name="search" class="btn btn-sm btn-default" onClick="return check_form();" value="搜索" style="white-space:nowrap;margin-left:20px;"/>
								<a class="btn btn-sm btn-default" href="<?php echo pfUrl('','agent_operation','index');?>" style="white-space:nowrap;">重置</a>
								
								
						</form>
					</div>
					<div class="table-responsive">
						<table class="table table-striped b-t b-light text-sm">
							<thead>
								<tr role="row">
									<th width="100" colspan="1"  rowspan="1" role="columnheader" tabindex="0" >ID</th>
									<th width="100"colspan="1" rowspan="1" role="columnheader" >邀请码</th>
									<th width="110" colspan="1" rowspan="1" role="columnheader" aria-label="">申请人姓名</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">联系电话</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">身份证号</th>
									<th colspan="1" rowspan="1" role="columnheader" aria-label="">联系地址</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">电子邮箱</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">银行账号</th>
									<th width="90" colspan="1" rowspan="1" role="columnheader" aria-label="">开户银行</th>
									<th width="90" colspan="1" rowspan="1" role="columnheader" aria-label="">开户名</th>
									<th width="90" colspan="1" rowspan="1" role="columnheader" >认证状态</th>
									<th width="120" colspan="1" rowspan="1" role="columnheader" >添加时间</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">操作</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<?php if(!empty($operates)){foreach($operates as $key=>$vo){?>
									<tr>
										<td><?php echo $vo["id"];?></td>
										<td><?php echo $vo["referral_code"];?></td>
										<td><?php echo $vo["realname"];?></td>
										<td><?php echo $vo["phone"];?></td>
										<td><?php echo $vo["idcard"];?></td>
										<td><?php echo $vo["address"];?></td>
										<td><?php echo $vo["email"];?></td>
										<td><?php echo $vo["bankcard"];?></td>
										<td><?php echo $vo["bank"];?></td>
										<td><?php echo $vo["accountname"];?></td>
										<td><?php if($vo["is_check"]==0)echo "未认证";elseif($vo["is_check"]==1) echo "<font color='green'>认证通过</font>";else echo "<font color='red'>认证不通过</font>"?></td>
										<td><?php echo date("Y-m-d H:i",$vo["ctime"]);?></td>
										<td>
											<div align="center" style="white-space:nowrap;">
												<a class='btn_change' href="<?php echo pfUrl(" ","agent_operation","edit",array("id"=>$vo['id']))?>" style="white-space:nowrap;">编辑</a>
												<a class='btn_del' href="<?php echo pfUrl(" ","agent_operation","del_freeze",array("id"=>$vo['id']))?>" style="white-space:nowrap;">删除</a>
												
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
	$('.top_yunying').addClass('active');
	$('.tabtab8').addClass('active');
	</script>
</body>
</html>
