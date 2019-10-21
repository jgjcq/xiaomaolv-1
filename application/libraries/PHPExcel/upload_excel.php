

<?
// ini_set('display_errors',1);            //错误信息  
// ini_set('display_startup_errors',1);    //php启动错误信息  
// error_reporting(-1);                    //打印出所有的 错误信息  
// ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); //将出错信息输出到一个文本文件
include_once("inc/auth.inc.php");

include_once("inc/header.inc.php");
?>




<body class="bodycolor">

<?
include("function.php"); 

if($_POST['import']=="导入数据"){

	$leadExcel=$leadExcel;
	
	if($leadExcel == "true")
	{
		// var_dump($_FILES);
		// exit();
		//echo "OK";die();
		//获取上传的文件名
		$filename = $_FILES['inputExcel']['name'];
		//上传到服务器上的临时文件名
		$tmp_name = $_FILES['inputExcel']['tmp_name'];
		
		$msg = uploadFile($filename,$tmp_name);
		{ Message(_("提示"),_($msg));
			?>

			<br>
			<div align="center">
			 <input type="button" value="<?=_("返回")?>" class="BigButton" onClick="location='../teacher_operation/new.php?start=<?=$start?>'">
			</div>

			<?
			    exit;
		}
	}
}
?>

</body>
</html>