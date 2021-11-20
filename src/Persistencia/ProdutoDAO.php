<?php

class ProdutoDAO{

    function __construct(){
    }

    // Cadastra/Salva novo produto
    function salvar($produto, $conn){
        $query = "INSERT INTO `Produto`(`proNome`, `proPreco`, `proQtdEstoque`, `proDataCadastro`, `proDescricao`, `Categoria_catCodigo`) 
                    VALUES ('" . $produto->getNome() . "','" .
            $produto->getPreco() . "','" .
            $produto->getQtdEstoque() . "','" .
            $produto->getDataCadastro() . "','" .
            $produto->getDescricao() . "','" .
            $produto->getCategoria()->getCodigo() . "')";
        
        $res = $conn->query($query);
        return $res;
    }

    // Exclui
    function excluir($proCodigo, $conn){
        $query = "DELETE FROM `Produto` WHERE proCodigo = " . $proCodigo; //TODO - tratar SQLInjection

        $res = $conn->query($query);
        return $res;
    }

    // Retorna todos os produtos
    function listarTodos($conn){
        try {
            $query = "SELECT * FROM Produto";

            $res = $conn->query($query);
            return $res->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // busca um Produto por Codigo
    function buscarPorCodigo($proCodigo, $conn){
        try {
            $query = "SELECT * FROM `Produto` WHERE `proCodigo` = " . $proCodigo;
            $res = $conn->query($query);
            
            return $res->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


	// busca um Produto por Nome
    function buscarPorNome($proNome, $conn){
        try {
            $query = "SELECT * FROM `Produto` WHERE `proNome` = " . $proNome;
            $res = $conn->query($query);

            return $res->fetchAll();
		} catch (Exception $e) {
            echo $e->getMessage();
        }
	}
	
    // Edita um Produto
    function editar($produto, $conn){
        $query = "UPDATE `Produto` SET 
                    `proNome`='" . $produto->getNome() . "',
                    `proPreco`='" . $produto->getPreco() . "',
                    `proQtdEstoque`='" . $produto->getQtdEstoque() . "',
                    `proDataCadastro`='" . $produto->getDataCadastro() . "',
                    `proDescricao`='" . $produto->getDescricao() . "',
                    `Categoria_catCodigo`='" . $produto->getCategoria()->getCodigo() . "' WHERE `proCodigo` = " . $produto->getCodigo();

        $res = $conn->query($query);
        return $res;
    }
}
