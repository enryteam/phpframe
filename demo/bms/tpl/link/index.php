	<!-- 头部 -->
		<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->
	<section id="content">
		<section class="vbox">
			<section class="scrollable padder">
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
					<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
					<li>友情链接管理</li>
					<li>友情链接编辑</li>
				</ul>

				<!--内容区-->
				<section class="panel panel-default">
					<header class="panel-heading"> 友情链接编辑 </header>
					<div class="row text-sm wrapper" style="padding:1px;">
						
					</div>
					<div class="table-responsive">
						<table class="table table-striped b-t b-light text-sm">
							<thead>
								<tr role="row">
									<th width="100" colspan="1"  rowspan="1" role="columnheader" tabindex="0" >ID</th>
									<th colspan="1" rowspan="1" role="columnheader" >链接名称</th>
									<th colspan="1" rowspan="1" role="columnheader" >链接地址</th>
									<th width="200" colspan="1" rowspan="1" role="columnheader" aria-label="">前台是否显示</th>
									<th width="200" colspan="1" rowspan="1" role="columnheader" aria-label="">添加时间</th>
									<th width="200" colspan="1" rowspan="1" role="columnheader" aria-label="">操作</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php if(!empty($links)){?>
								<?php foreach($links as $key=>$vo){?>
									<tr>
										<td><?php echo $vo["id"];?></td>
										<td><?php echo $vo["title"];?></td>
										<td><?php echo $vo["link"];?></td>
										<td><?php if($vo["is_show"] == 1) echo "<font color='green'>显示</font>";else echo "<font color='red'>不显示</font>";?></td>
										<td><?php echo date("Y-m-d",$vo["ctime"]);?></td>
										<td>
											<div align="center" style="white-space:nowrap;">
												<a class='btn_change' href="<?php echo pfUrl(" ","link","edit",array("id"=>$vo['id']))?>" style="white-space:nowrap;">编辑</a>
												<a class='btn_del'  href="javascript: if(window.confirm('确定要删除吗？')) location.href='<?php echo pfUrl("","link","remove",array("id"=>$vo['id']))?>'" style="white-space:nowrap;">删除</a>
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
	$('.top_neirong').addClass('active');
	$('.tabtab6').addClass('active');
	</script>
</body>
</html>
