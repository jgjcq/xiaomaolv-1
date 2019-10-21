<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'qiniuSDK/autoload.php'; //以具体文件路径为主    
use Qiniu\Auth;  
use Qiniu\Storage\UploadManager;
class ExternalUpload extends HomeController {

	function __construct() { 
		parent::__construct();
	}

	/**************************************easyar*******************************************/
	function easyarUploadForm(){
		ob_clean();
		$director = "upload/easyar/";
		$output_dir = $director.date('Ymd',time())."/";
		if(!file_exists($output_dir))
			{
				mkdir($output_dir, 0777);
			}
		if(isset($_FILES["myfile"]))
		{
			$ret = array();

			$error =$_FILES["myfile"]["error"];
			$type=explode('.',$_FILES["myfile"]['name']);
			$document_name=buildOrdeNo();
		 	$fileName = $document_name.'.'.$type[count($type)-1];
		 	if(!in_array($type[count($type)-1],array('png','jpg','jpeg'))){
		 		exit(retJson("文件格式错误！", false));
		 	}
		 	move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
		 	$data=base_url().$output_dir.$fileName;
		}
		$params = [
			'type'=>'ImageTarget',
			'name' => $document_name,
			'active' => '1',
			'size' => '20',
			'meta' => base64_encode($document_name),
			'image' => base64_encode(file_get_contents($output_dir.$fileName)),
			'date' => gmdate('Y-m-d\TH:i:s.123\Z'),
			'appKey'=>EASYAR_CLOUDKEY
		];
		$params['signature'] = $this->getSign($params, EASYAR_CLOUDSECRET);
		$str = $this->httpPost('http://'.EASYAR_SEVER_END.'/targets/', json_encode($params));
		$obj = json_decode($str);
		if($obj->statusCode=='419'){
			exit(retJson("图片已使用", false));
		}
		else if($obj->statusCode!=0){
			exit(retJson("图片上传失败", false));
		}
		$remark=$obj->result->targetId;
		ob_clean();
		exit(retJson("上传成功！", true,$data,$remark));
	}
	function easyarUploadBase64(){
		ob_clean();
		$document_name=buildOrdeNo();
		if(checkStringIsBase64($_POST['image'])){
			$checkRet = uploadImg($_POST['image'],'easyar',$document_name);
			if(!$checkRet['status']){
				exit(toRetJson($checkRet));
			}
			$data = $checkRet["v"];
		}else{
			exit(retJson("请上传有效图片", false));
		}
		$params = [
			'type'=>'ImageTarget',
			'name' => $document_name,
			'active' => '1',
			'size' => '20',
			'meta' => base64_encode($document_name),
			'image' => base64_encode(file_get_contents($data)),
			'date' => gmdate('Y-m-d\TH:i:s.123\Z'),
			'appKey'=>EASYAR_CLOUDKEY
		];
		$params['signature'] = $this->getSign($params, EASYAR_CLOUDSECRET);
		$str = $this->httpPost('http://'.EASYAR_SEVER_END.'/targets/', json_encode($params));
		$obj = json_decode($str);
		if($obj->statusCode=='419'){
			exit(retJson("图片已使用", false));
		}
		else if($obj->statusCode!=0){
			exit(retJson("图片上传失败", false));
		}
		$remark=$obj->result->targetId;
		ob_clean();
		exit(retJson("上传成功！", true,$data,$remark));
	}

    function getSign($params, $cloudSecret) {
	    //按字典顺序排序
	    ksort($params);
	    $tmp = array();
	    foreach ($params as $key => $value) {
	      	$tmp[] = $key . $value;
	    }
	    $str = implode('', $tmp);
	    return sha1($str . $cloudSecret);
   	}




    /**************************************qiniu*******************************************/
    function qiniuUploadForm(){
    	ob_clean();
		$director = "upload/qiniu/";
		$output_dir = $director.date('Ymd',time())."/";
		if(!file_exists($output_dir))
			{
				mkdir($output_dir, 0777);
			}
		if(isset($_FILES["myfile"]))
		{
			$ret = array();

			$error =$_FILES["myfile"]["error"];
			$type=explode('.',$_FILES["myfile"]['name']);
			$document_name=buildOrdeNo();
		 	$fileName = $document_name.'.'.$type[count($type)-1];
		 	if(!in_array($type[count($type)-1],array('png','jpg','jpeg'))){
		 		exit(retJson("文件格式错误！", false));
		 	}
		 	move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
		 	$data=base_url().$output_dir.$fileName;
		}

    	$bucket = QINIU_BUCKET; //七牛云空间名        
		$accessKey = QINIU_ACCESS_KEY; //七牛云accesskey       
		$secretKey = QINIU_SECRET_KEY; //七牛云secretkey         
		$auth = new Auth($accessKey, $secretKey);
		$bucket = 'tuku-video';
		$token = $auth->uploadToken($bucket); 

		$filePath = $data;
		$uploadMgr = new UploadManager();
		list($ret, $err) = $uploadMgr->putFile($uptoken, null, $filePath);
		if ($err !== null) {
		    exit(retJson("上传失败", false,$err));
		} else {
		    exit(retJson("上传成功！", true,$ret));
		}
    }
    function qiniuUploadBase64(){
    	ob_clean();
		$document_name=buildOrdeNo();
		if(checkStringIsBase64($_POST['image'])){
			$checkRet = uploadImg($_POST['image'],'qiniu',$document_name);
			if(!$checkRet['status']){
				exit(toRetJson($checkRet));
			}
			$data = $checkRet["v"];
		}else{
			exit(retJson("请上传有效图片", false));
		}

    	$bucket = QINIU_BUCKET; //七牛云空间名        
		$accessKey = QINIU_ACCESS_KEY; //七牛云accesskey       
		$secretKey = QINIU_SECRET_KEY; //七牛云secretkey         
		$auth = new Auth($accessKey, $secretKey);
		$bucket = 'tuku-video';
		$uptoken = $auth->uploadToken($bucket); 

		$filePath = $data;
		$uploadMgr = new UploadManager();
		list($ret, $err) = $uploadMgr->putFile($uptoken, $checkRet['msg'], $filePath);
		if ($err !== null) {
		    exit(retJson("上传失败", false,$err));
		} else {
		    exit(retJson("上传成功！", true,$ret));
		}
    }
	
}