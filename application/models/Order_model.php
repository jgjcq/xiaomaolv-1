<?php
include_once "BaseModel.php";

class Order_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'order';
	}

}
?>