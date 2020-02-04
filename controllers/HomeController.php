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
	public function forgotpassword() {
	  $this->render('home/forgotpassword');
	}

	     
   public function getAllCount() {
	$obj = $this->loadModel('DashboardModel');
	$data = $obj->getAllCounts();
	// print_r($data);
	// exit(0);

	return $data;
	
	}
     
    public function getModulesChart() {
	$obj = $this->loadModel('DashboardModel');
	$data = $obj->getModulesChartDetails();
	// return $data;
	header('Content-Type: application/json');
		echo json_encode($data);
	
	}
	


}
