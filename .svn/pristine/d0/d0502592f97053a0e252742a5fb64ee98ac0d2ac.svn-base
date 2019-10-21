<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salesman extends AdminController
{
    private $hhr_type = array();
    function __construct() {
        parent::__construct();
        $this -> load -> model("Salesman_model");
        $this -> load -> model("Salesman_type_model");
        $this -> load -> model("User_model");
        $this -> load -> model("Area_model");
        $this -> load -> model("Setting_model");
        $this -> load -> model("Royalty_model");
        $this -> sidebar = "Salesman";
        $this->hhr_type = config_item("hhr_type");
    }

    public function type() {
        $this -> load -> view('admin/salesmanType');
    }
    public function getTypeDatas(){
        $connar = array();
        $data["ret"] = $this -> Salesman_type_model -> get_list_full($connar);
        echo json_encode($data);
    }

    public function Index() {
        $data = array();
        $data['pid'] = 0;
        $this -> load -> view('admin/salesmanList',$data);
    }

    public function children($id) {
        $data = array();
        $data['pid'] = $id;
        $this -> load -> view('admin/salesmanList',$data);
    }

    function getDatas($params = array(), $isExport = false) {
        $connar = array();
        if (!$isExport) {
            $params = $_POST;
            $connar = $this -> Salesman_model -> pickPages($connar, $params);
        }
        $connar['orderby'] = "id desc";
        $connar['where']="1=1";
        if (isset($params['param'])) {
            $connar['where'] .= $this->sqlLikeEscape(" and (nickname like '%??%' ",array($params['param']));
        }
        if (isset($params['pid']) && $params['pid'] > 0) {
            $connar['where'] .= $this->sqlLikeEscape(" and pid = ??",array($params['pid']));
        }
        if(isset($params['is_check']))
        {
            if($params['is_check']<2)
            {
                $connar['where'] .= $this->sqlLikeEscape(" and is_check=?? ",array($params['is_check']));
            }
        }
        else{
            $connar['where'] .=" and is_check=1";
        }
        if (!$isExport) {
            $data = $this -> Salesman_model -> get_page_list($connar);
        } else {
            $data["ret"] = $this -> Salesman_model -> get_list_full($connar);
        }
        foreach ($data["ret"] as $k => $v) {
           // $data['ret'][$k]['img_input']='<img src="'.$v['article_image'].'" style="width:100px; height:50px;">';
            $data['ret'][$k]['is_check_text']=$v["is_check"] == 1?'已审核':'未审核';
            $type = $this->Salesman_type_model->get_single(array('id'=>$v['type']));
            $data['ret'][$k]['type_text'] = $type['name'];
            $data['ret'][$k]['pid_text'] = $v['pid'] == 0?'无':$v['pid'];
            $data['ret'][$k]['is_city_text'] = $v['is_city'] == 0?'否':'<span style="color:red">是</span>';
            $data['ret'][$k]['tx_price']  = $this->Royalty_model->getPrice($v['id']);

        }

        $data["ret"]=array_values($data["ret"]);
        if (!$isExport) {
            echo json_encode($data);
        } else {
            return $data["ret"];
        }
    }

    //改变启用状态
    function changeStatus($id, $status) {
        $admin = $this -> Salesman_model -> get_single(array("id" => $id));
        if (!$admin) {
            exit(retJson("当前用户不存在，请刷新后重试.", false));
        }
        // var_dump($admin);
        // exit();
        if ($admin['is_check']!=$status) {
            exit(retJson("当前用户状态不正确，请刷新后重试.", false));
        }

        $admin['is_check'] = 1 - $status;
        $this -> Salesman_model -> update($admin);
        if(!$status){
            $user = $this->User_model->get_single(array('id'=>$admin['user_id']));
            $data = array();
            $data['touser'] = $user['openid'];
            $data['template_id'] = 'j3JVmeDqU6UtL4T1MwYe1fQYD4lJNmFdfYxii8pTBk4';
            $data['data'] = array('first'=>array('value'=>'驴妈妈审通过！'),'keyword1'=>array('value'=>'测试2'),'keyword2'=>array('value'=>'测试3'),'remark'=>array('value'=>'测试4'),);
            $this->sendMsg($data);
        }
        $char=$status?'审核':'反审核';
        exit(retJson("操作成功", true));
    }
    function setCity($id, $status) {
        $admin = $this -> Salesman_model -> get_single(array("id" => $id));
        if (!$admin) {
            exit(retJson("当前驴妈妈不存在，请刷新后重试.", false));
        }
        if ($admin['is_city']!=$status) {
            exit(retJson("当前驴妈妈状态不正确，请刷新后重试.", false));
        }

        if($status == 0 and $this->Salesman_model->getCityUser($admin['city'])){
            exit(retJson("当前城市已有城市合伙人，请检查.", false));
        }

        $admin['is_city'] = 1 - $status;
        $this -> Salesman_model -> update($admin);
        $char=$status?'设置':'反设置';
        exit(retJson("操作成功", true));
    }

    //新增，修改
    function edit($id,$pid = 0){
        $user_list = $this->User_model->getUnSalesmanUserList();
        $province_list = $this->Area_model->getByParentId(-1);
        $type_list = $this -> Salesman_type_model ->getAll();
        if($id == 0){
            $data['title'] = "新增驴妈妈";
            $data['detail'] = $this -> Salesman_model -> get_single(array("id" => $id));
        }else{
            $data['title'] = "查看/编辑";
            $data['detail'] = $this -> Salesman_model -> get_single(array("id" => $id));
            $data['user'] = $this->User_model->get_single(array('id'=>$data['detail']['user_id']));
        }
        $data['parents'] = $this->Salesman_model->getListUnMe($id);
        $data['pid'] = $pid;
        $data['user_list'] = $user_list;
        $data['province_list'] = $province_list;
        $data['type_list'] = $type_list;
        $this -> load -> view('admin/salesmanEdit',$data);
    }
    function typeEdit($id){
        if($id == 0){
            $data['title'] = "新增驴妈妈身份";
            $data['detail'] = $this -> Salesman_type_model -> get_single(array("id" => $id));
        }else{
            $data['title'] = "查看/编辑";
            $data['detail'] = $this -> Salesman_type_model -> get_single(array("id" => $id));

        }
        $this -> load -> view('admin/salesmanTypeEdit',$data);
    }

    function save(){
        $count = $this -> Salesman_model -> get_count(array("user_id"=>$_POST['user_id']));
        $images=$_POST['ad_image'];
        $images = str_replace('[removed]','data:image/png;base64,',$images);
        $goods = array();
        $userId = $_SESSION[SESS_USER]["id"];
        if(!isset($_POST['id']) || $_POST['id'] == ""){
            $goods = copyArray($_POST,array("user_id","phone","address","type","nickname","province","city","area","pid"));
        }else{
            $goods = copyArray($_POST,array("id","user_id","phone","address","type","nickname","province","city","area","pid"));
        }
        if(checkStringIsBase64($images)){
            $checkRet = uploadImg($images,'article');
            if(!$checkRet['status']){
                exit(toRetJson($checkRet));
            }
            $goods['ad_image'] = $checkRet["v"];
        }else{
            $goods['ad_image'] = $_POST['ad_image'];
        }
        if(!isset($_POST['id']) || $_POST['id'] == ""){
            if($count)
            {
                exit(retJson("该会员已存在.", false));
            }
            $goods['reg_time']=date("Y-m-d H:i:s");
            $id = $this -> Salesman_model -> add($goods);
            $isAdd = 1;
            exit(retJson("添加成功.", true,$isAdd));
        }else{

            $isAdd = 0;
            $this -> Salesman_model -> update($goods);
            exit(retJson("修改成功.", true,$isAdd));
        }
    }

    function typeSave(){
        if(!isset($_POST['id']) || $_POST['id'] == ""){
            $goods = copyArray($_POST,array("name"));
        }else{
            $goods = copyArray($_POST,array("id","name"));
        }

        if(!isset($_POST['id']) || $_POST['id'] == ""){
            $id = $this -> Salesman_type_model -> add($goods);
            $isAdd = 1;
            exit(retJson("添加成功.", true,$isAdd));
        }else{

            $isAdd = 0;

            $this -> Salesman_type_model -> update($goods);
            exit(retJson("修改成功.", true,$isAdd));
        }
    }

    public function setting(){
        $setting_list = $this->Setting_model->getByCode("salesman");
        $data['setting_list'] = $setting_list;
        $this -> load -> view('admin/salesmanSetting',$data);
    }

    public function settingSave(){
        $ids = $_POST['ids'];
        $values = $_POST['values'];
        if($ids && count($ids) >0){
            foreach($ids as$key=>$id){
                $this->Setting_model->updateSetting($id,$values[$key]);
            }
        }
        exit(retJson("修改成功.", true));
    }
    public function txList(){

        $this -> load -> view('admin/txList');
    }

    public function getTxDatas(){
        $status = $_POST['status'];
        $connar = array();
        $connar = $this -> Salesman_model -> pickPages($connar, $_POST);
        $connar['where'] = " in_out = 1";
        if(isset($status) && $status != -1){
            $connar['where'] .= " and status = $status";
        }
        $data = $this->Royalty_model->get_page_list($connar);
        foreach ($data["ret"] as $k => $v) {
            $salesman = $this -> Salesman_model ->get_single(array('id'=>$v['salesman_id']));
            $data['ret'][$k]['salesman_name']=$salesman['nickname'];
            $data['ret'][$k]['real_name']=$salesman['real_name'];
            $data['ret'][$k]['bank']=$salesman['bank'];
            $data['ret'][$k]['bank_code']=$salesman['bank_code'];
            $data['ret'][$k]['aiplay']=$salesman['aiplay'];
            $data['ret'][$k]['status_text'] = $v['status'] == 0?'否':'<span style="color:red">是</span>';
        }

        $data["ret"]=array_values($data["ret"]);
        echo json_encode($data);
    }

    function txStatus($id, $status) {
        $admin = $this -> Royalty_model -> get_single(array("id" => $id));
        if (!$admin) {
            exit(retJson("当前订单不存在，请刷新后重试.", false));
        }
        if ($admin['status']!=$status) {
            exit(retJson("当前用户订单不正确，请刷新后重试.", false));
        }

        $admin['status'] = 1 - $status;
        $this -> Royalty_model -> update($admin);
        if(!$status){
            $user = $this->User_model->get_single(array('id'=>$admin['user_id']));
            $data = array();
            $data['touser'] = $user['openid'];
            $data['template_id'] = 'j3JVmeDqU6UtL4T1MwYe1fQYD4lJNmFdfYxii8pTBk4';
            $data['data'] = array('first'=>array('value'=>'提现审核通过！'),'keyword1'=>array('value'=>'测试2'),'keyword2'=>array('value'=>'测试3'),'remark'=>array('value'=>'测试4'),);
            $this->sendMsg($data);
        }
        $char=$status?'审核':'反审核';
        exit(retJson("操作成功", true));
    }


}