<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Home extends AdminController {

	function __construct() {
		parent::__construct();
		$this -> sidebar = "Overview-Home";
		
	}

	function Index() {
		
		$this->load->view('admin/home');

		

	}
	
	

}
