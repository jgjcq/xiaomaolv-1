<?php
include_once "BaseModel.php";

class Gorder_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'gorder';
	}
	
}
?>