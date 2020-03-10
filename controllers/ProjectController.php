<?php

class ProjectController extends Controller {
  /**
   * Default home controller index function
   */
	public function index() {
	  $this->render('project/projects');
	}

	public function purchaseorder() {
	  $this->render('project/purchaseorder');
	}

	public function getAllProject() {

		$obj = $this->loadModel('ProjectModel');
		$data = $obj->getAllProjects();
		return $data;
	}
	public function addNewProject() {
		

		$data = $_POST;
		$model = $this->loadModel('ProjectModel');
		$response = $model->addNewProjects($data);
		// print_r($response);
		if($response['status'] == 'success') {
		  	$result = ['status' => 'success' , 'data' =>$response['response']];
		}else{
			$result = ['status' => 'error','data' => 'Please Contact Admin'];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	
	}

	public function editProjects() {
		
		
		$data = $_POST;
		// print_r($data);
		// exit();
		$model = $this->loadModel('ProjectModel');
		$response = $model->editGetProject($data);
		// print_r($response);
		if($response['status'] == 'success') {
		  	$result = ['status' => 'success' , 'data' =>$response['response']];
		}else{
			$result = ['status' => 'error','data' => 'Please Contact Admin'];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	
	}
	/*gets tet list of projects from Project Table*/
	public function getProjectList() {
		
		
		// $data = $_POST;
		print_r("asas");
		exit(0);
		// $model = $this->loadModel('ProjectModel');
		// $response = $model->editGetProject($data);
		// // print_r($response);
		// if($response['status'] == 'success') {
		//   	$result = ['status' => 'success' , 'data' =>$response['response']];
		// }else{
		// 	$result = ['status' => 'error','data' => 'Please Contact Admin'];
		// }
		// header('Content-Type: application/json');
		// echo json_encode($result);
	
	}

	/*Putrhcase Order Function*/
	public function getAllPurchaseOrderDetails() {

			$obj = $this->loadModel('PurchaseOrderModel');
			$data = $obj->getAllPurchaseOrder();
			return $data;
		}

	public function addNewPO() {
		

		$data = $_POST;
		// print_r($data);
		// exit(0);
		$model = $this->loadModel('PurchaseOrderModel');
		$response = $model->addNewPurchaseOrder($data);
		// print_r($response);
		if($response['status'] == 'success') {
		  	$result = ['status' => 'success' , 'data' =>$response['response']];
		}else{
			$result = ['status' => 'error','data' => 'Please Contact Admin'];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	
	}
	public function editPurchaseOrder() {
		
		
		$data = $_POST;
		// print_r($data);
		// exit();
		$model = $this->loadModel('PurchaseOrderModel');
		$response = $model->editGetPurchaseOrder($data);
		// print_r($response);
		if($response['status'] == 'success') {
		  	$result = ['status' => 'success' , 'data' =>$response['poId']];
		}else{
			$result = ['status' => 'error','data' => 'Please Contact Admin'];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	
	}

	public function deletePurchaseOrder() {
		
		
		$data = $_POST;
		// print_r($data);
		// exit();
		$model = $this->loadModel('PurchaseOrderModel');
		$response = $model->deletePurchaseOrderRecord($data);
		// print_r($response);
		if($response['status'] == 'success') {
		  	$result = ['status' => 'success' , 'data' =>$response['response']];
		}else{
			$result = ['status' => 'error','data' => 'Please Contact Admin'];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	
	}





}