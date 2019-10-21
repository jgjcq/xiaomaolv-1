<?php
include_once "BaseModel.php";

class User_course_detail_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'user_course_detail';
	}
	
}
?>