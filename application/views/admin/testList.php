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
		<script src="cust/js/testList.js"></script>
	</head>
	<body>
		<?php include_once 'public/views/topper.php'
		?>
		<?php include_once 'public/views/menu.php'
		?>
		<div class="page-content">
			<div class="page-header">
				<h1>账户一览表</h1>
			</div>
			<div class="listcontent container">
				<form id="searchForm">
					<div class="col-xs-6">
						<label for="">条件</label>
						<input style="width:60%;" type="text" name='param' id="param" placeholder="账户名/姓名"/>
						<select name="role" id="role">
							<option value="-1">全部</option>
							<?php foreach ($role as $k => $v): ?>
								<option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</form>
				<div class='row'>
					<table id="table" class="xrTable">
						<thead>
							<tr>
								<th name="_oper" style="width: 120px;"></th>
								<th name="_usercode" > 账户名 </th>
								<th name="_username" > 姓名 </th>
								<th name="_roleName" > 角色 </th>
								<th name="_statusChar" > 启用状态</th>



                                <th name="_phone" > 联系方式</th>
                                <th name="_address" > 车行地址</th>
                                <th name="_business_license" > 营业执照图片本地地址</th>
                                <th name="_parking_space" > 车位数</th>
                                <th name="_openid" > 微信唯一标识</th>


                                <th name="_logintimeChar" > 最近登录时间</th>

                                <th name="_createdChar" > 创建时间 </th>
                                <th name="_updatedChar" > 更新时间 </th>


							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<div class="ace-settings-container" id="ace-settings-container">
			<div  class="btn btn-info btn-xs" onclick="showDialogModal('<?php echo base_url(); ?>Admin/Test/Navi')">
				添加
			</div>
			<!--<div class="btn btn-info btn-xs" id="export">
				导出
			</div>-->
		</div>
		<?php include_once 'public/views/footer.php'
		?>
	</body>
	<script>
		$("body").keydown(function() {
             if (event.keyCode == "13") {//keyCode=13是回车键
                 $('.searchButton a').click();
             }
         });
		$("#role").change(function(){
			$('.searchButton a').click();
		});

		function toNavi(){
			var diag = new Dialog();

			diag.Width = 885;

			diag.Height = 520;

			diag.Title = "用户详情";

			diag.URL = "<?php echo base_url(); ?>Admin/Test/Navi";

			diag.show();

		}
	</script>
</html>