<?php

class VendaDAO{

    function __construct(){
    }

    // Cadastra/Salva novo cliente
    function salvar($venda, $conn){
        $query = "INSERT INTO `Venda`(`cliNome`, `cliCPF`) 
                    VALUES ('" . $venda->getNome() . "','" .
            $venda->getCpf() . "')";

        $res = $conn->query($query);
        return $res;
    }

    // Exclui cliente
    function excluir($cliCodigo, $conn){
        $query = "DELETE FROM `Cliente` WHERE cliCodigo = " . $cliCodigo; //TODO - tratar SQLInjection

        $res = $conn->query($query);
        return $res;
    }

    // Retorna clientes
    function listarTodos($conn){
        try {
            $query = "SELECT * FROM Cliente";

            $res = $conn->query($query);
            return $res->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // busca um Cliente por Codigo
    function buscarPorNome($cliCodigo, $conn){
        try {
            $query = "SELECT * FROM `Cliente` WHERE `cliCodigo` = " . $cliCodigo;
            $res = $conn->query($query);

            return $res->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

	// busca um Cliente por Nome
    function buscarPorCodigo($cliNome, $conn){
        try {
            $query = "SELECT * FROM `Cliente` WHERE `cliNome` = " . $cliNome;
            $res = $conn->query($query);

            return $res->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
	
    // Edita um Cliente
    function editar($cliente, $conn){
        $query = "UPDATE `Cliente` SET 
                    `cliNome`='" . $cliente->getNome() . "',
                    `cliCPF`='" . $cliente->getCpf() . "' WHERE `funCodigo` = " . $cliente->getCodigo();
        $res = $conn->query($query);
        return $res;
    }
}
