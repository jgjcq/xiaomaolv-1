<?php
include_once "BaseModel.php";

class Salesman_type_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'salesman_type';
	}
	public function getAll(){
	    $list = $this->get_list_full();
	    return $list;
    }
}
?>