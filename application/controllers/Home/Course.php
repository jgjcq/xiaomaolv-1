<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Course extends HomeController
{
    private $course_type_list = array();
    private $signPackage = array();
    function __construct() {
        parent::__construct();
        $this->course_type_list = config_item("course_type");
        $this -> load -> model("Course_model");
        $this -> load -> model("CourseDetail_model");
        $this -> load -> model("Coupon_user_model");
        $this -> load -> model("Order_model");
        $this -> load -> model("Order_detail_model");
        $this -> load -> model("Share_model");
        $this -> load -> model("Share_detail_model");
        require_once 'jssdk.php';
        $jssdk = new JSSDK($this->wx_config['appid'],$this->wx_config['appsecret']);
        $this->signPackage = $jssdk->getSignPackage();
    }
    public function index($keyword = '') {
        $data = array();
        if($keyword)
        $data["keyword"] = $keyword;
        $this -> load -> view('home/courseList',$data);
    }

    public function searchCourse($keyword) {
        $keyword =  urldecode($keyword);
        $data = array();
        if($keyword){
            $data = $this->Course_model->get_list(array(),'id desc'," title like '%$keyword%' and status = 1");
        }
        echo json_encode($data);
    }

    public function getTypeListDatas($course_type,$ishot,$page) {
        $data = array();
        $connar = array();
        $connar['orderby'] = "id desc";
        $connar['pageSize'] = 5;
        $connar['pageNo'] = $page;
        $connar['where']="1=1";
        if($course_type){
            $connar['where'] .=" and course_type = $course_type";
        }
        if($ishot){
            $connar['where'] .=" and ishot = $ishot";
        }
        $data = $this->Course_model->get_page_list($connar);
        echo json_encode($data);
    }

    public function typeList($course_type) {
        $data = array();
        $data["course_list"] = $this->Course_model->get_list(array(),'id desc'," course_type = $course_type and status = 1");
        $data['title'] = $this->course_type_list[$course_type];
        $data['course_type'] = $course_type;
        $this -> load -> view('home/courseTypeList',$data);
    }


    public function buy($id,$uid = 0){

        require_once 'AppServiceWxPayBlog.php';
        $config = array();
        $config['openid'] = $_SESSION['app_home_session']['openid'];
        $config['out_trade_no'] = '123456';
        $config['body'] = 'aabbccssdd123';
        $config['total_fee'] = '100';
        $config['notify_url'] = 'http://zjyuxinjiaoyu.com/xiaomaolv/Home/order/notify';
        //$app = new AppServiceWxPay($config);
        //$ret = $app->pay();

        $course = $this->Course_model->get_single(array("id" => $id));
        if($course['zs_video_big']){
            $zs_video_big = $this -> CourseDetail_model ->get_single(array('id'=>$course['zs_video_big']));
            $data['zs_video_big'] = $zs_video_big;
        }

        $data['detail'] = $course;
        $data['title'] = "购买课程";
        $coupon_price= $this->Coupon_user_model->getMaxPrice($this->uid);
        if($coupon_price){
            $data['coupon_price'] = $coupon_price;
        }else{
            $data['coupon_price'] = 0;
        }
        $conarr = array();
        $conarr['where'] = " course_id = $id and user_id = {$this->uid}";
        $order_detail = $this->Order_detail_model->get_single_full($conarr);

        $data['isBuy'] = $order_detail?true:false;
        $data['order_detail'] = $order_detail;
        $buyList = $this->Course_model->getCourseBuyed($id);
        $data['buyList'] = $buyList;
        $order = array();
        $order['id'] = -1;
        $data['order'] = $order;
        $data['is_fx'] = false;
        $data['fx_id'] = -1;
        $tagsStr = $course['tags'];
        $tags = explode("|",$tagsStr);
        $data['tags_list'] = $tags;

        $share = $this->Share_model->getShare($id,$uid);
        if(!$share){
            $share = array();
            $share['user_id'] = $uid;
            $share['course_id'] = $id;
            $share['count'] = 0;
            $share['create_time'] = time();
            //$share['order_id'] = $id;
            $share['id'] = $this->Share_model->add($share);

        }

        if(!$this->Share_detail_model->isVist($share['id'],$this->uid)){
            $share_detail = array();
            $share_detail['share_id'] = $share['id'];
            $share_detail['vist_id'] = $this->uid;
            $share_detail['create_time'] = time();
            $this->Share_detail_model->add($share_detail);
            $share['count'] +=1;
            $this->Share_model->update($share);
        }
        $data['share_id'] = $share['id'];
        $data['signPackage'] = $this->signPackage;
        $this -> load -> view('home/courseBuy',$data);
    }
    public function fx($id,$uid){
        $order_detail = $this->Order_detail_model->get_single(array('id'=>$id));
        $order = $this->Order_model->get_single(array("id" => $order_detail['order_id']));
        $data['title'] = "购买课程";
        $data['coupon'] = $this->Coupon_user_model->getMaxPrice($this->uid);
        $course = $this->Course_model->get_single(array("id" => $order['course_id']));
        if($course['zs_video_big']){
            $zs_video_big = $this -> CourseDetail_model ->get_single(array('id'=>$course['zs_video_big']));
            $data['zs_video_big'] = $zs_video_big;
        }

        $data['detail'] = $course;
        $buyList = $this->Course_model->getCourseBuyed($id);
        $data['buyList'] = $buyList;
        $data['order'] = $order;
        $data['fx_id'] = $order['id'];
        $data['isBuy'] = $this->Order_detail_model->isBuy($order['id'],$this->uid);
        $data['order_detail'] = $order_detail;

        $tagsStr = $course['tags'];
        $tags = explode("|",trim($tagsStr));
        $data['tags_list'] = $tags;
        $coupon= $this->Coupon_user_model->getMaxPrice($this->uid);
        if($coupon){
            $data['coupon_price'] = $coupon;
        }else{
            $data['coupon_price'] = 0;
        }
        $data['is_fx'] = true;
        $share = $this->Share_model->getShare( $order['course_id'],$uid);
        if(!$share){
            $share = array();
            $share['user_id'] = $uid;
            $share['course_id'] = $order['course_id'];
            $share['count'] = 0;
            $share['create_time'] = time();
            $share['order_id'] = $id;
            $share['id'] = $this->Share_model->add($share);

        }

        if(!$this->Share_detail_model->isVist($share['id'],$this->uid)){
            $share_detail = array();
            $share_detail['share_id'] = $share['id'];
            $share_detail['vist_id'] = $this->uid;
            $share_detail['create_time'] = time();
            $this->Share_detail_model->add($share_detail);
            $share['count'] +=1;
            $this->Share_model->update($share);
        }
        $data['share_id'] = $share['id'];
        $data['signPackage'] = $this->signPackage;
        $this -> load -> view('home/courseBuy',$data);
    }

}