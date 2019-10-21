<?php
include_once "BaseModel.php";

class Share_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'share';
	}

	public function getShare($course_id,$uid){
	    $sql = "select * from db_share where course_id = $course_id and user_id = $uid limit 0,1";
	    $info = $this->single($sql);
	    if($info){
	        return get_object_vars($info);
        }
	    return null;
    }

}
?>