<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html><html lang="en">
	<head>
		<!--加载header文件-->
		<?php
		include_once 'public/views/header.php';
		?>
		<?php
		include_once 'public/home/html/faltSelect.php';
		?>
		<link rel="stylesheet" href="public/css/edit.css" />
        <link href="public/css/uploadfile.css" rel="stylesheet">
        <script src="public/js/jquery.uploadfile.min.js"></script>
        <script src="cust/js/goodsUpload.js"></script>
		<script src="cust/js/userEdit.js"></script>
		<script src="public/js/cus_modal.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<input type="hidden" id="modal_title" value="<?=$title ?>" />
				<input type="hidden" id="modal_height" value="450" />
				<form id="editForm">
					<input type="hidden" id="id" name="id" value="<?=estr($detail, 'id') ?>" />
					<table class='edit_table'>
						<tr>
							<th class="required">账户</th>
							<td>
								<?php
									if(isset($detail['id'])){
								?>
									<input readonly="readonly" type="text" name="usercode" id="usercode" value="<?=estr($detail, 'usercode') ?>" dataType="*"/>
								<?php
									}else{
								?>
									<input type="text" name="usercode" id="usercode" value="<?=estr($detail, 'usercode') ?>" dataType="*" />
								<?php
									}
								?>
							</td>
							<th class="required">昵称</th>
							<td>
								<input type="text" name="username" id="username" value="<?=estr($detail, 'username') ?>" dataType="*" <?php if($detail['id']==1) echo 'readOnly'; ?>/>
							</td>
						</tr>
                        <tr>
                            <th class="required">性别</th>
                            <td colspan="3" class="sub-role-td">
                                <select id="gender" name="gender">
                                    <option value="1" <?php if(estr($detail, 'gender') == 1) {?>selected<?php }?>>男</option>
                                    <option value="2" <?php if(estr($detail, 'gender') == 2) {?>selected<?php }?>>女</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>头像</th>
                            <td colspan="3">
                                <input type="hidden" name="head_img" value="<?=estr($detail, 'head_img') ?>" id="head_img" dataType="*">
                                <img src="<?php echo $detail['head_img']?$detail['head_img']:'cust/images/upload.png'; ?>" alt="" style="width:150px; height:70px; cursor: pointer;" onclick="$(this).next().click();" >
                                <input type="file" style="display: none;" name="image_file" onchange="doImage(this);">
                            </td>

                        </tr>
                        <tr>
                            <th>手机</th>
                            <td colspan="3">
                                <input type="text"  name="phone" id="phone" value="<?=estr($detail, 'phone') ?>">
                            </td>

                        </tr>
						
					</table>
				</form>
			</div>
		</div>
	</body>


	<script type="text/javascript">

    </script>
</html>
