	<!-- 头部 -->
		<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->
	<section id="content">
		<section class="vbox">
			<section class="scrollable padder">
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
					<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
					<li><a href="javascript:;">交易商管理</a></li>
					<li><a href="javascript:;">挂牌编辑</a></li>
				</ul>

				<!--内容区-->
				<section class="panel panel-default">
					<header class="panel-heading"> 挂牌编辑 </header>
					<div class="row text-sm wrapper">
						<form class="form-inline" name="searchform" action="<?php echo pfUrl('','dealer','index');?>" method="GET" style="margin-left:15px;">
							<input type="hidden" value="entry_market" name="c"> <input type="hidden" value="index" name="a"> <input type="hidden" name="s" value="is_post" />
								手机号&nbsp;&nbsp;<input name="phone" class="input-sm form-control" value="<?php echo $_GET['phone']; ?>" placeholder="手机号" style="margin-right:20px;"/>
								真实姓名&nbsp;&nbsp;<input name="realname" class="input-sm form-control" value="<?php echo $_GET['realname']; ?>" placeholder="真实姓名" style="margin-right:20px;"/>
								审核状态&nbsp;&nbsp;<select name="status" class="input-sm form-control input-s-sm inline">
									<option value="">--请选择状态--</option>
									<option value="0">未审核</option>
									<option value="1">通过</option>
									<option value="2">不通过</option>
								</select>
								
								
								<input type="submit" name="search" class="btn btn-sm btn-default" onClick="return check_form();" value="搜索" style="white-space:nowrap;margin-left:20px;"/>
								<a class="btn btn-sm btn-default" href="<?php echo pfUrl('','dealer','index');?>" style="white-space:nowrap;">重置</a>
								
								
						</form>
					</div>
					<div class="table-responsive">
						<table class="table table-striped b-t b-light text-sm">
							<thead>
								<tr role="row">
									<th width="100" colspan="1"  rowspan="1" role="columnheader" tabindex="0" >ID</th>
									<th width="100"colspan="1" rowspan="1" role="columnheader" >真实姓名</th>
									<th width="100"colspan="1" rowspan="1" role="columnheader" >身份证号</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" >手机号</th>
									<th width="130" colspan="1" rowspan="1" role="columnheader" aria-label="">邮箱</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">营业执照号</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">税务登记号</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">组织机构代码</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">申请时间</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">审核状态</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">操作</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php if(!empty($entry_market)){?>
								<?php foreach($entry_market as $key=>$vo){?>
									<tr>
										<td><?php echo $vo["id"];?></td>
										<td><?php echo $vo["realname"];?></td>
										<td><?php echo strlen($vo["idcard"])==15?substr_replace($vo["idcard"],"********",6,8):(strlen($vo["idcard"])==18?substr_replace($vo["idcard"],"********",6,8):"身份证位数不正常！");?></td>
										<td><?php echo $vo["phone"];?></td>
										<td><?php echo $vo["email"];?></td>
										<td><?php echo $vo["business_licence"];?></td>
										<td><?php echo $vo["tax_registration"];?></td>
										<td><?php echo $vo["organization_code"];?></td>
										<td><?php echo date("Y-m-d H:i",$vo["ctime"]);?></td>
										<td><?php if($vo["status"] == 0){?>未审核<?php }elseif($vo["status"] == 1){?><font style="color: #1abc9c;padding: 2px 5px;">通过</font><?php }elseif($vo["status"] == 2){?><font style="color: #ff0000;padding: 2px 5px;">不通过</font><?php }?></td>
										<td>
											<div align="center" style="white-space:nowrap;">
											<?php if($vo["status"] == 0){?>
												<a class='btn_change' href="<?php echo pfurl('','dealer','check',array('id'=>$vo['id']))?>" style="white-space:nowrap;">审核</a>
											<?php }?>
												<a class='btn_del'  href="javascript: if(window.confirm('确定要删除吗？')) location.href='<?php echo pfUrl("","dealer","remove",array("id"=>$vo['id']))?>'" style="white-space:nowrap;">删除</a>
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
	$('.top_yonghu').addClass('active');
	$('.tabtab3').addClass('active');
	</script>
</body>
</html>
