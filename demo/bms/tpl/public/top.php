<!DOCTYPE html>
<html lang="en" class="app">
<head>
<meta charset="utf-8" />
<title>积交所——BMS后台管理系统</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="stylesheet" href="attms/css/app.v2.css" type="text/css" />
<link rel="stylesheet" href="attms/css/font.css" type="text/css" cache="false" />
<link rel="stylesheet" href="attms/css/style.css" type="text/css" cache="false" />
<link rel="stylesheet" href="attms/js/calendar/bootstrap_calendar.css" type="text/css" cache="false" />
<script type="text/javascript" src="attms/js/jquery-1.11.3.js"></script>
<!--artDialog插件-->
<script type="text/javascript" src="attms/js/jquery.form.js"></script>
<script type="text/javascript" src="attms/js/pan_jquery.js"></script>
<script type="text/javascript" src="attms/js/artDialog4.1.7/artDialog.js?skin=twitter"></script>
<script src="attms/js/artDialog4.1.7/plugins/iframeTools.js"></script>
<!--artDialog插件-->
<script language="javascript" type="text/javascript" src="attms/My97DatePicker/WdatePicker.js"></script>
<style media="screen">
  .tab_choose{
    height:50px;
    line-height:50px;
    text-align:center;
    color:#ffffff;
    font-size:16px;
    cursor:pointer;
    background-color:#1abc9c;
    padding: 0 25px;
  }
  .tab_choose.active{
    background-color: #ffffff;
    color: #1abc9c;
  }
  .tabtab{
    display: none;
  }
  .tabtab.active{
    display: block;
  }
  
