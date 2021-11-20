<?php

class ItemVenda{

	// Atributos da classe ItemVenda
	private $produto;
	private $venda;
    private $qtd;
    private $preco;

	// Contrutores da classe ItemVenda
	function __construct($qtd, $preco, $produto = null, $venda = null){
        $this->produto = $produto;
        $this->venda = $venda;
        $this->qtd = $qtd;
        $this->preco = $preco;
    }

	// Metodos getter do atributo Produto
	function getProduto(){
		return $this->produto;
	}
	
	// Metodos getter e setter do atributo Venda
	function getVenda(){
		return $this->venda;
	}
	
	// Metodos getter e setter do atributo Qtd
	function getQtd(){
		return $this->qtd;
	}
	
	function setQtd($qtd){
		$this->qtd = $qtd; 
	}
	
	// Metodos getter e setter do atributo Preco
	function getPreco(){
		return $this->preco;
	}
	
	function setPreco($preco){
		$this->preco = $preco; 
	}

}

?>