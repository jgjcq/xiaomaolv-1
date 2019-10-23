<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends AdminController {

	function __construct() { 
		parent::__construct();
		$this -> load -> model("User_model");		
		$this -> sidebar = "Member-User";
	}

	public function Index() {
		$this -> load -> view('admin/userList');
	}

	function getDatas($params = array(), $isExport = false) {
		$connar = array();
		if (!$isExport) {
			$params = $_POST;
			$connar = $this -> User_model -> pickPages($connar, $params);
		}

		$connar['orderby'] = "id asc";
		$connar['where']=' 1=1 ';
		$connar['items']='user.*';
		if(isset($params['status']))
		{
			if($params['status']<2)
			{
				$connar['where'].=$this->sqlEscape("and user.status=??",array($params['status']));
			}
		}
		if (isset($params['param'])) {
			$connar['where'] .= $this->sqlLikeEscape(" and (username like '%??%' ",array($params['param']));
			$connar['where'] .= $this->sqlLikeEscape(" or usercode like '%??%') ",array($params['param']));
		}

		if (!$isExport) {
			$data = $this -> User_model -> get_page_list($connar);
		} else {
			$data["ret"] = $this -> User_model -> get_list_full($connar);
		}
		foreach ($data['ret'] as $k => $v) {
			if($v['head_img'])
			{
				$data['ret'][$k]['imageChar']='<img src="'.base_url().$v['head_img'].'" style="width:40px; height:40px; border-radius:25px;">';
			}
			else
			{
				$data['ret'][$k]['imageChar']='<img src="'.base_url().'public/home/images/my-face.jpg" style="width:40px; height:40px; border-radius:25px;">';
			}
			
			$data['ret'][$k]['createdChar']=date('Y-m-d H:i:s',$v['created']);
			
			if(!$v['username'])
			{
				$data['ret'][$k]['username']='（未设置）';
			}

				
		}
		if (!$isExport) {
			echo json_encode($data);
		} else {
			return $data["ret"];
		}
	}


	//改变启用状态
	function changeStatus($id, $status) {
		$user = $this -> User_model -> get_single(array("id" => $id));
		if (!$user) {
			exit(retJson("当前用户不存在，请刷新后重试.", false));
		}
		if ($user['status']!=$status) {
			exit(retJson("当前用户状态不正确，请刷新后重试.", false));
		}
		$user['status'] = 1 - $status;
		$this -> User_model -> update($user);
		$char=$status?'冻结':'启用';
		exit(retJson("已" . $char.'用户'.$user['usercode'], true));
	}
	//初始化密码
	function initPassword($id) {
		$user = $this -> User_model -> get_single(array("id" => $id));
		if (!$user) {
			exit(retJson("当前会员不存在，请刷新后重试.", false));
		}
		$randStr = md5(getRandStr(16));
		$password = getPasswrodWithTwiceEncode(INIT_PWD,$randStr);
		$user['id'] = $id;
		$user['password'] = $password;
		$user['passsalt'] = $randStr;
		// $_SESSION['tongbao_admin']['password']=$password;
		// $_SESSION['tongbao_admin']['passsalt']=$passsalt;
		$this -> User_model -> update($user);
		exit(retJson($user['usercode'] . "登录密码初始化成功", true));
	}


    //新增，修改
    function edit($id){

        if($id == 0){
            $data['title'] = "新增会员";
            $data['detail'] = $this -> User_model -> get_single(array("id" => $id));
        }else{
            $data['title'] = "查看/编辑";
            $data['detail'] = $this -> User_model -> get_single(array("id" => $id));

        }
        $this -> load -> view('admin/userEdit',$data);
    }

    function save(){
        // var_dump($_POST);
        // exit();

        $count = $this -> User_model -> get_count(array("usercode"=>$_POST['usercode']));

        $goods = copyArray($_POST,array("usercode","username","gender","head_img","phone"));


        $images=$this->NOTXSS_POST['head_img'];
        if(checkStringIsBase64($images)){
            $checkRet = uploadImg($images,'article');
            if(!$checkRet['status']){
                exit(toRetJson($checkRet));
            }
            $goods['head_img'] = $checkRet["v"];
        }else{
            $goods['head_img'] = $this->NOTXSS_POST['head_img'];
        }
        if(!isset($_POST['id']) || $_POST['id'] == ""){

            if($count)
            {
                exit(retJson("该会员已存在.", false));
            }
            $goods['created']=time();
            $this -> User_model -> add($goods);
            $isAdd = 1;


            exit(retJson("添加成功.", true,$isAdd));
        }else{

            $goods_data=$this->User_model->get_single(array('id'=>$_POST['id']));
            if($goods_data['head_img']&&$goods_data['head_img']!=$goods['head_img'])
            {
                unlink($goods_data['head_img']);
            }

            $goods['updated']=time();
            $isAdd = 0;
            $this -> User_model -> update($goods);
            exit(retJson("修改成功.", true,$isAdd));
        }
    }


	

	
	
	
}