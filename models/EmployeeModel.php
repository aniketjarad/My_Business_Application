<?php
class URLModel {
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
    public function getAll()
    {
        $sql = "select * from emp_master";
        $result = mysqli_query($this->db, $sql);
        $count = 1;
        while($array = mysqli_fetch_object($result)){
            $row->{$count} = $array;
            $count++;
        }
        return $row;
    }

    /**
     * Insert record in URLs table
     */
    public function addURL($long_url)
    {   
        $result = array();
        // clean the input from javascript code for example
        $long_url = strip_tags($long_url);
        
        $json_data = $this->checkExisting($long_url);
        if($json_data){
            $data = json_decode($json_data,true);
            if(empty($data['short_url']) && !empty($data['id'])){
                $short_url = $this->generateShortUrl($data['id']);
                //$short_url = "http://bit.ly/".$short_url."/";
                $this->updateWhere($long_url,$short_url);
                $result = $short_url;
            }else{
                $result = $data['short_url'];
            }
            
        }else{
            $sql = "INSERT INTO URLs (long_url) VALUES ('".$long_url."')";
            mysqli_query($this->db, $sql);
            $unique_id = mysqli_insert_id($this->db);
            $short_url = $this->generateShortUrl($unique_id);
            //$short_url = "http://bit.ly/".$short_url."/";
            $this->updateWhere($long_url,$short_url);
            $result = $short_url;
        }
        
        return $result;
    }

    /**
     * Where query for URLs table
     */
    public function whereURL($array)
    {
        $cond_string = '';
        foreach($array as $key => $value) {
          $cond_string .= $key.'= "'.$value.'"';
        }
        $sql = "SELECT * FROM URLs WHERE ".$cond_string;

        $result = mysqli_query($this->db, $sql);

        return mysqli_fetch_assoc($result);
    }
    /**
     * updateWhere query for URLs table
     */
    public function updateWhere($long_url,$short_url)
    {
        
        $sql = "UPDATE `URLs` SET `short_url`='".$short_url."'WHERE `long_url`='".$long_url."'";

        $result = mysqli_query($this->db, $sql);

        return mysqli_fetch_object($result);
    }

    public function generateShortUrl($unique_id)
    {   
        
        $map_string = "0aR1bS2cT3dU4eV5fW6gX7hY8iZ9jAkBlCmDnEoFpGqHrIsJtKuLvMwNxOyPzQ";
        $map_array = str_split($map_string);
        $short_url = array();

        // Convert given integer id to a base 36 number
        while ($unique_id)
        {
            // use above map to store actual character
            // in short url
            array_push($short_url,$map_array[$unique_id%62]);
            $unique_id = (int)($unique_id/62);
        }

        // Reverse shortURL to complete base conversion
        $short_url = implode(array_reverse($short_url));
        
        return $short_url;

    }

    public function checkExisting($long_url) {

        $return_obj = $this->whereURL(['long_url'=> $long_url]);
        
        if ($return_obj) {
            $result = json_encode($return_obj);
        }else{
            $result = false;
        }
        
        return $result;
    }
}
