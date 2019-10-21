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
		<script src="cust/js/txList.js"></script>
	</head>  
	<body> 
		<div class="page-container container">
			<div class="searchForm">
			    <div class="searchForm-title"><i class="icon-table searchForm-title-icon"></i>提现管理<i class="icon-double-angle-up searchFormTitleIcon"></i></div>
			    <div class="searchForm-main">
					<form id="searchForm">
							<select name="status" id="status">
                                <option value="0">未审核</option>
								<option value="1">已审核</option>
								<option value="2">全部</option>
							</select>
					</form>
				</div>
			</div>
			<div class="operationRow">
			</div>
			<div class="listcontent">
				<div class='xrTableRow'>
					<table id="table" class="xrTable">
						<thead>
							<tr>
								<th name="_xrno"></th>
								<th name="_oper" style="width: 80px;">操作</th>
                                <th name="_order_number" > 提现单号 </th>
								<th name="_salesman_name" > 昵称 </th>
                                <th name="_real_name" > 真实姓名 </th>
                                <th name="_bank" > 开户行 </th>
                                <th name="_bank_code" > 银行卡号 </th>
                                <th name="_aiplay" > 支付宝账号 </th>
                                <th name="_status_text" > 是否审核 </th>
                                <th name="_create_date" > 创建日期 </th>
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