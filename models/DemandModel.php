<?php

class DemandModel {
    /**
     * Check database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
            $this->db_pdo = new PDO("mysql:host=localhost;dbname=mybusinessapplication", DB_USER, DB_PASS);;
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
            $row['count'] = $array[0];
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
            // echo '<pre>';
            //  print_r($arrEMPDetails);
            //  echo '</pre>';
        
        return $arrEMPDetails;
    }

    /**
     * Insert record in URLs table
    */
    public function addDemand($data,$files)
    {

        $jd_file_type = $files['jd_attach']['type'];
        $cv_file_type = $files['cv_attach']['type'];

        $jd_file = $files['jd_attach']['tmp_name'];
        $cv_file = $files['cv_attach']['tmp_name'];
        if(!empty($jd_file) && !empty($cv_file)){
            $content = file_get_contents($jd_file);
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

                mysqli_query($this->db, $sql_cv);

                
        }else{

        }
        exit(0);
    }



}
