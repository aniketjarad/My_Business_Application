<?php

/**
 * This is the "base controller class".
 */
class Controller {
    public $db = null;
    /**
    * Create database connection
    */
    function __construct() {
        session_start();
        $this->openDatabaseConnection();
    }

    /**
    * Database connection
    */
    private function openDatabaseConnection() {
        $this->db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Check connection
        if (mysqli_connect_errno())
        {
          
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }
    }

    /**
    * Load database model
    */
    public function loadModel($model_name) {
        require 'models/' . $model_name . '.php';
        // return new model (and pass the database connection to the model)
        return new $model_name($this->db);
    }

    /**
    * Render html view pages
    */
    public function render($path,array $vars = null) {
        $file = 'view/'.$path.'.php';

        if(is_readable($file)){
            if(isset($vars)){
                extract($vars);
            }
            // render view file with layout
            require 'view/layout/header.php';
            if(isset($_SESSION['emp_code'])){
                require 'view/layout/navigation.php';
            }
            require $file;

            if(isset($_SESSION['emp_code'])){
                require 'view/layout/nav-footer.php';
            }
            require 'view/layout/footer.php';
            return true;
        }
        throw new Exception('View issues');
    }
}
