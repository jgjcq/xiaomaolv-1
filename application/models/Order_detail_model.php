<?php
include_once "BaseModel.php";

class Order_detail_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'order_detail';
        $this->reflash();
	}

	public function  getBuyedList($uid){
	    $sql = "select id from db_order_detail where user_id = $uid and `status` < 2 GROUP BY order_id";
	    return $this->query($sql);
    }

    public function getByStatus($status = -1,$uid){
       $sql = "select od.id as did,o.status as order_status,o.*,od.*,c.* from db_order_detail od LEFT JOIN db_course c ON c.id = od.course_id LEFT JOIN db_order o ON o.id = od.order_id where od.user_id = $uid";
       if($status != -1){
           $sql .=" and o.status = $status";
       }
	     return $this->query($sql);
    }

    public function reflash(){
	    $sql = "update db_order o set o.total = (select count(*) FROM db_order_detail od WHERE od.order_id = o.id);";
	    $this->execute($sql);
        $sql1 = "update db_order  set `status` = 3 WHERE unix_timestamp(now()) > end_time;";
        $this->execute($sql1);
        $sql2 = "update db_order set `status` = 4 where total >= 3 and `status` <> 3;";
        $this->execute($sql2);

    }
    public function isBuy($order_id,$uid){
	    $count = $this->get_count(array('order_id'=>$order_id,'user_id'=>$uid));
	    if($count >0){
	        return true;
        }else{
	        return false;
        }
    }

    public function getXyList($uid){
	    $sql = "select od.* from db_order_detail od LEFT JOIN db_order o ON od.order_id = o.id and o.`status` <>3  where od.share_id in (select id from db_share where user_id = $uid)";
	    return $this->query($sql);
    }

    public function getTxList(){
	    $sql = "select od.* from db_order_detail od LEFT JOIN db_order o ON od.order_id = o.id WHERE od.tk_status = 0 and o.`status` = 3";
	    return $this->query($sql);
    }
}
?>