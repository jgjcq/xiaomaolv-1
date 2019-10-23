<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DDLController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }


    //下拉框获取select表 select选择框 下拉数据
    public function getSelectType($type)
    {
        $this->load->model('Select_model');
        $datas = $this->Select_model->get_list(array("sel_type" => $type));
        exit(retJson("", true, $datas));
//        select * from  db_select where sel_type = $type
//        select * from db_address where belong = 0;
    }

    public function getSelectCustomerType($sel_type,$pid)
    {
        $this->load->model('Select_model');
        $datas = $this->Select_model->get_list(array("sel_type" => $sel_type,"pid"=>$pid));
        exit(retJson("", true, $datas));
    }

    //带全部
    public function getSelectCustomerTypeAndAll($sel_type,$pid)
    {
        $this->load->model('Select_model');
        $datas = $this->Select_model->get_list(array("sel_type" => $sel_type,"pid"=>$pid));
        array_unshift($datas, array('id'=>-1,'sel_type'=>0,'caption'=>'全部','sel_level'=>0,'pid'=>0,'status'=>0));
        exit(retJson("", true, $datas));
    }


    //下拉框获取address表  地址下拉数据
    public function getAddressBelong($belong)
    {
        $this->load->model('Address_model');
        $datas = $this->Address_model->get_list(array("belong" => $belong));
        exit(retJson("", true, $datas));

    }
    //带全部
    public function getAddressBelongAndAll($belong)
    {
        $this->load->model('Address_model');
        $datas = $this->Address_model->get_list(array("belong" => $belong));
        array_unshift($datas, array('id'=>0,'city_id'=>-1,'city'=>'全部','belong'=>$belong,'develop_status'=>0,'longitude'=>0,'latitude'=>0));
        exit(retJson("", true, $datas));

    }

    //1.客户联系人：所属客户   2.订单管理：所属客户 3.费用管理：所属客户
    public function getCustomer(){
        $this->load->model('Customer_model');
        $datas = $this->Customer_model->get_list(array('status'=>CommonStatus::UnDeleted[XPHEnum::Value]));
        exit(retJson("", true, $datas));
    }

    //订单管理：所属样品  所属业务员
    public function getSample(){
        $this ->load->model('Sample_model');
        $datas=$this->Sample_model->get_list(array('status'=>CommonStatus::UnDeleted[XPHEnum::Value]));
        exit(retJson("",true,$datas));
    }

    //客户管理：跟进人； 订单管理：所属业务员
    public function getAdmin($type){
        $this ->load->model('Admin_model');
        $datas=$this->Admin_model->get_list(array("role_id"=>$type));
        exit(retJson("",true,$datas));
    }
	
	
	function getPidListByLevel(){
		$this->load->model('Module_model');
		$module = $this -> Module_model -> get_list(array("level" => $_POST['level']-1));
		exit(retJson("模块数据.", true,$module));
	}





}