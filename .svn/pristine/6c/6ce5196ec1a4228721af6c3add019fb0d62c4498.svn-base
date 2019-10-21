<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html><html lang="en">
	<head>
		<!--加载header文件-->
		<?php
		include_once 'public/views/header.php';
		?>
		<link rel="stylesheet" href="public/css/edit.css" />
		<script src="cust/js/roleEdit.js"></script>
		<script src="public/js/cus_modal.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<input type="hidden" id="modal_title" value="<?=$title ?>" />
				<input type="hidden" id="modal_height" value="450" />
				<form id="editForm">
					<input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
					<table class="xrTable">
						<tr>
							<th style="text-align: center; border-top:1px solid #eee; background-color: #eee;">入口名称</th>
							<th style="text-align: center; border-top:1px solid #eee; background-color: #eee;">英文名</th>
							<th style="text-align: center; border-top:1px solid #eee; background-color: #eee;">选择</th>
						</tr>
						<?php foreach ((new AppConFunc)->getAll() as $k => $v):?>
						<tr>
							<td><?php echo $v[2] ?></td>
							<td><?php echo $v[1] ?></td>
							<td><input type="checkbox" name="role[]" value="<?php echo $v[1] ?>" <?php if(in_array($v[1],$role)) echo 'checked="checked"'; ?>></td>
						</tr>
						<?php endforeach; ?>
						
						
						
						
						
						
						
					</table>
				</form>
				<div class="viewContent">
					<!--这是显示具体车辆信息情况的。-->
				</div>
			</div>
		</div>
	</body>
</html>
