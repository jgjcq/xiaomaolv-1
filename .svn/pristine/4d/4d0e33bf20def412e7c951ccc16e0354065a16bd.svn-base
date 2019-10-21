<?php
include_once "BaseModel.php";

class Setting_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'setting';
	}

    public function getByCode($code){
	    $list = $this->get_list(array('code'=>$code),"setting_id asc");
	    return $list;
    }

    public function updateSetting($id,$value,$code = 'salesman'){
	    $sql = "update db_setting set value='$value' where setting_id = $id and code = '$code'";
	    $this->execute($sql);
    }

    public function getByKeyCode($key,$code = 'salesman'){
        $list = $this->get_single(array('code'=>$code,'key'=>$key));
        return $list;
    }
}
?>