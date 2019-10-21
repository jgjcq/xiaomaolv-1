<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends AdminController
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("Admin_model");
        $this->sidebar = "T-Test";
    }

    public function Index()
    {
        //角色数组
        $this->load->model("Role_model");
        $connar['where'] = " id<>1 ";
        $data['role'] = $this->Role_model->get_list_full($connar);
        $this->load->view('admin/testList', $data);
    }
    public function Index2()
    {
        //角色数组
        $this->load->model("Role_model");
        $connar['where'] = " id<>1 ";
        $data['role'] = $this->Role_model->get_list_full($connar);
        $this->load->view('admin/testList2', $data);
    }

    function getDatas($params = array(), $isExport = false)
    {
        $connar = array();
        if (!$isExport) {
            $params = $_POST;
            $connar = $this->Admin_model->pickPages($connar, $params);
        }
//        $connar['items']="car.*,from_unixtime(db_car.created) createdChar,ifnull(from_unixtime(db_car.updated),'--') updatedChar";
        $connar['items'] = "admin.*,role.name roleName";
        $connar['orderby'] = "role_id,id desc";

        $connar['where'] = "role_id<>" . ROLE_ADMIN." and role_id<>".ROLE_CARDEALER;


        $connar['join'] = array('role', 'role.id=admin.role_id');
        if (isset($params['role']) && $params['role'] > -1) {
            $connar['where'] .= " and role_id=" . $params['role'];
        } else {
            $connar['where'] .= " and 1=1";
        }

        if (isset($params['param'])) {
            $connar['where'] .= " and (username like '%" . $params['param'] . "%' ";
            $connar['where'] .= " or usercode like '%" . $params['param'] . "%') ";
        }

        if (!$isExport) {
            $data = $this->Admin_model->get_page_list($connar);
        } else {
            $data["ret"] = $this->Admin_model->get_list_full($connar);
        }
        foreach ($data['ret'] as $k => $v) {

            $data['ret'][$k]['statusChar'] = $v['status'] ? echoImg('right', '20', '20') : echoImg('error', '20', '20');
            if ($v['updated']) {
                $data['ret'][$k]['logintimeChar'] = date('Y-m-d H:i:s', $v['updated']);
            } else {
                $data['ret'][$k]['logintimeChar'] = '--';
            }


        }
        if (!$isExport) {
            echo json_encode($data);
        } else {
            return $data["ret"];
        }
    }

    //改变启用状态
    function changeStatus($id, $status)
    {
        $admin = $this->Admin_model->get_single(array("id" => $id));
        if (!$admin) {
            exit(retJson("当前用户不存在，请刷新后重试.", false));
        }
        // var_dump($admin);
        // exit();
        if ($admin['status'] != $status) {
            exit(retJson("当前用户状态不正确，请刷新后重试.", false));
        }
        if ($admin['id'] == 1) {
            exit(retJson("超级管理员不可被操作.", false));
        }
        $admin['status'] = 1 - $status;
        $this->Admin_model->update($admin);
        exit(retJson("已" . $status ? '冻结' : '启用' . '用户' . $admin['username'], true));
    }

    //初始化密码
    function initPassword($id)
    {
        $admin = $this->Admin_model->get_single(array("id" => $id));
        if (!$admin) {
            exit(retJson("当前会员不存在，请刷新后重试.", false));
        }
        if ($admin['id'] == 1) {
            exit(retJson("超级管理员不可被操作.", false));
        }
        $randStr = md5(getRandStr(16));
        $password = getPasswrodWithTwiceEncode(INIT_PWD, $randStr);
        $admin['id'] = $id;
        $admin['password'] = $password;
        $admin['passsalt'] = $randStr;
        // $_SESSION['tongbao_admin']['password']=$password;
        // $_SESSION['tongbao_admin']['passsalt']=$passsalt;
        $this->Admin_model->update($admin);
        exit(retJson($admin['username'] . "登录密码初始化成功", true));
    }

    //新增，修改
    function edit($id)
    {
        //角色数组
        $this->load->model("Role_model");
        $connar['where'] = " id<>1 ";
        $data['role'] = $this->Role_model->get_list_full($connar);

        if ($id == 0) {
            $data['title'] = "新增用户";
            $data['detail'] = $this->Admin_model->get_single(array("id" => $id));
        } else {
            $data['title'] = "编辑用户";
            $data['detail'] = $this->Admin_model->get_single(array("id" => $id));
        }
        $this->load->view('admin/adminEdit', $data);
    }

    //新增修改操作
    function save()
    {
        // var_dump($_POST);
        // exit();
        if (!isset($_POST['role_id'])) {
            exit(retJson("请选择角色.", false));
        }
        if ($_POST['role_id'] == 1) {
            exit(retJson("超级管理员不能被添加或者修改.", false));
        }
        if (!isset($_POST['usercode'])) {
            exit(retJson("用户名不能为空.", false));
        }
        if (!isset($_POST['username'])) {
            exit(retJson("姓名不能为空.", false));
        }

        if (!isset($_POST['phone'])) {
            exit(retJson("联系方式不能为空.", false));
        }
        if (!isset($_POST['address'])) {
            exit(retJson("车行地址不能为空.", false));
        }
        if (!isset($_POST['business_license'])) {
            exit(retJson("营业执照图片本地地址不能为空.", false));
        }
        if (!isset($_POST['parking_space'])) {
            exit(retJson("车位数不能为空.", false));
        }
        if (!isset($_POST['openid'])) {
            exit(retJson("微信唯一标识不能为空.", false));
        }

        $admin = copyArray($_POST, array("username", "role_id", "id", "usercode","phone","address","business_license","parking_space","openid",));
        if (!isset($_POST['sub_role_id'])) {
            $admin['sub_role_id'] = '';
        } else {
            if (in_array($_POST['role_id'], $_POST['sub_role_id'])) {
                exit(retJson("其他角色不能包含主角色.", false));
            }
            if (count($_POST['sub_role_id']) != count(array_unique($_POST['sub_role_id']))) {
                exit(retJson("其他角色不能重复.", false));
            }
            $admin['sub_role_id'] = implode(',', $_POST['sub_role_id']);
        }
        $count = $this->Admin_model->get_count(array("usercode" => $_POST['usercode']));

        if (!isset($_POST['id']) || $_POST['id'] == "") {

            if ($count > 0) {
                exit(retJson("账户名已存在.", false));
            }
            $salt = md5(GetRandStr(16));
            $password = getPasswrodWithTwiceEncode(INIT_PWD, $salt);
            $admin["password"] = $password;
            $admin["passsalt"] = $salt;
            $admin['status'] = 1;
            $this->Admin_model->add($admin);
            $isAdd = 1;


            exit(retJson("添加成功.", true, $isAdd));
        } else {

            $default_admin = $this->Admin_model->get_single(array('id' => $_POST['id']));
            if ($default_admin['role_id'] == 1) {
                exit(retJson("超级管理员不可被修改.", false));
            }
            $isAdd = 0;
            $this->Admin_model->update($admin);

            $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
            $this->cache->delete('module' . $_POST['id']);

            exit(retJson("修改成功.", true, $isAdd));
        }
    }

    function Navi(){
        $this->load->view('admin/navi');
    }


}