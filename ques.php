<?php 
 include_once("connection.php");

 class Quest{
     public $con;

     function __construct()
     {
         $obj=new Dbconnect;
         $this->con=$obj->dbconnection();
     }

     function insert($ques,$opt1,$opt2,$opt3,$opt4,$ans,$cat){
         $q="INSERT INTO `tbl_ques`( `ques`, `opt1`, `opt2`, `opt3`, `opt4`, `ans`, `category`)
          VALUES ('$ques','$opt1','$opt2','$opt3','$opt4','$ans','$cat')";
          if($this->con->query($q)===true){
              return true;
          }else
          {
              return false;
          }
          

     }
 }