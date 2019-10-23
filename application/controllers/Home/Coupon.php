<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Coupon extends HomeController
{
    private $course_type_list = array();
    function __construct() {
        parent::__construct();
        $this->course_type_list = config_item("course_type");
        $this -> load -> model("Coupon_model");
        $this -> load -> model("Coupon_user_model");
        $this -> load -> model("Order_model");
        $this -> load -> model("Order_detail_model");
        $this -> load -> model("Course_model");
    }
    public function index() {
        $data = array();
        $conarr = array();
        $conarr['where'] = " user_id = {$_SESSION['app_home_session']['id']}";
        $data['hd_list'] =$this->Coupon_user_model->get_list_full($conarr);
        $data['course_list'] =$this->Course_model->getCourseOrderByCoupon($this->uid);
        $this -> load -> view('home/couponList',$data);
    }



}