<?php

class PurchaseOrderModel {
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

    public function getAllPurchaseOrder() {
        
        $sql = "SELECT * FROM `purchase_order` ORDER BY `po_number` ";
        $result = mysqli_query($this->db, $sql);
        $count = 1;
        while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $row->{$count} = $array;
            $count++;
        }

        $arrPODetails = array();
        // echo '<pre>';
        // print_r($row);
        // echo '</pre>';
        // exit(0);
         foreach($row as $key => $emp_data)
            {
                if(!empty($arrPODetails['po_number'][$key])){
                    $arrPODetails[$emp_data['po_number']][$key] = array();    
                }else{
                    $arrPODetails[$emp_data['po_number']][$key]['po_number'] = $emp_data['po_number'];
                    $arrPODetails[$emp_data['po_number']][$key]['start_date'] = $emp_data['start_date'];
                    $arrPODetails[$emp_data['po_number']][$key]['end_date'] = $emp_data['end_date'];
                    $arrPODetails[$emp_data['po_number']][$key]['project_name'] = $emp_data['project_name'];
                    if( $emp_data['active'] == 1){
                     $arrPODetails[$emp_data['po_number']][$key]['active'] = "Yes";
                    }
                    elseif ($emp_data['active'] == 0) {
                        # code...
                        $arrPODetails[$emp_data['po_number']][$key]['active'] = "No";
                    }
                    
                    
                }
            }
            // echo '<pre>';
            //  print_r($arrProjectDetails);
             // echo '</pre>';
        
        return $arrPODetails;
    }

     public function addNewPurchaseOrder($data) {
        // print_r($data['ActionName']);
        // exit();

        $projectNameStripped = str_replace('+', ' ', $data['projectNameName']);
        
        if($data['ActionName'] == "add"){

            $sql="INSERT INTO `purchase_order` (`po_number`,`project_name`,`start_date` ,`end_date`)VALUES ('".$data['poNumName']."','".$projectNameStripped."','".$data['startDateName']."','".$data['endDateName']."')";
           // print_r($sql);
           // exit(0);
            $res = mysqli_query($this->db, $sql); 
            $result = array();
            if($res){

                $sql="SELECT `po_number` FROM `purchase_order` WHERE `project_name` = '".$projectNameStripped."' AND `active` = 1";
                $arrProjects = array();
                $getProject = mysqli_query($this->db, $sql); 
                while($array = mysqli_fetch_array($getProject,MYSQLI_ASSOC)){
                    $row->{$count} = $array;
                    array_push($arrProjects ,$array['po_number']);
                    $count++;
                }
                $strProject = implode(",",$arrProjects);

                //Update the Project Table for the Purchase ORder
                $sql="UPDATE `projects` SET `pos` ='".$strProject."' WHERE  `project_name`= '".$projectNameStripped."'";
                // print_r($sql);
                // exit(0);
                $res = mysqli_query($this->db, $sql); 

                $result['status'] = "success";
                $result['response'] = "Records Inserted Successfully.";
            }
            else{

                $result['status'] = "error";
                $result['response'] = "Record Could Not be Inserted.";

            }

        }
        else if ($data['ActionName'] == 'edit') {
            // // print_r("expression");
            // print_r($data);
            // exit(0);
            if($data['active'] == "on"){
                $active = 1;
            }
            else{
                $active = 0;
            }
            // print_r($active);
            // exit();

            $sql= "UPDATE `purchase_order` SET `start_date`='".$data['startDateName']."',`end_date`= '".$data['endDateName']."', `active`= '".$active."' WHERE  `po_number`='".$data['poNumName']."'";
           
            $res = mysqli_query($this->db, $sql); 
            
            // exit(0);
            $result = array();
            if($res){

                $sql="SELECT `po_number` FROM `purchase_order` WHERE `project_name` = '".$projectNameStripped."' AND `active` = 1";

                
                $arrProjects = array();
                $getProject = mysqli_query($this->db, $sql); 
                while($array = mysqli_fetch_array($getProject,MYSQLI_ASSOC)){
                    $row->{$count} = $array;
                    array_push($arrProjects ,$array['po_number']);
                    $count++;
                }
                $strProject = implode(",",$arrProjects);

                //Update the Project Table for the Purchase ORder
                $sql="UPDATE `projects` SET `pos` ='".$strProject."' WHERE  `project_name`= '".$projectNameStripped."'";
                // print_r($sql);
                // exit(0);
                $res = mysqli_query($this->db, $sql);
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

    public function editGetPurchaseOrder($data) {
        
        $sql = "SELECT * FROM `purchase_order` where `po_number`= '".$data['idProject']."'";
        $result = mysqli_query($this->db, $sql);
        $count = 1;
        while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $row->{$count} = $array;
            $count++;
        }
        // print_r($row);
        // exit(0);
        $arrPODetails = array();
        // echo '<pre>';
        // print_r($row);
        // echo '</pre>';
        // exit(0);
        $arrPODetails['status'] = 'success';
         foreach($row as $key => $emp_data)
            {
                if(!empty($arrPODetails['po_number'][$key])){
                    $arrPODetails['poId'][$key] = array();    
                }else{
                    $arrPODetails['poId'][$key]['po_number'] = $emp_data['po_number'];
                    $arrPODetails['poId'][$key]['start_date'] = $emp_data['start_date'];
                    $arrPODetails['poId'][$key]['end_date'] = $emp_data['end_date'];
                    $arrPODetails['poId'][$key]['project_name'] = $emp_data['project_name'];
                   
                     $arrPODetails['poId'][$key]['active'] = $emp_data['active'] ;
                   
                    
                    
                }
            }
            // echo '<pre>';
             // print_r($arrPODetails);
             // exit(0);
             // echo '</pre>';
        
        return $arrPODetails;
    }



     public function deletePurchaseOrderRecord($data) {
        
        $arrString = explode('|', $data['idProject']);

        // print_r($arrString);
        // exit(0);
        $sql = "DELETE FROM `purchase_order` WHERE `po_number`='".$arrString[0]."' ";
        $result = mysqli_query($this->db, $sql);
        
        $result = array();
        

        $sql="SELECT `po_number` FROM `purchase_order` WHERE `project_name` = '".$arrString[1]."' AND `active` = 1";

        
        $arrProjects = array();
        $getProject = mysqli_query($this->db, $sql); 
        while($array = mysqli_fetch_array($getProject,MYSQLI_ASSOC)){
            $row->{$count} = $array;
            array_push($arrProjects ,$array['po_number']);
            $count++;
        }
        $strProject = implode(",",$arrProjects);

        //Update the Project Table for the Purchase ORder
        $sql="UPDATE `projects` SET `pos` ='".$strProject."' WHERE  `project_name`= '".$arrString[1]."'";
        // print_r($sql);
        // exit(0);
        $res = mysqli_query($this->db, $sql);
        $result['status'] = "success";
        $result['response'] = "Records Updated Successfully.";
            
          
            // echo '<pre>';
            //  print_r($arrProjectDetails);
             // echo '</pre>';
        
        return $arrPODetails;
    }


}