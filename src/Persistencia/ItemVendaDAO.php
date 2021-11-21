<?php

class ItemVendaDAO{

    function __construct(){
    }

    // Cadastra/Salva novo itemVenda
    function salvar($itemVenda, $conn){
        try{
            $query = "INSERT INTO `ItemVenda`(`itvProCodigo`, `itvVenCodigo`, `itvQtd`, `itvPreco`) 
                        VALUES ('" . $itemVenda->getProduto() . "','" .
                        $itemVenda->getVenda() . "','" .
                        $itemVenda->getQtd() . "','" .
                        $itemVenda->getPreco() . "')";

            $res = $conn->query($query);
            if ($res)
                return $res;
                    
            throw new Exception('Erro ao cadastrar itemVenda no banco de dados');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Exclui itemVenda por coidgo Venda
    function excluirPorVenda($itvVenCodigo, $conn){
        $query = "DELETE FROM `ItemVenda` WHERE itvVenCodigo = " . $itvVenCodigo; //TODO - tratar SQLInjection

        $res = $conn->query($query);
        return $res;
    }
	
	// Exclui itemVenda por codigo de Protudo e Venda
    /* function excluirPorAmbos($itvProCodigo, $itvVenCodigo, $conn){
        $query = "DELETE FROM `ItemVenda` WHERE itvProCodigo = " . $itvProCodigo . 
					" and itvVenCodigo = " . $itvVenCodigo; //TODO - tratar SQLInjection

        $res = $conn->query($query);
        return $res;
    } */

    // Retorna todos os itemVenda de uma venda
    function listarTodosPorVenda($itvVenCodigo, $conn){
        try {
            $query = "SELECT * FROM ItemVenda WHERE itvVenCodigo = " . $itvVenCodigo;

            $res = $conn->query($query);
            $res = $res->fetchAll();

            $itensVenda = array();

            foreach($res as $item){
                $itemVenda = new ItemVenda(
                    $item['itvQtd'],
                    $item['itvPreco'],
                    $item['itvProCodigo'],
                    $item['itvVenCodigo']
                );

                array_push($itensVenda, $itemVenda);
            }

            return $itensVenda;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

	// Retorna todos os itemVenda de um produto
    /* function listarTodosPorProduto($itvProCodigo, $conn){
        try {
            $query = "SELECT * FROM ItemVenda WHERE itvProCodigo = " . $itvProCodigo;

            $res = $conn->query($query);
            return $res->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } */

    // busca uma ItemVenda por codigo de Protudo e Venda
    /* function buscarPorCodigoAmbos($itvProCodigo, $itvVenCodigo, $conn){
        try {
            $query = "SELECT * FROM `ItemVenda` WHERE itvProCodigo = " . $itvProCodigo . 
					" and itvVenCodigo = " . $itvVenCodigo; //TODO - tratar SQLInjection
            $res = $conn->query($query);

            return $res->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } */

}
