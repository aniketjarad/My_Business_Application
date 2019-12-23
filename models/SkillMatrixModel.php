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
    public function getAllSkills()
    {
    	
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
                    $arrEMPDetails[$emp_data['emp_code']."|".$emp_data['emp_name']][$key]['skill'] = $emp_data['skill'];
                    $arrEMPDetails[$emp_data['emp_code']."|".$emp_data['emp_name']][$key]['proficiency'] = $emp_data['proficiency'];
                    $arrEMPDetails[$emp_data['emp_code']."|".$emp_data['emp_name']][$key]['skill_category'] = $emp_data['skill_category'];
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
