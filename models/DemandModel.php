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
        //$sql = "SELECT count(`bos_id`) FROM `demand` where status is NULL ORDER BY `demand_id`";
        $sql ="select max(demand_id) from demand"; 
        $row = array();
        //$count = 0;
        foreach ($this->db->query($sql) as $key=>$array) {
            //print_r($array);
            $row[] = $array["max(demand_id)"]+1;
            //$count++;
        }
        
        return $row;
    }

    public function getDemand(){
        //$sql = "SELECT `demand_id` FROM `demand` where status is NULL ORDER BY `demand_id`";
        $sql ="select max(demand_id) from demand";
        $row = array();
        $count = 0;
        foreach ($this->db->query($sql) as $array) {
            //print_r($array);
            $row[$count] = $array["max(demand_id)"]+1;
            $count++;
        }
        return $row;
    }
    public function get($id){
        $sql = "select * from demand where demand_id='".$id."'";
        $result = mysqli_query($this->db, $sql);
        $count = 0;
        while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $row = $array;
            $count++;
        }
        return $row;
    }

    /**
     * Insert record in URLs table
    */
    public function addDemand($data,$files)
    {   
        $return = array();
        $demand_id = "";
        $backfill = "";
        if(!empty($data['backfill_emp_id'])){
            $backfill = $data['backfill_emp_id'];
        }
        if($data['action']=="update"){
            $timestamp = time();
            $sql = "select jd,cv from demand where demand_id=".$data['demand_id'].";";
            $result = mysqli_query($this->db, $sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $demand_id = $data['demand_id'];
            if(!empty($files['jd_attach']['tmp_name']) && !empty($files['cv_attach']['tmp_name'])){
                $jd_file = $files['jd_attach']['tmp_name'];
                $cv_file = $files['cv_attach']['tmp_name'];
                $jd_file_type = end(explode(".",$files['jd_attach']['name']));
                $cv_file_type = end(explode(".",$files['cv_attach']['name']));
                $status_jd = $status_cv = $arc_jd_file_path = $arc_abs_jd_path = $arc_cv_file_path = $arc_abs_cv_path = $abs_cv_path = $jd_file_path = $abs_jd_path = $cv_file_path = "";
                if($data['status']=="Dropped" || $data['status']=="Joined"){
                    $arc_jd_file_path = ARC_FILE_PATH."Demand_".$demand_id."_".$timestamp."_JD.".$jd_file_type;
                    $arc_abs_jd_path = ARC_ABS_FILE_PATH."Demand_".$demand_id."_".$timestamp."_JD.".$jd_file_type;
                    $arc_cv_file_path = ARC_FILE_PATH."Demand_".$demand_id."_".$timestamp."_CV.".$cv_file_type;
                    $arc_abs_cv_path = ARC_ABS_FILE_PATH."Demand_".$demand_id."_".$timestamp."_CV.".$cv_file_type;
                    $status_jd = move_uploaded_file($jd_file,$arc_jd_file_path);
                    $status_cv = move_uploaded_file($cv_file,$arc_cv_file_path);

                    //unlink(FILE_PATH.$row['cv']);
                    //unlink(FILE_PATH.$row['jd']);
                }else{
                    $jd_file_path = FILE_PATH."Demand_".$demand_id."_".$timestamp."_JD.".$jd_file_type;
                    $abs_jd_path = ABS_FILE_PATH."Demand_".$demand_id."_".$timestamp."_JD.".$jd_file_type;
                    $cv_file_path = FILE_PATH."Demand_".$demand_id."_".$timestamp."_CV.".$cv_file_type;
                    $abs_cv_path = ABS_FILE_PATH."Demand_".$demand_id."_".$timestamp."_CV.".$cv_file_type;
                    $status_jd = move_uploaded_file($jd_file,$jd_file_path);
                    $status_cv = move_uploaded_file($cv_file,$cv_file_path);

                    unlink(FILE_PATH.end(explode("/",$row['cv'])));
                    unlink(FILE_PATH.end(explode("/",$row['jd'])));
                }

                if($status_jd !=1 && $status_cv!=1){
                    $return['status'] = "error";
                    $return['data'] = "File Upload Failed. Try Again..!";
                }else{
                    if($data['status']=="Dropped"){
                        // $status_jd = rename($row['jd'], ARC_FILE_PATH.end(explode("/",$row['jd'])));
                        // $status_cv = rename($row['cv'], ARC_FILE_PATH.end(explode("/",$row['cv'])));

                        $sql = "UPDATE `demand` SET `candidate_name`='',`position`='".$data['position']."',`joining_date`='',`tentative_mapping`='',`status`='',`backfill_emp_id`='',`jd`='',`cv`='',`bos_id`='".$data['bos_id']."' WHERE `demand_id`='".$demand_id."'";
                        mysqli_query($this->db, $sql);

                        $sql = "INSERT INTO `demand_archieve` (`demand_id`, `candidate_name`, `position`, `joining_date`,`tentative_mapping`,`status`,`backfill_emp_id`,`jd`,`cv`,`bos_id`) VALUES ('".$demand_id."','".$data['candidate_name']."','".$data['position']."','".$data['joining_date']."','".$data['tentative_mapping']."','".$data['status']."','".$backfill."','". $arc_abs_jd_path."','". $arc_abs_cv_path."','".$data['bos_id']."')";
                        //echo "\n==33==>".$sql;
                        mysqli_query($this->db, $sql);
                    }else if($data['status']=="Joined") {
                        $sql = "delete from demand where demand_id=".$demand_id.";";
                        mysqli_query($this->db, $sql);
                        $sql = "INSERT INTO `demand_archieve` (`demand_id`, `candidate_name`, `position`, `joining_date`,`tentative_mapping`,`status`,`backfill_emp_id`,`jd`,`cv`,`bos_id`) VALUES ('".$demand_id."','".$data['candidate_name']."','".$data['position']."','".$data['joining_date']."','".$data['tentative_mapping']."','".$data['status']."','".$backfill."','". $arc_abs_jd_path."','". $arc_abs_cv_path."','".$data['bos_id']."')";
                        mysqli_query($this->db, $sql);
                    }else{
                        $sql = "UPDATE `demand` SET `candidate_name`='".$data['candidate_name']."',`position`='".$data['position']."',`joining_date`='".$data['joining_date']."',`tentative_mapping`='".$data['tentative_mapping']."',`status`='".$data['status']."',`backfill_emp_id`='".$backfill."',`jd`='".$abs_jd_path."',`cv`='".$abs_cv_path."',`bos_id`='".$data['bos_id']."' WHERE `demand_id`='".$demand_id."'";
                        mysqli_query($this->db, $sql);
                        //echo "\n==11==>".$sql;
                    }
                    $return['status'] = "success";
                    $return['data'] = "Demand Updated Successfully...!";
                }
            }else if(!empty($files['jd_attach']['tmp_name'])){
                
                $jd_file = $files['jd_attach']['tmp_name'];
                $jd_file_type = end(explode(".",$files['jd_attach']['name']));
                $status = $arc_jd_file_path = $arc_abs_jd_path = $jd_file_path = $abs_jd_path= "";
                if($data['status']=="Dropped" || $data['status']=="Joined"){
                    $arc_jd_file_path = ARC_FILE_PATH."Demand_".$demand_id."_".$timestamp."_JD.".$jd_file_type;
                    $arc_abs_jd_path = ARC_ABS_FILE_PATH."Demand_".$demand_id."_".$timestamp."_JD.".$jd_file_type;
                    $status = move_uploaded_file($jd_file,$arc_jd_file_path);
                    //unlink(FILE_PATH.$row['jd']);
                }else{
                    $jd_file_path = FILE_PATH."Demand_".$demand_id."_".$timestamp."_JD.".$jd_file_type;
                    $abs_jd_path = ABS_FILE_PATH."Demand_".$demand_id."_".$timestamp."_JD.".$jd_file_type;
                    $status = move_uploaded_file($jd_file,$jd_file_path);
                    
                    unlink(FILE_PATH.end(explode("/",$row['jd'])));
                }

                if($status!=1){
                    $return['status'] = "error";
                    $return['data'] = "File Upload Failed. Try Again..!";
                }else{
                    if($data['status']=="Dropped"){
                        $arc_abs_cv_path = ABS_FILE_PATH.end(explode("/",$row['cv']));
                        $arc_cv_path = ARC_FILE_PATH.end(explode("/",$row['cv']));
                        rename(FILE_PATH.end(explode("/",$row['cv'])), $arc_cv_path);

                        $sql = "UPDATE `demand` SET `candidate_name`='',`position`='".$data['position']."',`joining_date`='',`tentative_mapping`='',`status`='',`backfill_emp_id`='',`jd`='',`cv`='',`bos_id`='".$data['bos_id']."' WHERE `demand_id`='".$demand_id."'";
                        mysqli_query($this->db, $sql);

                        $sql = "INSERT INTO `demand_archieve` (`demand_id`, `candidate_name`, `position`, `joining_date`,`tentative_mapping`,`status`,`backfill_emp_id`,`jd`,`cv`,`bos_id`) VALUES ('".$demand_id."','".$data['candidate_name']."','".$data['position']."','".$data['joining_date']."','".$data['tentative_mapping']."','".$data['status']."','".$backfill."','". $arc_abs_jd_path."','". $arc_abs_cv_path."','".$data['bos_id']."')";
                        //echo "\n==33==>".$sql;
                        mysqli_query($this->db, $sql);
                    }else if($data['status']=="Joined") {
                        $arc_abs_cv_path = ARC_FILE_PATH.end(explode("/",$row['cv']));
                        rename($row['cv'], $arc_abs_cv_path);
                        $sql = "delete from demand where demand_id=".$demand_id.";";
                        mysqli_query($this->db, $sql);
                        $sql = "INSERT INTO `demand_archieve` (`demand_id`, `candidate_name`, `position`, `joining_date`,`tentative_mapping`,`status`,`backfill_emp_id`,`jd`,`cv`,`bos_id`) VALUES ('".$demand_id."','".$data['candidate_name']."','".$data['position']."','".$data['joining_date']."','".$data['tentative_mapping']."','".$data['status']."','".$backfill."','". $arc_abs_jd_path."','". $arc_abs_cv_path."','".$data['bos_id']."')";
                        mysqli_query($this->db, $sql);
                    }else{

                        $sql = "UPDATE `demand` SET `candidate_name`='".$data['candidate_name']."',`position`='".$data['position']."',`joining_date`='".$data['joining_date']."',`tentative_mapping`='".$data['tentative_mapping']."',`status`='".$data['status']."',`backfill_emp_id`='".$backfill."',`jd`='".$abs_jd_path."',`bos_id`='".$data['bos_id']."' WHERE `demand_id`='".$demand_id."'";
                        mysqli_query($this->db, $sql);
                    }
                    
                    //echo "\n==22==>".$sql;
                    $return['status'] = "success";
                    $return['data'] = "Demand Updated Successfully...!";
                }
            }else if(!empty($files['cv_attach']['tmp_name'])){
                $cv_file = $files['cv_attach']['tmp_name'];
                $file_type = end(explode(".",$files['cv_attach']['name']));
                $status = $arc_cv_file_path = $arc_abs_cv_path = $file_path = $abs_path = "";
                if($data['status']=="Dropped" || $data['status']=="Joined"){
                    $arc_cv_file_path = ARC_FILE_PATH."Demand_".$demand_id."_".$timestamp."_CV.".$file_type;
                    $arc_abs_cv_path = ARC_ABS_FILE_PATH."Demand_".$demand_id."_".$timestamp."_CV.".$file_type;
                    $status = move_uploaded_file($cv_file,$arc_cv_file_path);
                }else{
                    $file_path = FILE_PATH."Demand_".$demand_id."_".$timestamp."_CV.".$file_type;
                    $abs_path = ABS_FILE_PATH."Demand_".$demand_id."_".$timestamp."_CV.".$file_type;
                    $status = move_uploaded_file($cv_file,$file_path);
                    unlink(FILE_PATH.end(explode("/",$row['cv'])));
                }

                if($status!=1){
                    $return['status'] = "error";
                    $return['data'] = "File Upload Failed. Try Again..!";
                }else{
                    if($data['status']=="Dropped"){
                        // $status_jd = rename($row['jd'], ARC_FILE_PATH.end(explode("/",$row['jd'])));
                        $arc_abs_jd_path = ABS_FILE_PATH.end(explode("/",$row['jd']));

                        $arc_jd_path = ARC_FILE_PATH.end(explode("/",$row['jd']));
                        rename(FILE_PATH.end(explode("/",$row['jd'])), $arc_jd_path);

                        // echo "\nFile Moved with status=>".$status1;
                        // exit(0);
                        $sql = "UPDATE `demand` SET `candidate_name`='',`position`='".$data['position']."',`joining_date`='',`tentative_mapping`='',`status`='',`backfill_emp_id`='',`jd`='',`cv`='',`bos_id`='".$data['bos_id']."' WHERE `demand_id`='".$demand_id."'";
                        mysqli_query($this->db, $sql);

                        $sql = "INSERT INTO `demand_archieve` (`demand_id`, `candidate_name`, `position`, `joining_date`,`tentative_mapping`,`status`,`backfill_emp_id`,`jd`,`cv`,`bos_id`) VALUES ('".$demand_id."','".$data['candidate_name']."','".$data['position']."','".$data['joining_date']."','".$data['tentative_mapping']."','".$data['status']."','".$backfill."','". $arc_abs_jd_path."','". $arc_abs_cv_path."','".$data['bos_id']."')";
                        //echo "\n==33==>".$sql;
                        mysqli_query($this->db, $sql);
                    }else if($data['status']=="Joined") {
                        $arc_abs_jd_path = ABS_FILE_PATH.end(explode("/",$row['jd']));

                        $arc_jd_path = ARC_FILE_PATH.end(explode("/",$row['jd']));
                        rename(FILE_PATH.end(explode("/",$row['jd'])), $arc_jd_path);

                        $sql = "delete from demand where demand_id=".$demand_id.";";
                        mysqli_query($this->db, $sql);
                        $sql = "INSERT INTO `demand_archieve` (`demand_id`, `candidate_name`, `position`, `joining_date`,`tentative_mapping`,`status`,`backfill_emp_id`,`jd`,`cv`,`bos_id`) VALUES ('".$demand_id."','".$data['candidate_name']."','".$data['position']."','".$data['joining_date']."','".$data['tentative_mapping']."','".$data['status']."','".$backfill."','". $arc_abs_jd_path."','". $arc_abs_cv_path."','".$data['bos_id']."')";
                        mysqli_query($this->db, $sql);
                    }else{
                        $sql = "UPDATE `demand` SET `candidate_name`='".$data['candidate_name']."',`position`='".$data['position']."',`joining_date`='".$data['joining_date']."',`tentative_mapping`='".$data['tentative_mapping']."',`status`='".$data['status']."',`backfill_emp_id`='".$backfill."',`cv`='".$abs_path."',`bos_id`='".$data['bos_id']."' WHERE `demand_id`='".$demand_id."'";
                        mysqli_query($this->db, $sql);
                    }
                    //echo "\n==44==>".$sql;
                    $return['status'] = "success";
                    $return['data'] = "Demand Updated Successfully...!";
                }
            }else if(empty($files['jd_attach']['tmp_name']) && empty($files['cv_attach']['tmp_name'])){

                if($data['status']=="Dropped"){
                    $arc_abs_jd_path = ABS_FILE_PATH.end(explode("/",$row['jd']));
                    $arc_abs_cv_path = ABS_FILE_PATH.end(explode("/",$row['cv']));

                    $arc_jd_path = ARC_FILE_PATH.end(explode("/",$row['jd']));
                    rename(FILE_PATH.end(explode("/",$row['jd'])), $arc_jd_path);

                    $arc_cv_path = ARC_FILE_PATH.end(explode("/",$row['cv']));
                    rename(FILE_PATH.end(explode("/",$row['cv'])), $arc_cv_path);
                    //echo "\n=>".$a."==".$b;exit(0);

                    $sql = "UPDATE `demand` SET `candidate_name`='',`position`='".$data['position']."',`joining_date`=NULL,`tentative_mapping`='',`status`=NULL,`backfill_emp_id`='',`jd`='',`cv`='',`bos_id`='".$data['bos_id']."' WHERE `demand_id`='".$demand_id."'";
                    mysqli_query($this->db, $sql);
                    //echo "\n==11==>".$sql;
                    //exit(0);
                    $sql = "INSERT INTO `demand_archieve` (`demand_id`, `candidate_name`, `position`, `joining_date`,`tentative_mapping`,`status`,`backfill_emp_id`,`jd`,`cv`,`bos_id`) VALUES ('".$demand_id."','".$data['candidate_name']."','".$data['position']."','".$data['joining_date']."','".$data['tentative_mapping']."','".$data['status']."','".$backfill."','". $arc_abs_jd_path."','". $arc_abs_cv_path."','".$data['bos_id']."')";
                    //echo "\n==22==>".$sql;
                    //exit(0);
                    mysqli_query($this->db, $sql);
                }else if($data['status']=="Joined") {

                    $arc_abs_jd_path = ABS_FILE_PATH.end(explode("/",$row['jd']));
                    $arc_abs_cv_path = ABS_FILE_PATH.end(explode("/",$row['cv']));

                    $arc_jd_path = ARC_FILE_PATH.end(explode("/",$row['jd']));
                    rename(FILE_PATH.end(explode("/",$row['jd'])), $arc_jd_path);

                    $arc_cv_path = ARC_FILE_PATH.end(explode("/",$row['cv']));
                    rename(FILE_PATH.end(explode("/",$row['cv'])), $arc_cv_path);

                    $sql = "delete from demand where demand_id=".$demand_id.";";
                    //echo "===>".$sql;exit(0);
                    mysqli_query($this->db, $sql);

                    $sql = "INSERT INTO `demand_archieve` (`demand_id`, `candidate_name`, `position`, `joining_date`,`tentative_mapping`,`status`,`backfill_emp_id`,`jd`,`cv`,`bos_id`) VALUES ('".$demand_id."','".$data['candidate_name']."','".$data['position']."','".$data['joining_date']."','".$data['tentative_mapping']."','".$data['status']."','".$backfill."','". $arc_abs_jd_path."','". $arc_abs_cv_path."','".$data['bos_id']."')";
                    mysqli_query($this->db, $sql);
                }
                else{
                    $sql = "UPDATE `demand` SET `candidate_name`='".$data['candidate_name']."',`position`='".$data['position']."',`joining_date`='".$data['joining_date']."',`tentative_mapping`='".$data['tentative_mapping']."',`status`='".$data['status']."',`backfill_emp_id`='".$backfill."',`bos_id`='".$data['bos_id']."' WHERE `demand_id`='".$demand_id."'";
                    mysqli_query($this->db, $sql);
                }                
                //echo "\n==55==>".$sql;
                $return['status'] = "success";
                $return['data'] = "Demand Updated Successfully...!";
            }
        }else if ($data['action']=="add") {
            $timestamp = time();
            $demand_id = $data['demand_id'];
            if(!empty($files['jd_attach']['tmp_name']) && !empty($files['cv_attach']['tmp_name']) && !empty($data['candidate_name'])){
                $jd_file = $files['jd_attach']['tmp_name'];
                $cv_file = $files['cv_attach']['tmp_name'];
                $jd_file_type = end(explode(".",$files['jd_attach']['name']));
                $cv_file_type = end(explode(".",$files['cv_attach']['name']));
                $jd_file_path = FILE_PATH."Demand_".$demand_id."_".$timestamp."_JD.".$jd_file_type;
                $abs_jd_path = ABS_FILE_PATH."Demand_".$demand_id."_".$timestamp."_JD.".$jd_file_type;
                
                $cv_file_path = FILE_PATH."Demand_".$demand_id."_".$timestamp."_CV.".$cv_file_type;
                $abs_cv_path = ABS_FILE_PATH."Demand_".$demand_id."_".$timestamp."_CV.".$cv_file_type;

                $status_jd = move_uploaded_file($jd_file,$jd_file_path);
                $status_cv = move_uploaded_file($cv_file,$cv_file_path);
                if($status_jd !=1 && $status_cv!=1){
                    $return['status'] = "error";
                    $return['data'] = "File Upload Failed. Try Again..!";
                }else{
                    $sql = "INSERT INTO `demand` (`demand_id`, `candidate_name`, `position`, `joining_date`,`tentative_mapping`,`status`,`backfill_emp_id`,`jd`,`cv`,`bos_id`) VALUES ('".$demand_id."','".$data['candidate_name']."','".$data['position']."','".$data['joining_date']."','".$data['tentative_mapping']."','".$data['status']."','".$backfill."','". $abs_jd_path."','". $abs_cv_path."','".$data['bos_id']."')";
                    //echo "\n==33==>".$sql;
                    mysqli_query($this->db, $sql);
                    $return['status'] = "success";
                    $return['data'] = "Demand Added Successfully...!";
                }
            }else if(!empty($files['jd_attach']['tmp_name'])){
                $jd_file = $files['jd_attach']['tmp_name'];
                $file_type = end(explode(".",$files['jd_attach']['name']));
                $file_path = FILE_PATH."Demand_".$demand_id."_".$timestamp."_JD.".$file_type;
                $abs_path = ABS_FILE_PATH."Demand_".$demand_id."_".$timestamp."_JD.".$file_type;
                $status = move_uploaded_file($jd_file,$file_path);
                if($status!=1){
                    $return['status'] = "error";
                    $return['data'] = "File Upload Failed. Try Again..!";
                }else{
                    $sql = "INSERT INTO `demand` (`demand_id`, `candidate_name`, `position`, `joining_date`,`tentative_mapping`,`status`,`backfill_emp_id`,`jd`,`bos_id`) VALUES ('".$demand_id."','".$data['candidate_name']."','".$data['position']."','".$data['joining_date']."','".$data['tentative_mapping']."','".$data['status']."','".$backfill."','". $abs_path."','".$data['bos_id']."')";
                    //echo "\n==44==>".$sql;
                    mysqli_query($this->db, $sql);
                    $return['status'] = "success";
                    $return['data'] = "Demand Added Successfully...!";
                }
            }
        }else if(empty($data['demand_id'])){
            $return['status'] = "error";
            $return['data'] = "Demand ID Cannot be Empty ..!";
        }
        return $return; 
    }

    /**
     * Get all data from Employees
     */
    
    public function getAll()
    {
        $sql = "select * from demand order by joining_date";
        $result = mysqli_query($this->db, $sql);
        $count = 1;
        while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $row->{$count} = $array;
            $count++;
        }
        return $row;
    }

    public function getAllArchieve()
    {
        $sql = "select * from demand_archieve order by demand_id";
        $result = mysqli_query($this->db, $sql);
        $count = 1;
        while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $row->{$count} = $array;
            $count++;
        }
        return $row;
    }
}