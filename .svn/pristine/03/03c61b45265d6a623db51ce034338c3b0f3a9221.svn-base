<?php
include_once "BaseModel.php";

class Royalty_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'royalty';
	}

    public function getPrice($uid,$flag = false){
	    $where = "";
	    if($flag){
            $where = " and in_out = 0";
        }
	    $sql = "select sum(tc_price) as total_price from db_royalty where salesman_id = $uid $where group  by salesman_id";
	    $ret = $this->single($sql);
	    if(!$ret){
	        return 0;
        }else{
            return get_object_vars($ret)['total_price'];
        }

    }

    public function isTx($salesman_id){
	    $count = $this->get_count(array('salesman_id'=>$salesman_id,'in_out'=>1,'status'=>0));
	    if($count >0){
	        return true;
        }else{
	        return false;
        }
    }
}
?>