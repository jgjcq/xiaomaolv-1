<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends AdminController {

	function __construct() { 
		parent::__construct();
        $this -> load -> model("Config_model");
        $this -> load -> model("Config_detail_model");
        $this -> sidebar = "Content-Config";
	}
	public function index(){
	    $this->load->view("admin/configList");
    }
    function getDatas($params = array(), $isExport = false) {
        $connar = array();
        if (!$isExport) {
            $params = $_POST;
            $connar = $this -> Config_model -> pickPages($connar, $params);
        }
        $connar['orderby'] = "id desc";
        $connar['where']="1=1";
        if (isset($params['param'])) {
            $connar['where'] .= $this->sqlLikeEscape(" and (title like '%??%' ",array($params['param']));
        }

        if (!$isExport) {
            $data = $this -> Config_model -> get_page_list($connar);
        } else {
            $data["ret"] = $this -> Config_model -> get_list_full($connar);
        }
        foreach ($data["ret"] as $k => $v) {
            $data['ret'][$k]['img_input']='<img src="'.$v['article_image'].'" style="width:100px; height:50px;">';
            $data['ret'][$k]['createdChar']=date('Y-m-d H:i:s',$v['created']);
        }

        $data["ret"]=array_values($data["ret"]);
        if (!$isExport) {
            echo json_encode($data);
        } else {
            return $data["ret"];
        }
    }

}