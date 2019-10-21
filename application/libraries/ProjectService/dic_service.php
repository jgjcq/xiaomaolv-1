<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dic_service{
	private $CI;
	function __construct() { 
		$this->CI = &get_instance();
	}
	//获取dic数据
	public function getWebConfig($key,$type=false) {
		if(is_array($key))
		{	
			if(count($key)!=0){
				$key = "'".str_replace(",","','",join(",",$key))."'";
				$sql="select * from db_dic where dic_key in (".$key.")";
			}
			else{
				$sql="select * from db_dic where 1=1 ";
			}
			if($type){
				$sql.=" and type='".$type."'";
			}
			$data1=$this->CI->db->query($sql)->result_array();
			$data=array();
			foreach ($data1 as $k => $v) {
				$data[$v['dic_key']]=$v;
			}
		}
		else
		{	
			if($type){
				$sql="select * from db_dic where dic_key='".$key."' and type='".$type."' ";
			}
			else{
				$sql="select * from db_dic where dic_key='".$key."' ";
			}
			$data=$this->CI->db->query($sql)->row_array();
		}

		if($data)
		{
			return $data;
		}
		else{
			return array();
		}	
	}

	//dic批量添加(包含删除原数据)
	public function addWebConfig($type,$array,$del=true){
		if($del){
			$this->CI->db->query("delete from db_dic where type='".$type."' ");
		}
		$add_sql=" insert into db_dic (type,dic_key,dic_value,caption) values ";
		foreach ($array as $k => $v) {
			if($k!=0){
				$add_sql.=" , ";
			}
			$add_sql.=" ('".$v['type']."','".$v['dic_key']."','".$v['dic_value']."','".$v['caption']."') ";
		}
		$this->CI->db->query($add_sql);
	}

	
	
}