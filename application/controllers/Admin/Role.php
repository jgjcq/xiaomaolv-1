<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends AdminController {

	function __construct() { 
		parent::__construct();
		$this -> load -> model("Role_model");
		$this -> sidebar = "Permissions-Role";
	}

	public function Index() {
		$this -> load -> view('admin/roleList');
	}

	function getDatas($params = array(), $isExport = false) {
		$connar = array();
		if (!$isExport) {
			$params = $_POST;
			$connar = $this -> Role_model -> pickPages($connar, $params);
		}

		$connar['orderby'] = "id asc";
		$connar['where']=' 1=1 and id<>1 ';
		$connar['items']="role.*,from_unixtime(db_role.created) createdChar,ifnull(from_unixtime(db_role.updated),'--') updatedChar";
		if (isset($params['param'])) {
			$connar['where'] .= $this->sqlLikeEscape(" and role.name like '%??%' ",array($params['param']));
		}

		if (!$isExport) {
			$data = $this -> Role_model -> get_page_list($connar);
		} else {
			$data["ret"] = $this -> Role_model -> get_list_full($connar);
		}
		if (!$isExport) {
			echo json_encode($data);
		} else {
			return $data["ret"];
		}
	}

	//新增，修改
	function edit($id){
		if($id == 0){
			$data['title'] = "新增角色";
			$data['detail'] = $this -> Role_model -> get_single(array("id" => $id));
		}else{
			$data['title'] = "编辑角色";
			$data['detail'] = $this -> Role_model -> get_single(array("id" => $id));
		}
		$this -> load -> view('admin/roleEdit',$data);
	}

	//新增修改操作
	function save(){
		if($_POST['id']==1)
		{
			exit(retJson("超级管理员不能被添加或者修改.", false));
		}
		if (!isset($_POST['name'])) {
			exit(retJson("角色名不能为空.", false));
		}
		
		$role = copyArray($_POST,array("name","id"));
		$count = $this -> Role_model -> get_count(array("name"=>$_POST['name']));
		
		if(!isset($_POST['id']) || $_POST['id'] == ""){
			
			if($count > 0){
			exit(retJson("角色已存在.", false));
			}
			$role['created']=time();
			$this -> Role_model -> add($role);
			$isAdd = 1;


			exit(retJson("添加成功.", true,$isAdd));
		}else{
			
			
			$isAdd = 0;
			$role['updated']=time();
			$this -> Role_model -> update($role);
			exit(retJson("修改成功.", true,$isAdd));
		}
	}

	//删除角色
	function delete($id){
		if($id==1)
		{
			exit(retJson("超级管理员不可被删除.", false));
		}
		$select_sql=$this->sqlEscape("select r.*,ifnull(count(a.id),0) count_admin from db_role r left join db_admin a on a.role_id=r.id where r.id=?? group by r.id",array($id));
		$role=$this->Role_model->query($select_sql);
		if(!$role)
		{
			exit(retJson("该角色不存在.", false));
		}
		if($role[0]['count_admin']!=0)
		{
			exit(retJson("该角色下还存在用户，无法删除.", false));
		}
		$this->Role_model->delete($id);
		//删除权限表中对应角色的所有权限
		$delete_sql=$this->sqlEscape("delete from db_role_module where role_id=??",array($id));
		$this -> load -> model("Role_module_model");
		$this->Role_module_model->query($delete_sql,false);

		//删除角色对应权限的模块缓存
		$this->delMRole();

		exit(retJson("角色删除成功.", true));
	}

	//设置权限页面
	function roleModule($id){
		$data['title'] = "角色权限";
		$data['role_id']=$id;
		
		$this -> load -> model("Role_module_model");
		$role_module=$this->Role_module_model->get_list(array('role_id'=>$id));
		$data['role_module']=array_column($role_module,'module_id');
		// var_dump($data['role_module']);
		// exit();
		// 
		$this -> load -> model("Module_model");
		$module=$this->Module_model->get_list(array());
		foreach ($module as $k => $v) {
			$module[$k]['value']=$v['id'];
			$module[$k]['name']=$v['cname'];
			$module[$k]['inputName']='module';
			if(in_array($v['id'],$data['role_module'])){
				$module[$k]['checked']=true;
			}
			else{
				$module[$k]['checked']=false;
			}
			unset($module[$k]['icon']);
			unset($module[$k]['cname']);
			unset($module[$k]['ename']);
			unset($module[$k]['is_show']);
			unset($module[$k]['created']);
			unset($module[$k]['updated']);
			unset($module[$k]['order']);
			unset($module[$k]['level']);
		}
		$data['module']=listToTree($module,'id','pid','children');
		$data['module']=array_values($data['module']);
		// var_dump($data['module']);
		// exit();
		// 
		
		$this->load->view('admin/roleModule',$data);
	}

	//设置权限保存
	function saveRoleModule(){
		$role_id=$_POST['role_id'];
		if($role_id==1){
			exit(retJson("超级管理员权限不可被操作.", false));
		}

		$this -> load -> model("Role_module_model");
		$this->Role_module_model->delBatch('role_id='.$role_id);
		
		if(isset($_POST['module'])&&$_POST['module']!='')
		{
			$module_id=$_POST['module'];
			$now=time();
			$add_sql="insert into db_role_module (role_id,module_id,created) values ";
			foreach ($module_id as $k => $v) {
				if($k==0)
				{
					$add_sql.=" ('{$role_id}','{$v}','{$now}') ";
				}
				else{
					$add_sql.=" , ";
					$add_sql.=" ('{$role_id}','{$v}','{$now}') ";
				}
			}
			$this->Role_module_model->query($add_sql,false);
		}
		
		
		//删除角色对应权限的模块缓存
		$this->delMRole();
		
		exit(retJson("权限设置成功.", true));
	}

	
}