<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html><html lang="en">
	<head>
		<!--加载header文件-->
		<?php
		include_once 'public/views/header.php';
		?>
		<link rel="stylesheet" href="public/css/edit.css" />
		<script src="cust/js/roleModule.js"></script>
		<script src="public/js/cus_modal.js"></script>
		<style>
			.clear {
				clear: both
				}
			.RadioStyle input {
				display: none;
				}
			.RadioStyle label {
				border: 1px solid #CCC;
				color: #666;
				padding: 2px 10px 2px 5px;
				line-height: 28px;
				min-width: 80px;
				text-align: center;
				/*float: left;*/
				margin: 2px;
				border-radius: 4px;
				margin-top: 10px;
				cursor: pointer;
				}
			.RadioStyle input:checked + label {
				background: url(<?php echo base_url() ?>public/home/images/ico_checkon.svg) no-repeat right bottom;
				border: 1px solid #00a4ff;
				background-size: 21px 21px;
				color: #00a4ff
				}
			.RadioStyle input:disabled + label {
				opacity: 0.7;
				}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row RadioStyle">
				<input type="hidden" id="modal_title" value="<?=$title ?>" />
				<input type="hidden" id="modal_height" value="450" />
				<form id="editForm">
					<input type="hidden" id="role_id" name="role_id" value="<?php echo $role_id; ?>" />

					<?php foreach ($module as $k => $v): ?>
						<div style="border:1px solid #ddd; padding:0px 10px 0px 10px;">
						<div style="margin-top:10px; padding-bottom: 10px;"><div style="font-weight: bold;">一级模块：</div><input type="checkbox" name="module[]" id="module<?php echo $v['id'] ?>" value="<?php echo $v['id']; ?>" <?php echo in_array($v['id'], $role_module)?'checked="checked"':''; ?> data-is-sub="0" style="margin:0px 5px 0px 10px;" class="module-<?php echo $v['id']; ?>"><label for="module<?php echo $v['id'] ?>"><?php echo $v['cname']; ?></label></div>
						<?php if(isset($v['_child'])): ?>
						<div style="margin-top:5px; padding-bottom: 10px;"><div style="font-weight: bold;">二级模块：</div>
						<?php foreach ($v['_child'] as $k1 => $v1): ?>
							<input type="checkbox" id="module<?php echo $v1['id'] ?>" name="module[]" value="<?php echo $v1['id']; ?>" <?php echo in_array($v1['id'], $role_module)?'checked="checked"':''; ?> data-is-sub="1" data-pid="<?php echo $v1['pid']; ?>" style="margin:0px 5px 0px 10px;" class="module-<?php echo $v1['id']; ?>">
							<label for="module<?php echo $v1['id'] ?>"><?php echo $v1['cname']; ?></label>
							<?php if(isset($v1['_child'])): ?>
							<div style="margin-top:5px; padding-bottom: 10px;"><div style="font-weight: bold;">三级模块：</div>
							<?php foreach ($v1['_child'] as $k2 => $v2): ?>
								<input type="checkbox" id="module<?php echo $v2['id'] ?>" name="module[]" value="<?php echo $v2['id']; ?>" <?php echo in_array($v2['id'], $role_module)?'checked="checked"':''; ?> data-is-sub="1" data-pid="<?php echo $v2['pid']; ?>" style="margin:0px 5px 0px 10px;" class="module-<?php echo $v2['id']; ?>">
								<label for="module<?php echo $v2['id'] ?>"><?php echo $v2['cname']; ?></label>
							<?php endforeach; ?></div>
							</div>
							<?php endif; ?>
						<?php endforeach; ?></div>
						<?php endif; ?>
						
					<?php endforeach; ?>
	
				</form>
				<div class="viewContent">
					<!--这是显示具体车辆信息情况的。-->
				</div>
			</div>
		</div>
	</body>
</html>
