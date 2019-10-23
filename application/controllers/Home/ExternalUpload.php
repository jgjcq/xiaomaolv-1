<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExternalUpload extends HomeController {

	function __construct() { 
		parent::__construct();
	}

	public function Index() {
		
		$this -> load -> view('Home/upload');
	}
	
	
}