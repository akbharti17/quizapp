<?php
include("connection.php");
class User
{
    public $con;

    function __construct()
    {
        $obj = new Dbconnect;
        $this->con = $obj->dbconnection();
    }

    function insert($name, $email, $password)
    {
        $q = "INSERT INTO `tbl_user`(name,email_id,password) VALUES ('$name','$email','$password')";
        if($this->con->query($q)===TRUE){
            return true;
        }else{
            return false;
        }
        
    }

    function login($email,$pass){
        $q="SELECT * FROM `tbl_user` WHERE `email_id`='$email' AND password='$pass'";
        $result=$this->con->query($q);
        if($result->num_rows > 0){
            $data=$result->fetch_assoc();
            return $data;

        }else{
            return false;
        }
        
    }
}
