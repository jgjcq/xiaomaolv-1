<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DoTime extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> model("Admin_model");
        $this -> load -> model("Order_detail_model");
	}

	public function Index() {
		$list = $this->Order_detail_model->getTxList();
		var_dump($list);
	}

}