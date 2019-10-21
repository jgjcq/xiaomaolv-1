<?php
include_once "BaseModel.php";

class User_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'user';
	}

	public function getUnSalesmanUserList(){
	    $sql = "select * from db_user  where id not in (select user_id from db_salesman  )";
	    $list = $this->query($sql);
	    return $list;
    }
}
?>