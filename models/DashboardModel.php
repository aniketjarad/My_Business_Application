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

    /* This for Home Details */
   
    public function getAllCounts()
    {
        // print_r("expression");
        $arrAllCount = array();
        
        $emp_count = $this->getEmpCount();

        $arrAllCount['emp_count'] = $emp_count;

        $certificate_count = $this->getCertificateCount();

        $arrAllCount['certificate_count'] = $certificate_count;

        $inactiveUsers_details = $this->getInactiveUsersCount();

        $arrAllCount['inactive_users'] = $inactiveUsers_details;

         // print_r($arrAllCount);
         return $arrAllCount;

    }
    //All employee count
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
    //Infra employee count
    public function getEmpCountinfra()
    {
        
        $sql = "select count(*) from emp_master";
        // print_r($sql_no_emp);
        $result = mysqli_query($this->db, $sql);
        $response = mysqli_fetch_array($result,MYSQLI_ASSOC);
        return $response['count(*)'];
    }

    public function getCertificateCount()
    {
        
        $sql = "select count(*) from certification";
        // print_r($sql_no_emp);
        $result = mysqli_query($this->db, $sql);
        $response = mysqli_fetch_array($result,MYSQLI_ASSOC);
        return $response['count(*)'];
    }

    public function getInactiveUsersCount()
    {
        
        $sql = "select count(*) from emp_master WHERE active='0'";
        // print_r($sql_no_emp);
        $result = mysqli_query($this->db, $sql);
        $response = mysqli_fetch_array($result,MYSQLI_ASSOC);
        return $response['count(*)'];
    }

     

    public function getModulesChartDetails()
    {   
        // print_r("Module");
        // exit();
        $sql = "SELECT COUNT(`emp_code`), module FROM certification WHERE cert_name NOT LIKE 'Micro%' GROUP BY module";
        // print_r($sql_no_emp);
        $result = mysqli_query($this->db, $sql);
        while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $row->{$count} = $array;
            $count++;

        }

        $arrChartDetails = array();  
        $arrmodData = array(); 
        $arrmodCount = array();
         foreach($row as $key => $data)
            {
                array_push($arrmodData, $data["module"]);
                array_push($arrmodCount, $data["COUNT(`emp_code`)"]);

            }



        $arrChartDetails['certiModLabels'] = $arrmodData;
        $arrChartDetails['certiModCount'] = $arrmodCount;

         // echo '<pre>';
         // print_r( $arrChartDetails);

         // echo '</pre>';
        return $arrChartDetails;
    }

    // ################### All SkillSet ChartDetails ###################
     public function getAllSkillSetChartDetails()
    {   

        $sql = "SELECT COUNT(`emp_code`), cost_center FROM emp_master GROUP BY cost_center";

        $result = mysqli_query($this->db, $sql);
        while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $row->{$count} = $array;
            $count++;

        }

        $arrChartDetails = array();  
        $arrmodData = array(); 
        $arrmodCount = array();
        foreach($row as $key => $data)
            {
               if($data["cost_center"] == '47200013'){
                    array_push($arrmodData, "Servicenow");
                }
                else if ($data["cost_center"] == '47200012') {
                    array_push($arrmodData, "RPA");
                }
                else{
                     array_push($arrmodData, "Ifra Automation");
                 }                
                array_push($arrmodCount, $data["COUNT(`emp_code`)"]);

        }

        $arrChartDetails['certiModLabels'] = $arrmodData;
        $arrChartDetails['certiModCount'] = $arrmodCount;
        // echo '<pre>';
        //  print_r( $arrChartDetails);

        //  echo '</pre>';
        return $arrChartDetails;
    }

// ################### All Expertise ChartDetails ###################
     public function getAllExpertiseChartDetails()
    {   

        $sql = "SELECT COUNT(`emp_code`), category FROM certification GROUP BY category";

        $result = mysqli_query($this->db, $sql);
        while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $row->{$count} = $array;
            $count++;

        }

        $arrChartDetails = array();  
        $arrmodData = array(); 
        $arrmodCount = array();
        foreach($row as $key => $data)
            {
                array_push($arrmodData, $data["category"]);
                array_push($arrmodCount, $data["COUNT(`emp_code`)"]);

        }

        $arrChartDetails['certiModLabels'] = $arrmodData;
        $arrChartDetails['certiModCount'] = $arrmodCount;
        // echo '<pre>';
        //  print_r( $arrChartDetails);

        //  echo '</pre>';
        return $arrChartDetails;
    }

