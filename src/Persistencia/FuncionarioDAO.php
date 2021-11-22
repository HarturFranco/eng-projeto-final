<?php

require_once('Lib/Auth.php');

class FuncionarioDAO
{

    function __construct()
    {
    }

    // Cadastra/Salva novo funcionario
    function salvar($func, $conn)
    {
        try {
            $query = "INSERT INTO `Funcionario`(`funNome`, `funEmail`, `funUsername`, `funSenha`, `funIsGerente`) 
                    VALUES ('" . $func->getNome() . "','" .
                $func->getEmail() . "','" .
                $func->getUsername() . "','" .
                $func->getSenha() . "','" .
                $func->getIsGerente() . "')";


            $res = $conn->query($query);

            if ($res)
                return $res;
            
            throw new Exception('Erro ao cadastrar funcionario no banco de dados');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Exclui
    function excluir($funCodigo, $conn)
    {
        try {
            if($funCodigo == Auth::getCodigo())
                throw new Exception('Funcionario esta logado.');
            $consulta = $this->buscarPorCodigo($funCodigo, $conn);

            if($consulta){
                $query = "DELETE FROM `Funcionario` WHERE funCodigo = " . $funCodigo;
                $conn->query($query);
            }else {
                throw new Exception('Funcionario não existe no banco de dados');
            }       
            
        } catch (PDOException $e) {
            throw new Exception('Erro ao conectar ao banco de dados.');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Retorna todos os funcionarios
    function listarTodos($conn)
    {
        try {
            $query = "SELECT * FROM Funcionario";

            $res = $conn->query($query);
            return $res->fetchAll();
        } catch (Exception $e) {
            throw new $e->getMessage();
        }
    }

    // busca um Funcionario por Codigo
    function buscarPorCodigo($funCodigo, $conn)
    {
        try {
            $consulta = $conn->prepare("SELECT * FROM Funcionario WHERE funCodigo = :codigo");
            $consulta->execute(['codigo' => $funCodigo]);

            return $consulta->fetch();
        } catch (PDOException $e) {
            throw new Exception('Erro ao conectar ao banco de dados.');
        } catch (Exception $e){
            throw new Exception('Erro ao buscar funcionario.');
        }
    }

    // busca um Funcionario por Nome
    function buscarPorNome($funNome, $conn)
    {
        try {
            $query = "SELECT * FROM `Funcionario` WHERE `funNome` = " . $funNome;
            $res = $conn->query($query);

            return $res->fetchAll();
        } catch (Exception $e) {
            throw new $e->getMessage();
        }
    }

    // busca um Funcionario por username e senha
    function buscarPraLogin($username, $senha, $conn)
    {
        try {
            $consulta = $conn->prepare("SELECT * FROM Funcionario WHERE funUsername = :username");
            $consulta->execute(['username' => $username]);

            if ($consulta->fetch()) {
                $consulta = $conn->prepare("SELECT * FROM Funcionario WHERE funUsername = :username AND funSenha = :senha");
                $consulta->execute(['username' => $username, 'senha' => $senha]);

                if ($consulta)
                    return $consulta->fetch();
                else
                    return false;
            } else 
                throw new Exception('Usuario nao cadastrado');
        } catch (PDOException $e) {
            throw new Exception('Erro ao conectar ao banco de dados.');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Edita um funcionario um Funcionario
    function editar($func, $conn)
    {
        try {
            $consulta = $this->buscarPorCodigo($func->getCodigo(), $conn);

            if($consulta){
                $query = "UPDATE `Funcionario` SET 
                    `funNome`='" . $func->getNome() . "',
                    `funEmail`='" . $func->getEmail() . "',
                    `funUsername`='" . $func->getUsername() . "',
                    `funSenha`='" . $func->getSenha() . "',
                    `funIsGerente`='" . $func->getIsGerente() . "' WHERE `funCodigo` = " . $func->getCodigo();

            
            
                $res = $conn->query($query);
                
                return $res;
            }else {
                throw new Exception('Funcionario não existe no banco de dados');
            }       
            
        } catch (PDOException $e) {
            throw new Exception('Erro ao conectar ao banco de dados.');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
