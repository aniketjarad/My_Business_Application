<?php

class ProjectModel {
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

    /*Get All the details from the Project Table ot Display. */
    public function getAllProjects() {
        
        $sql = "SELECT * FROM `projects` ORDER BY `project_id` ";
        $result = mysqli_query($this->db, $sql);
        $count = 1;
        while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $row->{$count} = $array;
            $count++;
        }

        $arrProjectDetails = array();
        // echo '<pre>';
        // print_r($row);
        // echo '</pre>';
         foreach($row as $key => $emp_data)
            {
                if(!empty($arrProjectDetails['project_id'][$key])){
                    $arrProjectDetails[$emp_data['project_id']][$key] = array();    
                }else{
                    $arrProjectDetails[$emp_data['project_id']][$key]['project_id'] = $emp_data['project_id'];
                    $arrProjectDetails[$emp_data['project_id']][$key]['project_name'] = $emp_data['project_name'];
                    $arrProjectDetails[$emp_data['project_id']][$key]['cost_center'] = $emp_data['cost_center'];
                    $arrProjectDetails[$emp_data['project_id']][$key]['pos'] = $emp_data['pos'];
                    if( $emp_data['active'] == 1){
                     $arrProjectDetails[$emp_data['project_id']][$key]['active'] = "Yes";
                    }
                    elseif ($emp_data['active'] == 0) {
                        # code...
                        $arrProjectDetails[$emp_data['project_id']][$key]['active'] = "No";
                    }
                    
                    
                }
            }
            // echo '<pre>';
            //  print_r($arrProjectDetails);
             // echo '</pre>';
        
        return $arrProjectDetails;
    }

    /* Create the record of new Project when requested.*/
    public function addNewProjects($data) {
        // print_r($data['ActionName']);
        // exit();

       if($data['ActionName'] == "add"){
            $sql="INSERT INTO `projects` (`project_id`, `project_name`,`cost_center`)VALUES ('".$data['projectIdName']."','".$data['projectName']."','".$data['projectCostCenter']."')";
           // print_r($sql);
            $res = mysqli_query($this->db, $sql); 
            $result = array();
            if($res){
            
                $result['status'] = "success";
                $result['response'] = "Records Inserted Successfully.";
            }
            else{

                $result['status'] = "error";
                $result['response'] = "Record Could Not be Inserted.";

            }
        }
        else if ($data['ActionName'] == 'edit') {

            if($data['active'] == "on"){
                $active = 1;
            }
            else{
                $active = 0;
            }
            // print_r($active);
            // exit();
            $sql= "UPDATE `projects` SET `project_name`='".$data['projectName']."',`cost_center`= '".$data['projectCostCenter']."', `active`= '".$active."' WHERE  `project_id`='".$data['projectIdName']."'";
           
            $res = mysqli_query($this->db, $sql); 
            $result = array();
            if($res){
            
                $result['status'] = "success";
                $result['response'] = "Records Updated Successfully.";
            }
            else{

                $result['status'] = "error";
                $result['response'] = "Record Could Not be Updated.";
            }
        }
         
        return $result;      
        
        
    }
    public function editGetProject($data) {
        
        $sql="SELECT * FROM `projects` WHERE `project_id`='".$data['idProject']."'";

        $res = mysqli_query($this->db, $sql);
        $details = array();
        $count = 1;
        while($array = mysqli_fetch_array($res,MYSQLI_ASSOC)){
            $row->{$count} = $array;
            $count++;
        } 
         foreach($row as $key => $emp_data)
            {
                if(!empty($details[$emp_data['project_id']][$key])){
                    $details['project_id'][$key] = array();    
                }else{
                    $details['project_id'][$key]['project_id'] = $emp_data['project_id'];
                    $details['project_id'][$key]['project_name'] = $emp_data['project_name'];
                    $details['project_id'][$key]['cost_center'] = $emp_data['cost_center'];
                    $details['project_id'][$key]['pos'] = $emp_data['pos'];
                    $details['project_id'][$key]['active'] = $emp_data['active'];
                    
                }
            }
       
        $result = array();
        if($res){
        
            $result['status'] = "success";
            $result['response'] = $details;
        }
        else{

            $result['status'] = "success";
            $result['response'] = "Record Does Not Exists.";

        }
        // print_r($result);
        // exit(0);        
        return $result;      
        
        
    }


}