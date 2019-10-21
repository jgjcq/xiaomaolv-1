<?php
include_once "BaseModel.php";

class Config_detail_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'config_detail';
	}
	
}
?>