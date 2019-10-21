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
		<script src="cust/js/couponEdit.js"></script>
		<script src="cust/js/goodsUpload.js"></script>
		<script src="public/js/cus_modal.js"></script>
        <script type="text/javascript" src="cust/js/My97DatePicker/WdatePicker.js"></script>
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
						</tr>
                        <tr>
                            <th>优惠卷类型</th>
                            <td colspan="3" >
                                <select name="type" id="type">
                                    <?php
                                    foreach ($coupon_type as $k=>$v){
                                    ?>
                                    <option value="<?=$k?>" <?php if(estr($detail, 'type') == $k) {?>selected<?php }?>><?=$v?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th>金额</th>
                            <td colspan="3" >
                                <input name="zk" id="zk"  value="<?=estr($detail, 'zk') ?>"  datatype="/^-?[1-9]+(\.\d+)?$|^-?0(\.\d+)?$|^-?[1-9]+[0-9]*(\.\d+)?$/"><span id="unit">元</span>
                            </td>
                        </tr>
                      <!--  <tr>
                            <th>有效期(不填永久有效)</th>
                            <td colspan="3" >
                                <input type="text" class="Wdate" id="start_time" value="<?=estr($detail, 'start_time') ?>"  name="start_time" onclick="WdatePicker({maxDate:'#F{$dp.$D(\'end_time\',{d:-3});}'})"/>
                                <input type="text" class="Wdate" id="end_time" value="<?=estr($detail, 'end_time') ?>"  name="end_time" onclick="WdatePicker({minDate:'#F{$dp.$D(\'start_time\',{d:3});}'})"/>
                            </td>
                        </tr>
						-->
						<tr>
							<th>备注</th>
							<td colspan="3">
								<textarea name="remark" id="remark" cols="30" rows="10" style="width:100%;"><?php echo $detail['remark']; ?></textarea>
							</td>
							
						</tr>


						
						
					</table>
				</form>
			</div>
		</div>
	</body>
	<script>

    </script>
</html>
