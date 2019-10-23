<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html><html lang="en">
	<head>
		<?php
		include_once 'public/views/header.php';
		?>
		<script type="text/javascript" src="public/assets/js/jquery-1.10.2.min.js"></script>
		<link rel="stylesheet" type="text/css" href="public/append/diyUpload/css/webuploader.css">
		<link rel="stylesheet" type="text/css" href="public/append/diyUpload/css/diyUpload.css">
		<script type="text/javascript" src="public/append/diyUpload/js/webuploader.html5only.min.js"></script>
		<script type="text/javascript" src="public/append/diyUpload/js/diyUpload.js"></script>
		<script src="public/js/cus_modal.js"></script>
		<?php if(isWxC()):?>
			<link rel="stylesheet" href="cust/css/m/mEdit.css" />
		<?php endif;?>
	</head>
	<style>
	*{ margin:0; padding:0;}
	#box{ margin:0px; width:100%; min-height:412px; background:#FF9;padding-bottom:12px;}
	#demo{ margin:50px auto; width:586px; min-height:250px; background:#CF9}
	</style>
<body>
	<input type="hidden" id="modal_title" value="<?=$title ?>" />
	<input type="hidden" id="dirName" value="<?=$_GET['dirName'] ?>" />
<div id="box">
	<span>最大上传照片数12张，最大上传大小10M.</span>
	<div id="test" ></div>
</div>

<!--<div id="demo">
	<div id="as" ></div>
</div>-->
</body>
<script type="text/javascript">
/*
* 服务器地址,成功返回,失败返回参数格式依照jquery.ajax习惯;
* 其他参数同WebUploader
*/
$('#test').diyUpload({
	url:'Comm/Fileupload?dirName='+$("#dirName").val(),
	success:function( data ) {
		console.info( data );
	},
	error:function( err ) {
		console.info( err );
		swal({
			title: "上传失败!",
			text: "上传失败，请重新上传.",
			type: "error"
		}, function() {
		});
	},
		//最大上传的文件数量, 总文件大小,单个文件大小(单位字节);
	fileNumLimit:12,
	fileSizeLimit:10 * 1024 *1024 * 12,
	fileSingleSizeLimit:10 * 1024 *1024
});
//
//$('#as').diyUpload({
//	url:'Comm/fileupload',
//	success:function( data ) {
//		console.info( data );
//	},
//	error:function( err ) {
//		console.info( err );	
//	},
//	buttonText : '选择文件',
//	chunked:true,
//	// 分片大小
//	chunkSize:512 * 1024,
//	//最大上传的文件数量, 总文件大小,单个文件大小(单位字节);
//	fileNumLimit:50,
//	fileSizeLimit:500000 * 1024,
//	fileSingleSizeLimit:50000 * 1024,
//	accept: {}
//});
</script>
</html>
