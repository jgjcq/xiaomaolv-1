<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppContent extends AdminController {

	function __construct() {
		parent::__construct();
		$this -> load -> model("Banner_model");
		$this -> sidebar = "Content-AppContent";
	}

	function Index() {	
		$data['title'] = '广告横幅';
		$data['banners'] = $this-> Banner_model ->get_list(array(),'sort asc');
		$this -> load -> view('admin/bannerList',$data);
	}
	

	function save(){
		$images = explode('-',$_POST['images']);

		$sorts = explode('-',$_POST['sorts']);
		$cust_url = explode('-',$_POST['cust_url']);

		$banners = array();
		foreach($images as $i => $v){
			if($v == ""){
				continue;
			}
			if($sorts[$i] != "" && !is_numeric($sorts[$i])){
				exit(retJson("排序必须为数字.",false));
				break;
			}

			$banners[$i]['sort'] = $sorts[$i];
			$banners[$i]['cust_url'] = $cust_url[$i];
			if(checkStringIsBase64($v)){
				$checkRet = uploadImg($v,'banner');
				if(!$checkRet['status']){
					exit(toRetJson($checkRet));
				}
				$banners[$i]['banner_image'] = $checkRet["v"];
			}else{
				$banners[$i]['banner_image'] = $v;
			}
			$banners[$i]['created']=time();
			$banners[$i]['type']=1;
		}
		// //删除文件夹中的图片
		// $default_banner=$this->Banner_model->get_list(array('type'=>1));
		// foreach ($default_banner as $k => $v) {
		// 	unlink($v['banner_image']);
		// }
		$this -> Banner_model ->delBatch('type=1');
		if($banners){
			$this -> Banner_model -> add_batch($banners);
		}
		
		exit(retJson("横幅更新完成.",true));
	}
}