</style>
<!--[if lt IE 9]> <script src="js/ie/html5shiv.js" cache="false"></script> <script src="js/ie/respond.min.js" cache="false"></script> <script src="js/ie/excanvas.js" cache="false"></script> <![endif]-->
</head>
<body>
<section class="vbox">
	<header class="bg-dark dk header navbar navbar-fixed-top-xs">
		<div class="navbar-header aside-md" style="background-color:#0fa184;"> <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav"> <i class="fa fa-bars"></i> </a> <a href="javascript:;" class="navbar-brand" data-toggle="fullscreen" style="padding-left:43px;"><img src="attms/images/logo.png" class="m-r-sm"></a> <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user"> <i class="fa fa-cog"></i> </a> </div>
		<ul class="nav navbar-nav">
		  <li class="tab_choose top_index" onClick="javascript:window.location.href='index.php?c=index&a=index';$('.tabtab1').addClass('active');$('.tabtab2').removeClass('active');$('.tabtab3').removeClass('active');$('.tabtab4').removeClass('active');$('.tabtab5').removeClass('active');$('.tabtab6').removeClass('active');$('.tabtab7').removeClass('active');"><i class="fa fa-chain icon" style="margin-right:5px;"></i>欢迎页</li>
			<?php if(in_array('admin::index',$_SESSION['user_quanxian']) || in_array('admin::add',$_SESSION['user_quanxian']) || in_array('group::index',$_SESSION['user_quanxian']) || in_array('group::add',$_SESSION['user_quanxian'])){?>
		  <li class="tab_choose top_xitong" onClick="javascript:$('.tabtab2').addClass('active');$('.tabtab1').removeClass('active');$('.tabtab3').removeClass('active');$('.tabtab4').removeClass('active');$('.tabtab5').removeClass('active');$('.tabtab6').removeClass('active');$('.tabtab7').removeClass('active');$('.tabtab8').removeClass('active');"><i class="fa fa-gear icon" style="margin-right:5px;"></i>系统管理</li>
			<?php }?>
			<?php if(in_array('user::index',$_SESSION['user_quanxian']) || in_array('user::batchimport',$_SESSION['user_quanxian']) || in_array('seller::index',$_SESSION['user_quanxian']) || in_array('dealer::index',$_SESSION['user_quanxian']) || in_array('dealer::batchimport',$_SESSION['user_quanxian'])){?>
		  <li class="tab_choose top_yonghu" onClick="javascript:$('.tabtab3').addClass('active');$('.tabtab1').removeClass('active');$('.tabtab2').removeClass('active');$('.tabtab4').removeClass('active');$('.tabtab5').removeClass('active');$('.tabtab6').removeClass('active');$('.tabtab7').removeClass('active');$('.tabtab8').removeClass('active');"><i class="fa fa-user icon" style="margin-right:5px;"></i>客户管理</li>
			<?php }?>
			<?php if(in_array('rlist::index',$_SESSION['user_quanxian']) || in_array('withdraw::index',$_SESSION['user_quanxian']) || in_array('finance::index',$_SESSION['user_quanxian']) || in_array('bankbind::index',$_SESSION['user_quanxian'])){?>
		  <li class="tab_choose top_caiwu" onClick="javascript:$('.tabtab4').addClass('active');$('.tabtab1').removeClass('active');$('.tabtab2').removeClass('active');$('.tabtab3').removeClass('active');$('.tabtab5').removeClass('active');$('.tabtab6').removeClass('active');$('.tabtab7').removeClass('active');$('.tabtab8').removeClass('active');"><i class="fa fa-user icon" style="margin-right:5px;"></i>财务管理</li>
			<?php }?>
			<?php if(in_array('deal::parameter',$_SESSION['user_quanxian']) || in_array('deal::index',$_SESSION['user_quanxian'])){?>
		  <li class="tab_choose top_jiaoyi" onClick="javascript:$('.tabtab5').addClass('active');$('.tabtab1').removeClass('active');$('.tabtab2').removeClass('active');$('.tabtab3').removeClass('active');$('.tabtab4').removeClass('active');$('.tabtab6').removeClass('active');$('.tabtab7').removeClass('active');$('.tabtab8').removeClass('active');"><i class="fa fa-tag icon" style="margin-right:5px;"></i>交易管理</li>
			<?php }?>
			<?php if(in_array('article::index',$_SESSION['user_quanxian']) || in_array('article::add',$_SESSION['user_quanxian']) || in_array('article_cate::index',$_SESSION['user_quanxian']) || in_array('article_cate::add',$_SESSION['user_quanxian']) || in_array('link::index',$_SESSION['user_quanxian']) || in_array('link::add',$_SESSION['user_quanxian']) || in_array('bank::index',$_SESSION['user_quanxian']) || in_array('bank::add',$_SESSION['user_quanxian'])){?>
		  <li class="tab_choose top_neirong" onClick="javascript:$('.tabtab6').addClass('active');$('.tabtab1').removeClass('active');$('.tabtab2').removeClass('active');$('.tabtab3').removeClass('active');$('.tabtab4').removeClass('active');$('.tabtab5').removeClass('active');$('.tabtab7').removeClass('active');$('.tabtab8').removeClass('active');"><i class="fa fa-bars icon" style="margin-right:5px;"></i>内容管理</li>
			<?php }?>
			<?php if(in_array('order::index',$_SESSION['user_quanxian']) || in_array('goods::index',$_SESSION['user_quanxian']) || in_array('goods_cate::index',$_SESSION['user_quanxian']) || in_array('goods_cate::add',$_SESSION['user_quanxian'])){?>
		  <li class="tab_choose top_shangcheng" onClick="javascript:$('.tabtab7').addClass('active');$('.tabtab1').removeClass('active');$('.tabtab2').removeClass('active');$('.tabtab3').removeClass('active');$('.tabtab4').removeClass('active');$('.tabtab5').removeClass('active');$('.tabtab6').removeClass('active');$('.tabtab8').removeClass('active');"><i class="fa fa-briefcase icon" style="margin-right:5px;"></i>商城管理</li>
			<?php }?>
		  <?php if(in_array('operate::index',$_SESSION['user_quanxian']) || in_array('agent_operation::index',$_SESSION['user_quanxian']) || in_array('agent::index',$_SESSION['user_quanxian'])){?>
		  <li class="tab_choose top_yunying" onClick="javascript:$('.tabtab8').addClass('active');$('.tabtab1').removeClass('active');$('.tabtab2').removeClass('active');$('.tabtab3').removeClass('active');$('.tabtab4').removeClass('active');$('.tabtab5').removeClass('active');$('.tabtab6').removeClass('active');$('.tabtab7').removeClass('active');"><i class="fa fa-briefcase icon" style="margin-right:5px;"></i>运营管理</li>
			<?php }?>
		</ul>
		<ul class="nav navbar-nav navbar-right hidden-xs nav-user">
			<li class="dropdown" style="background-color:#0fa184;"> <a href="javascript:;" style="background-color:#0fa184;">管理员：<?php echo $admin['adminname'];?></a></li>
			<li class="dropdown xxx" style="background-color:#ffc333;"> <a href="index.php?c=index&a=logout" style="color:#333333;background-color: #ffc333;">安全退出</a></li>
		</ul>
	</header>
	<section>
		<section class="hbox stretch"> <!-- .aside -->
			<aside class="bg-dark lter aside-md hidden-print" id="nav">
					<section class="vbox">
					  <section class="w-f scrollable" style="background-color:#394555;">
						<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333"> <!-- nav -->
						  <nav class="nav-primary hidden-xs">
							<ul class="nav tabtab tabtab1">
							  <li> <a href="javascript:;" style="background-color:#394555;"><span style="padding-left:15px;">欢迎页</span> </a></li>
							</ul>
							<ul class="nav tabtab tabtab2">
							  <?php if(in_array('admin::index',$_SESSION['user_quanxian']) || in_array('admin::add',$_SESSION['user_quanxian'])){?>
									<li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">操作员管理</span> </a>
									<ul class="nav lt">
										<?php if(in_array('admin::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','admin','index')?>" ><span style="padding-left:25px;">操作员编辑</span> </a></li><?php }?>
										<?php if(in_array('admin::add',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','admin','add')?>" ><span style="padding-left:25px;">操作员新增</span> </a></li><?php }?>
									</ul>
									</li>
								<?php }?>
								<?php if(in_array('group::index',$_SESSION['user_quanxian']) || in_array('group::add',$_SESSION['user_quanxian'])){?>
									<li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">权限组管理</span> </a>
									<ul class="nav lt">
										<?php if(in_array('group::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','group','index')?>" ><span style="padding-left:25px;">权限组编辑</span> </a></li><?php }?>
										<?php if(in_array('group::add',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','group','add')?>" ><span style="padding-left:25px;">权限组新增</span> </a></li><?php }?>
									</ul>
									</li>
								<?php }?>
							</ul>

							<ul class="nav tabtab tabtab3">
							  <?php if(in_array('user::index',$_SESSION['user_quanxian']) || in_array('user::batchimport',$_SESSION['user_quanxian'])){?>
									<li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">客户管理</span> </a>
									<ul class="nav lt">
										<?php if(in_array('user::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','user','index');?>" ><span style="padding-left:25px;">客户编辑</span> </a></li><?php }?>
										<?php if(in_array('user::batchimport',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','user','batchimport');?>" ><span style="padding-left:25px;">批量开户</span> </a></li><?php }?>
									</ul>
									</li>
								<?php }?>
								<?php if(in_array('dealer::index',$_SESSION['user_quanxian']) || in_array('dealer::batchimport',$_SESSION['user_quanxian'])){?>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">交易商管理</span> </a>
								<ul class="nav lt">
								  <?php if(in_array('dealer::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','dealer','index');?>" ><span style="padding-left:25px;">挂牌编辑</span> </a></li><?php }?>
								  <?php if(in_array('dealer::batchimport',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','dealer','batchimport');?>" ><span style="padding-left:25px;">批量挂牌</span> </a></li><?php }?>
								  <?php if(in_array('goods_release::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','goods_release','index');?>" ><span style="padding-left:25px;">入场登记</span> </a></li><?php }?>
								</ul>
							  </li>
								<?php }?>
								<?php if(in_array('seller::index',$_SESSION['user_quanxian'])){?>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">卖家管理</span> </a>
								<ul class="nav lt">
								  <?php if(in_array('seller::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','seller','index');?>" ><span style="padding-left:25px;">店铺审核</span> </a></li><?php }?>
								</ul>
							  </li>
								<?php }?>
							</ul>

							<ul class="nav tabtab tabtab4">
							  <?php if(in_array('rlist::index',$_SESSION['user_quanxian']) || in_array('withdraw::index',$_SESSION['user_quanxian'])){?>
								<li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">出入金管理</span> </a>
								<ul class="nav lt">
								  <?php if(in_array('rlist::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','rlist','index');?>" ><span style="padding-left:25px;">入金管理</span> </a></li><?php }?>
								  <?php if(in_array('withdraw::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','withdraw','index');?>" ><span style="padding-left:25px;">出金管理</span> </a></li><?php }?>
								</ul>
							  </li>
								<?php }?>
								<?php if(in_array('finance::index',$_SESSION['user_quanxian'])){?>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">报表管理</span> </a>
								<ul class="nav lt">
								  <?php if(in_array('finance::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','finance','index');?>" ><span style="padding-left:25px;">财务报表</span> </a></li><?php }?>
								</ul>
							  </li>
								<?php }?>
								<?php if(in_array('bankbind::index',$_SESSION['user_quanxian'])){?>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">账号管理</span> </a>
								<ul class="nav lt">
								  <?php if(in_array('bankbind::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','bankbind','index');?>" ><span style="padding-left:25px;">银行卡绑定</span> </a></li><?php }?>
								</ul>
							  </li>
								<?php }?>
							</ul>

							<ul class="nav tabtab tabtab5">
							  <?php if(in_array('deal::parameter',$_SESSION['user_quanxian'])){?>
								<li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">交易参数</span> </a>
								<ul class="nav lt">
								  <?php if(in_array('deal::parameter',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','deal','parameter');?>" ><span style="padding-left:25px;">参数设置</span> </a></li><?php }?>
								</ul>
							  </li>
								<?php }?>
								<?php if(in_array('deal::index',$_SESSION['user_quanxian'])){?>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">交易统计</span> </a>
								<ul class="nav lt">
								  <?php if(in_array('deal::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','deal','index');?>" ><span style="padding-left:25px;">成交记录</span> </a></li><?php }?>
								</ul>
							  </li>
								<?php }?>
							</ul>

							<ul class="nav tabtab tabtab6">
							  <?php if(in_array('article::index',$_SESSION['user_quanxian']) || in_array('article::add',$_SESSION['user_quanxian'])){?>
								<li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">文章管理</span> </a>
								<ul class="nav lt">
								  <?php if(in_array('article::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','article','index');?>" ><span style="padding-left:25px;">文章编辑</span> </a></li><?php }?>
								  <?php if(in_array('article::add',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','article','add');?>" ><span style="padding-left:25px;">文章新增</span> </a></li><?php }?>
								</ul>
							  </li>
								<?php }?>
								<?php if(in_array('article_cate::index',$_SESSION['user_quanxian']) || in_array('article_cate::add',$_SESSION['user_quanxian'])){?>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">文章分类管理</span> </a>
								<ul class="nav lt">
								  <?php if(in_array('article_cate::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','article_cate','index');?>" ><span style="padding-left:25px;">文章分类编辑</span> </a></li><?php }?>
								  <?php if(in_array('article_cate::add',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','article_cate','add');?>" ><span style="padding-left:25px;">文章分类新增</span> </a></li><?php }?>
								</ul>
							  </li>
								<?php }?>
								<?php if(in_array('link::index',$_SESSION['user_quanxian']) || in_array('link::add',$_SESSION['user_quanxian'])){?>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">友情链接管理</span> </a>
								<ul class="nav lt">
								  <?php if(in_array('link::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','link','index');?>" ><span style="padding-left:25px;">友情链接编辑</span> </a></li><?php }?>
								  <?php if(in_array('link::add',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','link','add');?>" ><span style="padding-left:25px;">友情链接新增</span> </a></li><?php }?>
								</ul>
							  </li>
								<?php }?>
								<?php if(in_array('bank::index',$_SESSION['user_quanxian']) || in_array('bank::add',$_SESSION['user_quanxian'])){?>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">银行管理</span> </a>
								<ul class="nav lt">
								  <?php if(in_array('bank::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','bank','index');?>" ><span style="padding-left:25px;">银行浏览</span> </a></li><?php }?>
								  <?php if(in_array('bank::add',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','bank','add');?>" ><span style="padding-left:25px;">银行新增</span> </a></li><?php }?>
								</ul>
							  </li>
								<?php }?>
							</ul>

							<ul class="nav tabtab tabtab7">
								<?php if(in_array('order::index',$_SESSION['user_quanxian'])){?>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">商品订单管理</span> </a>
								<ul class="nav lt">
								  <?php if(in_array('order::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','order','index');?>" ><span style="padding-left:25px;">订单浏览</span> </a></li><?php }?>
								</ul>
							  </li>
								<?php }?>
								<?php if(in_array('goods::index',$_SESSION['user_quanxian'])){?>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">商品管理</span> </a>
								<ul class="nav lt">
								  <?php if(in_array('goods::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','goods','index');?>" ><span style="padding-left:25px;">商品审核</span> </a></li><?php }?>
								</ul>
							  </li>
								<?php }?>
								<?php if(in_array('goods_cate::index',$_SESSION['user_quanxian']) || in_array('goods_cate::add',$_SESSION['user_quanxian'])){?>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">商品分类管理</span> </a>
								<ul class="nav lt">
								  <?php if(in_array('goods_cate::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','goods_cate','index');?>" ><span style="padding-left:25px;">商品分类编辑</span> </a></li><?php }?>
								  <?php if(in_array('goods_cate::add',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','goods_cate','add');?>" ><span style="padding-left:25px;">商品分类新增</span> </a></li><?php }?>
								</ul>
							  </li>
								<?php }?>
								
							</ul>
							<ul class="nav tabtab tabtab8">
								<?php if(in_array('operate::index',$_SESSION['user_quanxian'])){?>
								<li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">运营中心管理</span> </a>
									<ul class="nav lt">
										<?php if(in_array('operate::batchimport',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','operate','batchimport');?>" ><span style="padding-left:25px;">批量开户</span> </a></li><?php }?>
										<?php if(in_array('operate::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','operate','index');?>" ><span style="padding-left:25px;">运营中心编辑</span> </a></li><?php }?>
										<?php if(in_array('operate::development',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','operate','development');?>" ><span style="padding-left:25px;">发展客户</span> </a></li><?php }?>
										<?php if(in_array('operate::deal',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','operate','deal');?>" ><span style="padding-left:25px;">交易统计</span> </a></li><?php }?>
									</ul>
								</li>
								<?php }?>
								<?php if(in_array('agent_operation::index',$_SESSION['user_quanxian'])){?>
								<li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">代理运营中心管理</span> </a>
									<ul class="nav lt">
										<?php if(in_array('agent_operation::batchimport',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','agent_operation','batchimport');?>" ><span style="padding-left:25px;">批量开户</span> </a></li><?php }?>
										<?php if(in_array('agent_operation::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','agent_operation','index');?>" ><span style="padding-left:25px;">代理运营编辑</span> </a></li><?php }?>
										<?php if(in_array('agent_operation::development',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','agent_operation','development');?>" ><span style="padding-left:25px;">发展客户</span> </a></li><?php }?>
										<?php if(in_array('agent_operation::deal',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','agent_operation','deal');?>" ><span style="padding-left:25px;">交易统计</span> </a></li><?php }?>
									</ul>
								</li>
								<?php }?>
								<?php if(in_array('agent::index',$_SESSION['user_quanxian'])){?>
								<li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">代理商管理</span> </a>
									<ul class="nav lt">
										<?php if(in_array('agent::batchimport',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','agent','batchimport');?>" ><span style="padding-left:25px;">批量开户</span> </a></li><?php }?>
										<?php if(in_array('agent::index',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','agent','index');?>" ><span style="padding-left:25px;">代理商编辑</span> </a></li><?php }?>
										<?php if(in_array('agent::development',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','agent','development');?>" ><span style="padding-left:25px;">发展客户</span> </a></li><?php }?>
										<?php if(in_array('agent::deal',$_SESSION['user_quanxian'])){?><li > <a href="<?php echo pfurl('','agent','deal');?>" ><span style="padding-left:25px;">交易统计</span> </a></li><?php }?>
									</ul>
								</li>
								<?php }?>
								
							</ul>

							
						  </nav>
						  <!-- / nav --> </div>
					  </section>
					  <footer class="footer lt hidden-xs b-t b-dark">
						<a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon"> <i class="fa fa-angle-left text"></i> <i class="fa fa-angle-right text-active"></i> </a>
					  </footer>
					</section>
			</aside>
