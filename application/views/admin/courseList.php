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
		<script src="cust/js/courseList.js"></script>
	</head>  
	<body> 
		<div class="page-container container">
			<div class="searchForm">
			    <div class="searchForm-title"><i class="icon-table searchForm-title-icon"></i>课程列表<i class="icon-double-angle-up searchFormTitleIcon"></i></div>
			    <div class="searchForm-main">
					<form id="searchForm">
							<input style="width:30%;" type="text" name='param' id="param" placeholder="标题/子标题"/>
							<select name="status" id="status">
								<option value="1">已发布</option>
								<option value="0">未发布</option>
								<option value="2">全部</option>
							</select>
					</form>
				</div>
			</div>
			<div class="operationRow">
				<button class="pageItemButton" onclick="showDialogModal('<?=base_url()?>Admin/Course/edit/0');"><i class="icon-edit"></i>添加</button>
			</div>
			<div class="listcontent">
				<div class='xrTableRow'>
					<table id="table" class="xrTable">
						<thead>
							<tr>
								<th name="_xrno"></th>
								<th name="_oper" style="width: 80px;">操作</th>
								<th name="_title" > 课程名称 </th>
                                <th name="_course_type_name" > 课程类型 </th>
								<th name="_img_input" > 展示图片 </th>
                                <th name="_typeStr" > 文件类型 </th>
                                <th name="_old_price" > 原价 </th>
                                <th name="_price" > 单人价格 </th>
                                <th name="_p_price" > 成团价格 </th>
                                <th name="_max_coupon" > 代金卷额度 </th>
                                <th name="_ishot_str" > 好课天天抢 </th>
                                <th name="_isjt_str" > 精挑细选 </th>
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