<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	protected $NOTXSS_POST=false;
	protected $NOTXSS_GET=false;
	function __construct() {
		parent::__construct();
		$this->getPageInfos();
		$this->xssEscape();
	}
	//xss
	function xssEscape(){
		if(isset($_POST)){
			$this->NOTXSS_POST=$_POST;
			$_POST=$this->input->post();
		}
		if(isset($_GET)){
			$this->NOTXSS_GET=$_GET;
			$_GET=$this->input->get();
		}
	}
	//防止sql注入
	function sqlEscape($sql,$param,$like=false){
		// $param[$k]=$this->db->escape($v);
		$sql_array=explode('??',$sql);
		$new_sql=$sql_array[0];
		foreach ($param as $k => $v) {
			if(!$like){
				$new_sql.=$this->db->escape($v);
			}
			else{
				$new_sql.=$this->db->escape_like_str($v);
			}
			if(isset($sql_array[$k+1])){
				$new_sql.=$sql_array[$k+1];
			}
		}
		return $new_sql;
	}
	function sqlLikeEscape($sql,$param){
		$new_sql=$this->sqlEscape($sql,$param,true);
		return $new_sql;
	}
	//获取页面基础信息
    function getPageInfos() {
        if (!hasSess(SESS_DIC)) {
            $this -> load -> model("Dic_model");
            $vs = $this -> Dic_model -> get_list(array("type" => "webInfo"));
            $dic = array();
            foreach ($vs as $v) {
                $dic[$v['type']][$v['dic_key']] = $v['dic_value'];
            }
            setSess($dic, SESS_DIC);
        }
    }

	//清除权限缓存
	protected function delMRole(){
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		$this->load->model('Admin_model');
		$admin=$this->Admin_model->get_list(array());
		foreach ($admin as $k => $v) {
			$this->cache->delete('module'.$v['id']);
		}
		//清缓存的同时，要把用户快捷入口的物权限模块数据删除掉
		
	}

	//获取后台用户快捷入口，只在两个admin调用
	protected function getQuickEntry(){
		$this->load->model('Quick_entry_model');
		$admin_id=$_SESSION[SESS_USER]['id'];
		$connar['cond']=array('quick_entry.admin_id'=>$admin_id,'m.level'=>2);
		$connar['join'][0]=array('module m','m.id=quick_entry.module_id');
		$connar['join'][1]=array('module m2','m2.id=m.pid');
		$connar['items']=' m.*,m2.icon,quick_entry.id quick_entry_id ';
		$data=$this->Quick_entry_model->get_list_full($connar);
		$this->load->vars('quick_entry',$data);
		$this->load->vars('quick_entry_count',count($data));
	}

}

