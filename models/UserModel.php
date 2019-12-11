<?php

class UserModel {
    /**
     * Check database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get all data from URLs
     */
    public function getAll()
    {
        $sql = "select * from users";
        $result = mysqli_query($this->db, $sql);
        $count = 1;
        while($array = mysqli_fetch_object($result)){
            $row->{$count} = $array;
            $count++;
        }
        return $row;
    }

    /**
     * Insert record in URLs table
     */
    public function addUser($data)
    {   
        $result = array();
        // clean the input from javascript code for example
        $email_id = strip_tags($data['email']);
        
        $json_data = $this->checkExisting($email_id);
        //print_r($json_data);
        if($json_data){
            $json_data = json_decode($json_data,true);
            
            if(empty($json_data['users']) && $json_data['emp_master']['is_manager'] == 1&& $json_data['emp_master']['active'] == 1){ // Signup Case
                $sql = "INSERT INTO users (`email_id`,`wiw_id`,`password`) VALUES ('".$email_id."','".$json_data['emp_master']['wiw_id']."','".base64_encode($data['pass-key'])."')";
                
                mysqli_query($this->db, $sql);
                $result['status'] = "success";
                $result['response'] = "Registered Successfully.";
            }else if(empty($json_data['users']) && $json_data['emp_master']['is_manager'] == 0){
                $result['status'] = "error";
                $result['response'] = "Sorry...! You are not Manager.";
            }else if(!empty($json_data['users']['email_id'])){ // Reset Password case.
                $result['status'] = "error";
                $result['response'] = "User Already Exists.";
            }else if(!empty($json_data['users']) && $json_data['emp_master']['active'] == 0){
                $result['status'] = "error";
                $result['response'] = "User is not Active.";
            }
        }
        
        return $result;
    }

    /**
     * Where query for URLs table
     */
    public function whereUser($array,$login,$signup)
    {
        //print_r($array);exit;
        $return = [];
        $cond_string = '';
        foreach($array as $key => $value) {
            $cond_string .= $key.'= "'.$value.'" and ';
        }
        $cond_string = trim($cond_string,' and ');
        
        if($signup){
            $sql = "SELECT `email_id` FROM users WHERE ".$cond_string;
            $sql_emp = "SELECT * FROM emp_master WHERE ".$cond_string;
            $result = mysqli_query($this->db, $sql);
            $result_emp = mysqli_query($this->db, $sql_emp);
            $return['users'] = mysqli_fetch_assoc($result);
            $return['emp_master'] = mysqli_fetch_assoc($result_emp);
        }elseif ($login) {
            $sql = "SELECT `email_id` FROM users WHERE ".$cond_string;
            $sql_emp = "SELECT * FROM emp_master WHERE `email_id`='".$array['email_id']."'";
            $result = mysqli_query($this->db, $sql);
            $result_emp = mysqli_query($this->db, $sql_emp);
            $return['users'] = mysqli_fetch_assoc($result);
            $return['emp_master'] = mysqli_fetch_assoc($result_emp);
        }
        
        return $return;
    }
    /**
     * updateWhere query for URLs table
     */
    public function updateWhere($long_url,$short_url)
    {
        
        $sql = "UPDATE `Users` SET `short_url`='".$short_url."'WHERE `long_url`='".$long_url."'";

        $result = mysqli_query($this->db, $sql);

        return mysqli_fetch_object($result);
    }


    public function checkExisting($email) {
        $return_obj = $this->whereUser(['email_id'=> $email],0,1);
        
        if ($return_obj) {
            $result = json_encode($return_obj);
        }else{
            $result = false;
        }
        
        return $result;
    }


    public function checkLogin($data) {
        $return_obj = $this->whereUser($data,1,0);
        $result = array();
        if($return_obj){
            
            if(!empty($return_obj['users']) && $return_obj['users']['email_id'] == $data['email_id'] && $return_obj['emp_master']['active'] == 1 && $return_obj['emp_master']['is_manager'] == 1){ // Signup Case
                $result['status'] = "success";
                $result['response'] = "Login Successfully.";
                session_start();
                $_SESSION['emp_code'] = $return_obj['emp_master']['emp_code'];
                $_SESSION['emp_name'] = $return_obj['emp_master']['emp_name'];
            }else if(empty($return_obj['users']) && (($return_obj['emp_master']['active'] == 0)||($return_obj['emp_master']['active'] == 1))){ // Reset Password case.
                $result['status'] = "error";
                $result['response'] = "Invalid Password.";
            }else if(!empty($return_obj['users']) && $return_obj['emp_master']['active'] == 0){
                $result['status'] = "error";
                $result['response'] = "User is not Active.";
            }else{
                $result['status'] = "error";
                $result['response'] = "Invalid User or Password.";
            }
        }
        return $result;
    }

}
