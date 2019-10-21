<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html><html lang="en">
	<head>
		<!--加载header文件-->
		<?php
		include_once 'public/views/header.php';
		?>
        <link rel="stylesheet" href="public/css/edit.css" />
		<script src="public/js/jquery.uploadfile.min.js"></script>
		<script src="cust/js/salesmanSetting.js"></script>
		<style>

		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<form id="editForm">
					<table class='edit_table table-condensed'>
                        <?php
                            foreach ($setting_list as $setting){
                            ?>
                                <tr>
                                    <th style="width: 300px"><?=$setting['title']?><input type="hidden" name="ids[]" value="<?=$setting['setting_id']?>"></th>
                                    <td colspan="3"><input  type="text" name="values[]"  value="<?=estr($setting, 'value') ?>" dataType="*"/></td>
                                </tr>

                        <?php
                            }
                        ?>
                        <tr>
                            <td></td>
                            <td colspan="3"><input type="button" value="提交" onclick="settingSub()"/></td>
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
