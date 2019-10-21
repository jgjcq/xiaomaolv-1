<?php
include_once "BaseModel.php";

class Unloadarea_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'unloadarea';
	}
	
}
?>