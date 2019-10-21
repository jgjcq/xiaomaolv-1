<?php
include_once "BaseModel.php";

class Article_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'article';
	}
	
}
?>