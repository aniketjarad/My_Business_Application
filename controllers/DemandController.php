<?php

class DemandController extends Controller {
  /**
   * Default home controller index function
   */
	public function index() {
	  $this->render('demand/index');
	}

	public function add() {
		$data = $_POST;
		$files = $_FILES;
		$obj = $this->loadModel('DemandModel');
		$response = $obj->addDemand($data,$files);
		
		exit(0);
	}
	public function getInActiveEmployee(){
		$obj = $this->loadModel('EmployeeModel');
		$response = $obj->getInActiveEmployee();
		if($response) {
		  	$result = ['status' => 'success' , 'data' => $response];
		}else{
			$result = ['status' => 'error','data' => ""];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function getDemandCount(){
		$obj = $this->loadModel('DemandModel');
		$response = $obj->getDemandCount();
		return $response;
	}

	public function getDemand() {
		$result = array();
		$obj = $this->loadModel('DemandModel');
		$response = $obj->getDemand();
		if($response) {
		  	$result = ['status' => 'success' , 'data' => $response];
		}else{
			$result = ['status' => 'error','data' => ""];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	public function getAll() {
		$obj = $this->loadModel('EmployeeModel');
		$data = $obj->getAll();
		return $data;
	}
}
