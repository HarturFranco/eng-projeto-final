<?php

class VendaDAO{

    function __construct(){
    }

    // Cadastra/Salva novo venda
    function salvar($venda, $conn){
        $query = "INSERT INTO `Venda`(`venPrecoTotal`, `Funcionario_funCodigo`, `Cliente_cliCodigo`, `venStatus`) 
                    VALUES ('" . $venda->getPrecoTotal() . "','" .
					$venda->getFuncionario()->getCodigo() . "','" .
					$venda->getCliente()->getCodigo() . "','" .
            $venda->getStatus() . "')";

        $res = $conn->query($query);
        return $res;
    }

    // Exclui venda
    function excluir($venCodigo, $conn){
        $query = "DELETE FROM `Venda` WHERE venCodigo = " . $venCodigo; //TODO - tratar SQLInjection

        $res = $conn->query($query);
        return $res;
    }

    // Retorna todas as vendas
    function listarTodos($conn){
        try {
            $query = "SELECT * FROM Venda";

            $res = $conn->query($query);
            return $res->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // busca uma Venda por Codigo
    function buscarPorCodigo($venCodigo, $conn){
        try {
            $query = "SELECT * FROM `Venda` WHERE `venCodigo` = " . $venCodigo;
            $res = $conn->query($query);

            return $res->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

	
    // Edita um Venda
    function editar($venda, $conn){
        $query = "UPDATE `Venda` SET 
                    `venPrecoTotal`='" . $venda->getPrecoTotal() . "',
                    `Funcionario_funCodigo`='" . $venda->getFuncionario()->getCodigo() . "',
                    `Cliente_cliCodigo`='" . $venda->getCliente()->getCodigo() . "',
                    `venStatus`='" . $venda->getStatus() . "' WHERE `venCodigo` = " . $venda->getCodigo();
        $res = $conn->query($query);
        return $res;
    }
}
