<?php

class EmployeeController extends Controller {
  /**
   * Default home controller index function
   */
	public function index() {
		$this->render('employee/index');
	}

	public function certification() {
		$this->render('employee/certification');
	}

	public function getAll() {
		$obj = $this->loadModel('EmployeeModel');
		$data = $obj->getAll();
		return $data;
	}
	public function getAllCertification() {
		$obj = $this->loadModel('CertificationModel');
		$data = $obj->getAllCertifications();
		return $data;
	}
	public function getAllManager() {
		$obj = $this->loadModel('EmployeeModel');
		$data = $obj->getAllManagers();
		$return = array();
		foreach ($data as $key => $manager) {
				$return[$key] = $manager['emp_name'];
		}
		return $return;
	}

	public function get() {
		$obj = $this->loadModel('EmployeeModel');
		$managers = $obj->getAllManagers();
		$managers_new= array();
		foreach ($managers as $key => $manager) {
				$managers_new[$key] = $manager['emp_name'];
		}
		
		$array = array();

		$array['emp_code'] = $_POST['emp_code'];
		$data = $obj->whereEmployee($array);
		//print_r($data);exit(0);
		if($data) {
		  	$result = $data;
		  	$result['managers'] = $managers_new;
		}else{
			$result = ['status' => 'error', 'response' => 'Error...! Please Check with Admin.'];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	public function register() {
		$this->render('employee/register');
	}
	/**
 	* Insert users
 	*/
	public function save() {
		$data = $_POST;
		$model = $this->loadModel('EmployeeModel');
		$response = $model->addEmployee($data);
		if($response['status'] == 'success') {
		  	$result = ['status' => 'success' , 'data' => $response['response']];
		}else{
			$result = ['status' => 'error','data' => $response['response']];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	/**
 	* Insert users
 	*/
	public function update() {
		$data = $_POST;

		$model = $this->loadModel('EmployeeModel');
		$response = $model->updateEmployee($data);

		if($response['status'] == 'success') {
		  	$result = ['status' => 'success' , 'data' =>$response['response']];
		}else{
			$result = ['status' => 'error','data' => 'Please Contact Admin'];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}
}