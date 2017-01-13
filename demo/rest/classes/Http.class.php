<?php
defined('IN_PHPFRAME') or exit('No permission resources.');

class Http
{
	public function __construct()
	{
		$this->host="http://a1.easemob.com";
		$this->app="chengpai#test";
		$this->header=array();
		$this->clientId="YXA61bqh8NHtEeSbPndnui7b2g";
		$this->clientSecret="YXA6VbbRnFVdKTPFDizTdlMmwJzcQk8";
		
		$this->token="";
		
		if(!$this->token) $this->getToken();
		$this->header=array('Authorization:'."Bearer ".$this->token);
	}
	
	//获取token
	public function getToken()
	{
		$url="/token";
		$param=array(
			'grant_type'=>'client_credentials',
			'client_id'=>$this->clientId,
			'client_secret'=>$this->clientSecret,
		);
		$result=$this->post($url,$param);
		$this->token=$result['data']['access_token'];
	}
	
	public function get($url)
	{
		return $this->request($url,null,"get");
	}
	
	public function post($url,$param=array())
	{
		$param=json_encode($param);
		return $this->request($url,$param,"post");
	}
	
	public function request($url,$param,$method="post")
	{
		$result=array(
			'code'=>0,
			'data'=>'',
		);
		$url=$this->host.'/'.str_replace('#','/',$this->app).$url;
		/*
		import('@.libs.classes.Snoopy');
		
		$snoopy=new Snoopy();
		if($method=="post")
			$this->header['content-type']='application/json';
		
		foreach($this->header as $key=>$val)
			$snoopy->rawheaders[$key]=$val;
		
		if($method=='get')
			$flag=$snoopy->fetch($url);
		elseif($method=='post')
			$flag=$snoopy->submit($url,$param);
		
		*/
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		if($method=='post')
		{
			curl_setopt($ch, CURLOPT_POSTFIELDS,$param);
			curl_setopt($ch, CURLOPT_POST, 1);
			array_push($this->header,'Content-Type:application/json; charset=utf-8');
			array_push($this->header,'Content-Length:'.strlen($param));
		}
		
		curl_setopt($ch, CURLOPT_HTTPHEADER,$this->header);
		ob_start();
		$flag=curl_exec($ch);
		$content=ob_get_contents();
		ob_end_clean();
		$code=curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($code>200)
		{
			$result['code']=$code;
		}
		else
		{
			$content=json_decode($content,true);
			$result['data']=$content;
		}
		return $result;
		
	}
}
