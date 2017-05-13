<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*数据返回类
*
*/
class Response{

	const JSON='json';
	/**
	*按指定的方式输出通信数据
	*@param integer $code 状态码
	*@param string $message 提示信息
	*@param array $data 数据
	*@param strint $type 类型
	*return string
	*/
	public static function show($code,$message='',$data=array(),$type=self::JSON){
		if(!is_numeric($code)){//状态码不是数字
			return '';
		}
		$type = isset($_GET['format'])?$_GET['format']:self::JSON;

		$result=array(
			'code'=>$code,
			'message'=>$message,
			'data'=>$data
		);
		
		if($type=='json'){
			return self::json($code,$message,$data);
			exit;
		}elseif($type=='array'){
			var_dump($result);
			exit;
		}elseif($type=='xml'){
			return self::xml($code,$message,$data);
			exit;
		}else{
			//TODO
		}

	}


	/**
	*按json方式输出通信数据
	*@param integer $code 状态码
	*@param string $message 提示信息
	*@param array $data 数据
	*return string
	*/
	public static function json($code,$message='',$data=array()){
		if(!is_numeric($code)){//状态码不是数字
			return '';
		}

		$result=array(
			'code'=>$code,
			'message'=>$message,
			'data'=>$data
		);

		return json_encode($result);
		exit;
	}
	/**
	*按xml方式输出通信数据
	*@param integer $code 状态码
	*@param string $message 提示信息
	*@param array $data 数据
	*return string
	*/
	public static function xml($code,$message='',$data=array()){

		if(!is_numeric($code)){//状态码不是数字
			return '';
		}
		$result=array(
			'code'=>$code,
			'message'=>$message,
			'data'=>$data
		);

		header('Content-Type:text/xml');
		$xml="<?xml version='1.0' encoding='UTF-8'?>\n";
		$xml.="<root>\n";
		$xml.=self::xmlToEncode($result);
		$xml.="</root>";
		return $xml;

	}
	/**
	*解析$data数组  组装成xml数据
	*/
	public static function xmlToEncode($data){
		$xml="";
		$attr="";
		foreach($data as $key=>$value){
			if(is_numeric($key)){
				$attr=" id='{$key}'";
				$key="item";
			}
			$xml.="<{$key}{$attr}>";
			$xml.=is_array($value)?self::xmlToEncode($value):$value;
			$xml.="</{$key}>\n";
		}
		return $xml;
	}	

}
?>