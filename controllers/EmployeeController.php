<?php

class EmployeeController extends Controller {
  /**
   * Default home controller index function
   */
  public function index() {
	  $this->render('employee/index');
  }

  public function employee_master() {
	  //$this->render('home/employee');
  }


}