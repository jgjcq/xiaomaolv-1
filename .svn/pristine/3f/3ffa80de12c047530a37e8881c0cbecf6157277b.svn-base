<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html><html lang="en">
	<head>
		<!--加载header文件-->
		<?php
		include_once 'public/views/header.php';
		?>
		<link rel="stylesheet" href="public/css/edit.css" />
		<script src="cust/js/quickEntry.js"></script>
		<script src="public/js/cus_modal.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<input type="hidden" id="modal_title" value="<?=$title ?>" />
				<input type="hidden" id="modal_height" value="450" />
				<form id="editForm">
					<input type="hidden" id="role_id" name="role_id" value="<?php echo $role_id; ?>" />
					<input type="hidden" id="admin_id" name="admin_id" value="<?php echo $admin_id; ?>" />
					<?php foreach ($module as $k => $v): ?>
						<div style="border:1px solid #ddd; padding:0px 10px 0px 10px;">
						<div style="margin-top:10px; padding-bottom: 10px;"><p style="font-weight: bold;">一级模块：</p><input type="checkbox" name="module[]" value="<?php echo $v['id']; ?>" <?php echo in_array($v['id'], $role_module)?'checked="checked"':''; ?> data-is-sub="0" style="margin:0px 5px 0px 10px;" class="module-<?php echo $v['id']; ?>"><?php echo $v['cname']; ?></div>  
						<div style="margin-top:5px; padding-bottom: 10px;"><p style="font-weight: bold;">二级模块：</p>
						<?php foreach ($v['_child'] as $k1 => $v1): ?>
							<input type="checkbox" name="module[]" value="<?php echo $v1['id']; ?>" <?php echo in_array($v1['id'], $role_module)?'checked="checked"':''; ?> data-is-sub="1" data-pid="<?php echo $v1['pid']; ?>" style="margin:0px 5px 0px 10px;" class="module-<?php echo $v1['id']; ?>"><?php echo $v1['cname']; ?>
						<?php endforeach; ?></div></div>
					<?php endforeach; ?>
	
				</form>
				<div class="viewContent">
					<!--这是显示具体车辆信息情况的。-->
				</div>
			</div>
		</div>
	</body>
</html>
