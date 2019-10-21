<?php
class BaseModel extends CI_Model {
	protected $table;
	function __construct() {
		parent::__construct();
	}

	/**
	 * 普通sql查找
	 */
	public function query($sql,$is_select=true) {
		log_info($sql);
		if($is_select)
		{
			return $this -> db -> query($sql) -> result_array();
		}
		else
		{
			return $this -> db -> query($sql);
		}
		
	}

	/**
	 * 查找单条数据
	 */
	public function single($sql) {
		log_info($sql);
		$query = $this -> db -> query($sql);
		$row = $query -> first_row();
		if (isset($row)) {
			return $row;
		}
		return null;
	}

	/**
	 * update自定义语句
	 */
	public function execute($sql) {
		log_info($sql);
		 $this -> db -> query($sql);
		log_info($this -> db -> last_query());
		 return "";
	}

	/**
	 * 获取单条数据(全)
	 */
	public function get_single_full($conarr) {
		$this -> checkParams($conarr);
		$v =  $this -> db -> get() -> row_array();
		log_info($this -> db -> last_query());
		return $v;
	}

	/**
	 * 获取单条数据（简易）
	 */
	public function get_single($cond) {
		$conarr['cond'] = $cond;
		$this -> checkParams($conarr);
		return $this -> db -> get() -> row_array();
	}

	/**
	 * 批量添加信息
	 */
	public function add_batch($datas) {
		$this -> db -> insert_batch($this -> table, $datas);
	}

	/**
	 * 增加一条信息
	 */
	public function add($data) {
		$this -> db -> insert($this -> table, $data);
		return $this -> db -> insert_id();
	}


	/**
	 * 根据ID查找修改数据
	 */
	public function update($data,$key = "id") {
		$this -> db -> where($key, $data[$key]);
		
		return $this -> db -> update($this -> table, $data);

	}

	/**
	 * 批量更新
	 * @param $title 条件
	 */
	public function update_batch($data, $title) {
		return $this -> db -> update_batch($this -> table, $data, $title);
	}

	/**
	 * 根据条件删除信息
	 *
	 */
	public function delBatch($where) {
		$this -> db -> delete($this -> table, $where);
		return $this -> db -> affected_rows();
	}

	/**
	 * 删除
	 */
	public function delete($ids, $is_array = false) {
		if (!$is_array) {
			return $this -> delBatch("id = " . $ids);
		} else {
			$str_ids = implode(',', $ids);
			return $this -> delBatch("id in (" . $str_ids . ")");
		}
	}

	/**
	 * 简易版-get_list
	 */
	public function get_list($cond, $orderby = 'id asc', $where = '') {
		$conarr = array();
		$conarr['cond'] = $cond;
		$conarr['orderby'] = $orderby;
		if ($where!="")
			$conarr['where'] = $where;
		return $this -> get_list_full($conarr);
	}

	/**
	 * 根据条件查询列表信息
	 * where 可以用array，可以用 长字符串，可以用array 中加入>,like 等
	 * spec_where 可以用于特殊语句的where
	 */
	public function get_list_full($conarr = array()) {
		$conarr = $this -> checkParams($conarr);
		$datas = $this -> db -> get() -> result_array();
		log_info($this -> db -> last_query());
		return $datas;
	}

	public function get_count($cond = array()) {
		$conarr = array();
		$conarr['cond'] = $cond;
		return $this -> get_count_full($conarr);
	}

	/**
	 * 根据条件查询count
	 * conarr 可以用array，可以用 长字符串，可以用array 中加入>,like 等
	 * where 可以用于特殊语句
	 */
	public function get_count_full($conarr = array()) {
		$conarr['items'] = "count(*) as num";
		$conarr['isCount'] = true;
		$this -> checkParams($conarr);
		$num = $this -> db -> get() -> first_row() -> num;
		log_info($this -> db -> last_query());
		return $num;
	}

