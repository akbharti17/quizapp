<?php 
 include("connection.php");

 class Quest{
     public $con;

     function __construct()
     {
         $obj=new Dbconnect;
         $this->con=$obj->dbconnection();
     }

     function insert(){
         
     }
 }