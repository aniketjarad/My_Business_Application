<?php

class SkillMatrixModel {
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
    public function getAllSkills()    {
    	
        $sql = "SELECT * FROM `skill_matrix` ORDER BY `emp_code`";
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
                    $arrEMPDetails[$emp_data['emp_code']."|".$emp_data['emp_name']][$key]['primary_skill'] = $emp_data['primary_skill'];
                    $arrEMPDetails[$emp_data['emp_code']."|".$emp_data['emp_name']][$key]['secondary_skill'] = $emp_data['secondary_skill'];
                    
                }
            }
            // echo '<pre>';
            //  print_r($arrEMPDetails);
            //  echo '</pre>';
        
        return $arrEMPDetails;
    }

   
   

}
