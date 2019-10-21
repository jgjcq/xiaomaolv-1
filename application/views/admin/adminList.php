<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html><html lang="en">
	<head>
		<!--加载header文件-->
		<?php
		include_once 'public/views/header.php';
		?>
		<link rel="stylesheet" href="public/css/list.css" />
		<link rel="stylesheet" href="public/xr/xrDatatable.css" />
		<script src="public/xr/xrDatatable.js"></script>
		<script src="public/js/list.js"></script>
		<script src="cust/js/adminList.js"></script>
	</head>
	<body>
		<div class="page-container container">
			<div class="searchForm">
			    <div class="searchForm-title"><i class="icon-table searchForm-title-icon"></i>数据表格<i class="icon-double-angle-up searchFormTitleIcon"></i></div>
			    <div class="searchForm-main">
					<form id="searchForm">
							<input type="text" name='param' id="param" placeholder="账户名/姓名"/>
							<select name="role" id="role">
								<option value="-1">全部</option>
								<?php foreach ($role as $k => $v): ?>
									<option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
								<?php endforeach; ?>
							</select>
					</form>
				</div>
			</div>
			<div class="operationRow">
				<button class="pageItemButton" onclick="showDialogModal('<?=base_url()?>Admin/Admin/edit/0');"><i class="icon-edit"></i>添加</button>
			</div>
			<div class="listcontent">
				<div class='xrTableRow'>
					<table id="table" class="xrTable">
						<thead>
							<tr>
								<th name="_xrno"></th>
								<th name="_oper" style="width: 120px;">操作</th>
								<th name="_usercode" > 账户名 </th>
								<th name="_username" > 姓名 </th>
								<th name="_roleName" > 角色 </th>
								<th name="_subRoleName" > 子角色 </th>
								<th name="_statusChar" > 启用状态</th>
								<th name="_logintimeChar" > 最近登录时间</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</body>
	<script>
		$("body").keydown(function() {
             if (event.keyCode == "13") {//keyCode=13是回车键
                 $('.searchButton').click();
             }
         });
		$("#role").change(function(){
			$('.searchButton').click();
		});
	</script>
</html>