<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unique_username_lib 
{
    var $CI;
    public function __construct($params = array())
    {
        $this->CI =& get_instance();
        $this->CI->load->database();
        
    }

    //Generate a unique username using Database
    function generate_unique_username($string_name="", $rand_no = "")
    {
      // echo $string_name."".$rand_no;
       while(true){
            $username_parts = array_filter(explode(" ", strtolower($string_name))); //explode and lowercase name
            $username_parts = array_slice($username_parts, 0, 2); //return only first two arry part
        
            $part1 = (!empty($username_parts[0]))?substr($username_parts[0], 0,8):""; //cut first name to 8 letters
            $part2 = (!empty($username_parts[1]))?substr($username_parts[1], 0,5):""; //cut second name to 5 letters
            $part3 = ($rand_no)?rand(0, $rand_no):"";
            
            $username = $part1. str_shuffle($part2). $part3; //str_shuffle to randomly shuffle all characters 
            
            $username_exist_in_db = $this->username_exist_in_database($username); //check username in database
            if(!$username_exist_in_db){
                return $username;
            }
        }
    }

    // User Name exist in Database.
    function username_exist_in_database($username="")
    {
      $mitra = "SELECT * FROM mitra WHERE username = ?"; 
      $user = "SELECT * FROM user WHERE username = ?";
      $results1 = $this->CI->db->query($mitra, array($username));
      $results2 = $this->CI->db->query($mitra, array($username));
      if ( $results1->num_rows() > 0 OR $results2->num_rows() > 0) 
      {
      	# code...
      	return true;
      }
      else
      {
      	return false;
      }
      
    }
}