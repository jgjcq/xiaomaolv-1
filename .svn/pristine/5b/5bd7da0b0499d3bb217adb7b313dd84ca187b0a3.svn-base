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
		<script src="cust/js/moduleList.js"></script>
	</head>
	<body>
		<div class="page-container container">
			<div class="operationRow">
				<button class="pageItemButton" onclick="showDialogModal('<?=base_url()?>Admin/Module/edit/0');"><i class="icon-edit"></i>添加</button>
			</div>
			<div class="listcontent">
				<div class='xrTableRow'>
					<table id="table" class="xrTable">
						<thead>
							<tr>
								<th name="_xrno"></th>
								<th name="_oper" style="width: 120px;">操作</th>
								<th name="_cname" > 模块中文名</th>
								<th name="_ename" > 模块英文名 </th>
								<th name="_iconChar" > 模块图标 </th>
								<th name="_levelChar" > 模块层级 </th>
								<th name="_showChar" > 是否显示 </th>
								<th name="_order" > 排序 </th>
								<th name="_createdChar" > 创建时间 </th>
								<th name="_updatedChar" > 最后修改时间 </th>
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