<?php

class DemandModel {
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
    
    public function getDemandCount(){
        $sql = "SELECT count(`demand_id`) FROM `demand` where status is NULL ORDER BY `demand_id`";
        $row = array();
        $count = 0;
        foreach ($this->db->query($sql) as $array) {
            //print_r($array);
            $row['count'] = $array['count(`demand_id`)'];
            $count++;
        }
        return $row;
    }

    public function getDemand(){
        $sql = "SELECT `demand_id` FROM `demand` where status is NULL ORDER BY `demand_id`";
        
        $row = array();
        $count = 0;
        foreach ($this->db->query($sql) as $array) {
            //print_r($array);
            $row[$count] = $array['demand_id'];
            $count++;
        }
        return $row;
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
        return $arrEMPDetails;
    }

    /**
     * Insert record in URLs table
    */
    public function addDemand($data,$files)
    {
        $return = array();
        /*
        Array
        (
            [demand_id] => 1000
            [candidate_name] => Aniket
            [position] => Developer
            [joining_date] => 2020-01-29
            [tentative_mapping] => Smart TC
            [status] => On Track
        )
        */
        if(empty($data['demand_id'])){
            $return['status'] = "error";
            $return['data'] = "Demand ID Cannot be Empty ..!";
        }else{
            $sql = "INSERT INTO `demand` (`demand_id`, `candidate_name`, `position`, `joining_date`,`tentative_mapping`,`status`,`jd`) VALUES ('".$data['demand_id']."','".$data['candidate_name']."','".$data['position']."','".$data['joining_date']."','".$data['tentative_mapping']."','".$data['status']."','".$data['jd']."')";
            mysqli_query($this->db, $sql);
        }



        $jd_file_type = $files['jd_attach']['type'];
        $cv_file_type = $files['cv_attach']['type'];

        $jd_file = $files['jd_attach']['tmp_name'];
        $cv_file = $files['cv_attach']['tmp_name'];
        if(!empty($files['cv_attach']['tmp_name']) && !empty($files['jd_attach']['tmp_name'])){

            $file_path = FILE_PATH.$files['jd_attach']['name'];
            $status = move_uploaded_file($jd_file,$file_path);
            echo "\n====>".$return;
            exit(0);
            /*$content = file_get_contents($jd_file);
            //$content ="Hi hello";
            $stmt = $this->db_pdo->prepare("INSERT INTO `documents` VALUES (?,?,?,?)");
            //$stmt->bindParam('sssb',,,$jd_file_type,);
            //$stmt->bindParam('sssb',$data['demand_id'],$files['jd_attach']['name'],$jd_file_type,$content);
            $stmt->bindParam(1,$data['demand_id']);
            $stmt->bindParam(2,$files['jd_attach']['name']);
            $stmt->bindParam(3,$jd_file_type);
            $stmt->bindParam(4,$content);
            $stmt->execute();
            // $sql_jd = "INSERT INTO `documents` (`demand_id`, `doc_name`, `doc_type`, `content`) VALUES ('".$data['demand_id']."','".$files['jd_attach']['name']."','".$jd_file_type."','".$content ."')";
            //echo "====>".$sql_jd;

                //mysqli_query($this->db, $sql_jd);
                echo "Query successfull";
                exit(0);
            $sql_cv = "INSERT INTO `documents` (`demand_id`, `doc_name`, `doc_type`, `content`) VALUES ('".$data['demand_id']."','".$data['demand_id']."_CV.".$cv_file_type."','".$cv_file_type."','".$cv_file."')";

                mysqli_query($this->db, $sql_cv);*/

                
        }else{

        }
        exit(0);
    }



}
