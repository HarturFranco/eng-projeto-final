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
            return false;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Exclui
    function excluir($catCodigo, $conn){
        $query = "DELETE FROM `Categoria` WHERE catCodigo = " . $catCodigo; //TODO - tratar SQLInjection

        $res = $conn->query($query);
        return $res;
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
            $query = "SELECT * FROM `Categoria` WHERE `catCodigo` = " . $catCodigo;
            $res = $conn->query($query);

            return $res->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Edita uma Categoria
    function editar($cat, $conn){
        $query = "UPDATE `Categoria` SET 
                    `catNome`='" . $cat->getNome() . "',
                    `catDescricao`='" . $cat->getIsGerente() . "' WHERE `catCodigo` = " . $cat->getCodigo();

        $res = $conn->query($query);
        return $res;
    }
}
