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
		<script src="cust/js/userPassword.js"></script>
		<style>

		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<input type="hidden" id="modal_title" value="<?=$title ?>" />
				<input type="hidden" id="modal_height" value="380" />
				<form id="editForm" style="padding:10px;">
					 <div class="input-line">
					    <input type="password" class="form-control" id="oldPwd" name="oldPwd" placeholder="旧密码" dataType="*">
					 </div>
					 <div class="input-line">
					    <input type="password" class="form-control" id="newPwd" name="newPwd" placeholder="新密码" dataType="*">
					 </div>
					 <div class="input-line">
					    <input type="password" class="form-control" id="newPwd2" name="newPwd2" placeholder="确认密码" dataType="*">
					 </div>
				</form>
			</div>
		</div>
	</body>
</html>