class HomeController extends MY_Controller{
    public  $buyedCourseListStr = '';
    public  $buyedCourseList = array();
    public  $wx_config = array();
    public $uid;
	function __construct($notLogin=false) {
		parent::__construct();
        # 配置参数
        $config = array(
            'token'          => 'jgjcq',
            'appid'          => 'wxb9683d953c243b43',
            'appsecret'      => '1a3631550363b5701a76841ef12a5d8f',
            'encodingaeskey' => '',
            'type'			 => 'user',
        );
        $this->wx_config = $config;
        $this->load->library('Wechat/wechat_oauth', $config);


        $this -> load -> model("User_model");
        $this -> load -> model("Order_detail_model");
        $user = $this->User_model->get_single(array('id'=>1));
        $_SESSION['app_home_session'] = $user;
        if(!$notLogin){
            if(!isset($_SESSION['app_home_session']))
            {
                $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                $retUrl =  $this->wechat_oauth->getOauthRedirect($url,'','snsapi_userinfo');
                redirect($retUrl);
            }
            $this -> checkIsLogin();
            $this->uid = $_SESSION['app_home_session']['id'];
            $blist  = $this->Order_detail_model->getBuyedList($this->uid);
            $this->buyedCourseList = $blist;
            if($blist){
                $bstr = "";
                foreach($blist as $b){
                    $bstr .=$b['id'].',';
                }
                $bstr = substr($bstr,0,strlen($bstr)-1);
                $this->buyedCourseListStr = $bstr;
            }
        }

	}
	//验证是否登录
	protected function checkIsLogin(){
            //$user = $this->User_model->get_single(array('id' => 1));
            //$_SESSION['app_home_session'] = $user;
		   if(!isset($_SESSION['app_home_session']))
			{
				redirect(site_url('Home/Login'));
			}	
	}
	//验证是否单体登录
	protected function checkSingleLogin(){
		if(isset($_SESSION['web_home_session']))
		{
			$this->load->model('User_model');
		    $user=$this->User_model->get_single(array('id'=>$_SESSION['web_home_session']['id']));
		    if($_SESSION['web_home_session']['single_login']!=$user['single_login'])
		    {
		    	
		    	$user_id=$_SESSION['web_home_session']['id'];
		    	session_destroy();
				redirect(site_url('My/Login').'/'.$user_id);
		    }
		}

	}
	protected function getWxInfo(){
			$con = $this->router->fetch_class();//获取控制器名  
			$func = $this->router->fetch_method();//获取方法名  

			$appid = WX_APP_ID;
			if(!isset($_GET['code']))
			{
				$dizhi=urlencode(site_url($con.'/'.$func));
				header('location:https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$dizhi.'&response_type=code&scope=snsapi_userinfo&state=123&connect_redirect=1#wechat_redirect');
			}
			else{
				$code = $_GET['code'];
				$state = $_GET['state'];
				//换成自己的接口信息
				$appid = WX_APP_ID;
				$appsecret = WX_APP_SECRET;
				if (empty($code)) $this->error('授权失败');
				$token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
				$token = json_decode(file_get_contents($token_url));
				if (isset($token->errcode)) {
				    echo '<h1>错误：</h1>'.$token->errcode;
				    echo '<br/><h2>错误信息：</h2>'.$token->errmsg;
				    exit;
				}
				$access_token_url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid='.$appid.'&grant_type=refresh_token&refresh_token='.$token->refresh_token;
				//转成对象
				$access_token = json_decode(file_get_contents($access_token_url));
				if (isset($access_token->errcode)) {
				    echo '<h1>错误：</h1>'.$access_token->errcode;
				    echo '<br/><h2>错误信息：</h2>'.$access_token->errmsg;
				    exit;
				}
				$user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token->access_token.'&openid='.$access_token->openid.'&lang=zh_CN';
				//转成对象
				$user_info = json_decode(file_get_contents($user_info_url));
				if (isset($user_info->errcode)) {
				    echo '<h1>错误：</h1>'.$user_info->errcode;
				    echo '<br/><h2>错误信息：</h2>'.$user_info->errmsg;
				    exit;
				}

				$rs =  json_decode(json_encode($user_info),true);//返回的json数组转换成array数组

				//打印用户信息
				//echo '<pre>';
				// var_dump($token);
				// var_dump($access_token);
				//echo '</pre>';
				//获取open_id对应手机号
				
			}
			// $_SESSION['refresh']=$token->refresh_token;
			return $rs;
		
	}	

}
class ApiHomeController extends MY_Controller{
	function __construct() {
		parent::__construct();
		$this ->isAjax();
	}
	//验证是否ajax
	protected function isAjax() {
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){

		}
		else{
			exit(retJson("非法操作.", false));
		}
	}
	//验证是否登录
	protected function checkIsLogin(){
		   if(!isset($_SESSION['web_home_session']))
			{
				redirect(site_url('My/Login'));				
			}	
	}
	


}

class WxHomeController extends MY_Controller{
	function __construct() {
		parent::__construct();
		$this -> checkIsLogin();
	}
	protected function checkIsLogin(){
		if(!isset($_SESSION['weixin_user']))
		{
			$con = $this->router->fetch_class();//获取控制器名  
			$func = $this->router->fetch_method();//获取方法名  

			$appid = WX_APP_ID;
			if(!isset($_GET['code']))
			{
				$dizhi=urlencode(site_url($con.'/'.$func));
				header('location:https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$dizhi.'&response_type=code&scope=snsapi_userinfo&state=123&connect_redirect=1#wechat_redirect');
			}
			else{
				$code = $_GET['code'];
				$state = $_GET['state'];
				//换成自己的接口信息
				$appid = WX_APP_ID;
				$appsecret = WX_APP_SECRET;
				if (empty($code)) $this->error('授权失败');
				$token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
				$token = json_decode(file_get_contents($token_url));
				if (isset($token->errcode)) {
				    echo '<h1>错误：</h1>'.$token->errcode;
				    echo '<br/><h2>错误信息：</h2>'.$token->errmsg;
				    exit;
				}
				$access_token_url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid='.$appid.'&grant_type=refresh_token&refresh_token='.$token->refresh_token;
				//转成对象
				$access_token = json_decode(file_get_contents($access_token_url));
				if (isset($access_token->errcode)) {
				    echo '<h1>错误：</h1>'.$access_token->errcode;
				    echo '<br/><h2>错误信息：</h2>'.$access_token->errmsg;
				    exit;
				}
				$user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token->access_token.'&openid='.$access_token->openid.'&lang=zh_CN';
				//转成对象
				$user_info = json_decode(file_get_contents($user_info_url));
				if (isset($user_info->errcode)) {
				    echo '<h1>错误：</h1>'.$user_info->errcode;
				    echo '<br/><h2>错误信息：</h2>'.$user_info->errmsg;
				    exit;
				}

				$rs =  json_decode(json_encode($user_info),true);//返回的json数组转换成array数组

				//打印用户信息
				//echo '<pre>';
				// var_dump($token);
				// var_dump($access_token);
				//echo '</pre>';
				//获取open_id对应手机号
				
			}
			// $_SESSION['refresh']=$token->refresh_token;
			$_SESSION['weixin_user']=$rs;
		}
		// $_SESSION['weixin_user']['openid']=1;
	}

}
class AdminController extends MY_Controller{
	function __construct() {
		parent::__construct();
		$this -> checkIsLogin();
		$this->getModuleViewAndCheckRoleModule();
		$this->getQuickEntry();
	}
	//验证是否登录
	protected function checkIsLogin(){
		   if(!isset($_SESSION[SESS_USER]))
			{
				$url=base_url().'Admin/Login';
				redirect($url);
				
			}	
	}

