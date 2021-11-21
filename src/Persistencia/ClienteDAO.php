<?php

class ClienteDAO
{

    function __construct()
    {
    }

    // Cadastra/Salva novo cliente
    function salvar($cliente, $conn)
    {
        try {
            $consulta = $conn->prepare("SELECT * FROM Cliente WHERE cliCPF = :cpf");
            $consulta->execute(['cpf' => $cliente->getCpf()]);

            if ($consulta->fetch())
                throw new Exception('CPF ja cadatrado no banco de dados');
            $query = "INSERT INTO `Cliente`(`cliNome`, `cliCPF`) 
                    VALUES ('" . $cliente->getNome() . "','" .
                $cliente->getCpf() . "')";

            $res = $conn->query($query);

            if ($res)
                return $res;

            throw new Exception('Erro ao cadastrar cliente');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Exclui cliente
    function excluir($cliCodigo, $conn)
    {
        try {
            $consulta = $this->buscarPorCodigo($cliCodigo, $conn);

            if ($consulta) {
                $query = "DELETE FROM `Cliente` WHERE cliCodigo = " . $cliCodigo; //TODO - tratar SQLInjection

                $conn->query($query);
            } else {
                throw new Exception('Cliente não existe no banco de dados');
            }
        } catch (PDOException $e) {
            throw new Exception('Erro ao conectar ao banco de dados.');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Retorna clientes
    function listarTodos($conn)
    {
        try {
            $query = "SELECT * FROM Cliente";

            $res = $conn->query($query);
            return $res->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // busca um Cliente por Codigo
    function buscarPorCodigo($cliCodigo, $conn)
    {
        try {
            $query = "SELECT * FROM `Cliente` WHERE `cliCodigo` = " . $cliCodigo;
            $res = $conn->query($query);

            return $res->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // busca um Cliente pelo Nome
    function buscarPorNome($cliNome, $conn)
    {
        try {
            $query = "SELECT * FROM `Cliente` WHERE `cliNome` = " . $cliNome;
            $res = $conn->query($query);

            return $res->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Edita um Cliente
    function editar($cliente, $conn)
    {
        try {
            $consulta = $this->buscarPorCodigo($cliente->getCodigo(), $conn);

            if ($consulta) {
                $query = "UPDATE `Cliente` SET 
                    `cliNome`='" . $cliente->getNome() . "',
                    `cliCPF`='" . $cliente->getCpf() . "' WHERE `cliCodigo` = " . $cliente->getCodigo();
                $res = $conn->query($query);
                return $res;
            } else {
                throw new Exception('CLiente não existe no banco de dados');
            }
        } catch (PDOException $e) {
            throw new Exception('Erro ao conectar ao banco de dados.');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
