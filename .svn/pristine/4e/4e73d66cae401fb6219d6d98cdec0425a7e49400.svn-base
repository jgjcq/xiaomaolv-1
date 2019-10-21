<?php
/**********************功能性工具******************************/
function pri($s) {
	echo "<pre>";
	print_r($s);
	echo "</pre>";
}

//用于判断为空为空字符串判断
function isNullOrEmpty($s) {
	if ($s==null || $s=="") {
		return true;
	}
	return false;
}

//页面输出变量，为空或空字符串，用空格表示
function dstr($array, $key) {
	if (!isset($array[$key]) || isNullOrEmpty($array[$key])) {
		return "&nbsp;";
	}
	return $array[$key];
}

//编辑页面，用于简略add页面
function estr($array, $key) {
	if (!isset($array[$key]) || isNullOrEmpty($array[$key])) {
		return "";
	}
	return $array[$key];
}

function getBasePath(){
    return "/";
}

////获得访客浏览器类型
function GetBrowser() {
	if (!empty($_SERVER['HTTP_USER_AGENT'])) {
		$br = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/MSIE/i', $br)) {
			$br = 'IE浏览器';
		} elseif (preg_match('/Firefox/i', $br)) {
			$br = '火狐浏览器';
		} elseif (preg_match('/Chrome/i', $br)) {
			$br = '谷歌浏览器';
		} elseif (preg_match('/Safari/i', $br)) {
			$br = 'Safari';
		} elseif (preg_match('/Opera/i', $br)) {
			$br = 'Opera';
		} else {
			$br = '其他浏览器';
		}
		return $br;
	} else {
		return "获取浏览器信息失败！";
	}
}

//返回值-返回页面去
function retJson($msg = "", $status = true, $data = array(),$remark=array()) {
	$ret = array();
	$ret['status'] = $status;
	$ret['msg'] = $msg;
	if(is_array($data)){
		$ret['v'] = json_encode($data);
	}else{
		$ret['v'] = $data;
	}
	if(is_array($remark)){
		$ret['remark'] = json_encode($remark);
	}else{
		$ret['remark'] = $remark;
	}

	return json_encode($ret);
}

//返回值-返回Controller
function retArray($msg = "", $status = true, $data = array()) {
	$ret = array();
	$ret['status'] = $status;
	$ret['msg'] = $msg;
	$ret['v'] = $data;

	return $ret;
}

function toRetJson($retArray){
	return retJson($retArray['msg'],$retArray['status'],$retArray['v']);
}


//获取网页数据
function getPageContent($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	//抓取的后台页面地址
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$content = curl_exec($ch);
	$content = mb_convert_encoding($content, "UTF-8", "gb2312");
//	log_info($content);
	curl_close($ch);
	return $content;
}

//获取post返回值
function getLocalPost($url, $data,$isJson = true,$method = 'POST') {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	if($isJson){
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	}else{
		curl_setopt($ch, CURLOPT_HEADER, 0);
	}
	$result = curl_exec($ch);
//	log_info($result);
	curl_close($ch);
	return $result;
}
function httpPost($url, $data) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'Content-Type: application/json; charset=utf-8',
          'Content-Length: ' . strlen($data)));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $str = curl_exec($ch);
        curl_close($ch);
        return $str;
    }
function fileGetContentsPost($url, $post) {

    $options = array(

        'http' => array(

            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n". "Content-Length: ".strlen(http_build_query($post))."\r\n",

            // 'content' => 'name=caiknife&email=caiknife@gmail.com',

            'content' => http_build_query($post),

        ),

    );

    $result = file_get_contents($url, false, stream_context_create($options));

    return $result;

}

function xr_iconv($str, $from = 'UTF-8', $to = 'GB2312') {
	try {
		return iconv($from, $to . '//ignore', $str);
	} catch(Exception $e) {
		return "";
	}
}

//获取数组中的值
function getValInArr($arr, $keys = array()) {
	if (count($keys)==0) {
		return "";
	}
	if (count($keys)==1) {
		return $arr[$keys[0]];
	}
	$ret = $arr;
	foreach ($keys as $key) {
		$ret = $ret[$key];
	}
	return $ret;
}

