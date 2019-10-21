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
		<script src="cust/js/bannerList.js"></script>
		<style type="text/css">
			img.bannerImg{
				width:100%;
				border:solid gray 1px;
				cursor: pointer;
				height:180px;
				border-radius: 6px;
		
			}
			.row>div{
				margin-left:20px;
				margin-top:20px;
				width:210px;
				float:left;
				text-align: center;
			}
			.row>div input{
				width:100%;
			}
			.row>div i{
				color:#aaa;
    			font-size:26px;
    			cursor: pointer;
    			position: absolute;
    			top:4px;
    			right:6px;
			}
			.c_d:hover{
				background-color:#438EB9; 
				color:white;
			}
			.img-contant{
				position: relative;
			}

		</style>
	</head>
	<body>
		<button type="button" class="btn btn-primary btn-xs" id="saveBtn" style="float:right; margin:20px 20px 0px 0px;">保存</button>
		<button type="button" class="btn btn-danger btn-xs" onclick="showImage()" style="float:right; margin:20px 10px 0px 0px;">大图预览</button>
		<div class="page-container">
			<div class="listcontent container">
				<div class="row">
					<?php
						foreach($banners as $i => $v){
					?>
					<div class="img-contant">
						<img class="bannerImg" src="<?=$v["banner_image"]?>" alt="" />
						<input type="file" style="display: none;" />

						<input type="text" placeholder="排序" name="sort" value="<?=$v["sort"]?>" style="display: none;"/>
						<input type="text" placeholder="外链地址" name="cust_url" class='cust_url'  value="<?php echo $v['cust_url']; ?>" >
						<i class="icon-remove-sign"></i>
					</div>
					<?php
						} 
					?>
					<?php
						for($i=0;$i<6-count($banners);$i++){
					?>
					<div class="img-contant">
						<img class="bannerImg" src="cust/images/upload.png" alt="" />
						<input type="file" style="display: none;" />
						<input type="text" placeholder="排序" name="sort" style="display: none;" value="60"/>
						<input type="text" placeholder="外链地址" name="cust_url"  value="" class='cust_url'>

						
						<i class="icon-remove-sign"></i>
					</div>
					<?php
						} 
					?>
				</div>
			</div>
			<div class="row" style="text-align: center;margin-top:80px;">
				
			</div>
		</div>
		<div class="ace-settings-container" id="ace-settings-container">
		</div>
		
	</body>
	<script>
		var banner=<?php echo json_encode($banners); ?>;
		var img={data:[]}
		$.each(banner,function(k,v){
			img.data.push({'alt':v.cust_url,'pid':v.id,'src':v.banner_image,'thumb':''});
		});
		function showImage(){
			showDialogModalPhoto(img);
		}
	</script>
</html>