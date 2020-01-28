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
     * Insert record in URLs table
    */
    public function addDemand($data,$files)
    {
        //print_r($files);
        $return = array();
        $demand_id = "";
        $backfill = "";
        if(!empty($data['backfill_emp_id'])){
            $backfill = $data['backfill_emp_id'];
        }
        if(!empty($data['demand_id_select'])){
            $demand_id = $data['demand_id_select'];
            if(!empty($files['jd_attach']['tmp_name']) && !empty($files['cv_attach']['tmp_name']) && !empty($data['candidate_name'])){

                $jd_file = $files['jd_attach']['tmp_name'];
                $cv_file = $files['cv_attach']['tmp_name'];
                $jd_file_type = end(explode(".",$files['jd_attach']['name']));
                $cv_file_type = end(explode(".",$files['cv_attach']['name']));
                $jd_file_path = FILE_PATH."Demand_".$demand_id."_JD.".$jd_file_type;
                $abs_jd_path = ABS_FILE_PATH."Demand_".$demand_id."_JD.".$jd_file_type;
                
                $cv_file_path = FILE_PATH."Demand_".str_replace(" ","_", $data['candidate_name'])."_".$demand_id."_CV.".$cv_file_type;
                $abs_cv_path = ABS_FILE_PATH."Demand_".str_replace(" ","_", $data['candidate_name'])."_".$demand_id."_CV.".$cv_file_type;

                $status_jd = move_uploaded_file($jd_file,$jd_file_path);
                $status_cv = move_uploaded_file($cv_file,$cv_file_path);

                if($status_jd !=1 && $status_cv!=1){
                    $return['status'] = "error";
                    $return['data'] = "File Upload Failed. Try Again..!";
                }else{
                    $sql = "UPDATE `demand` SET `candidate_name`='".$data['candidate_name']."',`position`='".$data['position']."',`joining_date`='".$data['joining_date']."',`tentative_mapping`='".$data['tentative_mapping']."',`status`='".$data['status']."',`backfill_emp_id`='".$backfill."',`jd`='".$abs_jd_path."',`cv`='".$abs_cv_path."' WHERE `demand_id`='".$demand_id."'";
                    mysqli_query($this->db, $sql);
                    //echo $sql;
                    $return['status'] = "success";
                    $return['data'] = "Demand Added Successfully...!";
                }
            }else if(!empty($files['jd_attach']['tmp_name'])){
                $jd_file = $files['jd_attach']['tmp_name'];
                $file_type = end(explode(".",$files['jd_attach']['name']));
                $file_path = FILE_PATH."Demand_".$demand_id."_JD.".$file_type;
                $abs_path = ABS_FILE_PATH."Demand_".$demand_id."_JD.".$file_type;
                $status = move_uploaded_file($jd_file,$file_path);
                if($status!=1){
                    $return['status'] = "error";
                    $return['data'] = "File Upload Failed. Try Again..!";
                }else{
                   $sql = "UPDATE `demand` SET `candidate_name`='".$data['candidate_name']."',`position`='".$data['position']."',`joining_date`='".$data['joining_date']."',`tentative_mapping`='".$data['tentative_mapping']."',`status`='".$data['status']."',`backfill_emp_id`='".$backfill."',`jd`='".$abs_path."' WHERE `demand_id`='".$demand_id."'";
                    mysqli_query($this->db, $sql);
                    //echo $sql;
                    $return['status'] = "success";
                    $return['data'] = "Demand Added Successfully...!";
                }
            }
        }else if (!empty($data['demand_id'])) {
            $demand_id = $data['demand_id'];
            if(!empty($files['jd_attach']['tmp_name']) && !empty($files['cv_attach']['tmp_name']) && !empty($data['candidate_name'])){
                $jd_file = $files['jd_attach']['tmp_name'];
                $cv_file = $files['cv_attach']['tmp_name'];
                $jd_file_type = end(explode(".",$files['jd_attach']['name']));
                $cv_file_type = end(explode(".",$files['cv_attach']['name']));
                $jd_file_path = FILE_PATH."Demand_".$demand_id."_JD.".$jd_file_type;
                $abs_jd_path = ABS_FILE_PATH."Demand_".$demand_id."_JD.".$jd_file_type;
                
                $cv_file_path = FILE_PATH."Demand_".str_replace(" ","_", $data['candidate_name'])."_".$demand_id."_CV.".$cv_file_type;
                $abs_cv_path = ABS_FILE_PATH."Demand_".str_replace(" ","_", $data['candidate_name'])."_".$demand_id."_CV.".$cv_file_type;

                $status_jd = move_uploaded_file($jd_file,$jd_file_path);
                $status_cv = move_uploaded_file($cv_file,$cv_file_path);
                if($status_jd !=1 && $status_cv!=1){
                    $return['status'] = "error";
                    $return['data'] = "File Upload Failed. Try Again..!";
                }else{
                    $sql = "INSERT INTO `demand` (`demand_id`, `candidate_name`, `position`, `joining_date`,`tentative_mapping`,`status`,`backfill_emp_id`,`jd`,`cv`) VALUES ('".$demand_id."','".$data['candidate_name']."','".$data['position']."','".$data['joining_date']."','".$data['tentative_mapping']."','".$data['status']."','".$backfill."','". $abs_jd_path."','". $abs_cv_path."')";
                    //echo $sql;
                    mysqli_query($this->db, $sql);
                    $return['status'] = "success";
                    $return['data'] = "Demand Added Successfully...!";
                }
            }else if(!empty($files['jd_attach']['tmp_name'])){
                $jd_file = $files['jd_attach']['tmp_name'];
                $file_type = end(explode(".",$files['jd_attach']['name']));
                $file_path = FILE_PATH."Demand_".$demand_id."_JD.".$file_type;
                $abs_path = ABS_FILE_PATH."Demand_".$demand_id."_JD.".$file_type;
                $status = move_uploaded_file($jd_file,$file_path);
                if($status!=1){
                    $return['status'] = "error";
                    $return['data'] = "File Upload Failed. Try Again..!";
                }else{
                    $sql = "INSERT INTO `demand` (`demand_id`, `candidate_name`, `position`, `joining_date`,`tentative_mapping`,`status`,`backfill_emp_id`,`jd`) VALUES ('".$demand_id."','".$data['candidate_name']."','".$data['position']."','".$data['joining_date']."','".$data['tentative_mapping']."','".$data['status']."','".$backfill."','". $file_path."')";
                    //echo $sql;
                    mysqli_query($this->db, $sql);
                    $return['status'] = "success";
                    $return['data'] = "Demand Added Successfully...!";
                }
            }
        }else if(empty($data['demand_id_select']) && empty($data['demand_id'])){
            $return['status'] = "error";
            $return['data'] = "Demand ID Cannot be Empty ..!";
        }
        //exit(0);
        return $return; 
    }

    /**
     * Get all data from Employees
     */
    public function getAll()
    {
        $sql = "select * from demand order by demand_id";
        $result = mysqli_query($this->db, $sql);
        $count = 1;
        while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $row->{$count} = $array;
            $count++;
        }
        return $row;
    }
}