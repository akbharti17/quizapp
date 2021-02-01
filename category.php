<?php
include("connection.php");
class Category{
    public $con;

    function __construct(){
        $db=new Dbconnect;
        $this->con=$db->dbconnection();

    }
    function insert($cat,$no){
        $q="INSERT INTO `exam_category`(`category`, `quesno`) VALUES ('$cat','$no')";
        if($this->con->query($q)===TRUE){
            return true;
        }else{
            return false;
        }

    }

    function getData(){
        $q="SELECT * FROM `exam_category`";
        $data=$this->con->query($q);
        if($data->num_rows>0){
            return $data;
        }else{
            return false;
        }
    }
    
}