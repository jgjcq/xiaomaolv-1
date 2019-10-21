<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html><html lang="en">
	<head>
		<!--加载header文件-->
		<?php
		include_once 'public/views/header.php';
		?>
		<link rel="stylesheet" href="public/css/edit.css" />
		<link href="public/css/uploadfile.css" rel="stylesheet">
		<script src="public/js/jquery.uploadfile.min.js"></script>
		<script src="cust/js/salesmanTypeEdit.js"></script>
		<script src="cust/js/goodsUpload.js"></script>
		<script src="public/js/cus_modal.js"></script>
		<style>
			.file_input{
				width:70px; height:30px; border:3px solid #6FB3E0; border-radius: 3px; background-color:white; color:#6FB3E0; font-size: 14px; font-weight: bold; line-height: 25px; text-align: center; cursor: pointer;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<input type="hidden" id="modal_title" value="<?=$title ?>" />
				<input type="hidden" id="modal_height" value="550" />
				<form id="editForm">
					<input type="hidden" id="id" name="id" value="<?=estr($detail, 'id') ?>" />
					<table class='edit_table table-condensed'>
						<tr>
							<th>名称</th>
							<td colspan="3"><input  type="text" name="name" id="name" value="<?=estr($detail, 'name') ?>" dataType="*"/></td>
						</tr>

					</table>
				</form>
				<div class="viewContent">
					<!--这是显示具体车辆信息情况的。-->
				</div>
			</div>
		</div>
	</body>
	<script>


	</script>
</html>
