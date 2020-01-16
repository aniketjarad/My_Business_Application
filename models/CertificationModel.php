<?php

class CertificationModel {
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
    public function getAllCertifications()
    {
    	
        $sql = "SELECT * FROM `certification` ORDER BY `emp_code`";
        $result = mysqli_query($this->db, $sql);
        $count = 1;
        while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $row->{$count} = $array;
            $count++;
        }

        $arrEMPDetails = array();
        // echo '<pre>';
        // print_r($row);
        // echo '</pre>';
         foreach($row as $key => $emp_data)
            {
                if(!empty($arrEMPDetails[$emp_data['emp_code']."|".$emp_data['emp_name']][$key])){
                    $arrEMPDetails[$emp_data['emp_code']."|".$emp_data['emp_name']][$key] = array();    
                }else{
                    $arrEMPDetails[$emp_data['emp_code']."|".$emp_data['emp_name']][$key]['cert_name'] = $emp_data['cert_name'];
                    $arrEMPDetails[$emp_data['emp_code']."|".$emp_data['emp_name']][$key]['cert_expiry'] = $emp_data['cert_expiry'];
                    $arrEMPDetails[$emp_data['emp_code']."|".$emp_data['emp_name']][$key]['category'] = $emp_data['category'];
                     $arrEMPDetails[$emp_data['emp_code']."|".$emp_data['emp_name']][$key]['module'] = $emp_data['module'];
                }
            }
            // echo '<pre>';
            //  print_r($arrEMPDetails);
            //  echo '</pre>';
        
        return $arrEMPDetails;
    }

    /**
     * Insert record in URLs table
     */
   

}
