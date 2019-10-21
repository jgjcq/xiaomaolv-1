<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<?php
		include_once 'public/views/header.php';
		?>
	<script src="<?php echo base_url(); ?>public/home/js/jquery.js"></script>
	<?php include_once 'public/home/html/bootstrap.php' ?>
	<style>
		body{
			height:520px;
			width:900px;
			overflow: hidden;
		}
		.navi{
			height:auto;
			/*padding:10px 10px 10px 0px!important;*/
			padding-top:10px;
			padding-bottom:10px;
			background-color: #eee;
			width:900px;
		}
		.navi::-webkit-scrollbar {
       		display: none;
    	}
		.navi-item{
			height:40px; 
			text-align: center;
			line-height: 40px;
			width:80px;
			font-weight: bold;
			background-color: #fff;
			display: inline-block;
			margin-left: 10px;
			border-radius: 5px;
			color:#444;
			cursor:pointer;
		}
		.navi-item-active{
			color:white!important;
			background-color: #438EB9!important;
		}
	</style>
</head>
<body>
		<div class="row" style="padding:0px;">
			<div class="col-md-12 navi">
					<div class="navi-item navi-item-active" onclick="changePage(this);" data-url="<?php echo base_url(); ?>Admin/Test/Index2">客户档案</div>
					<div class="navi-item" onclick="changePage(this);" data-url="<?php echo base_url(); ?>Admin/Test/Index2">客户档案</div>
					<div class="navi-item" onclick="changePage(this);" data-url="<?php echo base_url(); ?>Admin/Test/Index2">客户档案</div>
					<div class="navi-item" onclick="changePage(this);" data-url="<?php echo base_url(); ?>Admin/Test/Index2">客户档案</div>
					<div class="navi-item" onclick="changePage(this);" data-url="<?php echo base_url(); ?>Admin/Test/Index2">客户档案</div>
					<div class="navi-item" onclick="changePage(this);" data-url="<?php echo base_url(); ?>Admin/Test/Index2">客户档案</div>
					<div class="navi-item" onclick="changePage(this);" data-url="<?php echo base_url(); ?>Admin/Test/Index2">客户档案</div>
			</div>
		</div>
		<div class="row" style="padding:0px;">
			<div class="col-md-12 iframe-content">
				<iframe name="tt" src="" width="885" height="470" frameborder="0"></iframe>
			</div>
		</div>		
</body>
<script>
	$(function(){
		$('.navi-item-active').click();
	})
	function changePage(obj){
		$('.navi-item').removeClass('navi-item-active');
		$(obj).addClass('navi-item-active');
		$('iframe').attr('src',$(obj).attr('data-url'));
	}
</script>
</html>