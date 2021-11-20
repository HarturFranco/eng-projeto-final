<?php

class Produto{

	// Atributos da classe Produto
	private $codigo;
	private $nome;
	private $preco;
	private $qtdEstoque;
	private $dataCadastro;
	private $descricao;
    private $categoria;

	// Contrutores da classe Produto
	function __construct($nome, $preco, $qtdEstoque, $dataCadastro, $descricao, $categoria, $codigo = null){
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->qtdEstoque = $qtdEstoque;
        $this->dataCadastro = $dataCadastro;
        $this->descricao = $descricao;
        $this->categoria = $categoria;
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
	
	// Metodos getter e setter do atributo Preco
	function getPreco(){
		return $this->preco;
	}
	
	function setPreco($preco){
		$this->preco = $preco; 
	}

	// Metodos getter e setter do atributo QtdEstoque
	function getQtdEstoque(){
		return $this->qtdEstoque;
	}
	
	function setQtdEstoque($qtdEstoque){
		$this->qtdEstoque = $qtdEstoque; 
	}
	
	// Metodos getter e setter do atributo DataCadastro
	function getDataCadastro(){
		return $this->dataCadastro;
	}
	
	function setDataCadastro($dataCadastro){
		$this->dataCadastro = $dataCadastro; 
	}
	
	// Metodos getter e setter do atributo Descricao
	function getDescricao(){
		return $this->descricao;
	}
	
	function setDescricao($descricao){
		$this->descricao = $descricao; 
	}
	
	// Metodos getter e setter do atributo Categoria
	function getCategoria(){
		return $this->categoria;
	}
	
	function setCategoria($categoria){
		$this->categoria = $categoria; 
	}
}

?>