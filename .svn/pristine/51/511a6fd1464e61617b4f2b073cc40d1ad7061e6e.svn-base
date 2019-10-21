<?php
include_once "BaseModel.php";

class Coupon_user_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'coupon_user';
	}

	function getMaxPrice($uid){
	    $sql = "select sum(coupon_price) as total from db_coupon_user  where user_id = $uid GROUP BY user_id limit 0,1";
	    $info =  $this->single($sql);
	    return $info->total;
    }

    function getCoupon($type,$uid){
	    $sql = "select * from db_coupon where type = $type and status = 1 limit 0,1";
        $coupon = $this->single($sql);
        if($coupon){
            $coupon_user = array();
            $coupon_user['coupon_id'] = $coupon->id;
            $coupon_user['coupon_name'] = $coupon->title;
            $coupon_user['coupon_price'] = $coupon->zk;
            $coupon_user['create_time'] = date("Y-m-d H:i:s");
            $coupon_user['remark'] = $coupon->remark;
            $coupon_user['user_id'] = $uid;
            $this->add($coupon_user);

        }
    }

    function useCoupon($uid,$price,$id){
        $coupon_user = array();
        $coupon_user['coupon_id'] = $id;
        $coupon_user['coupon_name'] = "消费";
        $coupon_user['coupon_price'] = 0-$price;
        $coupon_user['create_time'] = date("Y-m-d H:i:s");
        $coupon_user['remark'] = "购买课程花费：￥-$price";
        $coupon_user['user_id'] = $uid;
        $coupon_user['type'] = 1;
        $this->add($coupon_user);
    }
	
}
?>