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
					<!-- 订单详情 -->
					<div class="right my_shop" data-type="">
						<div class="shop_tab2_add">
								<div class="top">
										<div>
												<i>商品名称</i>
												<input type="text" name="name" value="" placeholder="商品名称不大于30个字" class="title">
												<div style="clear:both;"></div>
										</div>
										<div>
												<i>商品简介</i>
												<textarea placeholder="对此商品的简介" class="intro"></textarea>
												<div style="clear:both;"></div>
										</div>
										<div>
												<i>商品库存</i>
												<input type="text" name="name" value="" class="stock">
												<div style="clear:both;"></div>
										</div>
										<div>
												<i>商品分类</i>
												<select class="cid">
													<?php foreach ($fenlei as $key => $vo) {?>
													<option value="<?php echo $vo['id']?>"><?php echo $vo['title']?></option>
													<?php }?>
												</select>
												<div style="clear:both;"></div>
										</div>
										<div>
												<i>商品价格</i>
												<input type="text" name="name" value="" class="price">
												<div style="clear:both;"></div>
										</div>
								</div>
								<div class="center">
										<h1>上传商品图片<i>（ 图片最多上传5张,图片格式JPG或者PNG ）</i></h1>
										<ul>
											<li style="margin-left:300px"><img src="../attms/images/myshop_add.png" class="shangpin_pho1" /><input type="file" name="name" value="" onchange="previewFile1()" id="scflie1"></li>
												<div style="clear:both;"></div>
										</ul>
								</div>
								<div class="bottom">
										<h1>商品详情<i>（ 可图片可文字 ）</i></h1>
										<!-- 编辑器 -->
										<script type="text/javascript" charset="utf-8" src="../attms/ueditor/ueditor.config.js"></script>
										<script type="text/javascript" charset="utf-8" src="../attms/ueditor/ueditor.all.min.js"></script>
										<script type="text/javascript" charset="utf-8" src="../attms/ueditor/lang/zh-cn/zh-cn.js"></script>
										<div style="width:100%;">
												<script id="editor" type="text/plain" style="width:790px;height:490px;margin:0 auto;"></script>
										</div>
								</div>
								<div class="bottom">
									<h1>商品上架： <input type="radio" name="goods_status" value="1" class="goods_status"> <b>上架</b><input type="radio" name="goods_status" value="2" class="goods_status" style="margin-left:40px;"> <b>下架</b></h1>
									<h4><a href="javascript:;" onclick="tijiao()">保存并提交</a></h4>
									<h5><a href="<?php echo pfUrl('', 'user', 'store')?>">返回列表</a></h5>
								</div>
						</div>
					</div>
				</div>
				<!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 --><!-- 个人中心结束 -->
			</div>
		</div>
	</div>
	<input type="hidden" value="" class="my_avatar1"/>
	<!-- 尾部 -->
	<?php include("tpl/public/bottom.php");?>
	<!-- 尾部结束 -->
<script type="text/javascript">
	$('#left_dl4').show();
	$('#left_dl4').children().first().addClass('active');
	var ue = UE.getEditor('editor');
	
	    // 商品图片上传
    function previewFile1() {
      var file    = document.querySelector('#scflie1').files[0];
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
                $('.shangpin_pho1').attr('src',responsex.data);
                $('.my_avatar1').val(responsex.data);
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
	
	
	//添加商品
	function tijiao()
	{
		var title = $('.title').val();
		var intro=  $('.intro').val();
		var stock=  $('.stock').val();
		var cid=  $('.cid').val();
		var price=  $('.price').val();
		var img=  $('.my_avatar1').val();
		var detail=  ue.getContent();
		var goods_status= $('input[name="goods_status"]:checked ').val();
		if(title && intro && stock && cid && price && img && detail && goods_status){
			$.post(RestApi, { c: 'goods',a: 'add_goods',title:title,intro:intro,stock:stock,cid:cid,price:price,img:img,detail:detail,goods_status:goods_status}, function(response) {
				console.log(response);
				var responseObj=$.parseJSON(response);
				if(responseObj.code==200){
					window.wxc.xcConfirm(responseObj.message,'<?php echo pfUrl("","user","store")?>');
				}else{
					window.wxc.xcConfirm(responseObj.message);
				}
			});
		}else{
			window.wxc.xcConfirm('信息不完整');
		}
	}
</script>
</body>
</html>
