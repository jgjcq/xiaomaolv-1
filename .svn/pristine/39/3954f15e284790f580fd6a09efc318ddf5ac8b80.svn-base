<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommonAli extends MY_Controller {

	function __construct() { 
		parent::__construct();
        $this -> load -> model("Area_model");
	}

	/**  
	* 发送短信
	* @access public 
	* @param  $template_code    模板号
	* @param  $mobile_array    手机号数组
	* @param  $verify_code_array    参数=>值 数组
	*/
	function sendMobileMsg(){
		$template_code=$_POST['template_code'];
		$mobile_array=$_POST['mobile_array'];
		$verify_code_array=$_POST['verify_code_array'];

		$this->load->library('AliSmsBlog');
		$config=array(
			'accessKeyId'=>ALI_MSG_APPKEY,
			'accessKeySecret'=>ALI_MSG_APPSECRET,
			'signName'=>ALI_MSG_SIGN,
			'templateCode'=>$template_code
			);
		$ali_sms=new AliSms($config);
		$result=$ali_sms->send_verify($mobile_array,$verify_code_array);
	}

}