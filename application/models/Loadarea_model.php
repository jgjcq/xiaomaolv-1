<?php
include_once "BaseModel.php";

class Loadarea_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'loadarea';
	}
	
}
?>