<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html><html lang="en">
	<head>
		<!--加载header文件-->
		<?php
		include_once 'public/views/header.php';
		?>
		<link rel="stylesheet" href="public/css/edit.css" />
		<script src="cust/js/moduleEdit.js"></script>
		<script src="public/js/cus_modal.js"></script>
		<style>
			.icon_click_div{
				width:320px;
				height:220px;
				overflow-y: scroll;
				background-color:white;
				border:1px solid #ddd;
				position: absolute;
				/*top:0px;*/
				display: none;
				padding:10px;
			}
			.icon_font{
				width:30px;
				height:30px;
				line-height: 30px;
				color:#555;
				font-size: 16px;
				border: 1px solid #fff;
				text-align: center;
				cursor: pointer;
			}
			.icon_font:hover{
				background-color:#6FB3E0;
				border:1px solid #6FB3E0;
				color:white;
			}
			#icon_check{
				/*line-height: 30px;*/
				font-size: 26px;
				/*background-color:#6FB3E0;*/
				/*border:1px solid #6FB3E0;*/
				color:#555;
				position: absolute;
				/*top:3px;*/
				margin-left: 20px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<input type="hidden" id="modal_title" value="<?=$title ?>" />
				<input type="hidden" id="modal_height" value="450" />
				<form id="editForm">
					<input type="hidden" id="id" name="id" value="<?=estr($detail, 'id') ?>" />
					<input type="hidden" id="level_d" name="level_d" value="<?=estr($detail, 'level') ?>" />
					<input type="hidden" id="pid_d" name="pid_d" value="<?=estr($detail, 'pid') ?>" />
					<table class='edit_table'>
						<tr>
							<th class="required">模块中文名</th>
							<td>
								<input type="text" name="cname" id="cname" value="<?=estr($detail, 'cname') ?>" dataType="*" />
							</td>
							<th class="required">模块英文名</th>
							<td>
								<input type="text" name="ename" id="ename" value="<?=estr($detail, 'ename') ?>" dataType="*" />
							</td>
						</tr>
						<tr>
							<th class="required">模块层级</th>
							<td>
								<select name="level" id="level">
									<option value="1" <?php if($detail&&$detail['level']==1) echo 'selected="selected"' ?>>顶级</option>
									<option value="2" <?php if($detail&&$detail['level']==2) echo 'selected="selected"' ?>>第二级</option>
									<option value="3" <?php if($detail&&$detail['level']==3) echo 'selected="selected"' ?>>第三级</option>
								</select>
							</td>
							<th class="required">上级模块</th>
							<td>
								<select name="pid" id="pid">
									
								</select>
							</td>
						</tr>
						<tr>
							<th class="required">排序</th>
							<td>
								<input type="text" name="order" id="order" value="<?php echo $detail&&$detail['order']?$detail['order']:'60' ?>" dataType="*" />
							</td>
							<th class="required">是否显示</th>
							<td>
								<select name="is_show" id="is_show">
									<option value="1" <?php if($detail&&$detail['is_show']==1) echo 'selected="selected"' ?>>是</option>
									<option value="0" <?php if($detail&&$detail['is_show']==0) echo 'selected="selected"' ?>>否</option>
								</select>
							</td>
						</tr>
						<tr class="module_icon">
							<th class="required">模块图标代码</th>
							<td colspan="3">
								<input type="hidden" name="icon" value="<?=estr($detail, 'icon') ?>">
								<a class="btn btn-info btn-xs" id="icon_button">点击选择</a><i class="<?=estr($detail, 'icon') ?>" id="icon_check" <?php if((!isset($detail))||(!$detail['icon'])) echo 'style="display:none;"'; ?>></i>
								<div class="icon_click_div">
								<?php foreach ($icon_array as $k => $v): ?>
									<i class="fa <?php echo $v; ?> icon_font" data-class="fa <?php echo $v; ?>"></i>
								<?php endforeach; ?>
								</div>
							</td>
						</tr>
						
						
					</table>
				</form>
				<div class="viewContent">
					<!--这是显示具体车辆信息情况的。-->
				</div>
			</div>
		</div>
	</body>
</html>
