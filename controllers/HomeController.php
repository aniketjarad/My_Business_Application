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


	public function snowhome() {
	  $this->render('home/snowhome');
	}
	public function rpa() {
	  $this->render('home/rpa');
	}
	public function infra() {
	  $this->render('home/infra');
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

	public function getAllCountinfra() {
	$obj = $this->loadModel('DashboardModel');
	$data = $obj->getAllCountsinfra();
	// print_r($data);
	// exit(0);

	return $data;
	
	} 
  /* public function getAllCount() {
	$obj = $this->loadModel('DashboardModel');
	$data = $obj->getAllCounts();
	// print_r($data);
	// exit(0);

	return $data;
	
	}*/
     
 	/*public function getAllCounts() {
	$obj = $this->loadModel('DashboardModel');
	$data = $obj->getAllCounts();
	// print_r($data);
	// exit(0);

	return $data;
	
	}*/

    public function getModulesChart() {
	$obj = $this->loadModel('DashboardModel');
	$data = $obj->getModulesChartDetails();
	// return $data;
	header('Content-Type: application/json');
		echo json_encode($data);
	
	}
	


}
