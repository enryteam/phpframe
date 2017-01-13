// JavaScript Document
/************************************************************
 *	技术支持：易挖宝
 *	网   址：www.ewabao.com
*************************************************************/

/***************************************
* 	 creat by www.ewabao.com			   *
* 	 author dnt jessie.qiao 			   *
*    公共常用JS库						   *
****************************************/

window.onload = function()
{
	/*
	*方法：模拟表单提交删除
	*author:jessie.qiao
	*/
	$(".fromdelete").click(function(){
        var url = $(this).attr('url');
        var id = $(this).attr('id');
        var formdelete = $("form[name='formdelete']");
        art.dialog({
            title:'友情提示',
            content:'您确定吗？',
            okVal:'确定',
            ok:function(){
                $("input[name='deleteflag']").val(id);
                formdelete.attr('action',url);
                formdelete.submit();
            },
            cancelVal:'取消',
            cancel:true,
            lock:true
        });
		/*if(confirm("确定要删除吗？") == true)
		{
			var url = $(this).attr('url');
			var id = $(this).attr('id');
			var formdelete = $("form[name='formdelete']");
			$("input[name='deleteflag']").val(id);
			formdelete.attr('action',url);
			formdelete.submit();
		}*/
	});

	/*
	*方法：模拟表单提交删除多个
	*author:jessie.qiao
	*/
	$(".fromdeleteall").click(function(){
		//删除项id
		var rid = '';
		$("input[name='check']").each(function(){
			if($(this).attr("checked") == 'checked')
			{
				rid+=this.id+',';
			}								   
		});
		
		//判断是否选择删除项
		if(rid == '')
		{
			alert("请选择要删除的选项！");	
			return false;
		}
		
		//是否确认删除	
		if(confirm("您确定吗？") == true)
		{
			var url = $(this).attr('url');
			var formdelete = $("form[name='formdelete']");
			$("input[name='deleteflag']").val(rid);
			formdelete.attr('action',url);
			formdelete.submit();
		}
	});

	/*
	*节点控制器点击
	*author:jessie.qiao
	*/
	$(".cid").click(function(){
		 var status = $(this).attr("checked");
		 var id = $(this).val();
		 
		 if(status == undefined)
		 {
			//console.log("1",id);
		 	$(".action"+id).click();
			$(".action"+id).attr("checked",true);
			$(this).attr("checked",true);
		 }
		 else if(status == 'checked')
		 {
			// console.log("2");
		 	$(".action"+id).attr("checked",false);
			$(this).attr("checked",false);
		 }
	});	

	/*
	 *全选、全取消
	 *author:jessie.qiao
	 */
	$("input[name='all']").click(function(){
		if($(this).attr("checked") == 'checked'){
			 $("input[name='check']").each(function(index){
				 $(this).click();
				 $(this).attr("checked",true);
			 });
		 }else{
			$("input[name='check']").each(function(index){
				  $(this).attr("checked",false);
			 });
		 }		  
	});
	
	/*
	 *全选
	 *author:jessie.qiao
	 */
	$(".allselct").click(function(){
		if($(this).attr('id')==1)
		{
			$("input[name='check']").click();	
			$("input[name='check']").attr("checked",true);	
									   
			$(this).attr('id',0);
		}
		else if($(this).attr('id')==0)
		{
			$("input[name='check']").attr("checked",false);							   
			$(this).attr('id',1);
		}
	});
	
	/*
	 *取消
	 *author:jessie.qiao
	 */
	$(".cancel_btn").click(function(){
	       $("input[name='check']").each(function(){
			    $(this).attr("checked",false);								  
		   });							
	});
	
	/*
	 *反选
	 *author:jessie.qiao
	 */
	$(".fanxuan").click(function(){
		 $("input[name='all']").attr("checked",false);
	     $("input[name='check']").each(function(){
			if($(this).attr("checked") == 'checked')
			{
				$(this).attr("checked",false);
			}else{
				$(this).click();
			    $(this).attr("checked",true);
			}
		 });				 
	});
	
	//全选、全取消
	$("input[name='all']").click(function(){
		//alert($(this).attr("checked"));return false;
		if($(this).attr("checked") == undefined){
			 $("input[name='check']").each(function(index){
				  $(this).click();
				  $(this).attr("checked",true);
			 });
			 $(this).attr("checked",true);
		 }else{
			$("input[name='check']").each(function(index){
				  $(this).removeAttr("checked");
			 });
			$(this).removeAttr("checked");
		 }		  
	});
	
	//全选
	$(".allselct").click(function(){
		if($(this).attr('id')==1)
		{
			$("input[name='check']").attr("checked",true);							   
			$(this).attr('id',0);
		}
		else if($(this).attr('id')==0)
		{
			$("input[name='check']").attr("checked",false);							   
			$(this).attr('id',1);
		}
	});
	
	//取消
	$(".cancel_btn").click(function(){
	       $("input[name='check']").each(function(){
			    $(this).attr("checked",false);								  
		   });							
	});
	
	//反选
	$(".fanxuan").click(function(){
		 $("input[name='all']").attr("checked",false);
	     $("input[name='check']").each(function(){
			if($(this).attr("checked") == 'checked')
			{
				$(this).attr("checked",false);
			}else{
			    $(this).attr("checked",true);
			}
		 });				 
	});

	//添加数据
	$(".addData").click(function(){
			window.location.href = this.id;					 
	});
	
	//删除数据
	$(".removeData").click(function(){
		var rid = '';
	    $("input[name='check']").each(function(){
		    if($(this).attr("checked") == 'checked')
			{
				rid+=this.id+',';
			}								   
		});
		if(rid != '')
		{
			if(confirm("您确定吗？")==true){
				//alert(this.id+"/id/"+rid);
			    window.location.href = this.id+"/id/"+rid;
		    }
		}else{
		    alert("请选择要删除的选项！");	
			return false;
		}
	});
	
	//复选
	$("input[name='check']").click(function(){
		if($(this).attr('checked') == undefined)
		{
			var id = $(this).attr('id');
			$(".edit").attr('id',id);
			$(this).attr('checked',true);
		}	
		else
		{
			$(this).removeAttr('checked');
		}
	});
	
	//编辑
	$(".edit").click(function(){
		var url = $(this).attr('url');
		var id = $(this).attr('id');
		if(id == 0)
		{
			alert("请选择要编辑的选项！");
			return false;
		}
		
		window.location.href = url+'/id/'+id;
	});

}
