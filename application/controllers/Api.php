<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(-1);
class Api extends CI_Controller{
	//http://xx.com/page=1&pagesize=10
	public function index(){
 		$page = isset($_GET['page'])?$_GET['page']:1;
 		$pagesize = isset($_GET['pagesize'])?$_GET['pagesize']:10;

 		if(!is_numeric($page) || !is_numeric($pagesize)){
 			echo $this->response->show('4001','非法参数');
 		}else{
 			$data = array('page'=>$page,'pagesize'=>$pagesize);
 			echo $this->response->show('200','成功',$data);
 		}
 		
	}
}

?>