<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> model("Admin_model");
	}

	public function Index() {
		$this -> load -> view('admin/login');
	}

	function doLogin(){
		$param=$this->input->post();
		if(!($param['usercode']&&$param['password']))
		{
			exit(retJson('请填写完整信息！', false));
		}
		$conner['items']='passsalt,status';
		$conner['where']=$this->sqlEscape(" usercode=?? ",array($param['usercode']));
		// $conner['cond']=array('usercode'=>$param['usercode']);
		$admininfo=$this->Admin_model->get_single_full($conner);

		if($admininfo)
		{
			if(!$admininfo['status'])
			{
				exit(retJson('该用户已被禁用！', false));
			}
			$conner['items']='usercode,username,id,role_id,sub_role_id,updated,ip,head_img';
			$conner['cond']=array('usercode'=>$param['usercode'],'password'=>getPasswrodWithTwiceEncode($param['password'],$admininfo['passsalt']));
			$_admininfo=$this->Admin_model->get_single_full($conner);
			// var_dump($this->db->last_query());
			// exit();
			if($_admininfo)
			{
				$_SESSION[SESS_USER]=$_admininfo;
				$arr=array(
					'id'=>$_admininfo['id'],
					'updated'=>time(),
					'ip'=>$_SERVER['REMOTE_ADDR']
					);
				$this->Admin_model->update($arr);
				exit(retJson('登录成功！', true));
			}
			else{
				exit(retJson('帐号或者密码错误！', false));
			}
		}
		else{
			exit(retJson('不存在该用户！', false));
		}

	}
	function logOut(){
		session_destroy();
		redirect(site_url('Admin/Login/Index'));
	}
	//管理员修改密码
	function password(){
		$data['title'] = "密码修改";
		$this -> load -> view('admin/userPassword',$data);
	}
	
	function savePassword(){
		$detail = $this -> Admin_model -> get_single(array("id" => $_SESSION[SESS_USER]['id']));
		$tPassword = getPasswrodWithTwiceEncode($_POST["oldPwd"],$detail["passsalt"]);
		if($tPassword != $detail["password"]){
			exit(retJson("原密码错误", false));
		}
		if($_POST["newPwd"]!=$_POST["newPwd2"])
		{
			exit(retJson("两次密码输入不一致", false));
		}
		$salt = md5(GetRandStr(16));
		$password = getPasswrodWithTwiceEncode($_POST["newPwd"],$salt);
		$detail["password"] = $password;
		$detail["passsalt"] = $salt;
		$this -> Admin_model -> update($detail);
		exit(retJson("密码修改成功", true));
	}

	function quickEntry(){
		$data['title'] = "快捷入口";
		$data['role_id']=$_SESSION[SESS_USER]['role_id'];
		$data['admin_id']=$_SESSION[SESS_USER]['id'];
		$this -> load -> model("Module_model");
		if($data['role_id']==1){
			$connar['cond']=array();
		}
		else{
			$connar['cond']=array('rm.role_id'=>$data['role_id']);
		}
		$connar['join']=array('Role_module rm','rm.module_id=module.id');
		$connar['items']=' module.* ';
		$module=$this->Module_model->get_list_full($connar);
		$data['module']=listToTree($module);
		if($data['module']){
			$data['module']=arraySequence($data['module'],'order');
		}
		
		// var_dump($data['module']);
		// exit();
		$this -> load -> model("Quick_entry_model");
		$role_module=$this->Quick_entry_model->get_list(array('admin_id'=>$data['admin_id']));
		$data['role_module']=array_column($role_module,'module_id');
		// var_dump($data['role_module']);
		// exit();
		$this->load->view('admin/quickEntry',$data);
	}

	//保存快捷入口
	function saveQuickEntry(){
		$role_id=$_POST['role_id'];
		$admin_id=$_POST['admin_id'];
		// if($role_id==1){
		// 	exit(retJson("超级管理员权限不可被操作.", false));
		// }

		$this -> load -> model("Quick_entry_model");
		$this->Quick_entry_model->delBatch('admin_id='.$admin_id);
		
		if(isset($_POST['module'])&&$_POST['module']!='')
		{
			$module_id=$_POST['module'];
			$now=time();
			$add_sql="insert into db_quick_entry (admin_id,module_id,created) values ";
			foreach ($module_id as $k => $v) {
				if($k==0)
				{
					$add_sql.=" ('{$admin_id}','{$v}','{$now}') ";
				}
				else{
					$add_sql.=" , ";
					$add_sql.=" ('{$admin_id}','{$v}','{$now}') ";
				}
			}
			$this->Quick_entry_model->query($add_sql,false);
		}

		
		exit(retJson("快捷入口设置成功.", true));
	}

	function delQuickEntry($id){
		$this -> load -> model("Quick_entry_model");
		$this->Quick_entry_model->delete($id);
		exit(retJson("快捷入口删除成功.", true));
	}
	
	function changeHeadImg(){
		$data['title']="头像修改";
		$this -> load -> view("admin/changeHeadImg",$data);
	}

	function doChangeHeadImg(){
		if (checkStringIsBase64($this->NOTXSS_POST['head_img'])) {
            $checkRet = uploadImg($this->NOTXSS_POST['head_img'], 'head');
            if (!$checkRet['status']) {
                exit(toRetJson($checkRet));
            }
            $data['head_img'] = $checkRet["v"];
        } else {
            $data['head_img']=$this->NOTXSS_POST['head_img'];
        }
        $update=array(
        	'id'=>getSess(SESS_USER)['id'],
        	'head_img'=>$data['head_img']
        	);
        $this->Admin_model->update($update);
        $_SESSION[SESS_USER]['head_img']=$data['head_img'];
        exit(retJson("头像修改成功.", true));
	}
	
}