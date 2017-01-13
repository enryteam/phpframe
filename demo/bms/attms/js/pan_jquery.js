/**
 * Created by pjw on 14-6-23.
 */
function ajax_upInfo(obj){
    var the_id  		=   obj.id ;
    if(the_id==""||the_id==undefined){
        the_id			= 	"form_sub_"+Math.round(Math.random()*1000); 	//获取组合随机数
        var theLength 	= 	$("body").find("#"+the_id).length;				//查找是否有随机数相同
        if(theLength>0){
            the_id		= 	"form_sub_"+Math.round(Math.random()*1000); 	//相同则重新选择一次
        }
        obj.id 			=   the_id ;  										//将随机数赋值给对象
    }
    var options 		= 	{
        type:		'POST',								//form表单的提交类型
        url:        this.action,							//form表单的处理接口
        dataType:	'JSON',								//form表单的请求的数据返回类型
        success: function(data){
            
            switch (data.status){
                case 200://正确的对话框模式
                    //如果需要跳转
                    if(data.is_load){
                        art.dialog({
                            icon: 'succeed',
                            title:data.title,
                            content: data.msg,
                            lock: data.is_lock,
                            time:data.time,
                            close:function(){
                                window.location.href=data.url;
                            }
                        });
                    }else{//如果不需要跳转
                        art.dialog({
                            icon: 'succeed',
                            title:data.title,
                            content: data.msg,
                            lock: data.is_lock,
                            time:data.time
                        });
                    }
                    break;
                case 300://错误的对话框模式
                    art.dialog({
                        icon: 'error',
                        title:data.title,
                        content: data.msg,
                        lock: data.is_lock,
                        time:data.time
                    });
                    break;
                default ://其他状态码弹出模式
                    break;
            }
        }
    };
   // console.log("obj",obj.id);												//打印返回数据
    $("#"+the_id).ajaxSubmit(options);   									//调用Ajax请求方法

    return false; 															//阻止页面跳转
}
function node_show_hide(obj){
    $('.'+obj).toggle(500);
}