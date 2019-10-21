<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class My extends HomeController
{
    private $course_type_list = array();
    private $signPackage = array();
    function __construct()
    {
        parent::__construct();
        $this->course_type_list = config_item("course_type");
        $this->load->model("Course_model");
        $this->load->model("CourseDetail_model");
        $this->load->model("Order_detail_model");
        $this->load->model("Order_model");
        $this->load->model("Salesman_model");
        $this->load->model("Article_model");
        $this->load->model("Salesman_type_model");
        $this->load->model("Area_model");
        $this->load->model("Royalty_model");
        $this->load->model("User_model");
        $this->load->model("Coupon_user_model");
        $this->load->model("Share_detail_model");
        require_once 'jssdk.php';
        $jssdk = new JSSDK($this->wx_config['appid'],$this->wx_config['appsecret']);
        $this->signPackage = $jssdk->getSignPackage();
    }

    public function index()
    {
        $data["detail"] = $this->uid;
        $data['info'] = $this->Article_model->get_single(array('id' => 7));
        $data['max_coupon'] = $this->Coupon_user_model->getMaxPrice($this->uid);
        $this->load->view('home/my', $data);
    }

    public function myGroup()
    {
        $this->Order_detail_model->reflash();
        $data['course_all'] = $this->Order_detail_model->getByStatus(-1, $this->uid);
        $data['course_ing'] = $this->Order_detail_model->getByStatus(1, $this->uid);
        $data['course_fail'] = $this->Order_detail_model->getByStatus(3, $this->uid);
        $data['course_success'] = $this->Order_detail_model->getByStatus(4, $this->uid);
        $this->load->view('home/myGroup', $data);
    }

    public function myGroupDetail($id)
    {

        $order_detail = $this->Order_detail_model->get_single(array("id" => $id));
        $data['order_detail'] = $order_detail;
        if ($order_detail) {
            $order = $this->Order_model->get_single(array("id" => $order_detail['order_id']));
            $data['order'] = $order;
            $data['course'] = $this->Course_model->get_single(array("id" => $order['course_id']));
            if($data['course']['zs_video_big']){
                $zs_video_big = $this -> CourseDetail_model ->get_single(array('id'=>$data['course']['zs_video_big']));
                $data['zs_video_big'] = $zs_video_big;
            }
        }
        $buyList = $this->Course_model->getCourseBuyedByOrderId($order_detail['course_id'], $order_detail['order_id']);
        $data['buyList'] = $buyList;
        $data['id'] = $id;
        $data['signPackage'] = $this->signPackage;
        $this->load->view('home/myGroupDetail', $data);
    }


    public function kdb($fx_id = 0)
    {
        $type_list = $this->Salesman_type_model->getAll();
        $data['type_list'] = $type_list;
        $salesman = $this->Salesman_model->get_single(array("user_id" => $this->uid));
        if ($salesman && $salesman['is_check'] == 1) {
            $data['all_price'] = $this->Royalty_model->getPrice($salesman['id'], true);
            $data['kt_price'] = $this->Royalty_model->getPrice($salesman['id']);
            $data['info'] = $this->Article_model->get_single(array('id' => 5));
            $xylist = $this->Order_detail_model->getXyList($this->uid);
            $data['xycount'] = count($xylist);
            if($salesman['ad_image']){
                $data['ad_image'] = $salesman['ad_image'];
            }else{
                $data['ad_image'] = "cust/images/zu13.png";
            }
            $this->load->view('home/kdb1', $data);
        } elseif ($salesman && $salesman['is_check'] == 0) {
            $this->load->view('home/regOk', $data);
        } else {
            $data['fx_id'] = $fx_id;
            $this->load->view('home/kdb', $data);
        }

    }

    public function reg()
    {
        $fx_id = $_POST['fx_id'];
        $salesman = copyArray($_POST, array("nickname", "phone", "address", "type", "province", "city", "area"));
        $count = $this->Salesman_model->get_count(array("user_id" => $this->uid));
        if ($count) {
            exit(retJson("该会员已存在.", false));
        }
        $salesman['user_id'] = $this->uid;
        $salesman['reg_time'] = date("Y-m-d H:i:s");
        if ($salesman['province']) {
            $salesman['province'] = $this->Area_model->getIdByCode($salesman['province']);
        }
        if ($salesman['city']) {
            $salesman['city'] = $this->Area_model->getIdByCode($salesman['city']);
        }
        if ($salesman['area']) {
            $salesman['area'] = $this->Area_model->getIdByCode($salesman['area']);
        }
        if($fx_id >0){
            $salesman['pid'] = $fx_id;
        }
        $id = $this->Salesman_model->add($salesman);
        exit(retJson("添加成功.", true));
    }

    public function kdb1()
    {
        $data['info'] = $this->Article_model->get_single(array('id' => 5));
        $this->load->view('home/kdb1', $data);
    }

    public function regOk()
    {
        $this->load->view('home/regOk');
    }

    public function about()
    {
        $data['info'] = $this->Article_mode->get_single(array('id' => 9));
        $this->load->view('home/about', $data);
    }

    public function mySalesmans()
    {
        $my = $this->Salesman_model->getByUserId($this->uid);
        $sub_list = $this->Salesman_model->getByPid($my['id']);
        $data['sub_list'] = $sub_list;
        $this->load->view('home/mySalesmans', $data);
    }

    public function myVisit()
    {
        $list = $this->Share_detail_model->getListByUid($this->uid);
        $data['list'] = $list;
        $this->load->view('home/myVists', $data);
    }

    public function xyOrders(){
        $data = array();
        $salesman = $this->Salesman_model->get_single(array("user_id" => $this->uid));
        if ($salesman && $salesman['is_check'] == 1) {
            $xylist = $this->Order_detail_model->getXyList($this->uid);
            if($xylist){
                foreach ($xylist as $k=>$xy){
                    $course = $this->Course_model->get_single(array('id'=>$xy['course_id']));
                    $xylist[$k]['course'] = $course;
                }
            }
            $data['xylist'] = $xylist;
            $this->load->view('home/xyOrders', $data);
        } elseif ($salesman && $salesman['is_check'] == 0) {
            $this->load->view('home/regOk', $data);
        } else {
            $this->load->view('home/kdb', $data);
        }
    }
    public function jxjList(){
        $salesman = $this->Salesman_model->get_single(array("user_id" => $this->uid));
        $total_price = $this->Royalty_model->getPrice($salesman['id']);
        $list = $this->Royalty_model->get_list(array('salesman_id'=>$salesman['id'],'in_out'=>0));
        $data['total_price'] = $total_price;
        $data['list'] = $list;
        $this->load->view('home/jxjList', $data);
    }
    public function tx(){
        $salesman = $this->Salesman_model->get_single(array("user_id" => $this->uid));
        $data['kt_price'] = $this->Royalty_model->getPrice($salesman['id']);
        $list = $this->Royalty_model->get_list(array('salesman_id'=>$salesman['id'],'in_out' => 1));
        $data['list'] = $list;
        $user = $_SESSION['app_home_session'];
        $data['user'] = $user;
        $data['tx'] = false;
        if($user['phone']&&$user['bank']&&$user['bank_code']&&$user['real_name']&&$user['alipay']){
            $data['tx'] = true;
        }
        $this->load->view('home/tx',$data);
    }

    public function info(){
        $data['info'] = $_SESSION['app_home_session'];
        $this->load->view('home/info',$data);
    }

    public function updateInfo(){
        $info = copyArray($_POST,array("username","phone","birthday","bank","bank_code","real_name","alipay"));
        $info['id']= $this->uid;
        $this->User_model->update($info);
        $newUser = $this->User_model->get_single(array('id'=>$this->uid));
        $_SESSION['app_home_session'] = $newUser;
        exit(retJson("修改成功",true));
    }

    public function tg(){
        $salesman = $this->Salesman_model->get_single(array("user_id" => $this->uid));
        $data['signPackage'] = $this->signPackage;
        $data['fx_id'] = $salesman['id'];
        if($salesman['ad_image']){
            $data['ad_image'] = $salesman['ad_image'];
        }else{
            $data['ad_image'] = "cust/images/zu13.png";
        }
        $this->load->view('home/tg',$data);
    }

}