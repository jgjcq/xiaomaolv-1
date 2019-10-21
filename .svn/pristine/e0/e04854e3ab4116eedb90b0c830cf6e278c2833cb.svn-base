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
		<script src="cust/js/salesmanEdit.js"></script>
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
                    <input type="hidden" id="address" name="address" value="<?=estr($detail, 'address') ?>" />
					<table class='edit_table table-condensed'>
                        <tr>
                            <th>关联用户</th>
                            <td colspan="3">
                                <select name="user_id" id="user_id">
                                    <?php
                                    if(isset($user)){
                                        ?>
                                        <option value="<?=$user['id']?>" selected><?=$user['usercode']?></option>
                                        <?php
                                    }else{
                                    foreach($user_list as $user){
                                        ?>
                                        <option value="<?=$user['id']?>" <?php if(estr($detail, 'user_id') == $user['id']) {?>selected<?php }?>><?=$user['usercode']?></option>
                                        <?php
                                    }}
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>上级驴妈妈</th>
                            <td colspan="3">
                        <select name="pid" id="pid">
                            <option value="0" >无</option>
                        <?php
                            foreach($parents as $p){
                                $selected = $detail['pid'] == $p['id']?'selected':'';
                                echo <<<EOF
                       <option value="{$p['id']}" {$selected}>{$p['nickname']}</option>

EOF;
                            }
                        ?>
                        </select>
                                </td>
                        </tr>
						<tr>
							<th>昵称</th>
							<td colspan="3"><input  type="text" name="nickname" id="nickname" value="<?=estr($detail, 'nickname') ?>" dataType="*"/></td>
						</tr>

						<tr>
							<th>手机</th>
                            <td colspan="3"><input  type="text" name="phone" id="phone" value="<?=estr($detail, 'phone') ?>" dataType="*"/></td>
							</td>

						</tr>
                        <tr>
                            <th width="150">地址</th>
                            <td width="150">
                                <select name="province" id="province" dataType="*">
                                    <option value="">--省--</option>
                                    <?php
                                    foreach($province_list as $p){
                                        ?>
                                        <option value="<?=$p['areaId']?>" ><?=$p['areaName']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td  width="150">
                                <select name="city" id="city" dataType="*">
                                    <option value="">--市--</option>

                                </select>
                            </td>
                            <td  width="150">
                                <select name="area" id="area" dataType="*">
                                    <option value="">--区--</option>
                                </select>
                            </td>

                        </tr>

                        <tr>
                            <th>身份</th>
                            <td colspan="3">
                                <select name="type" id="type">
                                    <?php
                                    foreach($type_list as $v){
                                        ?>
                                        <option value="<?=$v['id']?>" <?php if(estr($detail, 'type') == $v['id']) {?>selected<?php }?>><?=$v['name']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <th>推广图片</th>
                            <td colspan="3">
                                <input type="hidden" name="ad_image" value="<?=estr($detail, 'ad_image') ?>" id="ad_image" dataType="*">
                                <img src="<?php echo $detail['ad_image']?$detail['ad_image']:'cust/images/upload.png'; ?>" alt="" style="width:150px; height:70px; cursor: pointer;" onclick="$(this).next().click();" >
                                <input type="file" style="display: none;" name="image_file" onchange="doImage(this);">
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
        $('#user_id').select2({
            width:200
        });
        $('#province,#city,#area').select2({
            width:100
        }).on("change",function (e) {
            var cityData = [{id:'',text:'--市--'}];
            var areaData = [{id:'',text:'--区--'}];
            var provinceId = "<?=estr($detail, 'province')?>";
            var cityId = "<?=estr($detail, 'city')?>";
            var areaId = "<?=estr($detail, 'area')?>";
            if($(this).select2('data').length == 0)return;
            if($(this).select2('data').length == 0|| !$(this).select2('data')[0].id){
                $('#city').empty();
                $('#city').select2({
                    data:cityData,
                    width:100
                });
                $('#area').empty();
                $('#area').select2({
                    data:areaData,
                    width:100
                });
            }else{
                const url = "/Admin/Api/getAreaByPid/"+$(this).select2('data')[0].id;
                if(e.currentTarget.id == 'province'){
                    $.getJSON(url,function (data) {
                        for(var i=0;i<data.length;i++){
                            cityData.push({id:data[i].areaId,text:data[i].areaName})
                        }
                        $('#city').empty();
                        $('#area').empty();
                        $('#area').select2({
                            data:areaData,
                            width:100
                        });
                        $('#city').select2({
                            data:cityData,
                            width:100
                        });
                        if(provinceId == $('#province').val()&&cityId){
                            $('#city').val([cityId]).trigger('change');
                        }
                    });
                }else if(e.currentTarget.id == 'city'){
                    $.getJSON(url,function (data) {
                        for(var i=0;i<data.length;i++){
                            areaData.push({id:data[i].areaId,text:data[i].areaName})
                        }
                        $('#area').empty();
                        $('#area').select2({
                            data:areaData,
                            width:100
                        });
                        if(cityId == $('#city').val()&&areaId){
                            $('#area').val([areaId]).trigger('change');;
                        }
                    });
                }
            }

        });
        $('#type').select2();


        var provinceId = "<?=estr($detail, 'province')?>";
        if(provinceId){
            $('#province').val([provinceId]).trigger('change');
        }

	</script>
</html>