//################## For Servicenow, Infra, RPA ###################

    public function getAllGenericCount($data)
    {
        $arrAllCount = array();
        
        $emp_count = $this->getEmpCountGeneric($data);

        $arrAllCount['emp_count'] = $emp_count;

        $certificate_count = $this->getCertificateCountGeneric($data);

        $arrAllCount['certificate_count'] = $certificate_count;

        $inactiveUsers_details = $this->getInactiveUsersCountGeneric($data);

        $arrAllCount['inactive_users'] = $inactiveUsers_details;

        return $arrAllCount;

    }
     public function getEmpCountGeneric($data)
    {
        if($data == 'Servicenow'){
          $sql = "select count(*) from emp_master WHERE cost_center='47200013'";
         }
        elseif ($data == 'Infra') {
            $sql = "select count(*) from emp_master WHERE cost_center='47200044'";
        }
        elseif ($data == 'RPA') {
             $sql = "select count(*) from emp_master WHERE cost_center='47200012'";
        }

        $result = mysqli_query($this->db, $sql);
        $response = mysqli_fetch_array($result,MYSQLI_ASSOC);
        return $response['count(*)'];

    }

     public function getCertificateCountGeneric($data)
    {   
        if($data == 'Infra'){
            $sql = "SELECT count(`certification`.emp_code) FROM `certification` JOIN `emp_master` ON `certification`.emp_code = `emp_master`.emp_code WHERE `emp_master`.cost_center='47200044'";
            $result = mysqli_query($this->db, $sql);
            $response = mysqli_fetch_array($result,MYSQLI_ASSOC);
       
         // print_r($emp_name_res['count(*)']);
        // exit(0);
            return $response['count(`certification`.emp_code)'];
        }
        else
        {
            if($data == 'Servicenow'){
                $sql = "select count(*) from certification WHERE category='Servicenow'";
             }            
            elseif ($data == 'RPA') {
                $sql = "select count(*) from certification WHERE category='RPA'";
            }
            // $sql = "select count(*) from certification";
            // print_r($sql_no_emp);
            $result = mysqli_query($this->db, $sql);
            $response = mysqli_fetch_array($result,MYSQLI_ASSOC);
           
             // print_r($emp_name_res['count(*)']);
            // exit(0);
            return $response['count(*)'];
        }
    }

     public function getInactiveUsersCountGeneric($data)
    {
        
        if($data == 'Servicenow'){
            $sql = "select count(*) from emp_master WHERE active='0' and cost_center='47200013'";
         }
        elseif ($data == 'Infra') {
            $sql = "select count(*) from emp_master WHERE active='0' and cost_center='47200044'";
        }
        elseif ($data == 'RPA') {
            $sql = "select count(*) from emp_master WHERE active='0' and cost_center='47200012'";
        }
        // print_r($sql_no_emp);
        $result = mysqli_query($this->db, $sql);
        $response = mysqli_fetch_array($result,MYSQLI_ASSOC);
        return $response['count(*)'];
    }


    // ############### Specific Chart Functions ###############



    public function getServicenowCertificateChartDetails()
    {   
        //print_r("Module");
        
        $sql = "SELECT COUNT(`emp_code`), module FROM certification WHERE category='Servicenow' and cert_name NOT LIKE 'Micro%' GROUP BY module";
        // print_r($sql_no_emp);
        $result = mysqli_query($this->db, $sql);
        // $response = mysqli_fetch_array($result,MYSQLI_ASSOC);
       
         while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $row->{$count} = $array;
            $count++;

        }
        $arrChartDetails = array();  
        $arrmodData = array(); 
        $arrmodCount = array();
         foreach($row as $key => $data)
            {
                array_push($arrmodData, $data["module"]);
                array_push($arrmodCount, $data["COUNT(`emp_code`)"]);
            }



        $arrChartDetails['certiModLabels'] = $arrmodData;
        $arrChartDetails['certiModCount'] = $arrmodCount;
        return $arrChartDetails;
    }

    public function getRPACertificateChartDetails()
    {   
        
        
        $sql = "SELECT COUNT(`emp_code`), module FROM certification WHERE category='RPA' GROUP BY module";
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
                array_push($arrmodData, $data["module"]);
                array_push($arrmodCount, $data["COUNT(`emp_code`)"]);

                // $arrChartDetails[$data["module"]] = $arrmodData;
            }



        $arrChartDetails['certiModLabels'] = $arrmodData;
        $arrChartDetails['certiModCount'] = $arrmodCount;

        //     echo '<pre>';
        // print_r( $countsm);

    //     // a/pre>';
    //     //  // print_r($arrChartDetails   );
    //     // exit(0);
        return $arrChartDetails;
    }
}
