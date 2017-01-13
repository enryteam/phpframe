
// JavaScript Document
/*
	技术支持：易挖宝
	服务范围：
	营销型网站建设、网上商城建设、高端网站建设、网站系统开发
	网   址：www.ewabao.cn 
	
	
*/

/**********************************************************************
 *	creat by www.ewabao.cn at 2014-08-08 author dnt wzh              *
 **********************************************************************/

$(document).ready(function(){
	//数据统计效果
	var oLi=$(".box_tj .ty_cont ul li");
	oLi.hover(function(){
		$(this).find('i').stop().animate({"height":"35px","opacity":"0.3"},100);
		$(this).children("div").children("h2").css({"color":"#fff","text-shadow":"1px 1px 1px #fff"});
		$(this).children("div").children("a").stop().animate({"right":"10px"});
	},function(){
		$(this).find('i').stop().animate({"height":"30px","opacity":"0.2"},100);	
		$(this).children("div").children("h2").css({"color":"#eee","text-shadow":"0px 0px 0px #fff"});
		$(this).children("div").children("a").stop().animate({"right":"15px"});
	});	
	$(".tabBox .tab_cont").hide().eq(0).show();
	$(".box_tj .ty_cont ul li.tab_btn").click(function(){
		var oIndex=$(this).index();
		$(".tabBox .tab_cont").hide().eq(oIndex).show();
	});
	
	//左侧导航效果
	$(".navbar dl").eq(0).children("dd").show();
	$(".navbar dl dt").click(function(){
		$(".navbar dl").removeClass("curr");
		$(this).parent("dl").addClass("curr");
		$(".navbar dl dd").stop().slideUp();
		$(this).siblings("dd").stop().slideDown();
	});
	
	//表单填色
	var oTab_size=$(".table").size();
	var oTr=0;
	if(oTab_size>0)
	{
		for(var a=0; a<oTab_size;a++)
		{
			var oTr=$(".table").eq(a).find("tr").size();
			for(var b=0;b<oTr;b++)
			{
				if(b%2==0){
					$(".table").eq(a).find("tr").eq(b).css({"background":"#f9f9f9"})
				};
			};
		};	
	};
	
	//顶部导航点击效果
	$(".nav ul li").click(function(){
		if($(this).children(".nav2").size()>0)
		{
			$(this).children(".nav2").slideToggle();	
		};	
	});
	
	/*
	//登录页面背景切换
	var oPar=parseInt((Math.random()/2)*10);
	var oImg="url(images/login_bg"+oPar+".jpg)";
	$("#login").css({"background-image":oImg});
	*/
	
	//右侧色块链接触碰效果
	$(".linkBox ul li").hover(function(){
		$(this).css({"opacity":"0.8"});	
		$(this).find(".icon_b").stop().animate({"margin-top":"3px"},300);
	},function(){
		$(this).css({"opacity":"1"});		
		$(this).find(".icon_b").stop().animate({"margin-top":"5px"},100);
	});
	
	//编辑页tab切换
	var eLi=$(".edit_box .edit_nav ul li");
	if(eLi.size()>0)
	{
		$(".edit_box .cbox").eq(0).show();
		var eSize=eLi.size();
		eLi.click(function(){
			var oIndex=$(this).index();
			eLi.removeClass("curr").eq(oIndex).addClass("curr");	
			var eCont=$(this).parents(".edit_box").find(".cbox");
			eCont.hide().eq(oIndex).show();
		});
		eLi.eq(0).trigger("click");
	};
	
	//栏目分类点击下拉
	$(".btn_xl").click(function(){
		$(this).parents("#col1").siblings(".col1").toggle();	
	});
	
});
function border_green(Oindex1){
	$(Oindex1).parents(".inputBox").css({"border-color":"#0f0"});
}
function border_red(Oindex){
	$(Oindex).parents(".inputBox").css({"border-color":"#f00"});
}