	//获取用户角色所对应的已有权限数组，用于显示菜单
	protected function getModuleViewAndCheckRoleModule(){
		$this->load->model('Admin_model');
		$admin_id=$_SESSION[SESS_USER]['id'];
		$admin=$this->Admin_model->get_single(array('id'=>$admin_id));
		$role_id=$admin['role_id'];
		$sub_role_id=$admin['sub_role_id'];
		//加载缓存类
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		if(!$module = $this->cache->get('module'.$admin_id))
		{
			if($role_id==1){
				$this -> load -> model("Module_model");			
				$module=$this->Module_model->get_list(array());
			}
			else{
				if($sub_role_id&&$sub_role_id!=''){
					$role_id_array=explode(',',$sub_role_id);
					$role_id_array[]=$role_id;
					$role_id_str=implode(',',$role_id_array);
					$select_sql="select distinct m.* from db_role_module r left join db_module m on m.id=r.module_id where r.role_id in (".$role_id_str.")";
				}
				else{
					$select_sql="select m.* from db_role_module r left join db_module m on m.id=r.module_id where r.role_id={$role_id}";
				}
				$this -> load -> model("Role_module_model");		
				$module=$this->Role_module_model->query($select_sql);
			}
			
			$this->cache->save('module'.$admin_id,$module,0);
		}
		$module=$this->cache->get('module'.$admin_id);
		if($module)
		{
			$modele_ename=array_column($module,'ename');
			$module=arraySequence($module,'order');
			$module=listToTree($module);
			$module=arraySequence($module,'order');
		}
		
		$this->load->vars('module',$module);
		//权限验证部分
		$controller = $this->router->fetch_class();
		$func = $this->router->fetch_method();
		if(!in_array($controller.'/'.$func,$modele_ename))
		{
			$is_ajax=isAjax();
			if($is_ajax){
				exit(retJson("您没有该操作权限！", false));
			}
			else{
				exit('您没有该模块权限！');
			}
			
		}
	}
}


class AdminTwoController extends MY_Controller{
	function __construct() {
		parent::__construct();
		$this -> checkIsLogin();
		$this->getModuleViewAndCheckRoleModule();
		$this->getQuickEntry();
	}
	//验证是否登录
	protected function checkIsLogin(){
		   if(!isset($_SESSION[SESS_USER]))
			{
				$url=base_url().'Admin/Login';
				redirect($url);
				
			}	
	}
	//获取用户角色所对应的已有权限数组，用于显示菜单
	protected function getModuleViewAndCheckRoleModule(){
		$this->load->model('Admin_model');
		$admin_id=$_SESSION[SESS_USER]['id'];
		$admin=$this->Admin_model->get_single(array('id'=>$admin_id));
		$role_id=$admin['role_id'];
		$sub_role_id=$admin['sub_role_id'];
		//加载缓存类
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		if(!$module = $this->cache->get('module'.$admin_id))
		{
			if($role_id==1){
				$this -> load -> model("Module_model");			
				$module=$this->Module_model->get_list(array());
			}
			else{
				if($sub_role_id&&$sub_role_id!=''){
					$role_id_array=explode(',',$sub_role_id);
					$role_id_array[]=$role_id;
					$role_id_str=implode(',',$role_id_array);
					$select_sql="select distinct m.* from db_role_module r left join db_module m on m.id=r.module_id where r.role_id in (".$role_id_str.")";
				}
				else{
					$select_sql="select m.* from db_role_module r left join db_module m on m.id=r.module_id where r.role_id={$role_id}";
				}
				$this -> load -> model("Role_module_model");		
				$module=$this->Role_module_model->query($select_sql);
			}
			
			$ret = $this->cache->save('module'.$admin_id,$module,0);
		}
		$module=$this->cache->get('module'.$admin_id);
		if($module)
		{
			$modele_ename=array_column($module,'ename');
			$module=arraySequence($module,'order');
			$module=listToTree($module);
			$module=arraySequence($module,'order');
		}
		$this->load->vars('module',$module);
		
	}
}


