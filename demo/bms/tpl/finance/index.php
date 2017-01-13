	<!-- 头部 -->
		<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->
	<section id="content">
		<section class="vbox">
			<section class="scrollable padder">
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
					<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
					<li><a href="javascript:;">报表管理</a></li>
					<li><a href="javascript:;">财务报表</a></li>
				</ul>

				<!--内容区-->
				<section class="panel panel-default">
					<header class="panel-heading"> 财务报表 </header>
					<div class="row text-sm wrapper">
						<form class="form-inline" name="searchform" action="<?php echo pfUrl('','finance','index');?>" method="GET" style="margin-left:15px;">
							<input type="hidden" value="finance" name="c"> <input type="hidden" value="index" name="a"> <input type="hidden" name="s" value="is_post" />
								
								交易类型&nbsp;&nbsp;<select name="cate" class="input-sm form-control input-s-sm inline" style="margin-right:20px;">
										<option value="">--请选择状态--</option>
										<option value="买入">买入</option>
										<option value="卖出">卖出</option>
								   </select>

								交易时间<input class="input-sm form-control Wdate w1" name="currenttime" onClick="WdatePicker()" placeholder="请选择交易时间"/>
								
								交易时间段<input class="input-sm form-control Wdate w1" name="starttime" onClick="WdatePicker()" placeholder="请选择开始时间"/>---<input class="input-sm form-control Wdate w1" name="overtime" onClick="WdatePicker()" placeholder="请选择截止时间"/>
								
								
								<input type="submit" name="search" class="btn btn-sm btn-default" onClick="return check_form();" value="搜索" style="white-space:nowrap;margin-left:20px;"/>
								<a class="btn btn-sm btn-default" href="<?php echo pfUrl('','finance','index');?>" style="white-space:nowrap;">重置</a>
								
								
						</form>
					</div>
					<div class="table-responsive">
						<table class="table table-striped b-t b-light text-sm">
							<thead>
								<tr role="row">
									<th width="110" colspan="1" rowspan="1" role="columnheader" aria-label="">交易类型</th>
									<th width="60"colspan="1" rowspan="1" role="columnheader" >真实姓名</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" >手机号</th>
									<th width="60" colspan="1" rowspan="1" role="columnheader" aria-label="">商品代号</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">成交数量</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">委托价格</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">成交价格</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">手续费</th>
									<th width="100" colspan="1" rowspan="1" role="columnheader" aria-label="">委托时间</th>
									<th width="60" colspan="1" rowspan="1" role="columnheader" aria-label="">成交时间</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php if(!empty($lists)){?>
								<?php foreach($lists as $key=>$vo){?>
									<tr>
										<td><?php if($vo["cate"]==0) echo "买入";else echo "卖出";?></td>
										<td><?php echo $vo["realname"];?></td>
										<td><?php echo $vo["phone"];?></td>
										<td><?php echo $vo["g_code"];?></td>
										<td><?php echo $vo["quantity"];?></td>
										<td><?php echo $vo["price"];?></td>
										<td><?php echo $vo["t_price"];?></td>
										<td><?php echo $vo["fee"];?></td>
										<td><?php echo $vo["ctime"];?></td>
										<td><?php echo $vo["deal_time"];?></td>
										
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
