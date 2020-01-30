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
	public function skillmatrix() {
		$this->render('employee/skillmatrix');
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
	public function getAllSkill() {
		$obj = $this->loadModel('SkillMatrixModel');
		$data = $obj->getAllSkills();
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
	/**
	Skill Matrix
	**/
 	public function getSkillList() {
			
		// print_r("sdasd");
		// exit(0);
		$model = $this->loadModel('AllSkillsModel');
		$response = $model->getAllSkillsList();
		
		if($response['status'] == 'success') {
			
		  	$result = ['status' => 'success' , 'data' =>$response['response']];
		  
		}else{
			$result = ['status' => 'error','data' => 'Please Contact Admin'];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	/**
 	* Insert Users Skill
 	*/
	public function addSkillSets() {
		$data = $_POST;
		$model = $this->loadModel('AllSkillsModel');
		$response = $model->addEmployeeSkill($data);

		if($response['status'] == 'success') {
		  	$result = ['status' => 'success' , 'data' =>$response['response']];
		}else{
			$result = ['status' => 'error','data' =>$response['response']];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	public function addNewSkill() {
		$data = $_POST;
		$model = $this->loadModel('AllSkillsModel');
		$response = $model->addCustomSkills($data);
		// print_r($response);
		if($response['status'] == 'success') {
		  	$result = ['status' => 'success' , 'data' =>$response['response']];
		}else{
			$result = ['status' => 'error','data' => $response['response']];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	public function deleteSkill() {
		$data = $_POST;
		$model = $this->loadModel('AllSkillsModel');
		$response = $model->deleteSkillRecord($data);
		if($response['status'] == 'success') {
		  	$result = ['status' => 'success' , 'data' =>$response['response']];
		}else{
			$result = ['status' => 'error','data' => $response['response']];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	//Get skill data for edit
	public function getEmpSkill() {
		$data = $_POST;
		$model = $this->loadModel('AllSkillsModel');
		$response = $model->getEmpSkillRecord($data);
		 // echo '<pre>';
   //      print_r($response);
   //      echo '</pre>';
		if($response['status'] == 'success') {
		  	$result = ['status' => 'success' , 'data' =>$response['response'] , 'selectedVal' =>$response['selectedVal']];
		}else{
			$result = ['status' => 'error','data' => $response['response']];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	// public function getAllCertificationDetails() {
	// 	// print_r("inthe controller");
	// 	$obj = $this->loadModel('CertificationCategoryModel');
	// 	$data = $obj->getAllCertificationList();
	// 	return $data;
	// }
	//Add new certificaton Category
	public function add_new_certi_category() {
		$data = $_POST;
		$model = $this->loadModel('CertificationCategoryModel');
		$response = $model->addNewCertCatMod($data);
		// print_r($response);
		if($response['status'] == 'success') {
		  	$result = ['status' => 'success' , 'data' =>$response['response']];
		}else{
			$result = ['status' => 'error','data' => 'Please Contact Admin'];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	//Get the certification Category on Page Load
	public function getCertCategory() {
		
		$model = $this->loadModel('CertificationCategoryModel');
		$response = $model->getUniqueCertCategory();
		// print_r($response);
		// exit(0);
		if($response) {
		  	$result = ['status' => 'success' , 'data' =>$response];
		}else{
			$result = ['status' => 'error','data' => 'Please Contact Admin'];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	public function certification_category() {
		$data = $_POST;		
		$result = array();
		$model = $this->loadModel('CertificationCategoryModel');
		$response = $model->getAllCertificationList($data);
		//print_r($response);
		if($response['response']['status'] == 'success') {
			//echo "status is iucess";
		  	$result = ['status' => 'success' , 'data' =>$response['result']];
		}else{
			//echo "status is failed";
			$result = ['status' => 'error','data' => 'Please Contact Admin'];
		}
		//echo "====>".$result;
		header('Content-Type: application/json');
		//$result = json_encode($result);
		echo json_encode($result);
	}


	public function add_certification() {
		$data = $_POST;
		// print_r("expression");	
		// print_r($data);
		// exit(0);
		$model = $this->loadModel('CertificationCategoryModel');
		$response = $model->addEmployeeCertificate($data);

		if($response['status'] == 'success') {
		  	$result = ['status' => 'success' , 'data' =>$response['response']];
		}else{
			$result = ['status' => 'error','data' => 'Please Contact Admin'];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	public function deleteCertification() {
		$data = $_POST['POST'];
		
		
		$model = $this->loadModel('CertificationCategoryModel');
		$response = $model->delteEmployeeCertificate($data);
		// print_r($response);
		// exit(0);
		if($response['status'] == 'success') {
		  	$result = ['status' => 'success' , 'data' =>$response['response']];
		}else{
			$result = ['status' => 'error','data' => 'Please Contact Admin'];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	public function deleteEmpCert() {
		$data = $_POST['emp_code'];
		// print_r($data);
		// exit(0);
		
		$model = $this->loadModel('CertificationCategoryModel');
		$response = $model->delteEmpCertRec($data);
		// print_r($response);
		// exit(0);
		if($response['status'] == 'success') {
		  	$result = ['status' => 'success' , 'data' =>$response['response']];
		}else{
			$result = ['status' => 'error','data' => 'Please Contact Admin'];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}


}