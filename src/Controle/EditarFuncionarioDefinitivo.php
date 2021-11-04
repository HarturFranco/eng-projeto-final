<?php
include_once '.././Percistencia/Connection.php';
include_once '.././Modelo/Funcionario.php';
include_once '.././Percistencia/FuncionarioDAO.php';

//Parametros
$codigo = $_POST['fCodigo'];
$email = $_POST['fEmail'];
$nome = $_POST['fNome'];
$username = $_POST['fUsername'];
$senha = $_POST['fSenha'];
$isGerente = $_POST['fIsGerente'];

// para testar com interface provisoria
if ($isGerente == "true"){
    $isGerente = 1;
} else{
    $isGerente = 0;
}



$conexao = new Connection();
$conexao = $conexao->getConnection();
$fundao = new FuncionarioDAO();

$fun = new Funcionario($email, $nome, $username, $senha, $isGerente, $codigo);

$res = $fundao->editar($fun, $conexao);

if($res == TRUE){
    echo "<script>alert('Funcionario Editado no Banco de Dados!')</script>";
} else{
    echo "<script>alert('Erro ao Editar Funcionário no Banco de Dados: " . $conexao->error."')</script>";
}






?>