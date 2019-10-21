<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends AdminController {

	function __construct() { 
		parent::__construct();
        $this -> load -> model("Area_model");
	}


    function getAreaByPid($pid){
        $area_list = $this->Area_model->getByParentId($pid);
        echo json_encode($area_list);
    }
}