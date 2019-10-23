<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends HomeController
{
    private $course_type_list = array();

    function __construct()
    {
        parent::__construct();
        $this->course_type_list = config_item("course_type");
        $this->load->model("Course_model");
        $this->load->model("Order_model");
        $this->load->model("Order_detail_model");
        $this->load->model("CourseDetail_model");
        $this->load->model("User_course_detail_model");
        $this->load->model("Coupon_user_model");
        $this->load->model("Share_model");
        $this->load->model("Setting_model");
        $this->load->model("Royalty_model");
        $this->load->model("Salesman_model");
    }

    public function buy()
    {
        $id = $_POST['id'];
        $type = $_POST['type'];
        $fxId = isset($_POST['fx_id']) ? $_POST['fx_id'] : -1;
        $zf_price = $_POST['zf_price'];
        $coupon = $_POST['coupon'];
        $share_id = $_POST['share_id'];
        $order_id = $fxId;
        $order = array();
        if ($fxId == -1) {
            $course = $this->Course_model->get_single(array("id" => $id));
            if (!$course) {
                exit(retJson("课程不存在", false));
            }
            $order['course_id'] = $id;
            $order['course_title'] = $course['title'];
            $order['create_time'] = time();
            $order['order_type'] = $type;
            $order['price'] = $zf_price;
            $order['end_time'] = time() + 2 * 24 * 3600;
            $order['creater'] = $_SESSION['app_home_session']['id'];
            $order['total'] = 1;
//            if ($type == 0) {
//                $order['status'] = 4;//TODO 测试，默认成功
//            } else {
//                $order['status'] = 1;
//            }
            $order['status'] = 0;
            $order_id = $this->Order_model->add($order);
            $order['id'] = $order_id;
        } else {
            $order = $this->Order_model->get_single(array('id' => $fxId));
            if (!$order) {
                exit(retJson("分享课程不存在", false));
            }

        }
        if ($order['end_time'] < time()) {
            $order['status'] = 3;
            $this->Order_model->update($order);
            exit(retJson("团购已失败", false));
        }

        if ($order_id) {
            $orderDetail = array();
            $orderDetail['order_id'] = $order_id;
            $orderDetail['user_id'] = $_SESSION['app_home_session']['id'];
            $orderDetail['username'] = $_SESSION['app_home_session']['username'];
            $orderDetail['usercode'] = $_SESSION['app_home_session']['usercode'];
            $orderDetail['price'] = $order['price'];
            $orderDetail['course_id'] = $id;
            $orderDetail['order_number'] = $this->getOrderNumber();
            $orderDetail['status'] = 0;
            $orderDetail['share_id'] = $share_id;
            $orderDetail['create_time'] = time();
            $id = $this->Order_detail_model->add($orderDetail);
            $orderDetail['id'] = $id;
            $this->Order_detail_model->reflash();
            $this->setOrderCourse($order_id);
            if ($coupon > 0) {
                $this->Coupon_user_model->useCoupon($this->uid, $coupon, $id);
            }
            exit(retJson("购买成功", true,$orderDetail));
        } else {
            exit(retJson("购买错误", false));
        }
    }

    public function reBuy($id)
    {
        $order = $this->Order_model->get_single(array('id' => $id));
        if ($order == null || $order['status'] == 4 || $order['order_type'] == 0) {
            exit(retJson("服务器内部错误", false));
        }
        $order['status'] = 1;
        $order['end_time'] = time() + 2 * 24 * 3600;
        $this->Order_model->update($order);
        exit(retJson("重新拼团成功", true));

    }

    function setOrderCourse($orderId)
    {
        $order = $this->Order_model->get_single(array("id" => $orderId));
        $connar = array();
        $connar['where'] = "course_id = {$order['course_id']}";
        $course_detail_list = $this->CourseDetail_model->get_list_full($connar);
        if ($course_detail_list) {
            foreach ($course_detail_list as $item) {
                $user_detail = array();
                $user_detail['course_detail_id'] = $item['id'];
                $user_detail['now_time'] = 0;
                $user_detail['total_time'] = $item['times'];
                $user_detail['order_id'] = $orderId;
                $user_detail['course_id'] = $order['course_id'];
                $user_detail['user_id'] = $_SESSION['app_home_session']['id'];
                $this->User_course_detail_model->add($user_detail);
            }
        }
    }

    public function doTx($price,$tx_type){
        $salesman = $this->Salesman_model->get_single(array("user_id" => $this->uid));
        if($salesman){
            if($this->Royalty_model->isTx($salesman['id'])){
                exit(retJson("当前只能有一个提取订单！",false));
            }
            $tx_price= $this->Royalty_model->getPrice($salesman['id'], true);
            if($tx_price > $price){
                $royalty['salesman_id'] = $salesman['id'];
                $royalty['tc'] = -$price;
                $royalty['tc_price'] = -$price;
                $royalty['price'] = -$price;
                $royalty['type'] = "tx";
                $royalty['order_id'] = -1;
                $royalty['order_detail_id'] = -1;
                $royalty['share_id'] = -1;
                $royalty['in_out'] = 1;
                $royalty['order_number'] = 'TX'.$this->getOrderNumber();
                $royalty['create_time'] = time();
                $royalty['status'] = 0;
                $royalty['create_date'] = date("Y-m-d H:i:s");
                $this->Royalty_model->add($royalty);
                exit(retJson("提现成功，请等待管理员审核！",true));
            }else{
                exit(retJson("余额不足！",false));
            }
        }
        exit(retJson("服务器内部错误！",false));
    }
    public function refund($order_number){
        $order_detail = $this->Order_detail_model->get_single(array('order_number'=>$order_number));
        require_once 'AppServiceWxPayBlog.php';
        $config = array();
        $config['out_trade_no'] = $order_number;
        $config['out_refund_no'] = 'TK'.$this->getOrderNumber();;
        $config['total_fee'] = $order_detail['price'];
        $config['transaction_id'] = $order_detail['transaction_id'];
        $app = new AppServiceWxPay($config);
        $ret = $app->refound();
        echo $ret;
    }
    public function startPay($order_number){
        $flag = false;
        $msg = "";
        if(isset($order_number)&&$order_number){
            $order_detail = $this->Order_detail_model->get_single(array('order_number'=>$order_number));
            if($order_detail){
                require_once 'AppServiceWxPayBlog.php';
                $config = array();
                $config['openid'] = $_SESSION['app_home_session']['openid'];
                $config['out_trade_no'] = $order_number;
                $config['body'] = '购买订单'.$order_number.',价格'.$order_detail['price'];
                $config['total_fee'] = $order_detail['price'];
                $config['notify_url'] = 'http://zjyuxinjiaoyu.com/xiaomaolv/Home/order/notify';
                $app = new AppServiceWxPay($config);
                $ret = $app->pay();
                $data['jsApiParameters'] = json_encode($ret);
                $data['order_number'] = $order_number;
                $this -> load -> view('home/startPay',$data);
            }
        }
    }

    public function notify(){
        log_info(var_export($_POST));
    }

    public function deleteOrder($order_number){
        $order_detail = $this->Order_detail_model->get_single(array('order_number'=>$order_number));
        if($order_detail){
            $order = $this->Order_model->get_single(array('id' => $order_detail['id']));
            if($order['order_type'] == 0){
                $this->Order_model->delete($order['id']);
            }
            $this->Order_detail_model->delete($order_detail['id']);
        }
        echo 1;
    }

    public function queryResult($order_number){
        require_once 'AppServiceWxPayBlog.php';
        $config = array();
        $config['out_trade_no'] = $order_number;
        $app = new AppServiceWxPay($config);
        $ret = $app->query();
        if($ret['return_code'] == 'SUCCESS'&&$ret['result_code'] == 'SUCCESS'&&$ret['trade_state'] == 'SUCCESS'){
            $order_detail = $this->Order_detail_model->get_single(array('order_number'=>$order_number));
            $order_detail['status'] = 1;
            $order_detail['transaction_id'] = $ret['transaction_id'];
            $this->Order_detail_model->update($order_detail);
            $this->Order_detail_model->reflash();
            $order =  $this->Order_model->get_single(array('id' => $order_detail['id']));
            if($order['status'] == 4 && $order_detail['share_id'] > 0){
                $orderDetailList = $this->Order_detail_model->get_list(array('order_id'=>$order['id'],'status'=>1));
                if($orderDetailList && count($orderDetailList)>0){
                    foreach ($orderDetailList as $od){
                        $this->cal($od);
                    }
                }
            }
            if($order['status'] == 3){

            }
        }
        echo json_encode($ret);
    }

    private function cal($order_detail)
    {
        $order_detail_id = $order_detail['id'];
        if ($order_detail) {
            $share = $this->Share_model->get_single(array('id' => $order_detail['share_id']));
            $royalty = array();
            $royalty['order_id'] = $order_detail['order_id'];
            $royalty['order_detail_id'] = $order_detail_id;
            $royalty['share_id'] = $share['id'];
            $royalty['price'] = $order_detail['price'];
            $royalty['create_time'] = time();
            $royalty['order_number'] = $order_detail['order_number'];
            $royalty['create_date'] = date("Y-m-d H:i:s");
            if ($share&&$share['user_id']) {
                $lmm = $this->Salesman_model->getByUserId($share['user_id']);
                if ($lmm) {
                    //城市合伙人
                    if ($lmm['is_city'] == 1) {
                        $this->getRoyalty($royalty, $lmm, "hhr_tr");

                    }elseif($lmm['is_gs'] == 1){
                        $city_hhr = $this->Salesman_model->getCityUser($lmm['city']);
                        $this->getRoyalty($royalty, $city_hhr, "yj_hhr_tc");
                    } else {
                        if ($lmm['pid'] == 0) {
                            //一级驴妈妈提成
                            $this->getRoyalty($royalty, $lmm, "yj_lmm_tc");

                            //一级驴妈妈城市合伙人提成
                            $city_hhr = $this->Salesman_model->getCityUser($lmm['city']);
                            $this->getRoyalty($royalty, $city_hhr, "yj_hhr_tc");
                        } else {
                            //二级驴妈妈提成
                            $this->getRoyalty($royalty, $lmm, "ej_lmm_tc");

                            //上级驴妈妈提成
                            $sj_lmm = $this->Salesman_model->get_single(array('id' => $lmm['pid']));
                            $this->getRoyalty($royalty, $sj_lmm, "sj_lmm_tc");

                            //城市合伙人
                            $city_hhr = $this->Salesman_model->getCityUser($sj_lmm['city']);
                            $this->getRoyalty($royalty, $city_hhr, "ej_hhr_tc");


                            if ($sj_lmm['city'] != $lmm['city']) {
                                //非同区域
                                $city_hhr = $this->Salesman_model->getCityUser($lmm['city']);
                                $this->getRoyalty($royalty, $city_hhr, "ej_tqy_tc");
                            }


                        }

                    }
                }
            }
        }
    }

    private function getRoyalty($royalty, $salesman, $code)
    {
        $salesman_id = $salesman != null?$salesman['id']:-1;
        $tc = $this->Setting_model->getByKeyCode($code);
        $royalty['salesman_id'] = $salesman_id;
        $royalty['tc'] = $tc['value'];
        $royalty['tc_price'] = $royalty['price'] * $royalty['tc'] / 100;
        $royalty['type'] = $code;
        $this->Royalty_model->add($royalty);
    }
    private function getOrderNumber(){
        $str = date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        return $str;
    }
}
