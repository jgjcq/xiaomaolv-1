<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class MyCourse extends HomeController
{
    function __construct() {
        parent::__construct();
        $this -> load -> model("Course_model");
        $this -> load -> model("CourseDetail_model");
        $this -> load -> model("User_course_detail_model");
        $this -> load -> model("Order_model");
        $this -> load -> model("Order_detail_model");
        $this -> load -> model("Share_model");
        $this -> load -> model("Share_model");
        $this -> load -> model("Coupon_model");
        $this -> load -> model("Coupon_user_model");
    }

    public function index() {
        $sql = "select c.* from db_order_detail od LEFT JOIN db_order o ON o.id = od.order_id  LEFT JOIN db_course c ON od.course_id = c.id WHERE od.user_id = {$this->uid} and o.status = 4 ORDER BY od.create_time desc;";
        $course_list  = $this->Course_model->query($sql);

        for($i =0 ;$i<sizeof($course_list);$i++){
            $sql1 = "SELECT * from db_course_detail cd LEFT JOIN db_user_course_detail ucd ON cd.id = ucd.course_detail_id AND ucd.user_id = {$this->uid} WHERE cd.course_id = {$course_list[$i]['id']}";
            $course_detail_list = $this->CourseDetail_model->query($sql1);
            $total = 0;
            $now = 0;
            foreach($course_detail_list as $d){
                $total += $d['total_time'];
                $now += $d['now_time'];
            }
            $over = 0;
            if($total >0){
                $over = $now/$total;
            }
            $course_list[$i]["over"] = round($over * 100);
        }

        $data["course_list"] = $course_list;
        $this -> load -> view('home/myCourse',$data);
    }

    public function detail($id) {
        $course = $this->Course_model->get_single(array("id"=>$id));
        $order_sql = "select o.*,od.id as did from db_order_detail od LEFT JOIN db_order o ON o.id = od.order_id where od.user_id = {$this->uid} and od.course_id = $id limit 0, 1";
        $order = $this->Course_model->single($order_sql);
        if($order->status == 4){
            $connar = array();
            $connar['where']="course_id = $id";

            $sql = "SELECT * from db_course_detail cd LEFT JOIN db_user_course_detail ucd ON cd.id = ucd.course_detail_id AND ucd.user_id = {$this->uid} WHERE cd.course_id = $id";

            $course_detail_list = $this->CourseDetail_model->query($sql);

            $data = array();
            $data['detail'] = $course;
            $data['detail_list'] = $course_detail_list;
            if($course["type"] == 1){
                $this -> load -> view('home/myCourseDetail',$data);
            }else{
                $this -> load -> view('home/myCourseDetail1',$data);
            }
        }else{
            redirect("Home/my/myGroupDetail/".$order->did);
        }


    }


    public function setHit($id,$now){
        $course_detail = $this->User_course_detail_model->get_single(array("id"=>$id,"user_id"=>$this->uid));
        if($course_detail['is_over'] != 1 && $now > $course_detail['now_time']){
            if($now < $course_detail["total_time"]&& $now != -1){
                $course_detail['now_time'] = $now;
                $this->User_course_detail_model->update($course_detail);
            }else{
                $course_detail['now_time'] = $course_detail['total_time'];
                $course_detail['is_over'] = 1;
                $this->User_course_detail_model->update($course_detail);
            }
        }

    }

    public function fxGetCoupon($course_id){
        $share = $this->Share_model->getShare($course_id,$this->uid);
        $course = $this->Course_model->get_single(array('id'=>$course_id));
        if(!$share && $course['fx_price'] > 0&&$this->uid>0){
            $share = array();
            $share['user_id'] = $this->uid;
            $share['course_id'] = $course_id;
            $share['count'] = 0;
            $share['create_time'] = time();
            $share['id'] = $this->Share_model->add($share);

            $coupon_user = array();
            $coupon_user['coupon_id'] = $course_id;
            $coupon_user['coupon_name'] = "分享课程<<".$course['title'].">>";
            $coupon_user['coupon_price'] = $course['fx_price'];
            $coupon_user['create_time'] = date("Y-m-d H:i:s");
            $coupon_user['remark'] = "分享课程<<".$course['title'].">>，获得代金卷￥".$course['fx_price'];
            $coupon_user['user_id'] = $this->uid;
            $this->Coupon_user_model->add($coupon_user);
            exit(retJson("首次分享,获得代金卷￥".$course['fx_price'],true));
        }
        exit(retJson("非首次分享",false));
    }

}