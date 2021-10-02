<?php

class Connection{
    private $servername="localhost";
    private $username="root";
    private $password="";
    private $bd="databasename";
    private $conn=null;
    
    function __construct(){}

    function getConnection(){
        if ($this->conn == null){
            $this->conn = mysqli_connect($this->servername, $this->username,$this->password, $this->bd);
        }
        if(!$this->conn){
            die("falha na conexão: ".$conn->connec_error);
        }
        return $this->conn;
    }
}

?>