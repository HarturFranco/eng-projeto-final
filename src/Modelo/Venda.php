<?php

class Venda{

	// Atributos da classe Venda
	private $codigo;
	private $precoTotal;
    private $cliente;
    private $funcionario;
    private $status;

	// Contrutores da classe Venda
	function __construct($codigo, $precoTotal, $cliente, $funcionario, $status){
        $this->codigo = $codigo;
        $this->precoTotal = $precoTotal;
        $this->cliente = $cliente;
        $this->funcionario = $funcionario;
        $this->status = $status;
    }
	
	function __construct($precoTotal, $cliente, $funcionario, $status){
		$this->codigo = null;
        $this->precoTotal = $precoTotal;
        $this->cliente = $cliente;
        $this->funcionario = $funcionario;
        $this->status = $status;
    }
	
	function __construct(){
		$this->codigo = null;
        $this->precoTotal = null;
        $this->cliente = null;
        $this->funcionario = null;
        $this->status = null;
    }

	// Metodos getter do atributo Codigo
	function getCodigo(){
		return $this->codigo;
	}
	
	// Metodos getter e setter do atributo PrecoTotal
	function getPrecoTotal(){
		return $this->precoTotal;
	}
	
	function setPrecoTotal($precoTotal){
		$this->precoTotal = $precoTotal; 
	}
	
	// Metodos getter e setter do atributo Cliente
	function getCliente(){
		return $this->cliente;
	}
	
	function setCliente($cliente){
		$this->cliente = $cliente; 
	}
	
	// Metodos getter e setter do atributo Funcionario
	function getFuncionario(){
		return $this->funcionario;
	}
	
	function setFuncionario($funcionario){
		$this->funcionario = $funcionario; 
	}
	
	// Metodos getter e setter do atributo Status
	function getStatus(){
		return $this->status;
	}
	
	function setStatus($status){
		$this->status = $status; 
	}

}

?>