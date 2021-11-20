<?php

class Categoria{

	// Atributos da classe Categoria
	private $codigo;
	private $nome;
    private $descricao;

	// Contrutores da classe Categoria
	function __construct($vnome, $vdescricao = null, $vcodigo = null){
        $this->codigo = $vcodigo;
        $this->nome = $vnome;
        $this->$descricao = $vdescricao;
    }
	
	// Metodos getter do atributo Codigo
	function getCodigo(){
		return $this->codigo;
	}
	
	// Metodos getter e setter do atributo Nome
	function getNome(){
		return $this->nome;
	}
	
	function setNome($nome){
		$this->nome = $nome; 
	}
	
	// Metodos getter e setter do atributo Descricao
	function getDescricao(){
		return $this->descricao;
	}
	
	function setDescricao($descricao){
		$this->descricao = $descricao; 
	}

}

?>