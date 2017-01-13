	<!-- 头部 -->
		<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->

	<section id="content">
		<section class="vbox">
			<section class="scrollable padder">
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
					<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
					<li>文章管理</li>
					<li>文章编辑</li>
				</ul>

				<!--内容区-->
				<section class="panel panel-default">
					<header class="panel-heading"> 文章编辑 </header>
					<div class="row text-sm wrapper">
						<form class="form-inline" name="searchform" action="<?php echo pfUrl('','article','index');?>" method="GET" style="margin-left:15px;">
							<input type="hidden" value="article" name="c"> <input type="hidden" value="index" name="a"> <input type="hidden" name="s" value="is_post" />
								标题&nbsp;&nbsp;<input name="title" class="input-sm form-control" value="<?php echo $_GET['title']; ?>" style="width:230px;margin-right:20px;white-space:nowrap;"/>
								分类&nbsp;&nbsp;<select name="cateid" class="input-sm form-control input-s-sm inline" style="width:105px;">
									<option value="">请选择分类</option>
									<?php foreach($cate as $k=>$v){?>
										<option value="<?php echo $v["id"];?>"><?php echo $v["title"];?></option>
									<?php }?>
								</select>
								
								<input type="submit" name="search" class="btn btn-sm btn-default" onClick="return check_form();" value="搜索" style="white-space:nowrap;margin-left:20px;"/>
								<a class="btn btn-sm btn-default" href="<?php echo pfUrl('','article','index');?>" style="white-space:nowrap;">重置</a>
								
						</form>
					</div>
					<div class="table-responsive">
						<table class="table table-striped b-t b-light text-sm">
							<thead>
								<tr role="row">
									<th width="100" colspan="1"  rowspan="1" role="columnheader" tabindex="0" >ID</th>
									<th colspan="1" rowspan="1" role="columnheader" >文章分类</th>
									<th colspan="1" rowspan="1" role="columnheader" >文章标题</th>
									<th width="200" colspan="1" rowspan="1" role="columnheader" aria-label="">标识图片</th>
									<th width="200" colspan="1" rowspan="1" role="columnheader" aria-label="">前台是否显示</th>
									<th width="200" colspan="1" rowspan="1" role="columnheader" aria-label="">浏览量</th>
									<th colspan="1" rowspan="1" role="columnheader" >添加时间</th>
									<th width="200" colspan="1" rowspan="1" role="columnheader" aria-label="">操作</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php if(!empty($article)){?>
								<?php foreach($article as $key=>$vo){?>
									<tr>
										<td><?php echo $vo["id"];?></td>
										<td><?php echo $vo["catetitle"];?></td>
										<td><?php echo $vo["title"];?></td>
										<td><img src="<?php echo $vo['image'];?>" width="40px"></td>
										<td><?php if($vo["is_show"] == 1) echo "<font color='#8ec165'>显示</font>";else echo "<font color='red'>不显示</font>";?></td>
										<td>
											<?php echo $vo["browse_number"];?>
										</td>
										<td><?php echo date("Y-m-d",$vo["ctime"]);?></td>
										<td>
											<div align="center" style="white-space:nowrap;">
												<a class='btn_change' href="<?php echo pfUrl(" ","article","edit",array("id"=>$vo['id']))?>" style="white-space:nowrap;">编辑</a>
												<a class='btn_del'  href="javascript: if(window.confirm('确定要删除吗？')) location.href='<?php echo pfUrl("","article","remove",array("id"=>$vo['id']))?>'" style="white-space:nowrap;">删除</a>
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
