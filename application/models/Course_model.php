<?php
include_once "BaseModel.php";

class Course_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'course';
	}

	public function getCourseBuyed($id){
	    $sql = "select od.*,u.id as uid,u.* from db_order_detail od LEFT JOIN db_order o ON od.order_id = o.id LEFT JOIN db_user u ON u.id = od.user_id WHERE  o.course_id = $id";
	    $list = $this->query($sql);
	    return $list;
    }
    public function getCourseBuyedByOrderId($id,$order_id){
        $sql = "select od.*,u.id as uid,u.* from db_order_detail od LEFT JOIN db_order o ON od.order_id = o.id LEFT JOIN db_user u ON u.id = od.user_id WHERE  o.course_id = $id and o.id = $order_id";
        $list = $this->query($sql);
        return $list;
    }

    public function getCourseOrderByCoupon($uid){
	    $sql ="select * from db_course where max_coupon >0 and status = 1 and id not in (select od.course_id from db_order_detail od LEFT JOIN db_order o ON od.order_id = o.id where o.status <> 3 and od.user_id = $uid) order by max_coupon desc";
        return $this->query($sql);
	}
	
}
?>