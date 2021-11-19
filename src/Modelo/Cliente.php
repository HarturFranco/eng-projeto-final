<?php

class Cliente{

	// Atributos da classe Cliente
	private $codigo;
	private $nome;
    private $cpf;

	// Contrutores da classe Cliente
	function __construct($codigo, $nome, $cpf){
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->cpf = $cpf;
    }
	
	function __construct($nome, $cpf){
		$this->codigo = null;
        $this->nome = $nome;
        $this->cpf = $cpf;
    }
	
	function __construct(){
		$this->codigo = null;
        $this->nome = null;
        $this->cpf = null;
    }

	// Metodos getter do atributo Codigo
	function getCodigo(){
		return $this->codigo;
	}
	
	function setCodigo($codigo){
		$this->codigo = $codigo; 
	}
	
	// Metodos getter e setter do atributo Nome
	function getNome(){
		return $this->nome;
	}
	
	function setNome($nome){
		$this->nome = $nome; 
	}
	
	// Metodos getter e setter do atributo CPF
	function getCpf(){
		return $this->cpf;
	}
	
	function setCpf($cpf){
		$this->cpf = $cpf; 
	}

}

?>