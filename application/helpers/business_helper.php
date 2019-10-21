<?php
	define('EARTH_RADIUS', 6370.6935);
	
	/**
	 * 二次加盐
	 */
	function getPasswrodWithTwiceEncode($password,$salt){
		$encryptedPassword = md5($password);
		$encryptedWithSaltPassword = md5($encryptedPassword.$salt);
		return $encryptedWithSaltPassword;
	}
	
	/**
	 * 随机获取
	 */
	function getRandNum($length = 8 ) 
	{ 
		// 密码字符集，可任意添加你需要的字符 
		$chars = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'); 
		  
		// 在 $chars 中随机取 $length 个数组元素键名 
		$keys = array_rand($chars, $length); 
		$password = ''; 
		for($i = 0; $i < $length; $i++) 
		{ 
			// 将 $length 个数组元素连接成字符串 
			$password .= $chars[$keys[$i]]; 
		} 
		return $password; 
	}
	
	/**
	 * 随机获取
	 */
	function getRandStr($length = 8 ) 
	{ 
		// 密码字符集，可任意添加你需要的字符 
		$chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 
		'i', 'j', 'k', 'l','m', 'n', 'o', 'p', 'q', 'r', 's', 
		't', 'u', 'v', 'w', 'x', 'y','z', 'A', 'B', 'C', 'D', 
		'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L','M', 'N', 'O', 
		'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y','Z', 
		'0', '1', '2', '3', '4', '5', '6', '7', '8', '9'); 
		  
		// 在 $chars 中随机取 $length 个数组元素键名 
		$keys = array_rand($chars, $length); 
		$password = ''; 
		for($i = 0; $i < $length; $i++) 
		{ 
			// 将 $length 个数组元素连接成字符串 
			$password .= $chars[$keys[$i]]; 
		} 
		return $password; 
	}
	
	function sendMessage($destination,$text){
		$postData = array();
		$postData["account"] = MSG_APPKEY;
		$postData["pswd"] = MSG_APPSECRET;
		$postData["mobile"] = $destination;
		$postData["msg"] = urlencode($text);
		$postData["needstatus"] = "true";
		getLocalPost(SMS_SEND_ADDRESS,generUrlDatas($postData),false);
	}
	
	function generateOrderId(){
//		$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
		$yCode = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
		$orderSn = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
		return $orderSn;
	}
	
	//通过金额获取兑冲券数量
	function getDcNumByEcoin($amount){
		if(!is_numeric($amount) || $amount <=0 || $amount % CROWDFUNDING_SINGLE_MINIMUM != 0){
			return 0;
		}
		$rate = explode(':',DC_E_RATE);
		$ret = $amount * $rate[0] / $rate[1];
		return $ret;
	}
	
	//通过预存金额，获取使用兑冲券数量
	function getDcNumByYucun($amount){
		if(!is_numeric($amount) || $amount <=0 || $amount % CROWDFUNDING_SINGLE_MINIMUM != 0){
			return 0;
		}
		$rate = explode(':',DC_YUCUN_RATE);
		$ret = $amount * $rate[0] / $rate[1];
		return $ret;
	}
	
	//通过佣金金额，获取使用兑冲券数量
	function getDcNumByYongjin($amount){
		if(!is_numeric($amount) || $amount <=0){
			return 0;
		}
		$rate = explode(':',DC_YONGJIN_RATE);
		$ret = $amount * $rate[0] / $rate[1];
		return $ret;
	}
	
	//判断附近的位置点
	function vicinity($lng, $lat, $distance = 0.5) {
	    //$distance = 0.5;      // 单位 10KM
	    $radius = EARTH_RADIUS;
	      
	    $dlng = rad2deg(2*asin(sin($distance/(2*$radius))/cos($lat)));
	    $dlat = rad2deg($distance*10/$radius);
	      
	    $lng_left = round($lng - $dlng, 6);
	    $lng_right = round($lng + $dlng, 6);
	    $lat_top = round($lat + $dlat, 6);
	    $lat_bottom = round($lat - $dlat, 6);
	      
	    return array('lng'=> array('left'=> $lng_left, 'right'=> $lng_right), 'lat'=> array('top'=> $lat_top, 'bottom'=> $lat_bottom));
	}
	
	//是否是base64图片
	function checkStringIsBase64($str){
		if(strpos($str,'data:image') === 0){
			return true;
		}
		return false;
    }
    

    
    //根据经纬度计算距离
    function getDistance($lat1, $lng1, $lat2, $lng2){   
		$earthRadius = EARTH_RADIUS; //approximate radius of earth in meters   
		$lat1 = ($lat1 * pi() ) / 180;   
		$lng1 = ($lng1 * pi() ) / 180;   
		$lat2 = ($lat2 * pi() ) / 180;   
		$lng2 = ($lng2 * pi() ) / 180;   
		$calcLongitude = $lng2 - $lng1;   
		$calcLatitude = $lat2 - $lat1;   
		$stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);   
		$stepTwo = 2 * asin(min(1, sqrt($stepOne)));   
		$calculatedDistance = $earthRadius * $stepTwo;   
		return round($calculatedDistance,1);   
	}   
    
?>