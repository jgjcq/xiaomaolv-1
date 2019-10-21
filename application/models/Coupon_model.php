<?php
include_once "BaseModel.php";

class Coupon_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'coupon';
	}


}
?>