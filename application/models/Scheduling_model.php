<?php
include_once "BaseModel.php";

class Scheduling_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'scheduling';
	}
	
}
?>