    <?php
    class AllSkillsModel {
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
       
        /**
         * Get all data from All Managers.
         */
        public function getAllSkillsList()
        {        
            $sql = "SELECT skill FROM `all_skills` ORDER BY skill ASC" ;
            $result = mysqli_query($this->db, $sql);        
            $count = 1;
            $arr_result = array();
            $arr_page['more'] = true;

            $arr_SkillList=array();
           
           while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                $row->{$count} = $array;
               $arrdata = array();
               // print_r($array['skill'] );

                $arrdata['id']= $count;
                $arrdata['text'] = $array['skill'];
                $count++;
                array_push($arr_SkillList, $arrdata);
            }
            $arr_result['result'] = $arr_SkillList;
            $arr_result['pagination'] = $arr_page;

            $arr_response['status'] = "success";
            $arr_response['response'] = $arr_result;

            return $arr_response;
        }

         public function addCustomSkills($data)
        { 
            // print_r("expression");
            // print_r($data);
            // exit(0);
            $sql_skill = "SELECT skill FROM `all_skills` ORDER BY skill ASC" ;
            $result_allskill = mysqli_query($this->db, $sql_skill);        
            $count = 1;
            $arr_SkillList=array();
           
           while($array = mysqli_fetch_array($result_allskill,MYSQLI_ASSOC)){
                $row->{$count} = $array;
               
                array_push($arr_SkillList, strtolower($array['skill']));
                 $count++;
            }

            if($data['skillNameCustom'] != ""){
                    $arr_skill_final = explode (",", $data['skillNameCustom'] ); 
                }

            $arr_response = array();        
            if(!empty($arr_skill_final)){               
                foreach ($arr_skill_final as $key => $value) {
                    if(!in_array(strtolower($value), $arr_SkillList)){          
                                             
                        $sql =   "INSERT INTO `all_skills` (`skill`) VALUES ('". $value."'); ";
                        $sql_result=  mysqli_query($this->db, $sql);
                        $result = mysqli_fetch_array($sql_result,MYSQLI_ASSOC);
                        $arr_response['status'] = "success";
                        $arr_response['response'] = "Skill Inserted Please Refresh.";

                       }           
                       else{
                        $arr_response['status'] = "error";
                        $arr_response['response'] = "Insert Failed Skill Already Exists.";
                       }    

                }
            }
          
             return  $arr_response;

        }

       public function addEmployeeSkill($data)
        {   
            
            //Employeee Name from Employee Code
            $sql_emp =   "SELECT emp_name FROM `emp_master` WHERE emp_code='".$data['emp_Name']."' ";
            $sql_emp_result=  mysqli_query($this->db, $sql_emp);
            $emp_name_res = mysqli_fetch_array($sql_emp_result,MYSQLI_ASSOC);

            
            $primary_string = implode(',', $data['skill_list_primary']);
            $secondary_string = implode(',', $data['skill_list_secondary']);

            // print_r( $primary_string );     
            $sql_emp =   "SELECT emp_code FROM `skill_matrix` WHERE emp_code='".$data['emp_Name']."' ";
            // print_r($sql_emp);
            $sql_emp_existin=  mysqli_query($this->db, $sql_emp);
            $check_existing = mysqli_fetch_array($sql_emp_existin,MYSQLI_ASSOC);

            if(empty($check_existing)){

                $sql =  "INSERT INTO `skill_matrix` (`emp_code`, `emp_name`, `primary_skill`, `secondary_skill`) VALUES ('".$data['emp_Name']."', '".$emp_name_res['emp_name']."', '".$primary_string."', '".$secondary_string."'); ";
                
                $sql_result=  mysqli_query($this->db, $sql);
                $result = mysqli_fetch_array($sql_result,MYSQLI_ASSOC);
                    // print_r($sql_result);
                    // exit(0);
                     $arr_response = array();
                if($sql_result == 1){
                    $arr_response['status'] = "success";
                    $arr_response['response'] = "Record Insert Succssfully.";
                }
                else{
                    $arr_response['status'] = "error";
                    $arr_response['response'] = "Insert Failed.";
                }
            }
            else{ 

                $sql = "UPDATE `skill_matrix` SET `primary_skill`='".$primary_string."',`secondary_skill`= '".$secondary_string."' WHERE `emp_code`='".$data['emp_Name']."'";

               
                $sql_result=  mysqli_query($this->db, $sql);
                $result = mysqli_fetch_array($sql_result,MYSQLI_ASSOC);
                $arr_response = array();
                if($sql_result == 1){
                    $arr_response['status'] = "success";
                    $arr_response['response'] = "Record Insert Succssfully.";
                }
                else{
                    $arr_response['status'] = "error";
                    $arr_response['response'] = "Insert Failed.";
                }
            }
          
      
        
            return $arr_response;
        }


        public function deleteSkillRecord($data)
        {        
            // print_r($data);
            // exit(0);
            $sql = "DELETE FROM `skill_matrix` WHERE `emp_code` = '".$data['emp_code']."';" ;
            $result = mysqli_query($this->db, $sql);      

           
           if($sql_result == 1){
                $arr_response['status'] = "success";
                $arr_response['response'] = "Record Deleted Succssfully.";

            }
            else{
                $arr_response['status'] = "error";
                $arr_response['response'] = "Record Cannot Be Deleted.";
            }
           

            return $arr_response;
        }
        //Getsthe the employee skills and returns the data for the selected Employee For Selct2
        public function getEmpSkillRecordSel2($data)
        { 
            $sql = "SELECT skill FROM `all_skills` ORDER BY skill ASC" ;
            $result = mysqli_query($this->db, $sql);        
            $count = 1;
            $arr_result = array();
            $arr_page['more'] = true;

            $arr_SkillList=array();
           
           while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                $row->{$count} = $array;
               $arrdata = array();
               // print_r($array['skill'] );

                $arrdata['id']= $count;
                $arrdata['text'] = $array['skill'];
                $count++;
                array_push($arr_SkillList, $arrdata);
            }
            $arr_result['result'] = $arr_SkillList;
            $arr_result['pagination'] = $arr_page;

            

            //This gets the primary and secondary skills of the employee
            $prim_array = explode(',', $data['primary_skill']);
            $second_array =explode(',', $data['secondary_skill']);

            $create_primary = array();
            $create_secondary = array();


            foreach ($arr_result['result'] as $key => $value) {
                if(in_array($value['text'], $prim_array)){

                    $value['selected'] = true;   
                    // print_r($value);
                    array_push($create_primary, $value);
                     //     exit(0);
                }
                elseif (in_array($value['text'], $second_array)) {
                    # code...
                    $value['selected'] = true;   
                    // print_r($value);
                    array_push($create_secondary, $value);
                }
                else
                {   
                    $value['selected'] = false;   
                    array_push($create_primary, $value);
                    array_push($create_secondary, $value);   
                }
               
            }

            //create a selcted list of the employee skills which can be set to slect 2

            $arr_result['result'] = $create_primary;
            $priRetArr = $arr_result;
            $arr_result['result'] = $create_secondary;            
            $secRetArr = $arr_result;

            // echo '<pre>';
            // print_r($priRetArr);
            // print_r($secRetArr);
            // echo '</pre>';
            // exit(0);
            $arr_response = array();
            $arr_response['primary_skill_sel'] = $priRetArr;
            $arr_response['secondary_skill_sel'] = $secRetArr;

            return $arr_response;

        }


        public function getEmpSkillRecord($data)
        {        
            // print_r($data);
            // exit(0);
            //Gets the employee details
            $sql = "SELECT * FROM `skill_matrix` WHERE `emp_code` = '".$data['emp_code']."';" ;
            $result = mysqli_query($this->db, $sql); 
            $emp_details = array();     
            while($array = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                $row->{$count} = $array;
               $emp_details['emp_code']  = $array['emp_code'];
               $emp_details['emp_name'] = $array['emp_name'];
               $emp_details['primary_skill'] = $array['primary_skill'];
               $emp_details['secondary_skill'] = $array['secondary_skill'];
                
                 $count++;
            }

           // print_r($row);
            $select2_list = $this->getEmpSkillRecordSel2( $emp_details);
            // echo '<pre>';
            // print_r($select2_list); 
            // echo '<pre>';
             // exit(0);
            $arr_response = array();
           if($result){
                $arr_response['status'] = "success";
                $arr_response['response'] = $emp_details;
                $arr_response['selectedVal'] = $select2_list;

            }
            else{
                $arr_response['status'] = "error";
                $arr_response['response'] = "No Record Found";
            }
           
            // print_r($arr_response );
            // exit(0);
             return $arr_response;
        }




    }
