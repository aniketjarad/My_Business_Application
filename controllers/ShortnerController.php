<?php
class ShortnerController extends Controller {
	/**
 	* Show URLs page
 	*/
  public function index() {
  	//$this->render('URLs/index');
  }

  /**
 	* Get all URLs data
 	*/
  public function getURLs() {
  	$model = $this->loadModel('URLModel');
    $URLs = $model->getAll();

    if ($URLs) {
    	$result = ['status' => 'success', 'data' => $URLs, 'msg' => 'Data found.'];
    }else{
    	$result = ['status' => 'error', 'data' => '', 'msg' => 'Data not found.'];
    }
    header('Content-Type: application/json');
		echo json_encode($result);
  }

  /**
 	* Insert URLs
 	*/
  public function save() {
    
  	$long_url = $_POST['long_url'];
    
  	$model = $this->loadModel('URLModel');
    $short_url = $model->addURL($long_url);
    
    if ($short_url) {
      $result = ['status' => 'success' , 'data' => $short_url];
    }else{
    	$result = ['status' => 'error'];
    }
    header('Content-Type: application/json');
		echo json_encode($result);
  }


  /**
  * Insert URLs
  */
  public function decode() {
    $short_url = str_ireplace('/shortner/decode/','', $_SERVER['REQUEST_URI']);
    $model = $this->loadModel('URLModel');
    $result = $model->whereURL(['short_url' => $short_url]);
    header("location:".$result['long_url']);
  }

}
