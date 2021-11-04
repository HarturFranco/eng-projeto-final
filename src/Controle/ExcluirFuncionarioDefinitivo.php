<?php
include_once '.././Percistencia/Connection.php';
include_once '.././Percistencia/FuncionarioDAO.php';
$codigo = $_POST['fCodigo'];


$conexao = new Connection();
$conexao = $conexao->getConnection();
$fundao = new FuncionarioDAO();

$res = $fundao->excluir($codigo, $conexao);
if($res === TRUE){
    echo "<script>alert('Excluido com sucesso!')</script>";
} else{
    echo "<script>alert('Não foi possivel excluir:".$conexao->error."')</script>";
}


?>