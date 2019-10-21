<?php
include_once "BaseModel.php";

class Salesman_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'salesman';
	}

	public function getListUnMe($id){
        $sql = "select * from db_salesman where is_check =1 ";
	    if($id >0){
	        $sql .= " and id <> $id";
        }
	    return $this->query($sql);
    }

    public function getCityUser($city){
        $sql = "select * from db_salesman where is_city = 1 and city = $city";
         $ret = $this->query($sql);
         if($ret && count($ret)>0){
             return true;
         }
         return false;
	}
	public function getByPid($pid){
	    $sql = "select s.*,u.head_img,(select count(*) from db_order_detail od LEFT JOIN db_order o ON od.order_id = o.id and o.`status` <>3  where od.share_id = (select id from db_share where user_id = u.id)) as count from db_salesman s left join  db_user u ON s.user_id = u.id where s.is_check= 1 and s.pid= $pid";
	    return $this->query($sql);
    }

    public function getByUserId($uid){
        $sql = "select * from db_salesman where user_id= $uid";
        return get_object_vars($this->single($sql));
    }
}
?>