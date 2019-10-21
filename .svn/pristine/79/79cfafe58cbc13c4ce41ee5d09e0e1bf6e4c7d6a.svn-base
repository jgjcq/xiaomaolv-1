<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jssdk_service{
	private $CI;
	function __construct() { 
		$this->CI = &get_instance();
	}

	/**  
	* 获取微信jssdk配置信息
	* @access public 
	* @param $url 发起配置地址
	* @return array
	*/  
	public function getWxJsSdkConfig($url) {
		//获取jssdk凭证
		$this->CI->load->library('JsSdkBlog');
		$jssdk = new JsSdk(WX_APP_ID, WX_APP_SECRET);
        $signPackage = $jssdk->GetSignPackage($url);
        return $signPackage;
	}
	
	
}