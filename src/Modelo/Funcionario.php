<?php

class Funcionario{

    private $codigo;
    private $email;
    private $nome;
    private $username;
    private $senha;
    private $isGerente;

    function __construct($vemail, $vnome, $vusername, $vsenha, $visGerente, $vcodigo = null){
        $this->codigo = $vcodigo;
        $this->email = $vemail;
        $this->nome = $vnome;
        $this->username = $vusername;
        $this->senha = $vsenha;
        $this->isGerente = $visGerente;
    }

    function getCodigo(){
        return $this->codigo;
    }

    function getEmail(){
        return $this->email;
    }
    
    function getNome(){
        return $this->nome;
    }

    function getUsername(){
        return $this->username;
    }

    function getSenha(){
        return $this->senha;
    }

    function getIsGerente(){
        return $this->isGerente;
    }

}

?>