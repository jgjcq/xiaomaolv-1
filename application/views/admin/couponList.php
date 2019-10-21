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
		<script src="cust/js/couponList.js"></script>
	</head>  
	<body> 
		<div class="page-container container">
			<div class="searchForm">
			    <div class="searchForm-title"><i class="icon-table searchForm-title-icon"></i>优惠卷列表<i class="icon-double-angle-up searchFormTitleIcon"></i></div>
			    <div class="searchForm-main">
					<form id="searchForm">
							<input style="width:30%;" type="text" name='param' id="param" placeholder="标题"/>
							<select name="status" id="status">
								<option value="1">已启用</option>
								<option value="0">未启用</option>
								<option value="-1">全部</option>
							</select>
					</form>
				</div>
			</div>
			<div class="operationRow">
				<button class="pageItemButton" onclick="showDialogModal('<?=base_url()?>Admin/Coupon/edit/0');"><i class="icon-edit"></i>添加</button>
			</div>
			<div class="listcontent">
				<div class='xrTableRow'>
					<table id="table" class="xrTable">
						<thead>
							<tr>
								<th name="_xrno"></th>
								<th name="_oper" style="width: 80px;">操作</th>
								<th name="_title" > 标题 </th>
                                <th name="_type_str" > 优惠卷类型 </th>
                                <th name="_zk" > 折扣 </th>
                                <th name="_create_time" > 创建时间 </th>
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