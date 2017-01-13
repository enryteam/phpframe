<?php
defined('IN_PHPFRAME') or exit('No permission resources.');

pc_base::load_app_class('RestAction');

class index extends RestAction
{
	public function __construct()
	{

		parent::__construct();
		$this->path = '../attms/upfile/'.date("Y").'/'.date("m").'/'.date("d").'/'.date("H").'/';
		mk_dir($this->path);
	}

	public function index()
	{
		returnJson('200');
	}
	//升级开关
	public function updatecheck()
	{

		$v = "1.0";//最新版本号
		//下载地址 http://www.wwcode.net/s/hed7e
		if(getgpc("cv")<$v)
		{
			returnJson('200',getgpc("cv").$v,"http://www.wwcode.net/s/hed7e");
		}
		else
		{

			returnJson('201',getgpc("cv").'已是最新版本');
		}

	}

	
}
