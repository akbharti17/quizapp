<?php
class Dbconnect
{
    public $username;
    public $host;
    public $pass;
    public $db;
    public $conn;

    function __construct()
    {
        $this->host = 'localhost';
        $this->username = 'root';
        $this->pass = '';
        $this->db = 'quiz';
    }
    function dbconnection()
    {
        $this->conn=new mysqli($this->host,$this->username,$this->pass,$this->db);
        if($this->conn->error){
            echo 'error in connection';
        }else{
            return $this->conn;
        }
    }
}

// $db=new Dbconnect;
// $con=$db->dbconnection();

