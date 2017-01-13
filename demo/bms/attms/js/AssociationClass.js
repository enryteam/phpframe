// JavaScript Document
// JavaScript Document 
// +----------------------------------------------------------------------
// | 版权所有：易挖宝
// +----------------------------------------------------------------------
// | 网 址： www.ewabao.com
// +----------------------------------------------------------------------
// | 电 话： 0755-33581131
// +----------------------------------------------------------------------
// | Author: 梁汝翔 <liangruxiang@ewabao.cn>
// +----------------------------------------------------------------------
// | Date: 2015年5月19日 15:00:00
// +----------------------------------------------------------------------
// +----------------------------------------------------------------------
// | Name: Jquery.ruiValidate.js ( 基于jQuery关联分类 )
// +----------------------------------------------------------------------
(function($){  
	
	/*********	
	  
	var _AssociationClass = new $.AssociationClass();  
	_AssociationClass.Init({ 
		FirstId:"FirstCate",			//初始化Id对象，第一层
		FirstIdValue:"2",    //初始化的值，
		FirstIdText:"分类二",    //初始化的值
		SecondId:"SecondCate",		//初始化ID对象，第二层
		SecondValue:"2-2",		//初始化的值  
		SecondText:"分类二子集二",    //初始化的值
		ThirdId:"",
		ThirdValue:""
	})	 
		    
	 *******/
	
	
	//关联分类一
	var AssociationClass = function(){
		this.pram = "" ;	
	}
	
	AssociationClass.prototype = {
		Init:function(send_options){
			var _Ac_option = this.Extend_options(send_options);
			console.log(_Ac_option);
			//初始化页面栏目数据
			this.InitAssociationData(_Ac_option);
		},
		Extend_options:function(send_options){ 
			//初始化分类数据
			var JsonData = [
					{
						title:"分类一",
						id:"1",
                        address:[
							{
                                title:"分类一子集一",
                                id:"1-1"
							}
						]  	
					},
					{
                        title:"分类二",
						id:"2",
                        address:[
							{
                                title:"分类二子集一",
                                id:"2-1"
							}
						]  	
					}
				]; 
			var defauleOptions = {
					ClassData:JsonData,		//连集数据
					FirstId:"FirstCate",			//初始化Id对象，第一层
					FirstIdValue:"2",    //初始化的值，
					FirstIdText:"分类二",    //初始化的值
					SecondId:"SecondCate",		//初始化ID对象，第二层
					SecondValue:"2-2",		//初始化的值  
					SecondText:"分类二子集二",    //初始化的值
					ThirdId:"",
					ThirdValue:"",
					ThirdText:""    //初始化的值
				}  
				
			var AC_Option =  jQuery.extend(true,{},defauleOptions,send_options); 		
			return AC_Option ;
		},
		//初始化页面数据
		InitAssociationData:function(_Ac_option){ 
			var FirstCheck = 0 ;
			//初始化第一个数据
			if(_Ac_option.FirstIdText==""||_Ac_option.FirstIdText=="请选择")  //是否有初始值，没有初始值
			{
				var _FirstSelect = $("#"+_Ac_option.FirstId);
				var CateData = _Ac_option.ClassData; //初始化分类数据
				if(CateData!=undefined&&CateData.length>0)
				{ 
					_FirstSelect.empty();
					for(var i = 0  in CateData)
					{ 
						var theName = CateData[i].TextName ; // options 的文本值 
						var theValue = CateData[i].TextValue ; // option  的value值 
						
						if(i == 0)
						{
							var Str = "<option value='"+theValue+"' selected>"+theName+"</option>";	
						}
						else
						{
							var Str = "<option value='"+theValue+"'>"+theName+"</option>";	
						}
						_FirstSelect.append($(Str));
					}	
				} 
			}
			else
			{
				var _FirstSelect = $("#"+_Ac_option.FirstId);
				var _FirstCheckValue = _Ac_option.FirstIdValue ;
				var _FirstCheckText = _Ac_option.FirstIdText ;
				var CateData = _Ac_option.ClassData; //初始化分类数据
				if(CateData!=undefined&&CateData.length>0)
				{ 
					_FirstSelect.empty();
					for(var i = 0  in CateData)
					{ 
						var theName = CateData[i].title ; // options 的文本值
						var theValue = CateData[i].id ; // option  的value值
						
						if(_FirstCheckValue == theValue && theName == _FirstCheckText)
						{
							FirstCheck = i ;
							var Str = "<option value='"+theValue+"' selected>"+theName+"</option>";	
						}
						else
						{
							var Str = "<option value='"+theValue+"'>"+theName+"</option>";	
						}
						_FirstSelect.append($(Str));
					}
				}
			} 
			
			//初始化第二个数据
			var SecondCheck = 0 ; 
			var _SecondSelect = $("#"+_Ac_option.SecondId);
			var _SecondCateData = _Ac_option.ClassData[FirstCheck].address ; //初始化分类数据
			var _SecondCheckValue = _Ac_option.SecondValue ;
			var _SecondCheckText = _Ac_option.SecondText ;
			
			if(CateData!=undefined&&CateData.length>0)
			{ 
				_SecondSelect.empty();
				for(var i = 0  in _SecondCateData)
				{ 
					var theName2 = _SecondCateData[i].title ; // options 的文本值
					var theValue2 = _SecondCateData[i].id ; // option  的value值
					if(_SecondCheckValue!=""&&_SecondCheckText!=""&&_SecondCheckValue==theValue2&&_SecondCheckText==theName2) 
					{ 
						SecondCheck = i ;
						var Str = "<option value='"+theValue2+"' selected>"+theName2+"</option>";	
					}else{
						var Str = "<option value='"+theValue2+"'>"+theName2+"</option>";		
					}
					_SecondSelect.append($(Str));
				}	
			}  
			
			if(_Ac_option.ThirdId!="")
			{ 
				//初始化第二个数据 
				var _ThirdSelect = $("#"+_Ac_option.ThirdId);
				var _ThirdCateData = _Ac_option.ClassData[FirstCheck].ChildCate[SecondCheck].ChildCate ; //初始化分类数据
				var _ThirdCheckValue = _Ac_option.ThirdValue ;
				var _ThirdCheckText = _Ac_option.ThirdText ;
				
				if(_ThirdCateData!=undefined&&_ThirdCateData.length>0)
				{ 
					_ThirdSelect.empty();
					for(var i = 0  in _ThirdCateData)
					{ 
						var theName2 = _ThirdCateData[i].TextName ; // options 的文本值 
						var theValue2 = _ThirdCateData[i].TextValue ; // option  的value值  
						if(_ThirdCheckValue!=""&&_ThirdCheckText!=""&&_ThirdCheckValue==theValue2&&_ThirdCheckText==theName2) 
						{  
							var Str = "<option value='"+theValue2+"' selected>"+theName2+"</option>";	
						}else{
							var Str = "<option value='"+theValue2+"'>"+theName2+"</option>";		
						}
						_ThirdSelect.append($(Str));
					}	
				}   
			}
			
			//绑定页面change事件
			this.Change_AssociationData(_Ac_option); 
		},
		Change_AssociationData:function(_Ac_option){
			//如果只有两级，那么关联   FirstChange事件
			if(_Ac_option.ThirdId!="")
			{ 
				var _this = this ;
				$("#"+_Ac_option.FirstId).change(function(){
					var theValue = $(this).val();
					var theText = $(this).find("option:selected").text();
					console.log("theValue",theValue,"____theText",theText);	
					
					_Ac_option.FirstIdValue = theValue ;
					_Ac_option.FirstIdText = theText ;
					
					_this.InitAssociationData(_Ac_option);
				});	
			}
			else
			{
				var _this = this ;
				$("#"+_Ac_option.FirstId).change(function(){
					var theValue = $(this).val();
					var theText = $(this).find("option:selected").text();
					console.log("theValue",theValue,"____theText",theText);	
					
					_Ac_option.FirstIdValue = theValue ;
					_Ac_option.FirstIdText = theText ;
					
					_this.InitAssociationData(_Ac_option);
				});	
				 
				$("#"+_Ac_option.SecondId).change(function(){
					var theValue = $(this).val();
					var theText = $(this).find("option:selected").text();
					console.log("theValue",theValue,"____theText",theText);	
					
					_Ac_option.SecondValue = theValue ;
					_Ac_option.SecondText = theText ; 
					_this.InitAssociationData(_Ac_option);
				});	 
					
			}	
		}	
	}  
	$.extend({AssociationClass:AssociationClass});  
})(jQuery);