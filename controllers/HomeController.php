<?php

class HomeController extends Controller {
  /**
   * Default home controller index function
   */
  public function index() {
	  $this->render('home/index');
  }

  public function signup() {
	  $this->render('home/signup');
  }


}
