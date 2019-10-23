<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon extends AdminController
{
    private $coupon_type = array();
    private $coupon_zk_type = array();
    function __construct() {
        parent::__construct();
        $this -> load -> model("Coupon_model");
        $this -> sidebar = "Coupon";
        $this->coupon_type = config_item("coupon_type");
        $this->coupon_zk_type = config_item("coupon_zk_type");
    }

    public function Index() {
        $this -> load -> view('admin/couponList');
    }

    function getDatas($params = array(), $isExport = false) {
        $connar = array();
        if (!$isExport) {
            $params = $_POST;
            $connar = $this -> Coupon_model -> pickPages($connar, $params);
        }
        $connar['orderby'] = "create_time desc";
        $connar['where']="1=1";
        if (isset($params['param'])) {
            $connar['where'] .= $this->sqlLikeEscape(" and (title like '%??%' ",array($params['param']));
        }
        if(isset($params['status']))
        {
            if($params['status']<2)
            {
                $connar['where'] .= $this->sqlLikeEscape(" and status=?? ",array($params['status']));
            }
        }
        else{
            $connar['where'] .=" and status=1";
        }
        if (!$isExport) {
            $data = $this -> Coupon_model -> get_page_list($connar);
        } else {
            $data["ret"] = $this -> Coupon_model -> get_list_full($connar);
        }
        foreach ($data["ret"] as $k => $v) {
            $data['ret'][$k]['type_str']=$this->coupon_type[$v['type']];
        }

        $data["ret"]=array_values($data["ret"]);
        if (!$isExport) {
            echo json_encode($data);
        } else {
            return $data["ret"];
        }
    }

    //新增，修改
    function edit($id){
        if($id == 0){
            $data['title'] = "新增优惠卷";
            $data['detail'] = $this -> Coupon_model -> get_single(array("id" => $id));
        }else{
            $data['title'] = "查看/编辑优惠卷";
            $data['detail'] = $this -> Coupon_model -> get_single(array("id" => $id));

            $connar = array();
            $connar['where']="Coupon_id = $id";
        }
        $data["coupon_type"] = $this->coupon_type;
        $data["coupon_zk_type"] = $this->coupon_zk_type;
        $this -> load -> view('admin/couponEdit',$data);
    }



    function save(){
        $count = $this -> Coupon_model -> get_count(array("type"=>$_POST['type']));
        $goods = array();
        $userId = $_SESSION[SESS_USER]["id"];
        if(!isset($_POST['id']) || $_POST['id'] == ""){
            $goods = copyArray($_POST,array("title","type","zk","remark"));
        }else{
            $goods = copyArray($_POST,array("id","title","remark"));
        }

        if(!isset($_POST['id']) || $_POST['id'] == ""){
            if($count)
            {
                exit(retJson("该类型代金卷已存在.", false));
            }
            $goods["created"] = $userId;
            $goods['create_time']=date("Y-m-d H:i:s");
            $id = $this -> Coupon_model -> add($goods);
            $isAdd = 1;
            exit(retJson("添加成功.", true,$isAdd));
        }else{

            $goods["updated"] = $userId;
            $goods['update_time']=date("Y-m-d H:i:s");
            $isAdd = 0;

            $this -> Coupon_model -> update($goods);
            exit(retJson("修改成功.", true,$isAdd));
        }
    }
    //改变启用状态
    function changeStatus($id, $status) {
        $admin = $this -> Coupon_model -> get_single(array("id" => $id));
        if (!$admin) {
            exit(retJson("当前优惠卷不存在，请刷新后重试.", false));
        }
        // var_dump($admin);
        // exit();
        if ($admin['status']!=$status) {
            exit(retJson("当前优惠卷状态不正确，请刷新后重试.", false));
        }

        $admin['status'] = 1 - $status;
        $this -> Coupon_model -> update($admin);
        $char=$status?'隐藏':'启用';
        exit(retJson("操作成功", true));
    }

    function del($id){
        $this -> CouponDetail_model -> delete($id);
        exit(retJson("删除成功.", true));
    }

}