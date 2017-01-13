	<!-- 头部 -->
		<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->
    <section id="content">
        <section class="vbox">
			<section class="scrollable padder">
				<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
				  <li><a href="<?php echo pfurl('','index','index')?>"><i class="fa fa-home"></i> Home</a></li>
				</ul>
				<div class="m-b-md">
				  <h3 class="m-b-none">欢迎您</h3>
				  <small>进入积交所后台业务管理系统</small> </div>
				<section class="panel panel-default">
				  <div class="row m-l-none m-r-none bg-light lter">
					<div class="col-sm-6 col-md-3 padder-v b-r b-light"> 
						<span class="fa-stack fa-2x pull-left m-r-sm"> 
							<i class="fa fa-arrow-down"></i> 
						</span> 
						<a class="clear" href="javascript:;"> 
							<span class="h3 block m-t-xs">
								<strong><?php echo ltrim(implode(',', str_split(str_repeat('-', 3 - (strlen($datas["recharge"]) % 3)).$datas["recharge"],3)),'-');?></strong>
							</span> 
							<small class="text-muted text-uc">入金总额</small> 
						</a> 
					</div>
					<div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> 
						<span class="fa-stack fa-2x pull-left m-r-sm"> 
							<i class="fa fa-arrow-up"></i>
						</span> 
						<a class="clear" href="javascript:;">
							<span class="h3 block m-t-xs">
								<strong id="bugs"><?php echo ltrim(implode(',', str_split(str_repeat('-', 3 - (strlen($datas["withdraw"]) % 3)).$datas["withdraw"],3)),'-');;?></strong>
							</span> 
							<small class="text-muted text-uc">出金总额</small> 
						</a> 
					</div>
					<div class="col-sm-6 col-md-3 padder-v b-r b-light">
						<span class="fa-stack fa-2x pull-left m-r-sm"> 
							<i class="fa fa-signal"></i> 
						</span> 
						<a class="clear" href="javascript:;"> 
							<span class="h3 block m-t-xs">
								<strong id="firers"><?php echo $datas["dealnum"];?></strong>
							</span> 
							<small class="text-muted text-uc">总成交量</small> 
						</a> 
					</div>
					<div class="col-sm-6 col-md-3 padder-v b-r b-light lt"> 
						<span class="fa-stack fa-2x pull-left m-r-sm"> 
							<i class="fa fa-tasks"></i>
						</span> 
						<a class="clear" href="javascript:;"> 
							<span class="h3 block m-t-xs">
								<strong><?php echo $datas["releasenum"];?></strong>
							</span> 
							<small class="text-muted text-uc">总发售量</small>
						</a>
					</div>
				</div>
				<div style="margin-top:20px;"></div>
				<div class="row m-l-none m-r-none bg-light lter">
					<div class="col-sm-6 col-md-3 padder-v b-r b-light" style="background-color: #f7f7f7;"> 
						<span class="fa-stack fa-2x pull-left m-r-sm"> 
							<i class="fa fa-user"></i> 
						</span> 
						<a class="clear" href="javascript:;"> 
							<span class="h3 block m-t-xs">
								<strong><?php echo $datas["usernum"];?></strong>
							</span> 
							<small class="text-muted text-uc">用户总量</small> 
						</a> 
					</div>
					<div class="col-sm-6 col-md-3 padder-v b-r b-light lt" style="background-color: #fff;"> 
						<span class="fa-stack fa-2x pull-left m-r-sm"> 
							<i class="fa fa-th-list"></i> 
						</span> 
						<a class="clear" href="javascript:;">
							<span class="h3 block m-t-xs">
								<strong id="bugs"><?php echo $datas["entrymarket"];?></strong>
							</span> 
							<small class="text-muted text-uc">挂牌总量</small> 
						</a> 
					</div>
					<div class="col-sm-6 col-md-3 padder-v b-r b-light" style="background-color: #f7f7f7;">
						<span class="fa-stack fa-2x pull-left m-r-sm"> 
							<i class="fa fa-home"></i> 
						</span> 
						<a class="clear" href="javascript:;"> 
							<span class="h3 block m-t-xs">
								<strong id="firers"><?php echo $datas["mallnum"];?></strong>
							</span> 
							<small class="text-muted text-uc">商铺总量</small> 
						</a> 
					</div>
					<div class="col-sm-6 col-md-3 padder-v b-r b-light lt" style="background-color: #fff;"> 
						<span class="fa-stack fa-2x pull-left m-r-sm"> 
							<i class="fa fa-tags"></i>
						</span> 
						<a class="clear" href="javascript:;"> 
							<span class="h3 block m-t-xs">
								<strong><?php echo $datas["ordernum"];?></strong>
							</span> 
							<small class="text-muted text-uc">订单总量</small>
						</a>
					</div>
				  </div>
				</section>
				<div class="row" style="margin-top:60px;">
				  <div class="col-md-8">
					<section class="panel panel-default">
					  <header class="panel-heading font-bold">登录日志<i style="font-style:normal;font-size:10px;color:#999999;">(截止数据为昨天)</i></header>
					  <table class="table table-striped b-t b-light text-sm">
						<thead>
							<tr role="row">
								<th width="15%" colspan="1"  rowspan="1" role="columnheader" tabindex="0" >ID</th>
								<th width="25%" colspan="1" rowspan="1" role="columnheader" >管理员名称</th>
								<th width="25%" colspan="1" rowspan="1" role="columnheader" >登录IP</th>
								<th width="25%" colspan="1" rowspan="1" role="columnheader" aria-label="">登录时间</th>
							</tr>
						</thead>
						<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php if(!empty($log)){?>
							<?php foreach($log as $key=>$vo){?>
								<tr>
									<td><?php echo $vo["id"];?></td>
									<td><?php echo $vo["admin_name"];?></td>
									<td><?php echo $vo["loginip"];?></td>
									<td><?php echo date("Y-m-d H:i:s",$vo["logintime"]);?></td>
								</tr>
							<?php }}else{?>
								<tr>
									<td colspan="10" align="center">没有记录！</td>
								</tr>
						<?php }?>

						</tbody>
					</table>
					</section>
				  </div>
				  <div class="col-md-4">
					<section class="panel panel-default" style="height:347px;">
					  <header class="panel-heading font-bold" style="background-color:#ffffff;border-bottom:0 none;">服务器信息</header>
					  <h1 style="padding:0px 15px 10px;font-size:12px;color:#666666;margin:0;line-height:20px;">程序名称：业务管理系统 - BMS(简称)</h1>
					  <h1 style="padding:0px 15px 10px;font-size:12px;color:#666666;margin:0;line-height:20px;">系统版本：v2.0.0</h1>
					  <h1 style="padding:0px 15px 10px;font-size:12px;color:#666666;margin:0;line-height:20px;">操作系统：CentOS</h1>
					  <h1 style="padding:0px 15px 10px;font-size:12px;color:#666666;margin:0;line-height:20px;">运行环境：Apache/2.44(Unix)OpenSSL/1.0.1e PHP/5.5.3 mod_perl/2.0.8-dev Perl/v5.16.3</h1>
					  <h1 style="padding:0px 15px 10px;font-size:12px;color:#666666;margin:0;line-height:20px;">数据版本：5.6.12</h1>
					  <h1 style="padding:0px 15px 10px;font-size:12px;color:#666666;margin:0;line-height:20px;">版权所有：CN.ENRY.JJS</h1>
					  <h1 style="padding:0px 15px 10px;font-size:12px;color:#666666;margin:0;line-height:20px;">站点路径：/htdocs/jjs/bms</h1>
					  <h1 style="padding:0px 15px 10px;font-size:12px;color:#666666;margin:0;line-height:20px;">运行时间：<?php echo date("YmdHis");?></h1>
					</section>
				  </div>
				</div>
				
			</section>
        </section>
    </section>
	<!-- 尾部 -->
		<?php include("tpl/public/bottom.php");?>
	<!-- 尾部结束 -->
	<script type="text/javascript">
	$('.top_index').addClass('active');
	$('.tabtab1').addClass('active');
	</script>
</body>
</html>
