<?php
// load application config
require 'config/config.php';

// load application class
require_once('libs/request.php');
require_once('libs/application.php');
// require_once 'libs/application.php';
require_once 'libs/controller.php';

// start the application
Application::route(new Request);