	/**
	 * 获取分页
	 * 默认pagesize=10
	 * @param array $conarr 条件数组
	 */
	public function get_page_list($conarr = array()) { 
		//总数量
		$data["count"] = $this -> get_count_full($conarr);

		$conarr = $this -> checkParams($conarr);
		//总页数
		$data["totalPage"] = ceil($data["count"] / $conarr['pageSize']);
		$data['pageNo'] = $conarr['pageNo'];
		$data["ret"] = $this -> db -> get() -> result_array();
		log_info($this -> db -> last_query());
		return $data;
	}

	private function checkParams($conarr = array()) {

		//查询项
		if (isset($conarr['items'])) {
			$this -> db -> select($conarr['items']);
		} else {
			$this -> db -> select("*");
		}
		//groupby
		if (isset($conarr['groupby'])) {
			$this -> db -> group_by($conarr['groupby']);
		}

		//table名
		$this -> db -> from($this -> table);

		//join
		if (!empty($conarr['join'])) {
			if (count($conarr['join'])==count($conarr['join'], 1)) {
				//一维数组
				if (!isset($conarr['join'][2])) {
					$conarr['join'][2] = "left";
				}
				$this -> db -> join($conarr['join'][0], $conarr['join'][1], $conarr['join'][2]);
			} else {
				//多维数组
				foreach ($conarr['join'] as $j) {
					if (!isset($j[2])) {
						$j[2] = "left";
					}
					$this -> db -> join($j[0], $j[1], $j[2]);
				}
			}
		}

		//普通条件
		if (isset($conarr['cond'])) {
			$this -> db -> where($conarr['cond']);
		}

		//like語句
		if (isset($conarr['like'])) {
			foreach ($conarr['like'] as $key => $v) {
				if (!isset($v[1])) {
					$v[1] = 'both';
				}
				$this -> db -> like($key, $v[0], $v[1]);
			}
		}

		//特殊where条件
		if (isset($conarr['where'])) {
			$this -> db -> where($conarr['where']);
		}

		//如果是计数，则不进行排序和分页
		if (!isset($conarr['isCount'])) {
			//排序
			if (isset($conarr['orderby'])) {
				$this -> db -> order_by($conarr['orderby']);
			}

			//分页
			if (isset($conarr['pageNo'])) {
				$this -> db -> limit($conarr['pageSize'], $conarr['pageSize'] * ($conarr['pageNo'] - 1));
			}
		}

		return $conarr;
	}

	/**
	 * 簡易版挑選所有的参数（单表操作的时候）
	 */
	public function pickAllParams($params) {
		$connar = array();
		foreach ($params as $key => $value) {
			if($key == "pageNo"){
				$connar['pageNo'] = $value;
				continue;
			}else if($key == "pageSize"){
				$connar['pageSize'] = $value;
				continue;
			}
			
			if (strstr($key, '_')) {
				$connar['like'][substr($key, 1)] = $value;
			} else {
				$connar['cond'][$key] = $value;
			}
		}
		return $connar;
	}

	/**
	 * 多表时，对单个条件进行分类。
	 */
	public function pickParam($conarr, $params, $key, $item = "", $isLike = true) {
		if($item == ""){
			$item = $key;
		}
		if (!isset($params[$item])) {
			return $conarr;
		}
		if ($isLike) {
			$conarr['like'][$key] = array($params[$item]);
		} else {
			$conarr['cond'][$key] = $params[$item];
		}

		return $conarr;
	}

	//分割分頁數據
	public function pickPages($conarr, $params) {
		$conarr['pageNo'] = $params['pageNo'];
		$conarr['pageSize'] = $params['pageSize'];
		return $conarr;
	}

	//日期比较
	public function dateBet($item, $params, $startkey, $endkey, $formatter = '%Y-%m-%d %H:%i:%s') {
		$where = ' (1=1 ';
		if (isset($params[$startkey])) {
			$where .= " and " . $item . " >= STR_TO_DATE('" . $params[$startkey] . "','" . $formatter . "') ";
		}

		if (isset($params[$endkey])) {
			$where .= " and " . $item . " <= STR_TO_DATE('" . $params[$endkey] . "','" . $formatter . "') ";
		}

		$where .= ' )';

		return $where;
	}

}
?>