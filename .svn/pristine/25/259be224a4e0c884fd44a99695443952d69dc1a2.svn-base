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
		<script src="cust/js/configList.js"></script>
	</head>  
	<body> 
		<div class="page-container container">
			<div class="searchForm">
			    <div class="searchForm-title"><i class="icon-table searchForm-title-icon"></i>驴妈妈管理<i class="icon-double-angle-up searchFormTitleIcon"></i></div>
			    <div class="searchForm-main">
					<form id="searchForm">
							<input style="width:30%;" type="text" name='param' id="param" placeholder="用户帐号/用户昵称"/>
							<select name="is_check" id="is_check">
                                <option value="2">全部</option>
								<option value="1">已审核</option>
								<option value="0">未审核</option>
							</select>
                        <input type="hidden" name="pid" value="<?=$pid?>" />
					</form>
				</div>
			</div>
			<div class="operationRow">
				<button class="pageItemButton" onclick="showDialogModal('<?=base_url()?>Admin/Salesman/edit/0/<?=$pid?>');"><i class="icon-edit"></i>添加</button>
			</div>
			<div class="listcontent">
				<div class='xrTableRow'>
					<table id="table" class="xrTable">
						<thead>
							<tr>
								<th name="_xrno"></th>
								<th name="_oper" style="width: 80px;">操作</th>
                                <th name="_user_id" > 绑定用户ID </th>
								<th name="_nickname" > 昵称 </th>
								<th name="_phone" > 手机 </th>
								<th name="_address" > 地区 </th>
								<th name="_type" > 身份 </th>
                                <th name="_is_check_text" > 状态 </th>
                                <th name="_reg_time" > 注册时间 </th>
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
		$("#status").change(function(){
			$('.searchButton').click();
		});

	</script>
</html>