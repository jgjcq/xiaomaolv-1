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
		<script src="cust/js/articleEdit.js"></script>
		<script src="cust/js/goodsUpload.js"></script>
		<script src="public/js/cus_modal.js"></script>
		<script type="text/javascript" charset="utf-8" src="public/ueditor/ueditor.config.js"></script>
	    <script type="text/javascript" charset="utf-8" src="public/ueditor/ueditor.all.min.js"> </script>
	    <script type="text/javascript" charset="utf-8" src="public/ueditor/lang/zh-cn/zh-cn.js"></script>
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
				<input type="hidden" id="modal_height" value="450" />
				<form id="editForm">
					<input type="hidden" id="id" name="id" value="<?=estr($detail, 'id') ?>" />
					<table class='edit_table table-condensed'>
						<tr>
							<th>标题</th>
							<td><input  type="text" name="title" id="title" value="<?=estr($detail, 'title') ?>" dataType="*"/></td>
							<th>子标题</th>
							<td><input  type="text" name="subtitle" id="subtitle" value="<?=estr($detail, 'subtitle') ?>" dataType="*"/></td>
						</tr>
					
						<tr>
							<th>展示图片</th>
							<td colspan="3">
							<input type="hidden" name="article_image" value="<?=estr($detail, 'article_image') ?>" id="article_image" dataType="*">
							<img src="<?php echo $detail['article_image']?$detail['article_image']:'cust/images/upload.png'; ?>" alt="" style="width:150px; height:70px; cursor: pointer;" onclick="$(this).next().click();" >
							<input type="file" style="display: none;" name="image_file" onchange="doImage(this);">
							</td>

						</tr>
						
						
						
						<tr>
							<th>内容</th>
							<td colspan="3">
								<script id="editor" type="text/plain" style="width:600px;height:250px;"></script>
								<textarea name="content" id="content" cols="30" rows="10" style="width:100%; display: none;"><?php echo $detail['content']; ?></textarea>
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
	<script>
		var ue=UE.getEditor('editor');
	</script>
</html>
