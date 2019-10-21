<?
//导入Excel文件
function uploadFile($file,$filetempname) 
{
	//自己设置的上传文件存放路径
	$filePath = 'upFile/';
	$str = "";
	//下面的路径按照你PHPExcel的路径来修改
	set_include_path('.'. PATH_SEPARATOR .'D:\MYOA\webroot\general\DIY_WSCP\DIY_exam\manage\excel\PHPExcel' . PATH_SEPARATOR .get_include_path()); 
      
	require_once 'PHPExcel.php';
	require_once 'PHPExcel\IOFactory.php';
	//require_once 'PHPExcel\Reader\Excel5.php';//excel 2003
	require_once 'PHPExcel\Reader\Excel2007.php';//excel 2007

	$filename=explode(".",$file);//把上传的文件名以“.”好为准做一个数组。
	if($filename[1]!='xls'&&$filename[1]!='xlsx') 
	{
		$msg='文件格式不正确，请上传后缀名为xls或者xlsx的excel文件';
	}
	else{
			$time=date("y-m-d-H-i-s");//去当前上传的时间 
			$filename[0]=$time;//取文件名t替换 
			$name=implode(".",$filename); //上传后的文件名 
			$uploadfile=$filePath.$name;//上传后的文件名地址 

		  
			//move_uploaded_file() 函数将上传的文件移动到新位置。若成功，则返回 true，否则返回 false。
		    $result=move_uploaded_file($filetempname,$uploadfile);//假如上传到当前目录下
		    if($result) //如果上传文件成功，就执行导入excel操作
		    {
			   //$objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2003
			   $objReader = PHPExcel_IOFactory::createReader('Excel2007');//use excel2003 和 2007 format
			   //$objPHPExcel = $objReader->load($uploadfile); //这个容易造成httpd崩溃
			   $objPHPExcel = PHPExcel_IOFactory::load($uploadfile);//改成这个写法就好了

			   $sheet = $objPHPExcel->getSheet(0); 
			   $highestRow = $sheet->getHighestRow(); // 取得总行数 
			   $highestColumn = $sheet->getHighestColumn(); // 取得总列数
		    
				//循环读取excel文件,读取一条,插入一条
				for($j=2;$j<=$highestRow;$j++)
				{ 
					

					for($k='A';$k<=$highestColumn;$k++)
					{ 
						$str .= iconv('utf-8','gbk',$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue()).'\\';//读取单元格
					} 
					//explode:函数把字符串分割为数组。
					$strs = explode("\\",$str);



					//验证数据合法性
					if(!$strs[0])
					{
						$msg = "数据格式不正确，导入失败！";
						break;
					}
					else if(!$strs[1])
					{
						$msg = "数据格式不正确，导入失败！";
						break;
					}
					else if(!$strs[2])
					{
						$msg = "数据格式不正确，导入失败！";
						break;
					}
					else if(!$strs[3])
					{
						$msg = "数据格式不正确，导入失败！";
						break;
					}
					else if(!$strs[4])
					{
						$msg = "数据格式不正确，导入失败！";
						break;
					}
					else if(!$strs[5])
					{
						$msg = "数据格式不正确，导入失败！";
						break;
					}
					else if(!$strs[6])
					{
						$msg = "数据格式不正确，导入失败！";
						break;
					}
					else
					{
						//var_dump($strs);
						//die();
						if($strs[4]=='是')
						{
							$IS_AT=1;
						}
						else{
							$IS_AT=0;
						}
						if($strs[6]=='是')
						{
							$IS_SCHOOL=1;
						}
						else{
							$IS_SCHOOL=0;
						}
						$sql = "INSERT INTO DIY_WSCP_TEACHER(TEA_USERID,TEA_IDCARD,TEA_BANK_CARD_NUMBER,TEA_BANK,IS_AT,INAUGURATION_TIME,IS_SCHOOL) VALUES('".$strs[0]."','".$strs[1]."','".$strs[2]."','".$strs[3]."','".$IS_AT."','".strtotime($strs[5])."','".$IS_SCHOOL."')";     
						//echo $sql;
						
						if(!exequery(TD::conn(),$sql)){
							return false;
						}
						$str = "";
						$msg = "导入成功！";
					}
					
					
			   } 
		   
		   	   unlink($uploadfile); //删除上传的excel文件
		    }else{
		       $msg = "导入失败！";
		    }
	}

    return $msg;
}
?>