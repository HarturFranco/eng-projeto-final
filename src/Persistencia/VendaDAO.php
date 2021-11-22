<?php

class VendaDAO{

    function __construct(){
    }

    // Cadastra/Salva novo venda
    function salvar($venda, $conn){
        try{
            $query = "INSERT INTO `Venda`(`venPrecoTotal`, `Funcionario_funCodigo`, `Cliente_cliCodigo`, `venStatus`) 
                VALUES ('" . $venda->getPrecoTotal() . "','" .
                $venda->getFuncionario()->getCodigo() . "','" .
                $venda->getCliente()->getCodigo() . "','" .
                $venda->getStatus() . "')";

            $res = $conn->query($query);

            if ($res)
                    return $res;
                
            throw new Exception('Erro ao cadastrar venda no banco de dados');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Exclui venda
    function excluir($venCodigo, $conn){
        try {
            $consulta = $this->buscarPorCodigo($venCodigo, $conn);

            if($consulta){
                $query = "DELETE FROM `Venda` WHERE venCodigo = " . $venCodigo; //TODO - tratar SQLInjection
                $conn->query($query);
            }else {
                throw new Exception('Venda não existe no banco de dados');
            }       
            
        } catch (PDOException $e) {
            throw new Exception('Erro ao conectar ao banco de dados.');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
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
        } catch (PDOException $e) {
            throw new Exception('Erro ao conectar ao banco de dados.');
        } catch (Exception $e){
            throw new Exception('Erro ao buscar venda.');
        }
        
    }
}
