<?php

class FuncionarioDAO{

    function __construct(){}

    // Cadastra/Salva novo funcionario
    function salvar($func, $conn){
        $query = "INSERT INTO `Funcionario`(`funNome`, `funEmail`, `funUsername`, `funSenha`, `funIsGerente`) 
                    VALUES ('" . $func->getNome() . "','" .
                     $func->getEmail() . "','" . 
                     $func->getUsername() . "','" . 
                     $func->getSenha() . "','" . 
                     $func->getIsGerente() ."')";

        
        $res = $conn->query($query);
        return $res;
        
    }

    // Exclui
    function excluir($fCodigo, $conn){
        $query = "DELETE FROM `Funcionario` WHERE funCodigo = ".$fCodigo; //TODO - tratar SQLInjection
        $res = $conn->query($query);
        return $res;
    }

    // Retorna funcionarios
    function listarTodos($conn){

        $query = "SELECT * FROM Funcionario";

        $res = $conn->query($query);
        return $res;

    }
    
    // busca um Funcionario por Codigo
    function buscarPorCodigo($fCodigo, $conn){

        $query = "SELECT * FROM `Funcionario` WHERE `funCodigo` = " . $fCodigo;

        $res = $conn->query($query);


        return $res;

    }

    // Edita um funcionario um Funcionario
    function editar($func, $conn){
        $query = "UPDATE `Funcionario` SET 
                    `funNome`='".$func->getNome()."',
                    `funEmail`='".$func->getEmail()."',
                    `funUsername`='".$func->getUsername()."',
                    `funSenha`='".$func->getSenha()."',
                    `funIsGerente`='".$func->getIsGerente()."' WHERE `funCodigo` = ". $func->getCodigo();


        $res = $conn->query($query);


        return $res;
    }



}

?>