//图片压缩
Function Img($Image, $Dw = 640, $Dh = 700, $Type = 1) {
	IF (!File_Exists($Image)) {
		Return False;
	}
	//如果需要生成缩略图,则将原图拷贝一下重新给$Image赋值
	IF ($Type!=1) {
		Copy($Image, Str_Replace(".", "_x.", $Image));
		$Image = Str_Replace(".", "_x.", $Image);
	}
	//取得文件的类型,根据不同的类型建立不同的对象
	$ImgInfo = GetImageSize($Image);
	Switch($ImgInfo[2]) {
		Case 1 :
			$Img = @ImageCreateFromGIF($Image);
			Break;
		Case 2 :
			$Img = @ImageCreateFromJPEG($Image);
			Break;
		Case 3 :
			$Img = @ImageCreateFromPNG($Image);
			Break;
	}
	//如果对象没有创建成功,则说明非图片文件
	IF (Empty($Img)) {
		//如果是生成缩略图的时候出错,则需要删掉已经复制的文件
		IF ($Type!=1) {Unlink($Image);
		}
		Return False;
	}
	//如果是执行调整尺寸操作则
	IF ($Type==1) {
		$w = ImagesX($Img);
		$h = ImagesY($Img);
		$width = $w;
		$height = $h;
		IF ($width>$Dw) {
			$Par = $Dw / $width;
			$width = $Dw;
			$height = $height * $Par;
			IF ($height>$Dh) {
				$Par = $Dh / $height;
				$height = $Dh;
				$width = $width * $Par;
			}
		} ElseIF ($height>$Dh) {
			$Par = $Dh / $height;
			$height = $Dh;
			$width = $width * $Par;
			IF ($width>$Dw) {
				$Par = $Dw / $width;
				$width = $Dw;
				$height = $height * $Par;
			}
		} Else {
			$width = $width;
			$height = $height;
		}
		$nImg = ImageCreateTrueColor($width, $height);
		//新建一个真彩色画布
		ImageCopyReSampled($nImg, $Img, 0, 0, 0, 0, $width, $height, $w, $h);
		//重采样拷贝部分图像并调整大小
		ImageJpeg($nImg, $Image);
		//以JPEG格式将图像输出到浏览器或文件
		Return True;
		//如果是执行生成缩略图操作则
	} Else {
		$w = ImagesX($Img);
		$h = ImagesY($Img);
		$width = $w;
		$height = $h;
		$nImg = ImageCreateTrueColor($Dw, $Dh);
		IF ($h / $w>$Dh / $Dw) {//高比较大
			$width = $Dw;
			$height = $h * $Dw / $w;
			$IntNH = $height - $Dh;
			ImageCopyReSampled($nImg, $Img, 0, -$IntNH / 1.8, 0, 0, $Dw, $height, $w, $h);
		} Else {//宽比较大
			$height = $Dh;
			$width = $w * $Dh / $h;
			$IntNW = $width - $Dw;
			ImageCopyReSampled($nImg, $Img, -$IntNW / 1.8, 0, 0, 0, $width, $Dh, $w, $h);
		}
		ImageJpeg($nImg, $Image);
		Return True;
	}
}

function getClientIP() {
	if (getenv("HTTP_CLIENT_IP"))
		$ip = getenv("HTTP_CLIENT_IP");
	else if (getenv("HTTP_X_FORWARDED_FOR"))
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	else if (getenv("REMOTE_ADDR"))
		$ip = getenv("REMOTE_ADDR");
	else
		$ip = "Unknow";
	return $ip;
}

//复制数组（选择某几项）
function copyArray($orgi,$items = array()){
	$ret = array();
	foreach($items as $i => $v){
		$ret[$v] = $orgi[$v];
	}
	return $ret;
}

//数组组成长url参数
function generUrlDatas($datas = array()){
	$str = "";
	foreach($datas as $key=>$value){
		$str .= $key."=".$value."&";
	}
	return substr($str,0,strlen($str)-1);
}

//字符串formatter
function str_format() {
	 $args = func_get_args();
	 if (count($args) == 0) { return;}
	 if (count($args) == 1) { return $args[0]; }
	 $str = array_shift($args);
	 $str = preg_replace_callback('/\\{(0|[1-9]\\d*)\\}/', create_function('$match', '$args = '.var_export($args, true).'; return isset($args[$match[1]]) ? $args[$match[1]] : $match[0];'), $str);
	 return $str;
}


