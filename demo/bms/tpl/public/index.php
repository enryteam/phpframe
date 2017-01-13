<body>
<section class="vbox">
	<header class="bg-dark dk header navbar navbar-fixed-top-xs">
		<div class="navbar-header aside-md" style="background-color:#0fa184;"> <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav"> <i class="fa fa-bars"></i> </a> <a href="javascript:;" class="navbar-brand" data-toggle="fullscreen" style="padding-left:43px;"><img src="attms/images/logo.png" class="m-r-sm"></a> <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user"> <i class="fa fa-cog"></i> </a> </div>
		<ul class="nav navbar-nav">
		  <li class="tab_choose top_index" onClick="javascript:window.location.href='index.php?c=index&a=index';$('.tabtab1').addClass('active');$('.tabtab2').removeClass('active');$('.tabtab3').removeClass('active');$('.tabtab4').removeClass('active');$('.tabtab5').removeClass('active');$('.tabtab6').removeClass('active');$('.tabtab7').removeClass('active');"><i class="fa fa-chain icon" style="margin-right:5px;"></i>欢迎页</li>
		  <li class="tab_choose top_xitong" onClick="javascript:$('.tabtab2').addClass('active');$('.tabtab1').removeClass('active');$('.tabtab3').removeClass('active');$('.tabtab4').removeClass('active');$('.tabtab5').removeClass('active');$('.tabtab6').removeClass('active');$('.tabtab7').removeClass('active');"><i class="fa fa-gear icon" style="margin-right:5px;"></i>系统管理</li>
		  <li class="tab_choose top_yonghu" onClick="javascript:$('.tabtab3').addClass('active');$('.tabtab1').removeClass('active');$('.tabtab2').removeClass('active');$('.tabtab4').removeClass('active');$('.tabtab5').removeClass('active');$('.tabtab6').removeClass('active');$('.tabtab7').removeClass('active');"><i class="fa fa-user icon" style="margin-right:5px;"></i>用户管理</li>
		  <li class="tab_choose top_caiwu" onClick="javascript:$('.tabtab4').addClass('active');$('.tabtab1').removeClass('active');$('.tabtab2').removeClass('active');$('.tabtab3').removeClass('active');$('.tabtab5').removeClass('active');$('.tabtab6').removeClass('active');$('.tabtab7').removeClass('active');"><i class="fa fa-user icon" style="margin-right:5px;"></i>财务管理</li>
		  <li class="tab_choose top_jiaoyi" onClick="javascript:$('.tabtab5').addClass('active');$('.tabtab1').removeClass('active');$('.tabtab2').removeClass('active');$('.tabtab3').removeClass('active');$('.tabtab4').removeClass('active');$('.tabtab6').removeClass('active');$('.tabtab7').removeClass('active');"><i class="fa fa-tag icon" style="margin-right:5px;"></i>交易管理</li>
		  <li class="tab_choose top_neirong" onClick="javascript:$('.tabtab6').addClass('active');$('.tabtab1').removeClass('active');$('.tabtab2').removeClass('active');$('.tabtab3').removeClass('active');$('.tabtab4').removeClass('active');$('.tabtab5').removeClass('active');$('.tabtab7').removeClass('active');"><i class="fa fa-bars icon" style="margin-right:5px;"></i>内容管理</li>
		  <li class="tab_choose top_shangcheng" onClick="javascript:$('.tabtab7').addClass('active');$('.tabtab1').removeClass('active');$('.tabtab2').removeClass('active');$('.tabtab3').removeClass('active');$('.tabtab4').removeClass('active');$('.tabtab5').removeClass('active');$('.tabtab6').removeClass('active');"><i class="fa fa-briefcase icon" style="margin-right:5px;"></i>商城管理</li>
		  
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
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">管理员管理</span> </a>
								<ul class="nav lt">
								  <li > <a href="<?php echo pfurl('','admin','index')?>" ><span style="padding-left:25px;">管理员列表</span> </a></li>
								  <li > <a href="<?php echo pfurl('','admin','add')?>" ><span style="padding-left:25px;">添加管理员</span> </a></li>
								</ul>
							  </li>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">管理组管理</span> </a>
								<ul class="nav lt">
								  <li > <a href="<?php echo pfurl('','group','index')?>" ><span style="padding-left:25px;">管理组列表</span> </a></li>
								  <li > <a href="<?php echo pfurl('','group','add')?>" ><span style="padding-left:25px;">添加管理组</span> </a></li>
								</ul>
							  </li>
							</ul>

							<ul class="nav tabtab tabtab3">
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">用户管理</span> </a>
								<ul class="nav lt">
								  <li > <a href="<?php echo pfurl('','user','index');?>" ><span style="padding-left:25px;">用户列表</span> </a></li>
								  <li > <a href="<?php echo pfurl('','user','batchimport');?>" ><span style="padding-left:25px;">批量开户</span> </a></li>
								</ul>
							  </li>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">交易商管理</span> </a>
								<ul class="nav lt">
								  <li > <a href="<?php echo pfurl('','dealer','index');?>" ><span style="padding-left:25px;">挂牌列表</span> </a></li>
								  <li > <a href="<?php echo pfurl('','dealer','batchimport');?>" ><span style="padding-left:25px;">批量挂牌</span> </a></li>
								</ul>
							  </li>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">卖家管理</span> </a>
								<ul class="nav lt">
								  <li > <a href="<?php echo pfurl('','seller','index');?>" ><span style="padding-left:25px;">店铺审核</span> </a></li>
								</ul>
							  </li>
							</ul>

							<ul class="nav tabtab tabtab4">
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">出入金管理</span> </a>
								<ul class="nav lt">
								  <li > <a href="<?php echo pfurl('','rlist','index');?>" ><span style="padding-left:25px;">入金管理</span> </a></li>
								  <li > <a href="<?php echo pfurl('','withdraw','index');?>" ><span style="padding-left:25px;">出金管理</span> </a></li>
								</ul>
							  </li>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">财务报表</span> </a>
								<ul class="nav lt">
								  <li > <a href="<?php echo pfurl('','finance','index');?>" ><span style="padding-left:25px;">列表</span> </a></li>
								</ul>
							  </li>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">账号管理</span> </a>
								<ul class="nav lt">
								  <li > <a href="<?php echo pfurl('','bankbind','index');?>" ><span style="padding-left:25px;">银行卡绑定列表</span> </a></li>
								</ul>
							  </li>
							</ul>

							<ul class="nav tabtab tabtab5">
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">参数设置</span> </a>
								<ul class="nav lt">
								  <li > <a href="<?php echo pfurl('','deal','parameter');?>" ><span style="padding-left:25px;">参数设置</span> </a></li>
								</ul>
							  </li>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">交易统计</span> </a>
								<ul class="nav lt">
								  <li > <a href="<?php echo pfurl('','deal','index');?>" ><span style="padding-left:25px;">列表</span> </a></li>
								</ul>
							  </li>
							</ul>

							<ul class="nav tabtab tabtab6">
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">文章管理</span> </a>
								<ul class="nav lt">
								  <li > <a href="<?php echo pfurl('','article','index');?>" ><span style="padding-left:25px;">列表</span> </a></li>
								  <li > <a href="<?php echo pfurl('','article','add');?>" ><span style="padding-left:25px;">添加</span> </a></li>
								</ul>
							  </li>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">文章分类管理</span> </a>
								<ul class="nav lt">
								  <li > <a href="<?php echo pfurl('','article_cate','index');?>" ><span style="padding-left:25px;">列表</span> </a></li>
								  <li > <a href="<?php echo pfurl('','article_cate','add');?>" ><span style="padding-left:25px;">添加</span> </a></li>
								</ul>
							  </li>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">友情链接管理</span> </a>
								<ul class="nav lt">
								  <li > <a href="<?php echo pfurl('','link','index');?>" ><span style="padding-left:25px;">列表</span> </a></li>
								  <li > <a href="<?php echo pfurl('','link','add');?>" ><span style="padding-left:25px;">添加</span> </a></li>
								</ul>
							  </li>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">银行管理</span> </a>
								<ul class="nav lt">
								  <li > <a href="<?php echo pfurl('','bank','index');?>" ><span style="padding-left:25px;">列表</span> </a></li>
								  <li > <a href="<?php echo pfurl('','bank','add');?>" ><span style="padding-left:25px;">添加</span> </a></li>
								</ul>
							  </li>
							</ul>

							<ul class="nav tabtab tabtab7">
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">商品订单管理</span> </a>
								<ul class="nav lt">
								  <li > <a href="<?php echo pfurl('','order','index');?>" ><span style="padding-left:25px;">订单列表</span> </a></li>
								</ul>
							  </li>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">商品管理</span> </a>
								<ul class="nav lt">
								  <li > <a href="<?php echo pfurl('','goods','index');?>" ><span style="padding-left:25px;">商品列表</span> </a></li>
								</ul>
							  </li>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">商品分类管理</span> </a>
								<ul class="nav lt">
								  <li > <a href="<?php echo pfurl('','goods_cate','index');?>" ><span style="padding-left:25px;">商品分类列表</span> </a></li>
								  <li > <a href="<?php echo pfurl('','goods_cate','add');?>" ><span style="padding-left:25px;">添加商品分类</span> </a></li>
								</ul>
							  </li>
							  <li class="active"> <a href="javascript:;" style="background-color:#394555;"><span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span style="padding-left:15px;">入场登记管理</span> </a>
								<ul class="nav lt">
								  <li > <a href="<?php echo pfurl('','goods_release','index');?>" ><span style="padding-left:25px;">入场登记列表</span> </a></li>
								</ul>
							  </li>
							</ul>

							
						  </nav>
						  <!-- / nav --> </div>
					  </section>
					  <footer class="footer lt hidden-xs b-t b-dark">
						<a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon"> <i class="fa fa-angle-left text"></i> <i class="fa fa-angle-right text-active"></i> </a>
					  </footer>
					</section>
				  </aside>