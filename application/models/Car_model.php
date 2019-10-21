<?php
include_once "BaseModel.php";

class Car_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'car';
	}
	
}
?>