//验证码
function getMathcode($width=100,$height=35) {
		$w = $width;
		$h = $height;
		$im = imagecreate($w, $h);

		//imagecolorallocate($im, 14, 114, 180); // background color
		$red = imagecolorallocate($im, 255, 0, 0);
		$white = imagecolorallocate($im, 255, 255, 255);

		$num1 = rand(1, 20);
		$num2 = rand(1, 20);

		$_SESSION['helloweba_math'] = $num1 + $num2;

		$gray = imagecolorallocate($im, 118, 151, 199);
		$black = imagecolorallocate($im, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));

		//画背景
		imagefilledrectangle($im, 0, 0, $w, $h, $black);
		//在画布上随机生成大量点，起干扰作用;
		for ($i = 0; $i < 80; $i++) {
			imagesetpixel($im, rand(0, $w), rand(0, $h), $gray);
		}

		imagestring($im, 5, 8, 9, $num1, $red);
		imagestring($im, 5, 33, 8, "+", $red);
		imagestring($im, 5, 48, 9, $num2, $red);
		imagestring($im, 5, 73, 8, "=", $red);
		imagestring($im, 5, 83, 7, "?", $white);

		header("Content-type: image/png");
		imagepng($im);
		imagedestroy($im);

		//echo iconv('utf-8','gbk',$_SESSION['code_zh']);
	}

	//生成16位订单编号
	 function buildOrdeNo(){
        // return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        $trade_no=substr(date('Y'),3,1).time().rand(100,999).substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 5, 13), 1))), 9, 2);
        return $trade_no;
    }
    //上传照片
	function uploadImg($base64_image_content,$name,$file=false){
		$director = "upload/".$name."/";
		//匹配出图片的格式
		if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
			$type = $result[2];
			$new_file = $director."".date('Ymd',time())."/";
			if(!file_exists($new_file))
			{
				//检查是否有该文件夹，如果没有就创建，并给予最高权限
				mkdir($new_file, 0777);
			}
			if(!$file){
				$new_file = $new_file.(time().getRandStr(8)).".".$type."";
			}
			else{
				$new_file = $new_file.$file.".".$type."";
			}
			if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
				return retArray($file.".".$type,true,$new_file);
			}
		}
		return retArray("图片上传失败.",false);
	}
	//上传文件
	function uploadCourseFile(){
        $ret = getMediaFileInfo($_FILES['file']['tmp_name']);
        $videoArray = array("mp4","avi","swf","mkv");
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $dirname = "audio";
        if(in_array($extension,$videoArray)){
            $dirname = "video";
        }
        $director = "upload/".$dirname."/";
        $new_file = $director."".date('Ymd',time())."/";
        if (!is_dir($new_file)) mkdir($new_file);
        $name = time().getRandStr(8);
        $img_file = $new_file.$name.".jpg";
        $new_file = $new_file.$name.".".$extension;
        $ret['url'] = $new_file;
        $ret["thumb"] = $img_file;
        $mret = move_uploaded_file($_FILES['file']['tmp_name'], $new_file);
        if ($mret) {
            if($dirname == 'video'){
               $r =  get_img_by_video($new_file,$img_file,3);
            }
            return retArray($_FILES['file']['name'],true,$ret);
        } else {
            return retArray("文件上传失败.",false);
        }
    }


    /*获取视频缩略图
    $videopath : 视频绝对地址
    $imgpath : 缩略图保存地址
    $time : 截取第几帧为缩略图
    */
    function get_img_by_video( $videopath, $imgpath, $time = 1) {
        if (! file_exists($videopath)) return false;
        if (strpos(PHP_OS, 'WIN') !== false){ //windows系统
            $str = "D:\\ffmpeg\\bin\\ffmpeg -i {$videopath} -y -f mjpeg -ss 3 -t {$time} -s 300x200 {$imgpath}";
            return exec($str);
        }else{
            $str = "ffmpeg -i {$videopath} -y -f mjpeg -ss 3 -t {$time} -s 300x200 {$imgpath}";
            return exec($str);
        }
    }

    /**
     * 获取文件信息
     * @access public
     * @param  file      $file     文件路径
     * @return array
     */

    function getMediaFileInfo($file)
    {
        if(PHP_OS == "Linux"){
            $command = sprintf('ffmpeg -i "%s" 2>&1', $file);//你的安装路径
        }else{
            $command = sprintf('D:\\ffmpeg\\bin\\ffmpeg -i "%s" 2>&1', $file);//你的安装路径
        }


        ob_start();
        passthru($command);
        $info = ob_get_contents();
        ob_end_clean();
        $data = array();
        if (preg_match("/Duration: (.*?), start: (.*?), bitrate: (\d*) kb\/s/", $info, $match)) {
            $data['duration'] = $match[1]; //播放时间
            $arr_duration = explode(':', $match[1]);
            $data['seconds'] = $arr_duration[0] * 3600 + $arr_duration[1] * 60 + $arr_duration[2]; //转换播放时间为秒数
            $data['start'] = $match[2]; //开始时间
            $data['bitrate'] = $match[3]; //码率(kb)
        }
        if (preg_match("/Video: (.*?), (.*?), (.*?)[,\s]/", $info, $match)) {
            $data['vcodec'] = $match[1]; //视频编码格式
            $data['vformat'] = $match[2]; //视频格式
            $data['resolution'] = $match[3]; //视频分辨率
        }
        if (preg_match("/Audio: (\w*), (\d*) Hz/", $info, $match)) {
            $data['acodec'] = $match[1]; //音频编码
            $data['asamplerate'] = $match[2]; //音频采样频率
        }
        if (isset($data['seconds']) && isset($data['start'])) {
            $data['play_time'] = $data['seconds'] + $data['start']; //实际播放时间
        }
        $data['size'] = filesize($file); //文件大小
        return $data;
    }

	//二维数组顺序打乱
	function shuffle_assoc($list) {
        if (!is_array($list)) return $list;

        $keys = array_keys($list);
        shuffle($keys);
        $random = array();
        foreach ($keys as $key)
        $random[$key] = shuffle_assoc($list[$key]);
        return $random;
    }
    //二维数组去重
    function more_array_unique($arr=array()){
        foreach($arr[0] as $k => $v){
            $arr_inner_key[]= $k;   //先把二维数组中的内层数组的键值记录在在一维数组中
        }
        foreach ($arr as $k => $v){
            $v =join(",",$v);    //降维 用implode()也行
            $temp[$k] =$v;      //保留原来的键值 $temp[]即为不保留原来键值
        }
        // printf("After split the array:<br>");
        // print_r($temp);    //输出拆分后的数组
        // echo"<br/>";
        $temp =array_unique($temp);    //去重：去掉重复的字符串
        foreach ($temp as $k => $v){
            $a = explode(",",$v);   //拆分后的重组 如：Array( [0] => james [1] => 30 )
            $arr_after[$k]= array_combine($arr_inner_key,$a);  //将原来的键与值重新合并
        }
        //ksort($arr_after);//排序如需要：ksort对数组进行排序(保留原键值key) ,sort为不保留key值
        return $arr_after;
    }
    //用于数组元素增加单引号
    function change_to_quotes($str) {
    return sprintf("'%s'", $str);
	}





	//获取毫秒
	function msectime() {
	  	$now=microtime();
	  	$now_array=explode(' ',$now);
	  	$hao=$now_array['0'];
	  	return $hao;
	}

	//字符串过长
	function sub_str($str,$len,$suffix="..."){
        if(function_exists('mb_substr')){
            if(strlen($str) > $len){
                $str= mb_substr($str,0,$len).$suffix;
            }
            return $str;
        }else{
            if(strlen($str) > $len){
                $str= substr($str,0,$len).$suffix;
            }
            return $str;
        }
    }
    //数组变成加引号的字符串
    function arrayToString($array){
    	$str = "'".str_replace(",","','",join(",",$array))."'";
    	return $str;
    }

	 //根据pid无线级分类转化成树状多维数组
	function listToTree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root=0) {
	    $tree = array();// 创建Tree
	    if(is_array($list)) {
	        // 创建基于主键的数组引用
	        $refer = array();
	        foreach ($list as $key => $data) {
	            $refer[$data[$pk]] =& $list[$key];
	        }

	        foreach ($list as $key => $data) {
	            // 判断是否存在parent
	            $parentId = $data[$pid];
	            if ($root == $parentId) {
	                $tree[$data[$pk]] =& $list[$key];
	            }else{
	                if (isset($refer[$parentId])) {
	                    $parent =& $refer[$parentId];
	                    $parent[$child][] =& $list[$key];
	                }
	            }
	        }
	    }
	    return $tree;
	}

	//二维数组根据字段排序
	function arraySequence($array, $field, $sort = 'SORT_ASC')
	{
	    $arrSort = array();
	    foreach ($array as $uniqid => $row) {
	        foreach ($row as $key => $value) {
	            $arrSort[$key][$uniqid] = $value;
	        }
	    }
	    array_multisort($arrSort[$field], constant($sort), $array);
	    return $array;
	}

	//数组存入text文件做为缓存
	function cacheArray($array,$filename){
		$filename=$filename;
		$file_hwnd=fopen($filename,"w");
		fwrite($file_hwnd,serialize($array)); //输入序列化的数据
		fclose($file_hwnd);
	}

	//从text文件中取出缓存还原成数组
	function unCacheArray($filename){
		$filename=$filename;
		$file_hwnd=fopen($filename,"r");
		$content = fread($file_hwnd, filesize($filename)); // 读去文件全部内容
		fclose($file_hwnd);
		$array_2 = unserialize($content); // 将文本数据转换回数组
		return $array_2;
	}

	//打印出一个类型img(对，错)
	function echoImg($type,$width,$height){
		$str='<img src="'.base_url().'public/home/images/'.$type.'.png" style="width:'.$width.'px; height:'.$height.'px;" />';
		return $str;
	}

	//验证货币
	function checkDecimal($number){
		if(!preg_match("/^[0-9]+(.[0-9]{1,2})?$/",$number))
		{
			return false;
		}
		else{
			return true;
		}
	}

	//判断是否为ajax
	function isAjax() {
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * 求两个已知经纬度之间的距离,单位为米
	 *
	 * @param lng1 $ ,lng2 经度
	 * @param lat1 $ ,lat2 纬度
	 * @return float 距离，单位米
	 * @author www.Alixixi.com
	 */
	function getLocationLength($lng1, $lat1, $lng2, $lat2) {
	    // 将角度转为狐度
	    $radLat1 = deg2rad($lat1); //deg2rad()函数将角度转换为弧度
	    $radLat2 = deg2rad($lat2);
	    $radLng1 = deg2rad($lng1);
	    $radLng2 = deg2rad($lng2);
	    $a = $radLat1 - $radLat2;
	    $b = $radLng1 - $radLng2;
	    $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))) * 6378.137 * 1000;
	    return $s;
	}


	function downloadDocument($url, $path)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
        $file = curl_exec($ch);
        curl_close($ch);
        $filename = pathinfo($url, PATHINFO_BASENAME);
        $resource = fopen($path . $filename, 'a');
        fwrite($resource, $file);
        fclose($resource);
        return $filename;
    }

    function downloadWxheadimg($headimgurl,$path){
        $header = array(
        'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:45.0) Gecko/20100101 Firefox/45.0',
         'Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3',
         'Accept-Encoding: gzip, deflate',);
        $url= $headimgurl;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $data = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if ($code == 200) {//把URL格式的图片转成base64_encode格式的！
           $imgBase64Code = "data:image/jpeg;base64," . base64_encode($data);
        }
        $img_content=$imgBase64Code;//图片内容
        // if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $img_content, $result)) {
        //      $type = $result[2];//得到图片类型png?jpg?gif?
        //      $new_file = $path.date("YmdHis").".".$type;
        //      if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $img_content)))) {
        //         return upload_img($new_file);
        //         // return "http://weixin.wy100.com/hyuser_sys/oldjie/".$new_file;
        //         // exit;
        //     }
        //     uploadImg($img_content,'wx_head');
        // }
        return uploadImg($img_content,$path);
    }

    //二维数组多字段排序
    //$arr = sortArrByManyField($array1,'id',SORT_ASC,'name',SORT_ASC,'age',SORT_DESC);
    function sortArrByManyField(){
        $args = func_get_args();
        if(empty($args)){
            return false;
        }
        $arr = array_shift($args);
        if(!is_array($arr)){
            return false;
        }
        foreach($args as $key => $field){
            if(is_string($field)){
                $temp = array();
                foreach($arr as $index=> $val){
                    $temp[$index] = $val[$field];
                }
                $args[$key] = $temp;
            }
        }
        $args[] = &$arr;//引用值
        call_user_func_array('array_multisort',$args);
        return array_pop($args);
    }

    //删除文件
    function delDocument($url){
    	if(file_exists($url)){
    		unlink($url);
    	}
    }

?>