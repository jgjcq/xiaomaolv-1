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
		<script src="cust/js/adminEdit.js"></script>
		<script src="public/js/cus_modal.js"></script>
	</head>
	<body>
		<div class="role-demo hidden">
			<select style="width:157px" id="role_id" dataType="*" data-val="<?=estr($detail, 'role') ?>" name="sub_role_id[]">
				<?php foreach ($role as $k => $v): ?>
					<option value="<?php echo $v['id']; ?>" <?php if($v['id']==$detail['role_id']) echo 'selected="selected"'; ?>><?php echo $v['name']; ?></option>
				<?php endforeach; ?>
			</select>
			<div class="btn btn-default btn-xs" onclick="delRole(this);">删除</div></br>
		</div>
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
							<th class="required">姓名</th>
							<td>
								<input type="text" name="username" id="username" value="<?=estr($detail, 'username') ?>" dataType="*" <?php if($detail['id']==1) echo 'readOnly'; ?>/>
							</td>
						</tr>
						<tr>
							<?php if(!isset($detail['id'])): ?>
							<th class="required">角色</th>
							<td colspan="3">
								<select style="width:157px" id="role_id" dataType="*" data-val="<?=estr($detail, 'role') ?>" name="role_id">
									<?php foreach ($role as $k => $v): ?>
										<option value="<?php echo $v['id']; ?>" <?php if($v['id']==$detail['role_id']) echo 'selected="selected"'; ?>><?php echo $v['name']; ?></option>
									<?php endforeach; ?>
								</select>
							</td>
							<?php else: ?>
							<th class="required">角色</th>
							<td colspan="3">
								<input type="hidden" name="role_id" value="<?=estr($detail, 'role_id') ?>">
								
									<?php foreach ($role as $k => $v): ?>
										<?php if($v['id']==$detail['role_id']) echo $v['name']; ?>
									<?php endforeach; ?>
								
							</td>
							<?php endif; ?>
						</tr>
						<tr>
							
							<th class="required">其他角色</th>
							<td colspan="3" class="sub-role-td">
								<div id="sub_role_div"></div>
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
		function addRole(){
			$('.sub-role-td').append($('.role-demo').html());
		}
		function delRole(obj){
			$(obj).next().remove();
			$(obj).prev().remove();
			$(obj).remove();
		}
	</script>


	<script type="text/javascript">
		<?php 
			$tagData=array();
			$defaultData=array();
			$have_sub_role_id=explode(',',$detail['sub_role_id']);
			foreach ($role as $k => $v) {
				if(in_array($v['id'],$have_sub_role_id)){
					$defaultData[]=array('name'=>$v['name'],'id'=>$v['id']);
				}else{
					$tagData[]=array('name'=>$v['name'],'id'=>$v['id']);
				}	
			}
		?>
	
		var tagData =<?php echo json_encode($tagData) ?>;
		var defaultData = <?php echo json_encode($defaultData) ?>;
	    //input name 为 fileIds
	    $.myMethod("#sub_role_div",tagData,"sub_role_id[]",defaultData);
	    $(".sumbit").on("click",function(){
	    	console.log($("form").serialize())
	    })


</script>
</html>
