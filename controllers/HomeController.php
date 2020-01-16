<?php

class HomeController extends Controller {
  /**
   * Default home controller index function
   */
	public function index() {
	  $this->render('home/index');
	}

	public function login() {
	  $this->render('home/login');
	}


	     
   public function getAllCount() {
	$obj = $this->loadModel('DashboardModel');
	$data = $obj->getAllCounts();
	return $data;
	
	}
        
	


}
