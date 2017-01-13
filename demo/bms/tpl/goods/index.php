<!-- 头部 -->
	<?php include("tpl/public/top.php");?>
<!-- 头部结束 -->
			<section id="content">
				<section class="vbox">
					<section class="scrollable padder">
						<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
							<li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
							<li>商品管理</li>
							<li>商品编辑</li>
						</ul>
	  
						<!--内容区-->
						<section class="panel panel-default">
							<header class="panel-heading"> 商品编辑 </header>
							<div class="row text-sm wrapper">
								<form class="form-inline" name="searchform" action="<?php echo pfUrl('','goods','index');?>" method="GET" style="margin-left:15px;">
									<input type="hidden" value="goods" name="c"> <input type="hidden" value="index" name="a"> <input type="hidden" name="s" value="is_post" />
										
										商品名称&nbsp;&nbsp;<input name="title" class="input-sm form-control" value="<?php echo $_GET['title']; ?>" style="width:150px;margin-right:25px;" placeholder="商品名称"/>
										商品分类&nbsp;&nbsp;<select name="cid" class="input-sm form-control input-s-sm inline" style="width:105px;margin-right:25px;">
											<option value="">--请选择--</option>
											<?php foreach($cate as $k=>$v){?>
												<option value="<?php echo $v["id"];?>"><?php echo $v["title"];?></option>
											<?php }?>
										</select>
										<!--上/下架&nbsp;&nbsp;<select name="goods_status" class="input-sm form-control input-s-sm inline" style="width:105px;margin-right:25px;">
											<option value="">--请选择--</option>
											<option value="1">上架</option>
											<option value="2">下架</option>
										</select>-->
										商品审核&nbsp;&nbsp;<select name="status" class="input-sm form-control input-s-sm inline" style="width:105px;">
											<option value="">--请选择--</option>
											<option value="no">未审核</option>
											<option value="1">审核通过</option>
											<option value="2">审核不通过</option>
										</select>
										<input type="submit" name="search" class="btn btn-sm btn-default" onClick="return check_form();" value="搜索" style="white-space:nowrap;margin-left:20px;"/>
										<a class="btn btn-sm btn-default" href="<?php echo pfUrl('','goods','index');?>" style="white-space:nowrap;">重置</a>
										
								</form>
							</div>
							<div class="table-responsive">
								<table class="table table-striped b-t b-light text-sm">
									<thead>
										<tr role="row">
											<th width="100" colspan="1"  rowspan="1">ID</th>
											<th width="100" colspan="1" rowspan="1">商品分类</th>
											<th colspan="1" rowspan="1">商品名称</th>
											<th width="100" colspan="1" rowspan="1">库存</th>
											<th width="140" colspan="1" rowspan="1">市场价(通用积分)</th>
											<th width="80" colspan="1" rowspan="1" >审核状态</th>
											<th width="80" colspan="1" rowspan="1" >销量</th>
											<th width="120" colspan="1" rowspan="1">添加时间</th>
											<th width="120" colspan="1" rowspan="1" >操作</th>
										</tr>
									</thead>
									<tbody role="alert" aria-live="polite" aria-relevant="all">
									<?php if(!empty($goods)){?>
										<?php foreach($goods as $key=>$vo){?>
											<tr>
												<td><?php echo $vo["id"];?></td>
												<td><?php echo $vo["catename"];?></td>
												<td><?php echo $vo["title"];?></td>
												<td><?php echo $vo["stock"];?></td>
												<td><?php echo $vo["price"];?></td>
												<td><?php if($vo["status"]==0) echo "未审核";elseif($vo["status"]==1) echo "<font color='#1abc9c'>通过</font>";elseif($vo["status"]==2) echo "<font color='red'>不通过</font>";?></td>
												<td><?php echo $vo["sold"];?></td>
												<td><?php echo date("Y-m-d",$vo["ctime"]);?></td>
												<td>
													<div align="center" style="white-space:nowrap;">
														<a class='btn_change' href="<?php echo pfUrl(" ","goods","edit",array("id"=>$vo['id']))?>" style="white-space:nowrap;">审核</a>
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
  $('.top_shangcheng').addClass('active');
	$('.tabtab7').addClass('active');

var arr1 = $('.minute').val().split(',');
var arr2 = $('.chukuang').val().split(',');

//配置路由
require.config({
	paths: {
	   echarts: 'http://cdn.51daniu.cn/chart/dist'
	}
});
require(
[
	'echarts',
	'echarts/chart/line',
	'echarts/chart/bar'// 使用柱状图就加载bar模块，按需加载
],
function (ec) {
	// 基于准备好的dom，初始化echarts图表
	var myChart = ec.init(document.getElementById('enryK'));
	var option = {
			tooltip : {
				trigger: 'axis'
			},
			legend: {
				data:['出矿量']
			},
			toolbox: {
				show : true,
				feature : {
					mark : {show: true},
					dataView : {show: true, readOnly: false},
					magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
					restore : {show: true},
					saveAsImage : {show: true}
				}
			},
			calculable : true,
			backgroundColor: '#f2f2f2',
			xAxis : [
				{
					type : 'category',
					boundaryGap : false,
					data : arr1
				}
			],
			yAxis : [
				{
					type : 'value'
				}
			],
			series : [
				{
					name:'出矿量',
					type:'line',
					stack: '总量',
					itemStyle: {normal: {areaStyle: {type: 'default'}}},
					data: arr2
				}
			]
		};

	    // 为echarts对象加载数据
	    myChart.setOption(option);
    }
);
</script>
</body>
</html>
