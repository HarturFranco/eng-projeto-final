<?php

class Connection
{
    private $servername = "db";
    private $username = "root";
    private $password = "123";
    private $bd = "toca_dos_instrumentos";
    private $pdo = null;

    function __construct()
    {
        $dsn = "mysql:dbname=" . $this->bd . ";host=" . $this->servername;

        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            throw new Exception('Falha na conexão com o banco de dados');
        }
    }

    function getConnection()
    {
        return $this->pdo;
    }
}
