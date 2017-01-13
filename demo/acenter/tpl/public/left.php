<div class="">
	<h1 class="dhl" data="1" style="cursor:pointer;"><?php if($userdata['type'] == 0) echo "用户中心";elseif($userdata['type'] == 2) echo "运营中心";elseif($userdata['type'] == 3) echo "代理运营中心";elseif($userdata['type'] == 4) echo "代理商中心";elseif($userdata['type'] == 1) echo "卖家中心";?></h1>
	<?php if($userdata['type'] <2 ){?>
	<div class="left">
		<ul>
			<li id="li1">
				<a href="javascript:;"><img src="../attms/images/user1.png" style="width:22px;height:22px;vertical-align:middle;position:relative;top:-2px;margin-right:10px;" />我的资料</a>
				<dl id="left_dl1">
					<dt class="dhl" data="2" onclick="javascript:window.location.href='<?php echo pfUrl('', 'user', 'personal')?>'">基本信息</dt>
					<dt class="dhl" data="3" onclick="javascript:window.location.href='<?php echo pfUrl('', 'user', 'pay_pwd')?>'">支付密码</dt>
					<dt class="dhl" data="4" onclick="javascript:window.location.href='<?php echo pfUrl('', 'user', 'bank')?>'">银行卡绑定</dt>
					<dt class="dhl" data="5" onclick="javascript:window.location.href='<?php echo pfUrl('', 'user', 'addr')?>'">收货地址</dt>
				</dl>
			</li>
			<li id="li2">
				<a href="javascript:;"><img src="../attms/images/user2.png" style="width:22px;height:22px;vertical-align:middle;position:relative;top:-2px;margin-right:10px;" />我的资产</a>
				<dl id="left_dl2">
					<dt onclick="javascript:window.location.href='<?php echo pfUrl('', 'user', 'assets')?>'">收支明细</dt>
				</dl>
			</li>
			<li id="li3">
				<a href="javascript:;"><img src="../attms/images/user4.png" style="width:22px;height:22px;vertical-align:middle;position:relative;top:-2px;margin-right:10px;" />我是买家</a>
				<dl id="left_dl3">
					<dt onclick="javascript:window.location.href='<?php echo pfUrl('', 'user', 'myorder')?>'">我的订单</dt>
				</dl>
			</li>
			<li id="li4">
				<a href="javascript:;"><img src="../attms/images/user3.png" style="width:22px;height:22px;vertical-align:middle;position:relative;top:-2px;margin-right:10px;" />我是卖家</a>
				<dl id="left_dl4">
					<?php if($dianpu=='yes'){?>
					<dt onclick="javascript:window.location.href='<?php echo pfUrl('', 'user', 'store')?>'">商品管理</dt>
					<?php }else{?>
					<dt onclick="javascript:window.location.href='<?php echo pfUrl('', 'user', 'application')?>'">店铺申请</dt>
					<?php }?>
					<dt onclick="javascript:window.location.href='<?php echo pfUrl('', 'user', 'dingdan')?>'">订单管理</dt>
				</dl>
			</li>
			<li id="li5">
				<a href="javascript:;"><img src="../attms/images/user5.png" style="width:22px;height:22px;vertical-align:middle;position:relative;top:-2px;margin-right:10px;" />我是交易商</a>
				<dl id="left_dl5">
					<dt onclick="javascript:window.location.href='../portal/index.php?c=goods&a=release'">申请发售</dt>
					<dt onclick="javascript:window.location.href='<?php echo pfUrl('', 'user', 'fashou')?>'">发售列表</dt>
				</dl>
			</li>
		</ul>
	</div>
	<?php }else{?>
	<div class="left">
		<ul>
			<li id="li1" class="active">
				<a href="javascript:;"><img src="../attms/images/user1.png" style="width:22px;height:22px;vertical-align:middle;position:relative;top:-2px;margin-right:10px;" />我的资质</a>
			</li>
			<li id="li2">
				<a href="javascript:;"><img src="../attms/images/user2.png" style="width:22px;height:22px;vertical-align:middle;position:relative;top:-2px;margin-right:10px;" />我的财报</a>
			</li>
			<li id="li3">
				<a href="javascript:;"><img src="../attms/images/user4.png" style="width:22px;height:22px;vertical-align:middle;position:relative;top:-2px;margin-right:10px;" />我的推荐</a>
			</li>
		</ul>
	</div>
	<?php }?>
</div>
<!-- 左侧导航开始 
<div class="">
	<h1>用户中心</h1>
	<div class="left">
		<ul>
			<li id="li0"><a href="<?php echo pfUrl("","index","index")?>" class="dh0" data="0"><img src="../attms/images/user1.png" style="width:22px;height:22px;vertical-align:middle;position:relative;top:-2px;margin-right:10px;" id="img0"/>我的主页</a></li>
			<li id="li1"><a href="<?php echo pfUrl("","user","personal")?>" class="dhl" data="1"><img src="../attms/images/user1.png" style="width:22px;height:22px;vertical-align:middle;position:relative;top:-2px;margin-right:10px;" id="img1"/>我的资料</a></li>
			<li id="li2"><a href="<?php echo pfUrl("","user","assets")?>" class="dhl" data="2"><img src="../attms/images/user2.png" style="width:22px;height:22px;vertical-align:middle;position:relative;top:-2px;margin-right:10px;" id="img2"/>我的资产</a></li>
			<li id="li3"><a href="<?php echo pfUrl("","user","buyer")?>" class="dhl" data="3"><img src="../attms/images/user4.png" style="width:22px;height:22px;vertical-align:middle;position:relative;top:-2px;margin-right:10px;" id="img3"/>我是买家</a></li>
			<li id="li4"><a href="<?php echo pfUrl("","user","seller")?>" class="dhl" data="4"><img src="../attms/images/user3.png" style="width:22px;height:22px;vertical-align:middle;position:relative;top:-2px;margin-right:10px;" id="img4"/>我是卖家</a></li>
			<li id="li5"><a href="<?php echo pfUrl("","user","dealer")?>" class="dhl" data="5"><img src="../attms/images/user5.png" style="width:22px;height:22px;vertical-align:middle;position:relative;top:-2px;margin-right:10px;" id="img5"/>我是交易商</a></li>
		</ul>
	</div>
</div>
 左侧导航结束 -->