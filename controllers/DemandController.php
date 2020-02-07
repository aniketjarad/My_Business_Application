<?php

class DemandController extends Controller {
  /**
   * Default home controller index function
   */
	public function index() {
	  $this->render('demand/index');
	}

	public function archieve() {
	  $this->render('demand/archieve');
	}

	public function add() {
		$data = $_POST;
		$files = $_FILES;
		$obj = $this->loadModel('DemandModel');
		$response = $obj->addDemand($data,$files);
		if($response['status'] == 'success') {
		  	$result = ['status' => 'success' , 'data' => $response['data']];
		}else{
			$result = ['status' => 'error','data' => $response['data']];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
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

	public function getAll(){
		$obj = $this->loadModel('DemandModel');
		$response['count'] = $obj->getDemandCount();
		$response['data'] = $obj->getAll();
		return $response;
	}

	public function getAllArchieve(){
		$obj = $this->loadModel('DemandModel');
		//$response['count'] = $obj->getDemandCount();
		$response['data'] = $obj->getAllArchieve();
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

	public function get() {
		$demand_id = $_POST['demand_id'];
		$result = array();
		$obj = $this->loadModel('DemandModel');
		$response = $obj->get($demand_id);
		if($response) {
		  	$result = ['status' => 'success' , 'data' => $response];
		}else{
			$result = ['status' => 'error','data' => ""];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}
}
