<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html><html lang="en">
	<head>
		<!--加载header文件-->
		<?php
		include_once 'public/views/header.php';
		?>
		<?php
		include_once 'public/home/html/treeView.php';
		?>
		<link rel="stylesheet" href="public/css/edit.css" />
		<script src="cust/js/roleModule.js"></script>
		<script src="public/js/cus_modal.js"></script>
		<style>
		/*	.clear {
				clear: both
				}
			.RadioStyle input {
				display: none;
				}
			.RadioStyle label {
				border: 1px solid #CCC;
				color: #666;
				padding: 2px 10px 2px 5px;
				line-height: 28px;
				min-width: 80px;
				text-align: center;
				margin: 2px;
				border-radius: 4px;
				margin-top: 10px;
				cursor: pointer;
				}
			.RadioStyle input:checked + label {
				background: url(<?php echo base_url() ?>public/home/images/ico_checkon.svg) no-repeat right bottom;
				border: 1px solid #00a4ff;
				background-size: 21px 21px;
				color: #00a4ff
				}
			.RadioStyle input:disabled + label {
				opacity: 0.7;
				}*/
			.tree{
				width:100%;
				padding:10px 20px 10px 20px;
				margin:20px 0 20px 0;
				/*border:1px solid #bbb;*/
				border-radius: 5px;
				/*border:none!important;*/
			}
			.checkbox{
				height:30px;
				/*line-height: 30px;*/
				/*border:1px solid #aaa;*/
				margin:0px!important;
				padding-left: 0px!important;
				min-height: 0px!important;
			}
			label{
				font-size: 14px;
			}
			.yn-tree-li{
				min-height:20px!important;
				padding-top: 0px!important;
			}
			.yn-tree-input {
				width:15px;
				height:15px;
				border:1px solid #438EB9!important;
			}
			.shrink{
				min-height:20px!important;
				padding-top: 0px!important;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row RadioStyle">
				<input type="hidden" id="modal_title" value="<?=$title ?>" />
				<input type="hidden" id="modal_height" value="450" />
				<form id="editForm">
					<input type="hidden" id="role_id" name="role_id" value="<?php echo $role_id; ?>" />

					<div id="treeview-checkable" class="tree">
					</div>
	
				</form>
				<div class="viewContent">
					<!--这是显示具体车辆信息情况的。-->
				</div>
			</div>
		</div>
	</body>
	
	<script>
		
		var shijian={
			onchange:function (input, yntree){
				// console.log(this);
			}
		}
		var checkStrictly={
			checkStrictly:true
		}
		var data={
			data:<?php echo json_encode($module); ?>
		}
		var defaultData=$.extend(shijian,checkStrictly,data);
		// 是否严格的遵循父子互相关联的做法
		var yntree = new YnTree(document.getElementById("treeview-checkable"), defaultData);
	</script>
</html>
