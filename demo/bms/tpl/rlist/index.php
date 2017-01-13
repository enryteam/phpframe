	<!-- 头部 -->
		<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->
	<section id="content">
		<section class="vbox">
			<section class="scrollable padder">
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
					<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
					<li>出入金管理</li>
					<li>入金管理</li>
				</ul>

				<!--内容区-->
				<section class="panel panel-default">
					<header class="panel-heading"> 入金管理 </header>
					<div class="row text-sm wrapper">
						<form class="form-inline" name="searchform" action="<?php echo pfUrl('','rlist','index');?>" method="GET" style="margin-left:15px;">
							<input type="hidden" value="rlist" name="c"> <input type="hidden" value="index" name="a"> <input type="hidden" name="s" value="is_post" />
								手机号&nbsp;&nbsp;<input name="phone" class="input-sm form-control" value="<?php echo $_GET['phone']; ?>" placeholder="手机号"/>
								真实姓名&nbsp;&nbsp;<input name="realname" class="input-sm form-control" value="<?php echo $_GET['realname']; ?>" placeholder="真实姓名"/>
								入金单号&nbsp;&nbsp;<input name="num" class="input-sm form-control" value="<?php echo $_GET['num']; ?>" placeholder="入金单号"/>
								入金状态&nbsp;&nbsp;<select name="is_true" class="input-sm form-control input-s-sm inline" style="width:120px;white-space:nowrap;">
										<option value="">--请选择状态--</option>
										<option value="0">未到账</option>
										<option value="1">已到账</option>
								   </select>
								<input type="submit" name="search" class="btn btn-sm btn-default" onClick="return check_form();" value="搜索" style="white-space:nowrap;margin-left:20px;"/>
								<a class="btn btn-sm btn-default" href="<?php echo pfUrl('','rlist','index');?>" style="white-space:nowrap;">重置</a>
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
									<th width="130" colspan="1" rowspan="1" role="columnheader" aria-label="">入金单号</th>
									<th width="130" colspan="1" rowspan="1" role="columnheader" aria-label="">入金方式</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">入金金额</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">应到金额</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">入金时间</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">操作</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php if(!empty($rlist)){?>
								<?php foreach($rlist as $key=>$vo){?>
									<tr>
										<td><?php echo $vo["id"];?></td>
										<td><?php echo $vo["realname"];?></td>
										<td><?php echo $vo["idcard"];?></td>
										<td><?php echo $vo["phone"];?></td>
										<td><?php echo $vo["num"];?></td>
										<td><?php if($vo["cate"] == 0) echo "信用卡";else echo "储蓄卡";?></td>
										<td><?php echo $vo["amount"];?></td>
										<td><?php echo $vo["deal_num"];?></td>
										<td><?php echo date("Y-m-d H:i",$vo["ctime"]);?></td>
										<td>
											<div align="center" style="white-space:nowrap;">
											<?php if($vo["is_true"] == 0){?>
												<a class='btn_del' href="<?php echo pfurl('','rlist','pay',array('id'=>$vo['id']))?>" style="white-space:nowrap;">确认到账</a>
											<?php }else{?>
												<font style="background: #1abc9c;color: #fff;padding: 2px 5px;">已到账</font>
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
