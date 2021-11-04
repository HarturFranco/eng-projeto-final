<?php

class Connection{
    private $servername="db";
    private $username="root";
    private $password="123";
    private $bd="toca_dos_instrumentos";
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