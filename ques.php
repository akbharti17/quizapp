<?php
include_once("connection.php");

class Quest
{
    public $con;

    function __construct()
    {
        $obj = new Dbconnect;
        $this->con = $obj->dbconnection();
    }

    function insertques($ques, $opt1, $opt2, $opt3, $opt4, $ans, $cat){
        
        $q="INSERT INTO `tbl_ques`(`ques`, `opt1`, `opt2`, `opt3`, `opt4`, `ans`, `category`)
         VALUES ('$ques','$opt1','$opt2','$opt3','$opt4','$ans','$cat') ";
         $status=$this->con->query($q);
        if($status===TRUE){
            return true;
        }else{
            return false;
        }

    }

    function getQues($cat){
        
        $q="SELECT * FROM `tbl_ques` WHERE category='$cat'";
        $result=$this->con->query($q);
        if($result->num_rows > 0){
            return $result;

        }else{
            return false;
        }
    }

    function getAll(){
        $q="SELECT * FROM `tbl_ques`";
        $result=$this->con->query($q);
        if($result->num_rows > 0){
            return $result;

        }else{
            return false;
        }
    }
}
