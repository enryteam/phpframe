<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_sys_class('BaseAction');

class trade2 extends BaseAction
{
	public function __construct()
	{
		//登录鉴权
	   
		parent::__construct();
	}
	
	//开盘
	public function open(){
		set_time_limit(1800);
		echo date('H:i:s').'<hr/>';
		$pwd=getgpc('pwd');
		if($pwd=='adminchen5188'){
			$restModel=D("Rest");
			$sql="select * from `jjs_contract` where lave_quantity > 0 and is_del = 0 order by id";
			$goods = $restModel->query($sql);
			foreach ($goods as $key => $vo) {
				$restModel->querysql("update `jjs_contract` set ctime = '".date("Y-m-d H:i:s")."' where id = '".$vo['id']."')");
				echo "update `jjs_contract` set ctime = '".date("Y-m-d H:i:s")."' where id = '".$vo['id']."')";
				if($vo['cate']==1){
					for($i=1;$i<=$vo['lave_quantity'];$i++){
						$name = $vo['g_code']."-S-".$vo['price']."-".$vo["user_id"]."-".$vo["id"];
						$data = $vo['g_code']."-S-".$vo['price']."-".$vo["user_id"]."-".$vo["id"]."-".rand(100000000000000000,999999999999999999);
						//写入队列
						file_get_contents("http://apistore.51daniu.cn:1218/?name=".$name."&opt=put&data=".$data."&auth=adminchen5188jjs");
					}
					echo date('H:i:s').'==='.$vo["id"].'==='.$vo['lave_quantity'].'==='.$vo['g_code'].'<hr/>';
				}else{
					for($i=1;$i<=$vo['lave_quantity'];$i++){
						$name = $vo['g_code']."-B-".$vo['price']."-".$vo["user_id"]."-".$vo["id"];
						$data = $vo['g_code']."-B-".$vo['price']."-".$vo["user_id"]."-".$vo["id"]."-".rand(100000000000000000,999999999999999999);
						//写入队列
						file_get_contents("http://apistore.51daniu.cn:1218/?name=".$name."&opt=put&data=".$data."&auth=adminchen5188jjs");
					}
					echo date('H:i:s').'==='.$vo["id"].'==='.$vo['lave_quantity'].'==='.$vo['g_code'].'<hr/>';
				}
			}
		}
		echo date('H:i:s');
		die;
	}
	public function close(){
		set_time_limit(0);
		echo date('H:i:s').'<hr/>';
		$pwd=getgpc('pwd');
		if($pwd=='adminchen5188'){
			$restModel=D("Rest");
			$sql="select * from `jjs_contract` where lave_quantity > 0 and is_del = 0 order by id";
			$goods = $restModel->query($sql);
			$nowtime=time();
			foreach ($goods as $key => $vo) {
				if($vo['cate']==1){
					for($i=0;$i<=$vo['lave_quantity'];$i++){
						$name = $vo['g_code']."-S-".$vo['price']."-".$vo["user_id"]."-".$vo["id"];
						//拉出队列
						$sqsdate = file_get_contents("http://apistore.51daniu.cn:1218/?name=".$name."&opt=get&auth=adminchen5188jjs");
						if($sqsdate == 'HTTPSQS_GET_END'){
							echo date('H:i:s').'==='.$vo["id"].'==='.$vo['lave_quantity'].'==='.$vo['g_code'].'<hr/>';
							break;
						}
					}
				}else{
					for($i=0;$i<=$vo['lave_quantity'];$i++){
						$name = $vo['g_code']."-B-".$vo['price']."-".$vo["user_id"]."-".$vo["id"];
						//拉出队列
						file_get_contents("http://apistore.51daniu.cn:1218/?name=".$name."&opt=get&auth=adminchen5188jjs");
						if($sqsdate == 'HTTPSQS_GET_END'){
							echo date('H:i:s').'==='.$vo["id"].'==='.$vo['lave_quantity'].'==='.$vo['g_code'].'<hr/>';
							break;
						}
					}
				}
			}
		}
		echo date('H:i:s');
		die;
	}
}
