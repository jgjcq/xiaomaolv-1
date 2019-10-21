<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module extends AdminController {

	function __construct() { 
		parent::__construct();
		$this -> load -> model("Module_model");
		$this -> sidebar = "Permissions-Module";
	}

	public function Index() {
		$this -> load -> view('admin/moduleList');
	}

    function getDatas($params = array(), $isExport = false) {
        $connar = array();
        if (!$isExport) {
            $params = $_POST;
            $connar = $this -> Module_model -> pickPages($connar, $params);
        }
        // $connar['where']=" 1=1 ";
        $connar['items']="module.*,from_unixtime(db_module.created) createdChar,ifnull(from_unixtime(db_module.updated),'--') updatedChar";
        $connar['cond']['level'] = 1;
        $connar['orderby'] = "is_show desc,pid";
        // if (isset($params['param'])) {
        // 	$connar['where'] .= " and (module.ename like '%" . $params['param'] . "%' ";
        // 	$connar['where'] .= " or module.cname like '%" . $params['param'] . "%') ";
        // }

        if (!$isExport) {
            $data = $this -> Module_model -> get_page_list($connar);
        } else {
            $data["ret"] = $this -> Module_model -> get_list_full($connar);
        }

        foreach ($data["ret"] as $k => $v) {
            $data['ret'][$k]['iconChar']='<i class="'.$v['icon'].'" style="font-size:22px; color:#555;"></i>';
            $data['ret'][$k]['showChar']=$v['is_show']?echoImg('right','20','20'):echoImg('error','20','20');
            $data['ret'][$k]['levelChar']=$v['level']==1?'顶级':'第二级';
            $connar2 = array();
            $connar2['items']="module.*,from_unixtime(db_module.created) createdChar,ifnull(from_unixtime(db_module.updated),'--') updatedChar";
            $connar2['cond']['level'] = 2;
            $connar2['cond']['pid'] = $data['ret'][$k]['id'];
            $connar2['orderby'] = "is_show desc,'order' desc";
            $data['ret'][$k]['sub'] = $this -> Module_model -> get_list_full($connar2);
            foreach ($data['ret'][$k]['sub'] as $k1 => $v1) {
                $data['ret'][$k]['sub'][$k1]['iconChar']='<i class="'.$v1['icon'].'" style="font-size:22px; color:#555;"></i>';
                $data['ret'][$k]['sub'][$k1]['showChar']=$v1['is_show']?echoImg('right','20','20'):echoImg('error','20','20');
                $data['ret'][$k]['sub'][$k1]['levelChar']=$v1['level']==1?'顶级':($v1['level']==2?'第二级':'第三级');

                $connar3 = array();
	            $connar3['items']="module.*,from_unixtime(db_module.created) createdChar,ifnull(from_unixtime(db_module.updated),'--') updatedChar";
	            $connar3['cond']['level'] = 3;
	            $connar3['cond']['pid'] = $v1['id'];
	            $connar3['orderby'] = "is_show desc,'order' desc";
	            $data['ret'][$k]['sub'][$k1]['sub'] = $this -> Module_model -> get_list_full($connar3);
	            foreach ($data['ret'][$k]['sub'][$k1]['sub'] as $k2 => $v2) {
	            	 $data['ret'][$k]['sub'][$k1]['sub'][$k2]['iconChar']='<i class="'.$v2['icon'].'" style="font-size:22px; color:#555;"></i>';
	                $data['ret'][$k]['sub'][$k1]['sub'][$k2]['showChar']=$v2['is_show']?echoImg('right','20','20'):echoImg('error','20','20');
	                $data['ret'][$k]['sub'][$k1]['sub'][$k2]['levelChar']=$v2['level']==1?'顶级':($v2['level']==2?'第二级':'第三级');
	            }
            }
        }
        $data["ret"]=arraySequence($data["ret"],'order');
        $data["ret"]=arraySequence(listToTree($data["ret"],'id','pid','sub'),'order');
        // var_dump($data["ret"]);
        // exit();
        if (!$isExport) {
            echo json_encode($data);
        } else {
            return $data["ret"];
        }
    }

	//新增，修改
	function edit($id){
		//获取图标
		$data['icon_array']=unCacheArray('cache/icon.txt');

		$data['module']=$this->Module_model->get_list(array('level'=>1),'order asc');
		if($id == 0){
			$data['title'] = "新增模块";
			$data['detail'] = $this -> Module_model -> get_single(array("id" => $id));
		}else{
			$data['title'] = "编辑模块";
			$data['detail'] = $this -> Module_model -> get_single(array("id" => $id));
		}
		$this -> load -> view('admin/moduleEdit',$data);
	}

	//新增修改操作
	function save(){
		if (!isset($_POST['cname'])) {
			exit(retJson("模块中文名不能为空.", false));
		}
		if (!isset($_POST['ename'])) {
			exit(retJson("模块英文名不能为空.", false));
		}
		
		if (!isset($_POST['level'])) {
			exit(retJson("模块层级不能为空.", false));
		}

		if (!isset($_POST['level'])) {
			exit(retJson("模块层级不能为空.", false));
		}

		
		$count = $this -> Module_model -> get_count(array("ename"=>$_POST['ename']));
		$this -> load -> model("Role_model");
		if(!isset($_POST['id']) || $_POST['id'] == ""){
            $module = copyArray($_POST,array("cname","ename","icon","level","pid","is_show",'order'));
			if($count > 0){
			exit(retJson("模块已存在.", false));
			}
			$module['created']=time();
			$this -> Module_model -> add($module);
			$isAdd = 1;
		}else{

            $module = copyArray($_POST,array("cname","id","ename","icon","level","pid","is_show",'order'));
			$isAdd = 0;
			$module['updated']=time();
			// if($module['level']==2){
			// 	$module['icon']='';
			// }
			$this -> Module_model -> update($module);
		
		}
		//清除超级管理员权限模块缓存
		$this->delMRole();
		exit(retJson($isAdd?'添加成功':'修改成功', true,$isAdd));
	}

	//删除角色
	function delete($id){
		$select_sql=$this->sqlEscape("select m.*,ifnull(count(m2.id),0) count_module from db_module m left join db_module m2 on m2.pid=m.id where m.id=?? group by m.id",array($id));
		$module=$this->Module_model->query($select_sql);
		if(!$module)
		{
			exit(retJson("该模块不存在.", false));
		}
		if($module[0]['count_module']!=0)
		{
			exit(retJson("该模块下还存在子模块，无法删除.", false));
		}
		//删除模块
		$this->Module_model->delete($id);
		//删除权限表中对应模块的所有权限
		$delete_sql=$this->sqlEscape("delete from db_role_module where module_id=??",array($id));
		$this -> load -> model("Role_module_model");
		$this->Role_module_model->query($delete_sql,false);

		//清除超级管理员权限模块缓存
		$this->delMRole();
		
		exit(retJson("模块删除成功.", true));
	}
	//改变显示状态
	function changeStatus($id, $is_show) {
		$module = $this -> Module_model -> get_single(array("id" => $id));
		if (!$module) {
			exit(retJson("当前模块不存在，请刷新后重试.", false));
		}
		if ($module['is_show']!=$is_show) {
			exit(retJson("当前模块状态不正确，请刷新后重试.", false));
		}
		$module['is_show'] = 1 - $is_show;
		$this -> Module_model -> update($module);

		//清除超级管理员权限模块缓存
		$this->delMRole();
		$char=$is_show?'隐藏':'显示';
		exit(retJson("已" . $char.'用户'.$module['cname'], true));
	}

	

	
}