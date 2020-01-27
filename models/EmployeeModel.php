<?php
class EmployeeModel {
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
     * Insert record in URLs table
     */
    public function addEmployee($data)
    {   
        $data = $this->processData($data);

        $result = array();
        // clean the input from javascript code for example
        $emp_code = strip_tags($data['emp_code']);
        
        $json_data = $this->checkExisting($emp_code);
        
        if(!$json_data){
            if(isset($data['is_manager']) && !empty($data)){ // Signup Case

                $sql = "INSERT INTO `emp_master` (`emp_code`, `emp_name`, `wiw_id`, `emea_id`, `email_id`, `doj`, `contact_no`, `manager`, `cost_center`, `designation`, `grade`, `department`, `is_manager`) VALUES ('".$data['emp_code']."','".$data['emp_name']."','".$data['wiw_id']."','".$data['emea_id']."','".$data['email_id']."','".$data['doj']."','".$data['contact_no']."','".$data['manager']."','".$data['cost_center']."','".$data['designation']."','".$data['grade']."','".$data['department']."','1')";
                mysqli_query($this->db, $sql);

                $result['status'] = "success";
                $result['response'] = "Registered Successfully.";
            }else if(!empty($data)){
                $sql = "INSERT INTO `emp_master` (`emp_code`, `emp_name`, `wiw_id`, `emea_id`, `email_id`, `doj`, `contact_no`, `manager`, `cost_center`, `designation`, `grade`, `department`) VALUES ('".$data['emp_code']."','".$data['emp_name']."','".$data['wiw_id']."','".$data['emea_id']."','".$data['email_id']."','".$data['doj']."','".$data['contact_no']."','".$data['manager']."','".$data['cost_center']."','".$data['designation']."','".$data['grade']."','".$data['department']."')";
                mysqli_query($this->db, $sql);
                $result['status'] = "success";
                $result['response'] = "Registered Successfully.";
            }
        }else{
            $result['status'] = "error";
            $result['response'] = "User Already Exists.";
        }
        return $result;
    }

    /**
     * Process data before insertion.
     */
    public function processData($data)
    {  
        $result = array();
        foreach ($data as $key => $value) {
            if($key =='email_id' || $key == 'wiw_id'){
                $result[$key] = strtolower($value);
            }elseif($key=='emp_name'||$key=='manager'||$key=='designation'||$key=='department'){
                $result[$key] = ucwords($value);
            }elseif($key=='emea_id'){
                $result[$key] = strtoupper($value);
            }else{
                $result[$key] = $value;
            }
        }
        return $result;
    }
    /**
     * Get all data from Employees
     */
    public function getAll()
    {
        $sql = "select * from emp_master order by emp_name";
        $result = mysqli_query($this->db, $sql);
        $count = 1;
        while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $row->{$count} = $array;
            $count++;
        }
        return $row;
    }

    /**
     * Get all data from Employees
     */
    public function getInActiveEmployee()
    {
        $sql = "select * from emp_master where active='0'";
        $result = mysqli_query($this->db, $sql);
        $count = 1;
        while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $row->{$count} = $array;
            $count++;
        }
        return $row;
    }
    /**
     * Get all data from All Managers.
     */
    public function getAllManagers()
    {
        $sql = "select distinct(`emp_name`) from `emp_master` where `is_manager`= '1'";
        $result = mysqli_query($this->db, $sql);
        $count = 1;
        while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $row->{$count} = $array;
            $count++;
        }
        return $row;
    }

    /**
     * Where query for Employees table
     */
    public function whereEmployee($array)
    {
        $cond_string = '';
        foreach($array as $key => $value) {
          $cond_string .= $key.'= "'.$value.'"';
        }
        $sql = "SELECT * FROM emp_master WHERE ".$cond_string;

        $result = mysqli_query($this->db, $sql);

        return mysqli_fetch_assoc($result);
    }
    
    /**
     * updateWhere query for URLs table
     */
    public function updateEmployee($data)
    {
        //print_r($data);exit(0);
        if(isset($data['active']) && isset($data['is_manager'])){
            $sql = "UPDATE `emp_master` SET `emp_name`='".$data['emp_name']."',`contact_no`='".$data['contact_no']."',`cost_center`='".$data['cost_center']."',`department`='".$data['department']."',`designation`='".$data['designation']."',`grade`='".$data['grade']."',`manager`='".$data['manager']."',`active`='1',`is_manager`='1' WHERE `emp_code`='".$data['emp_code']."'";
        }else if(isset($data['is_manager']) && !isset($data['active'])){
            $sql = "UPDATE `emp_master` SET `emp_name`='".$data['emp_name']."',`contact_no`='".$data['contact_no']."',`cost_center`='".$data['cost_center']."',`department`='".$data['department']."',`designation`='".$data['designation']."',`grade`='".$data['grade']."',`manager`='".$data['manager']."',`is_manager`='1',`active`='0' WHERE `emp_code`='".$data['emp_code']."'";
        }else if(isset($data['active']) && !isset($data['is_manager'])){
            $sql = "UPDATE `emp_master` SET `emp_name`='".$data['emp_name']."',`contact_no`='".$data['contact_no']."',`cost_center`='".$data['cost_center']."',`department`='".$data['department']."',`designation`='".$data['designation']."',`grade`='".$data['grade']."',`manager`='".$data['manager']."',`active`='1',`is_manager`='0' WHERE `emp_code`='".$data['emp_code']."'";
        }else if(!isset($data['active']) && !isset($data['is_manager'])){
            $sql = "UPDATE `emp_master` SET `emp_name`='".$data['emp_name']."',`contact_no`='".$data['contact_no']."',`cost_center`='".$data['cost_center']."',`department`='".$data['department']."',`designation`='".$data['designation']."',`grade`='".$data['grade']."',`manager`='".$data['manager']."',`active`='0',`is_manager`='0' WHERE `emp_code`='".$data['emp_code']."'";
        }
        
        mysqli_query($this->db, $sql);
        $result['status'] = "success";
        $result['response'] = "Updated Successfully";
        return $result;
    }
    /**
     * updateWhere query for URLs table
     */
    public function updateWhere($long_url,$short_url)
    {
        
        $sql = "UPDATE `URLs` SET `short_url`='".$short_url."'WHERE `long_url`='".$long_url."'";

        $result = mysqli_query($this->db, $sql);

        return mysqli_fetch_object($result);
    }

    
    public function checkExisting($emp_code) {

        $return_obj = $this->whereEmployee(['emp_code'=> $emp_code]);
        
        if ($return_obj) {
            $result = json_encode($return_obj);
        }else{
            $result = false;
        }
        
        return $result;
    }
}
