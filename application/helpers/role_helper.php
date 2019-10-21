<?php
class Rolea 
{
    const Value = 0;
    const Caption = 1;
    public static $EnumTypes = array();
    //通过值获取内容
	function Show($v){
		$CurCaption = "";
		foreach(self::$EnumTypes as $temp){
			if($temp[self::Value] == $v){
				$CurCaption = $temp[self::Caption];
				break;
			}
		}
		return $CurCaption;
	}
	function getAll(){
		return self::$EnumTypes;
	}
	function getAllOneD(){
		$new_array=array();
		foreach(self::$EnumTypes as $k=>$v){
			$new_array[]=$v[self::Caption];
		}
		return $new_array;
	}
}


//用户角色
class AdminRoleType extends Rolea
{
    
    function __construct(){
    	$Manager = array(1,'管理员');
    	$Seller = array(2,'总经理');
    	$SellCenter = array(3,'运营');
 		parent::$EnumTypes = array($Manager,$Seller,$SellCenter);
 	}
}

//网站控制器（后台）
class AppConFunc extends Rolea
{
    
    function __construct(){

    	$two = array(2,'Admin','用户管理');
    	$three = array(3,'AppContent','广告横幅');
    	$four = array(4,'Article','文章管理');
    	
    	$six = array(6,'Role','角色管理');
    
    	
    	$thirteen = array(13,'User','会员管理');
    	
 		parent::$EnumTypes = array($two,$three,$four,$thirteen);
 	}
}

