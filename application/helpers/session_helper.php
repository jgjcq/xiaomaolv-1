<?php
function loadBaseurl() {
	$config['base_url'] = $_SERVER['HTTP_HOST'];
}

/***********session*********************/
//session设值
function setSess($d, $key = SESS_USER) {
	unset($_SESSION[$key]);
	if ($d!=null) {
		$_SESSION[$key] = $d;
	}
}

//session取值
function getSess($key = SESS_USER) {
	if (!hasSess($key)) {
		return null;
	}
	return $_SESSION[$key];
}

//判断是否存在该session
function hasSess($key = SESS_USER) {
	if (isset($_SESSION[$key])) {
		return true;
	}
	return false;
}

/***********cookie*********************/
//cookie设值
function setCook($key, $d, $time = -1) {
	if($time == -1){
		$time = time() + 2 * 7 * 24 * 3600;
	}
	unset($_COOKIE[$key]);
	if ($d!=null) {
		setcookie($key,$d,$time);
	}
}

//cookie取值
function getCook($key) {
	if (!hasCook($key)) {
		return null;
	}
	return $_COOKIE[$key];
}

//判断是否存在该cookie
function hasCook($key) {
	if (!empty($_COOKIE[$key])) {
		return true;
	}
	return true;
}

//判断是否是微信端
function isWxC(){
	if(hasSess(SESS_IS_WX_CLIENT)){
		return true;
	}
	return false;
}

function wxPage(){
	if(isWxC()){
		return "m/";
	}
	return "";
}

?>