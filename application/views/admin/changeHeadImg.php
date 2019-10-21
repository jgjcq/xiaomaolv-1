<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html><html lang="en">
	<head>
		<!--加载header文件-->
		<?php
		include_once 'public/views/header.php';
		?>
		<link rel="stylesheet" href="public/css/edit.css" />
		<script src="public/js/cus_modal.js"></script>
		<script src="cust/js/changeHeadImg.js"></script>
		<style>
			body{
				background-color: white;
			}
		</style>
	</head>
	<body>
		<input type="hidden" id="modal_title" value="<?=$title ?>" />
		<div class="container">
			<div class="row">
				<div class="col-xs-12 text-center">
					<img style="width:100px; height:100px; border-radius: 50px; cursor: pointer; margin:20px auto;" src="<?php echo base_url() ?><?php echo getSess(SESS_USER)['head_img']?getSess(SESS_USER)['head_img']:'public/home/images/head_img.jpg' ?>" alt="" id="head_img_img">
					<input type="hidden" name="head_img" id="head_img" value="<?php echo getSess(SESS_USER)['head_img']; ?>">
				</div>
				<div class="col-xs-12 text-center">
					<div id="upload_button" style="height:45px; width:150px; line-height: 45px; border-radius: 4px; background-color: #5A98DE; color:white; font-size: 15px; text-align: center; margin:auto; cursor: pointer;"><i class="icon-camera" style="font-size: 24px; margin-right:8px; position: relative; top:4px;"></i>点击上传图片</div>
					<input type="file" style="display: none;">
				</div>
			</div>
		</div>
	</body>
</html>
