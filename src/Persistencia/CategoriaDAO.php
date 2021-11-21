<?php

class CategoriaDAO{

    function __construct(){
    }

    // Cadastra/Salva nova categoria
    function salvar($cat, $conn)
    {
        try {
            $query = "INSERT INTO `Categoria`(`catNome`, `catDescricao`) 
                    VALUES ('" . $cat->getNome() . "','" .
                $cat->getDescricao() . "')";


            $res = $conn->query($query);
            if ($res)
                return $res;
            
            throw new Exception('Erro ao cadastrar categoria');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Exclui
    function excluir($catCodigo, $conn){
        try {
            $consulta = $this->buscarPorCodigo($catCodigo, $conn);

            if($consulta){
                $query = "DELETE FROM `Categoria` WHERE catCodigo = " . $catCodigo; //TODO - tratar SQLInjection

                $conn->query($query);
            }else {
                throw new Exception('Categoria não existe no banco de dados');
            }       
            
        } catch (PDOException $e) {
            throw new Exception('Erro ao conectar ao banco de dados.');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Retorna todos as Categorias
    function listarTodos($conn){
        try {
            $query = "SELECT * FROM Categoria";

            $res = $conn->query($query);
            return $res->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // busca uma Categorias por Codigo
    function buscarPorCodigo($catCodigo, $conn){
        try {
            $consulta = $conn->prepare("SELECT * FROM Categoria WHERE catCodigo = :codigo");
            $consulta->execute(['codigo' => $catCodigo]);

            return $consulta->fetch();
        } catch (PDOException $e) {
            throw new Exception('Erro ao conectar ao banco de dados.');
        } catch (Exception $e){
            throw new Exception('Erro ao buscar categoria.');
        }
    }

    // Edita uma Categoria
    function editar($cat, $conn){
        try {
            $consulta = $this->buscarPorCodigo($cat->getCodigo(), $conn);

            if($consulta){
                $query = "UPDATE `Categoria` SET 
                    `catNome`='" . $cat->getNome() . "',
                    `catDescricao`='" . $cat->getDescricao() . "' WHERE `catCodigo` = " . $cat->getCodigo();

                $res = $conn->query($query);
                
                return $res;
            }else {
                throw new Exception('Categoria não existe no banco de dados');
            }       
            
        } catch (PDOException $e) {
            throw new Exception('Erro ao conectar ao banco de dados.');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
