<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html><html lang="en">
	<head>
		<!--加载header文件-->
		<?php
		include_once 'public/views/h_header_css.php';
		?>
	</head>
<body>
<div class="page-container">
	<p class="f-20 text-success">欢迎使用<?=getValInArr(getSess(SESS_DIC),array('webInfo','webtitle'))?></p>
	<!-- <p>登录次数：18 </p> -->
	<p>上次登录IP：<?php echo getSess(SESS_USER)['ip'] ?> &nbsp;&nbsp;&nbsp; 上次登录时间：<?php echo date('Y-m-d H:i:s',getSess(SESS_USER)['updated']) ?></p>
	<table class="table table-border table-bordered table-bg mt-20">
		<thead>
			<tr>
				<th colspan="2" scope="col">服务器信息</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>当前登陆用户 </td>
				<td><?php echo getSess(SESS_USER)['username'].'（'.getSess(SESS_USER)['usercode'].'）' ?></td>
			</tr>
			<tr>
				<td>服务器目录</td>
				<td><span id="lbServerName"><?php echo base_url() ?></span></td>
			</tr>
			<tr>
				<td>服务器IP地址</td>
				<td><?php echo $_SERVER['SERVER_ADDR'] ?></td>
			</tr>
			<tr>
				<td>服务器域名</td>
				<td><?php echo 'http://'.$_SERVER['SERVER_NAME'] ?></td>
			</tr>
			<tr>
				<td>服务器端口 </td>
				<td><?php echo $_SERVER["SERVER_PORT"] ?></td>
			</tr>
			<tr>
				<td>服务器的语言种类 </td>
				<td>Chinese (People's Republic of China)</td>
			</tr>
			<tr>
				<td>服务器当前时间 </td>
				<td class="sever-time"></td>
			</tr>
			
		</tbody>
	</table>
</div>
<!-- <button id="aa">sda</button> -->
</body>
<script>
	var time=<?php echo time() ?>;
	changeSeverTime(time);
	setInterval(function(){
		time=parseInt(time)+1;
		changeSeverTime(time);
	},1000);
	function changeSeverTime(time){
		var time2 = new Date(parseInt(time)*1000);
		$('.sever-time').html(time2);
	}

	// $(function(){
	// 	$('#aa').click(function(){
	// 		window.parent.showMessageRemind('asdsadas');
	// 	});
	// })
</script>
</html>