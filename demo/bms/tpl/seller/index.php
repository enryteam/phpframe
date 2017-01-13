<!-- 头部 -->
	<?php include("tpl/public/top.php");?>
<!-- 头部结束 -->
			<section id="content">
				<section class="vbox">
					<section class="scrollable padder">
						<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
							<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
							<li>卖家管理</li>
							<li>店铺审核</li>
						</ul>
	  
						<!--内容区-->
						<section class="panel panel-default">
							<header class="panel-heading"> 店铺审核 </header>
							<div class="row text-sm wrapper">
								<form class="form-inline" name="searchform" action="<?php echo pfUrl('','seller','index');?>" method="GET" style="margin-left:15px;">
									<input type="hidden" value="seller" name="c"> <input type="hidden" value="index" name="a"> <input type="hidden" name="s" value="is_post" />
										审核状态&nbsp;&nbsp;<select name="status" class="input-sm form-control input-s-sm inline" style="width:105px;">
											<option value="">--请选择--</option>
											<option value="no">未审核</option>
											<option value="1">审核通过</option>
											<option value="2">审核不通过</option>
										</select>
										<input type="submit" name="search" class="btn btn-sm btn-default" onClick="return check_form();" value="搜索" style="white-space:nowrap;margin-left:20px;"/>
										<a class="btn btn-sm btn-default" href="<?php echo pfUrl('','seller','index');?>" style="white-space:nowrap;">重置</a>
										
								</form>
							</div>
							<div class="table-responsive">
								<table class="table table-striped b-t b-light text-sm">
									<thead>
										<tr role="row">
											<th width="10%" colspan="1"  rowspan="1">ID</th>
											<th width="10%" colspan="1" rowspan="1">申请人姓名</th>
											<th width="15%" colspan="1" rowspan="1">身份证号</th>
											<th width="20%" colspan="1" rowspan="1">店铺名称</th>
											<th width="20%" colspan="1" rowspan="1">QQ</th>
											<th width="10%" colspan="1" rowspan="1" >审核状态</th>
											<th width="15%" colspan="1" rowspan="1">申请时间</th>
											<th width="10%" colspan="1" rowspan="1" >操作</th>
										</tr>
									</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
										<?php if(!empty($lists)){foreach($lists as $key=>$vo){?>
											<tr>
												<td><?php echo $vo["id"];?></td>
												<td><?php echo $vo["realname"];?></td>
												<td><?php echo strlen($vo["identity"])==15?substr_replace($vo["identity"],"********",6,8):(strlen($vo["identity"])==18?substr_replace($vo["identity"],"********",6,8):"身份证位数不正常！");?></td>
												<td><?php echo $vo["store_name"];?></td>
												<td><?php echo $vo["qq"];?></td>
												<td><?php if($vo["status"]==0) echo "未审核";elseif($vo["status"]==1) echo "<font color='#1abc9c'>通过</font>";elseif($vo["status"]==2) echo "<font color='red'>不通过</font>";?></td>
												<td><?php echo $vo["ctime"];?></td>
												<td>
													<div align="center" style="white-space:nowrap;">
														<a class='btn_change' href="<?php echo pfUrl(" ","seller","edit",array("id"=>$vo['id']))?>" style="white-space:nowrap;">审核</a>
													</div>
												</td>
											</tr>
										<?php }}else{?>
											<tr>
												<td colspan="12" align="center">没有记录！</td>
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
