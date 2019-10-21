<?php
include_once "BaseModel.php";

class Role_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'role';
	}
	
}
?>