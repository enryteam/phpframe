	<!-- 头部 -->
	<?php include("tpl/public/top.php");?>
	<!-- 头部结束 -->
	<div class="inner-wrap">
    	<!-- 商品列表开始 -->
	    <div class="page-maincontent">
	        <!-- 筛选区 -->
			<div class="filter-container">
      			<h1 style="color: #666666;font-size: 14px;padding: 15px 0;">您现在的位置： <a href="portal_index.html" style="color: #666666;">首页</a>&nbsp;&gt;&gt;&nbsp;<a href="javascript:;" style="color: #666666;">用户中心</a></h1>

				<!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 --><!-- 个人中心开始 -->
				<div class="user_content">
					<!-- 左侧导航开始 -->
					<?php include("tpl/public/left.php");?>
					<!-- 左侧导航结束 -->
					<!-- tab 3 我的订单 -->
					                  <!-- tab 4 商城管理 -->
					<!-- 店铺申请 -->
					<div class="right my_ziliao div1" data-type="10">
						<?php if($shenqing && $shenqing['status']==0){?>
							<h5><a href="javascript:;" class="active dhl" data="10">店铺审核中</a></h5>
						<?php }else{?>
							<h5><a href="javascript:;" class="active dhl" data="10">基本信息</a><a href="javascript:;" class="dhl" data="11">身份认证</a></h5>
							<div class="shop_tab1">
								<h1><i>店铺名称</i><input type="text" name="name" value="" class="store_name"></h1>
									<h1><i>姓名</i><input type="text" name="name" value="" class="name"></h1>
									<h1><i>身份证号</i><input type="text" name="name" value="" class="identity"></h1>
									<h1><i>QQ号</i><input type="text" name="name" value="" class="qq"></h1>
									<h1><i>&nbsp;</i><a href="javascript:;" onclick="javascript:xiayibu()">下一步</a></h1>
							</div>
					</div>

					<div class="right my_ziliao div2" data-type="11" style="display:none;">
							<h5><a href="javascript:;" class="dhl" data="10">基本信息</a><a href="javascript:;" class="active dhl" data="11">身份认证</a></h5>
							<div class="shop_tab2">
									<dl>
											<dt>
													<div>身份证正面图片</div>
													<h5><img src="../attms/images/shili1.png" class="shili_pho1" /><input type="file" name="name" value="" onchange="previewFile_shili1()" id="scflie_shili1"></h5>
											</dt>
											<dt>
													<div>身份证反面图片</div>
													<h5><img src="../attms/images/shili2.png" class="shili_pho2" /><input type="file" name="name" value="" onchange="previewFile_shili2()" id="scflie_shili2"></h5>
											</dt>
											<dt>
													<div>本人手持身份证照片</div>
													<h5><img src="../attms/images/shili3.png" class="shili_pho3" /><input type="file" name="name" value="" onchange="previewFile_shili3()" id="scflie_shili3"></h5>
											</dt>
											<h6 style="clear:both;"></h6>
									</dl>
									<p>
										<a href="javascript:;" onclick="javascript:tijiao()">提交申请</a>
									</p>
							</div>
						<?php }?>
					</div>
				</div>
				<!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 -->
			</div>
		</div>
	</div>
	<input type="hidden" name="name" value="" id="my_avatar_shili1" />
  <input type="hidden" name="name" value="" id="my_avatar_shili2" />
  <input type="hidden" name="name" value="" id="my_avatar_shili3" />
	<!-- 尾部 -->
	<?php include("tpl/public/bottom.php");?>
	<!-- 尾部结束 -->
<script type="text/javascript">
	$('#left_dl4').show();
	$('#left_dl4').children().first().addClass('active');

	//删除商品
	function del_goods(id)
	{
		$.post(RestApi, { c: 'goods',a: 'del_goods',goods_id:id}, function(response) {
			var responseObj=$.parseJSON(response);
			window.wxc.xcConfirm(responseObj.message,' ');
		});
	}
	// 身份证上传
    function previewFile_shili1() {
      var file    = document.querySelector('#scflie_shili1').files[0];
      var reader  = new FileReader();
      reader.addEventListener("load", function () {
        //preview.src = reader.result;
          $.ajax ({
            type: 'POST',
            url: 'http://apistore.51daniu.cn/rest/index.php',
            dataType: 'json',
            data: {"c":"upfile","a":"img","img":encodeURIComponent(reader.result)},
            success: function(responsex)
            {
                $('.shili_pho1').attr('src',responsex.data);
                $('#my_avatar_shili1').val(responsex.data);
            },
            error: function (data)
            {
               window.wxc.xcConfirm(data.message);
            }
        });
      }, false);
      if (file) {
        reader.readAsDataURL(file);
      }
    }

    function previewFile_shili2() {
      var file    = document.querySelector('#scflie_shili2').files[0];
      var reader  = new FileReader();
      reader.addEventListener("load", function () {
        //preview.src = reader.result;
          $.ajax ({
            type: 'POST',
            url: 'http://apistore.51daniu.cn/rest/index.php',
            dataType: 'json',
            data: {"c":"upfile","a":"img","img":encodeURIComponent(reader.result)},
            success: function(responsex)
            {
                $('.shili_pho2').attr('src',responsex.data);
                $('#my_avatar_shili2').val(responsex.data);
            },
            error: function (data)
            {
                window.wxc.xcConfirm(data.message);
            }
        });
      }, false);
      if (file) {
        reader.readAsDataURL(file);
      }
    }

    function previewFile_shili3() {
      var file    = document.querySelector('#scflie_shili3').files[0];
      var reader  = new FileReader();
      reader.addEventListener("load", function () {
        //preview.src = reader.result;
          $.ajax ({
            type: 'POST',
            url: 'http://apistore.51daniu.cn/rest/index.php',
            dataType: 'json',
            data: {"c":"upfile","a":"img","img":encodeURIComponent(reader.result)},
            success: function(responsex)
            {
                $('.shili_pho3').attr('src',responsex.data);
                $('#my_avatar_shili3').val(responsex.data);
            },
            error: function (data)
            {
							window.wxc.xcConfirm(data.message);
            }
        });
      }, false);
      if (file) {
        reader.readAsDataURL(file);
      }
    }
		function xiayibu(){
			var store_name=$('.store_name').val();
			var name=$('.name').val();
			var identity=$('.identity').val();
			var qq=$('.qq').val();
			if(store_name && name && identity && qq){
				$('.div1').hide();
				$('.div2').show();
			}else{
				window.wxc.xcConfirm('请填写所有资料');
			}
		}
		
		function tijiao(){
			var store_name=$('.store_name').val();
			var name=$('.name').val();
			var identity=$('.identity').val();
			var qq=$('.qq').val();
			var id_front=$('#my_avatar_shili1').val();
			var id_back=$('#my_avatar_shili2').val();
			var id_person=$('#my_avatar_shili3').val();
			if(store_name && name && identity && qq && id_front && id_back && id_person){
				$.post(RestApi, { c: 'store',a: 'store_application',store_name:store_name,name:name,identity:identity,qq:qq,id_front:id_front,id_back:id_back,id_person:id_person}, function(response) {
					var responseObj=$.parseJSON(response);
					window.wxc.xcConfirm(responseObj.message,' ');
				});
			}else{
				window.wxc.xcConfirm('请填写所有资料');
			}
		}
</script>
</body>
</html>
