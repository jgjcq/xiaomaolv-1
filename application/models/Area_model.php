<?php
include_once "BaseModel.php";

class Area_model extends BaseModel {
	function __construct() {
		parent::__construct();
		$this -> table = 'area';
	}

	public function getByParentId($parentId){
        $connar = array();
        $connar['where']="parentId = $parentId";
        return $this->get_list_full($connar);
    }
    public function getByParentCode($code){
	    $area = $this->get_single(array("areaCode"=>$code));
        $connar = array();
        $connar['where']="parentId = {$area['id']}";
        return $this->get_list_full($connar);
    }

    public function getIdByCode($code){
        $area = $this->get_single(array("areaCode"=>$code));
        return $area['areaId'];
    }
}
?>