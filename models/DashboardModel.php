<?php

class DashboardModel {
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
   
    public function getAllCounts()
    {
        // print_r("expression");
        $arrAllCount = array();
        
        $emp_count = $this->getEmpCount();

        $arrAllCount['emp_count'] = $emp_count;

        $certificate_count = $this->getCertificateCount();

        $arrAllCount['certificate_count'] = $certificate_count;

        // $module_details = $this->getModulesChartDetails();

        //  $arrAllCount['CertificateChart'] = $module_details;

         // print_r($arrAllCount);
         return $arrAllCount;

    }

    public function getEmpCount()
    {
        
        $sql = "select count(*) from emp_master";
        // print_r($sql_no_emp);
        $result = mysqli_query($this->db, $sql);
        $response = mysqli_fetch_array($result,MYSQLI_ASSOC);
       
        // print_r($emp_name_res['count(*)']);
        // exit(0);
        return $response['count(*)'];
    }

     public function getCertificateCount()
    {
        
        $sql = "select count(*) from certification";
        // print_r($sql_no_emp);
        $result = mysqli_query($this->db, $sql);
        $response = mysqli_fetch_array($result,MYSQLI_ASSOC);
       
        // print_r($emp_name_res['count(*)']);
        // exit(0);
        return $response['count(*)'];
    }

     public function getModulesChartDetails()
    {   
        //print_r("Module");
        
        $sql = "SELECT COUNT(`emp_code`), module FROM certification WHERE category='Servicenow' GROUP BY module";
        // print_r($sql_no_emp);
        $result = mysqli_query($this->db, $sql);
        // $response = mysqli_fetch_array($result,MYSQLI_ASSOC);
       
         while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $row->{$count} = $array;
            $count++;

        }

        // $countsm = '';
        $arrChartDetails = array();  
        $arrmodData = array(); 
        $arrmodCount = array();
         foreach($row as $key => $data)
            {
                 
                // $arrmodData['count'] =  $data["COUNT(`emp_code`)"];
                 // $arrmodData['module'][$key] =  $data["module"];
                array_push($arrmodData, $data["module"]);
                array_push($arrmodCount, $data["COUNT(`emp_code`)"]);

                // $arrChartDetails[$data["module"]] = $arrmodData;
            }



        $arrChartDetails['certiModLabels'] = $arrmodData;
        $arrChartDetails['certiModCount'] = $arrmodCount;

        //     echo '<pre>';
        // print_r( $countsm);

    //     // echo '<pre>';
    //     // print_r($arrChartDetails);
    //     // echo '</pre>';
    //     //  // print_r($arrChartDetails   );
    //     // exit(0);
        return $arrChartDetails;
    }




}
