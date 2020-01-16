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
         $arrAllCount = array();
        
        $emp_count = $this->getEmpCount();

        $arrAllCount['emp_count'] = $emp_count;

         $certificate_count = $this->getCertificateCount();

         $arrAllCount['certificate_count'] = $certificate_count;

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



}
