<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommonWx extends MY_Controller {

	function __construct() { 
		parent::__construct();
	}

	/**  
	* 获取微信jssdk配置信息
	* @access public 
	* @param $_POST['url'] 发起配置地址
	*/
	function getWxJsSdkConfig(){
		$this->load->library('WxService/jssdk_service');
        $signPackage=$this->jssdk_service->getWxJsSdkConfig($_POST['url']);
        exit(retJson("jssdk凭证.", true,$signPackage));
	}
		
}