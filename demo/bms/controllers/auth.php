<?php
defined('IN_PHPFRAME') or exit('No permission resources.');
pc_base::load_app_class('BmsAction');
class auth extends BmsAction
{
	/*
	 * 方法：权限节点列表
	 * author:jessie.qiao
	 * */
	public function index()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		//所有导航
		$nvaList = D("Bms")->query("select id,name from `jjs_navigation` order by sort desc");
		//$nvaList = $NavModule->field('id,name')->order('sort asc')->select();

		foreach($nvaList as $key=>$val)
		{
			//导航下面的所有控制器
			$nvaList[$key]['controllerList'] = D("Bms")->query("select id,module_name from `jjs_auth_rule` where nid = ".$val['id']." order by sort asc");
			//$nvaList[$key]['controllerList'] = D("Bms")->field('id,module_name')->where(array('nid'=>$val['id']))->order('sort asc')->select();
			//控制器下的所有方法
			foreach($nvaList[$key]['controllerList'] as $key1=>$val1)
			{
				//$nvaList[$key]['controllerList'][$key1]['actionList'] = $AuthModule->where(array('pid'=>$val1['id']))->order('sort asc')->select();
				$nvaList[$key]['controllerList'][$key1]['actionList'] = D("Bms")->query("select * from `jjs_auth_rule` where pid = ".$val1['id']." order by sort asc");	
			}
		}
		//print_r($nvaList[]);
		$this->assign('nvaList',$nvaList);
		$this->display();
	}
	
	/*
	 * 方法：添加节点
	 * author:jessie.qiao
	 * */
	public function add()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		if(isPost())
		{
			//添加数据
			$model = getgpc("model");
			$model_name = getgpc("model_name");
			$nodetype = getgpc("nodetype");
			$title = getgpc("title");
			$nid = getgpc("nid");
			$pid = getgpc("pid");
			$name = getgpc("name");
			$module = getgpc("module");
			$module_name = getgpc("module_name");
			$action = getgpc("action");
			$action_name = getgpc("action_name");
			$sort = getgpc("sort");
			$is_show = getgpc("is_show");
			if($nodetype)
			{
				//type 
				if($nodetype == 1){
					//添加控制器
					$name = "Bms/".$module;
					//添加数据合法检测
					if(empty($title))
					{
						bmsAlert("请输入名称！",pfUrl("bms","auth","add")); 
					}
					if($nid == 0)
					{
						bmsAlert("请选择所属导航！",pfUrl("bms","auth","add")); 
					}
					if(empty($module))
					{
						bmsAlert("请输入控制器名！",pfUrl("bms","auth","add")); 
					}
					if(empty($module_name))
					{
						bmsAlert("请输入控制器中文备注名称！",pfUrl("bms","auth","add")); 
					}
					if(empty($sort))
					{
						bmsAlert("请输入排序！",pfUrl("bms","auth","add")); 
					}

					$res = D("Bms")->querysql("insert into `jjs_auth_rule`(module,module_name,model,model_name,nodetype,name,title,nid,sort,is_show) values('".$module."','".$module_name."','".$model."','".$model_name."','".$nodetype."','".$name."','".$title."','".$nid."','".$sort."','".$is_show."')");
				}elseif($nodetype == 2)
				{
					//添加方法
					//添加数据合法检测
					if(empty($title))
					{
						bmsAlert("请输入名称！",pfUrl("bms","auth","add")); 
					}
					if($pid == 0)
					{
						bmsAlert("请选择所属控制器！",pfUrl("bms","auth","add"));
					}
					if(empty($action))
					{
						bmsAlert("请输入方法名！",pfUrl("bms","auth","add"));
					}
					if(empty($action_name))
					{
						bmsAlert("请输入方法中文备注名称！",pfUrl("bms","auth","add"));
					}
					if(empty($name))
					{
						bmsAlert("规则唯一标示格式为如：Bms/Index/index！",pfUrl("bms","auth","add"));
					}
					if(empty($sort))
					{
						bmsAlert("请输入排序！",pfUrl("bms","auth","add"));
					}
					//通过所属节点控制器获取控制名
					$r = D("Bms")->query("select module,module_name, from `jjs_auth_rule` where id = ".$pid);
					$res = D("Bms")->querysql("insert into `jjs_auth_rule`(action,action_name,module,module_name,model,model_name,nodetype,name,title,pid,nid,sort,is_show) values('".$action."','".$action_name."','".$r[0]["module"]."','".$r[0]["module_name"]."','".$model."','".$model_name."','".$nodetype."','".$name."','".$title."','".$pid."','".$nid."','".$sort."','".$is_show."')");
				}
				
				
				if($res)
				{
					//添加数据成功
					bmsAlert("添加权限节点成功！",pfUrl("bms","auth","index"));
				}
				else
				{
					//添加数据失败
					bmsAlert("添加数据失败！",pfUrl("bms","auth","index"));
				}
			}
			else
			{
				//创建数据失败
				bmsAlert("创建数据失败！",pfUrl("bms","auth","index"));
			}		
		}
		else
		{
			//控制器列表
			$controllerList = D("Bms")->query("select id,module_name,module from `jjs_auth_rule` where nodetype = 1 order by sort asc");
			//导航列表
			$navigationList = D("Bms")->query("select id,name from `jjs_navigation` where status = 1 order by sort asc");

			$this->assign("controllerList",$controllerList);
			$this->assign("navigationList",$navigationList);
			//显示模板
			$this->display();
		}
	}
	
	/*
	 * 方法：编辑节点
	 * author:jessie.qiao
	 * */
	public function edit()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		if(isPost())
		{
			//echo getgpc("id");
			//编辑数据
			if(trim(getgpc("id")))
			{
				$model = getgpc("model");
				$model_name = getgpc("model_name");
				$nodetype = getgpc("nodetype");
				$title = getgpc("title");
				$nid = getgpc("nid");
				$pid = getgpc("pid");
				$name = getgpc("name");
				$module = getgpc("module");
				$module_name = getgpc("module_name");
				$action = getgpc("action");
				$action_name = getgpc("action_name");
				$sort = getgpc("sort");
				$is_show = getgpc("is_show");

				if($nodetype)
				{
					//type 
					if($nodetype == 1){
						//修改控制器
						$name = "Bms/".$module_name;
						$res = D("Bms")->querysql("update `jjs_auth_rule` set model = '".$model."',model_name = '".$model_name."',nodetype = '".$nodetype."',title = '".$title."',nid = '".$nid."',module = '".$module."',module_name = '".$module_name."',sort = '".$sort."',is_show = '".$is_show."' where id = ".trim(getgpc("id")));

					}elseif($nodetype == 2)
					{
						//修改方法
						$res = D("Bms")->querysql("update `jjs_auth_rule` set model = '".$model."',model_name = '".$model_name."',nodetype = '".$nodetype."',title = '".$title."',nid = '".$nid."',module = '".$module."',module_name = '".$module_name."',sort = '".$sort."',is_show = '".$is_show."',action = '".$action."',action_name = '".$action_name."',name = '".$name."',pid = '".$pid."' where id = ".trim(getgpc("id")));
					}
					
					if($res)
					{
						//编辑成功
						bmsAlert("编辑保存成功！",pfUrl("bms","auth","index")); 
					}
					else
					{
						//编辑失败
						bmsAlert("保存数据失败！",pfUrl("bms","auth","edit")); 
					}
				}
				else
				{
					//创建数据失败
					bmsAlert("创建数据失败！",pfUrl("bms","auth","index"));
				}	
			}
			else
			{
				//创建数据失败
				bmsAlert("创建数据失败！",pfUrl("bms","auth","edit")); 
			}		
		}
		else
		{
			$nid = trim(getgpc("id"));
			//节点信息
			$nodeInfo = D("Bms")->query("select * from `jjs_auth_rule` where id = ".$nid);
			//控制器列表
			$controllerList = D("Bms")->query("select id,module_name,module from `jjs_auth_rule` where nodetype = 1 order by sort asc");
			//导航列表
			$navigationList = D("Bms")->query("select id,name from `jjs_navigation` where status = 1 order by sort asc");

			$this->assign("nodeInfo",$nodeInfo[0]);
			$this->assign("controllerList",$controllerList);
			$this->assign("navigationList",$navigationList);
			//显示模板
			$this->display();
		}
	}
	
	/*
	 * 方法：删除节点
	 * author:jirenyuo
	 * */
	public function remove()
	{
		if(!in_array(__METHOD__, $_SESSION['user_quanxian'])){
			bmsAlert("您没有此操作权限",pfUrl("","index","index"));
			die;
		}
		$nid = trim(getgpc("id"));
		$pid = D("Bms")->query("select * from `jjs_auth_rule` where pid = ".$nid);
		//查询节点是否存在子节点
		if($pid)
		{
			//exit(ajsx_load("该节点还存在其他关联节点，请先删除关联节点！",300));
			bmsAlert("该节点还存在其他关联节点，请先删除关联节点！",pfUrl("bms","auth","index")); 
		}else{
			//删除节点
			$res = D("Bms")->querysql("delete from `jjs_auth_rule` where id = ".$nid);
			if($res){
				bmsAlert("删除成功！",pfUrl("bms","auth","index")); 
			}else{
				bmsAlert("删除失败！",pfUrl("bms","auth","index")); 
			}
		}
		
	}
}
?>
