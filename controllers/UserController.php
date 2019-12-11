<?php
class UserController extends Controller {
  /**
   * Default user controller index function
   */
	public function index() {
	  $this->render('user/signup');
	}
	/**
 	* Insert users
 	*/
	public function save() {
		$data = $_POST;
		
		$model = $this->loadModel('UserModel');
		$response = $model->addUser($data);

		if($response) {
		  	$result = ['status' => 'success' , 'data' => $response];
		}else{
			$result = ['status' => 'error'];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	/**
 	* login user
 	*/
	public function login() {
		$data = array();
		$data['email_id'] = $_POST['email'];
		$data['password'] = base64_encode($_POST['pass-key']);

		$model = $this->loadModel('UserModel');
		$response = $model->checkLogin($data,1,0);
		//print_r($response);exit;
		if($response) {
		  	$result = $response;
		}else{
			$result = ['status' => 'error', 'response' => 'Error...! Please Check with Admin.'];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	public function logout() {
		$result = "";
		if(session_destroy()) {
		  	$result = ['status' => 'success', 'response' => 'Logout successfully.'];
		}else{
			$result = ['status' => 'error', 'response' => 'Error...! Please Check with Admin.'];
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}
}