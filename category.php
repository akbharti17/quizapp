<?php
include_once("connection.php");
class Category{
    public $con;

    function __construct(){
        $db=new Dbconnect;
        $this->con=$db->dbconnection();

    }
    function insertCat($cat){
        $q="INSERT INTO `exam_category`(`category`) VALUES ('$cat')";
        if($this->con->query($q)===TRUE){
            return true;
        }else{
            return false;
        }

    }

    function getCat(){
        $q="SELECT * FROM `exam_category`";
        $data=$this->con->query($q);
        if($data->num_rows>0){
            return $data;
        }else{
            return false;
        }
    }
    
}