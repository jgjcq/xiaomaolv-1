<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends AdminController { 

	function __construct() {  
		parent::__construct();
		$this -> load -> model("Article_model");
		$this -> sidebar = "Content-Article";
	} 

	public function Index() { 
		$this -> load -> view('admin/articleList');
	}

	function getDatas($params = array(), $isExport = false) {
		$connar = array(); 
		if (!$isExport) {
			$params = $_POST;
			$connar = $this -> Article_model -> pickPages($connar, $params);
		}
		$connar['orderby'] = "created desc";
		$connar['where']="1=1";
		if (isset($params['param'])) {
			$connar['where'] .= $this->sqlLikeEscape(" and (title like '%??%' ",array($params['param']));
			$connar['where'] .= $this->sqlLikeEscape(" or subtitle like '%??%') ",array($params['param']));
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
			$data = $this -> Article_model -> get_page_list($connar);
		} else {
			$data["ret"] = $this -> Article_model -> get_list_full($connar);
		}
		foreach ($data["ret"] as $k => $v) {
			$data['ret'][$k]['img_input']='<img src="'.$v['article_image'].'" style="width:100px; height:50px;">';
			$data['ret'][$k]['createdChar']=date('Y-m-d H:i:s',$v['created']);
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
			$data['title'] = "新增文章";
			$data['detail'] = $this -> Article_model -> get_single(array("id" => $id));
		}else{
			$data['title'] = "查看/编辑文章";
			$data['detail'] = $this -> Article_model -> get_single(array("id" => $id));
		 	
		}
		$this -> load -> view('admin/articleEdit',$data);
	}
	function save(){
		// var_dump($_POST);
		// exit();
	
		$count = $this -> Article_model -> get_count(array("title"=>$_POST['title']));
		
		$goods = copyArray($_POST,array("title","subtitle","id","content"));
	

		$images=$_POST['article_image'];
        $images = str_replace('[removed]','data:image/png;base64,',$images);
		if(checkStringIsBase64($images)){
				$checkRet = uploadImg($images,'article');
				if(!$checkRet['status']){
					exit(toRetJson($checkRet));
				}
				$goods['article_image'] = $checkRet["v"];
			}else{
				$goods['article_image'] = $_POST['article_image'];
			}
		if(!isset($_POST['id']) || $_POST['id'] == ""){
            $goods = copyArray($_POST,array("title","subtitle","content"));
			if($count)
			{
				exit(retJson("该文章已存在.", false));
			}
			$goods['created']=time();
			$this -> Article_model -> add($goods);
			$isAdd = 1;


			exit(retJson("添加成功.", true,$isAdd));
		}else{
			
			$goods_data=$this->Article_model->get_single(array('id'=>$_POST['id']));
			if($goods_data['article_image']&&$goods_data['article_image']!=$goods['article_image'])
			{
				unlink($goods_data['article_image']);
			}
			
			$goods['updated']=time();
			$isAdd = 0;
			$this -> Article_model -> update($goods);
			exit(retJson("修改成功.", true,$isAdd));
		}
	}


	//改变启用状态
	function changeStatus($id, $status) {
		$admin = $this -> Article_model -> get_single(array("id" => $id));
		if (!$admin) {
			exit(retJson("当前文章不存在，请刷新后重试.", false));
		}
		// var_dump($admin);
		// exit();
		if ($admin['status']!=$status) {
			exit(retJson("当前文章状态不正确，请刷新后重试.", false));
		}

		$admin['status'] = 1 - $status;
		$this -> Article_model -> update($admin);
		$char=$status?'隐藏':'发布';
		exit(retJson("已" .$char.'文章【'.$admin["title"].'】', true));
	}








	

	
	
}