<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends HomeController
{
    function __construct() {
        parent::__construct();
        $this -> load -> model("Banner_model");
        $this->load->model("Course_model");
        $this->load->library('Wechat/wechat_receive', $this->wx_config);
    }

    public function index() {
        $data = array();
        $connar = array();
        $connar['where'] = "status = 1";
        $connar['orderby'] = "id desc";
        $connar['pageSize'] = 15;
        $connar['pageNo'] = 1;
        if($this->buyedCourseList){
          //  $connar['where'] .= $this->sqlLikeEscape(" and (id not in (??)) ",array($this->buyedCourseListStr));
        }
        $data['banner_list'] = $this->Banner_model->get_list(array(),'sort asc');

        $hot_connar = $connar;
        $hot_connar['where'] .=" and ishot = 1";
        $data['hot_course_list'] = $this->Course_model->get_page_list($hot_connar)['ret'];

        $jt_connar = $connar;
        $jt_connar['where'] .=" and isjt = 1";
        $data['jt_course_list'] = $this->Course_model->get_page_list($jt_connar)['ret'];

        $data['course_type_list'] = config_item("course_type");
        $this -> load -> view('home/index',$data);
    }


}