<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends HomeController
{
    function __construct() {
        parent::__construct(true);
        $this->load->model("User_model");
        $this->load->model("Coupon_user_model");
        $this->load->library('Wechat/wechat_oauth', $this->wx_config);
    }

    public function index($code='') {
         $state = $_GET['state'];
         if($state){
             $reUrl = urldecode($state);
         }else{
             $reUrl = site_url("Home/index");
         }

            $token = $this->wechat_oauth->getOauthAccessToken();
            if($token){
                $access_token = $token['access_token'];
                $openid = $token['openid'];
                $refresh_token = $token['refresh_token'];
                $info = $this->wechat_oauth->getOauthUserinfo($access_token,$openid);
                $user = $this->User_model->get_single(array('openid'=>$openid));
                if(!$user){
                    $user = array();
                    $user['usercode'] = $info['nickname'];
                    $user['username'] = $info['nickname'];
                    $user['gender'] = $info['gender'];
                    $user['head_img'] = $info['headimgurl'];
                    $user['openid'] = $info['openid'];
                    $user['created'] = time();
                    $user['id'] = $this->User_model->add($user);
                    $this->Coupon_user_model->getCoupon(0,$user['id']);
                }
                $_SESSION['app_home_session'] = $user;
                redirect($reUrl);
            }
            echo '无法访问';
    }
    public function doLogin($uid){
        $user = $this->User_model->get_single(array('id'=>$uid));
        if($user){
            $_SESSION['app_home_session'] = $user;
            echo "1";
        }else{
            echo 0;
        }
    }

    public function out(){
        session_destroy();
        redirect(site_url('home/Login'));
    }
}