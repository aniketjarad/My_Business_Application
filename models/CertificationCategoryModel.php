<?php
class CertificationCategoryModel {
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
    public function getUniqueCertCategory()
    {         
       // print_r("expression");
       // exit(0);
        $sql = "select distinct(`certificate_category`) from `all_certificate` " ;
        $result = mysqli_query($this->db, $sql);     
       
        $cate_name=array();
        
        while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $row->{$count} = $array;
            array_push($cate_name,$array['certificate_category']);
            // print_r($array);
        }
        
        
        return $cate_name;
    }



    //Add new Certifcate Modules & Category
    public function addNewCertCatMod($data)
    {         
       // print_r($data);
       // exit(0); 
        $sql=" INSERT INTO `all_certificate` (`certificate_name`, `certificate_category`,`certificate_module`, `certificate_type`)VALUES ('".$data['nameNewCertName']."','".$data['nameNewCertCategory']."','".$data['nameNewCertModule']."','".$data['nameselNewCertType']."')";
       // print_r($sql);
        $result = mysqli_query($this->db, $sql);     
       // exit(0);
        // if($result){
        $result = array();
            $result['status'] = "success";
            $result['response'] = "Records Inserted Successfully.";
        // print_r($result);
        // exit(0);        
        return $result;
    }


    /**
     * Get all data from.
     */
    public function getAllCertificationList($data)
    {         
       
        $sql = "select distinct(`certificate_module`),certificate_name from `all_certificate` WHERE certificate_category='".$data['certCategory']."' order by certificate_module" ;
        $result = mysqli_query($this->db, $sql);        
        
        $count = 1;
        
        $arr_CertiName=array();
        $array_elements=array();
        //$array = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $result_array = array();
        //print_r($result);
        //exit(0);
        while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $row->{$count} = $array;
            $key = $array['certificate_module'];
            if(array_key_exists($key, $result_array)){
                array_push($result_array[$key],$array['certificate_name']);
            }else{
                $result_array[$key] = array();
                array_push($result_array[$key],$array['certificate_name']);
            }
            //print_r($array);
            
            $arr_CertiName['status']= "success"; 

            // array_push($array_elements,$array['certificate_name']);

            //print_r($array['certificate_name']);
             $count++;
            
        }
      
        $array_elements['response'] = $arr_CertiName; 
        $array_elements['result'] = $result_array;
        
        return $array_elements;
    }

   public function addEmployeeCertificate($data)
    {   
        // print_r($data['certModuleCustom']);
           

             $sql =   "SELECT emp_name FROM `emp_master` WHERE emp_code='".$data['emp_Name']."' ";
             $sql_result=  mysqli_query($this->db, $sql);
             $emp_name_res = mysqli_fetch_array($sql_result,MYSQLI_ASSOC);
             // print_r($emp_name_res['emp_name']);
             // exit(0);
        
        // if (($data['certModuleCustom'] == '') && ($data['certName'] != '') ) {
            # code...
        
        // print_r("sample");
            $sql=" INSERT INTO `certification` (`emp_code`, `emp_name`,`cert_name`, `cert_expiry`,`category`,`module`)VALUES ('".$data['emp_Name']."','".$emp_name_res['emp_name']."','".$data['certName']."','".$data['certExpDatename']."','".$data['certCategory']."','".$data['certModule']."')";
                mysqli_query($this->db, $sql);
                $result['status'] = "success";
                $result['response'] = "Record Inserted Successfully.";
        // }
        // else if (($data['certNameCustom'] != "") ) {
        //     # code...
        //     // print_r("sample 2323");
        //     $sql=" INSERT INTO `certification` (`emp_code`, `emp_name`, `cert_name`, `cert_expiry`,`category`,`module`)VALUES ('".$data['emp_Name']."','".$emp_name_res['emp_name']."','".$data['certNameCustom']."','".$data['certExpDatename']."','".$data['certCategory']."','".$data['certModuleCustom']."')";
        //         mysqli_query($this->db, $sql);
        //         $result['status'] = "success";
        //         $result['response'] = "Record Inserted Successfully.";
        // }

        // else
        // {
        //     // print_r("sample 2323asdasdasd");
        //         $result['status'] = "error";
        //         $result['response'] = "Could Not Process the Request";
        // }
    
        return $result;
    }


    public function delteEmployeeCertificate($data)
    {   
        // print_r($data[0]);
           
        // exit(0);
            $sql = "DELETE FROM `certification` WHERE `emp_code`= '".$data[0]."' AND`cert_name`='".$data[1]."'";
            $sql_result=  mysqli_query($this->db, $sql);

            $result['status'] = "success";
            $result['response'] = "Record Deleted Successfully.";
        // print_r($result);
        // exit(0);
        return $result;
    }

    public function delteEmpCertRec($data)
    {   
        // print_r($data[0]);
           
        // exit(0);
            $sql = "DELETE FROM `certification` WHERE `emp_code`= '".$data."'";
            $sql_result=  mysqli_query($this->db, $sql);

            $result['status'] = "success";
            $result['response'] = "Records Deleted Successfully.";
        // print_r($result);
        // exit(0);
        return $result;
    }

}
