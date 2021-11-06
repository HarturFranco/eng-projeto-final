<?php
include_once '../../Percistencia/Connection.php';
include_once '../../Modelo/Funcionario.php';
include_once '../../Percistencia/FuncionarioDAO.php';
$codigo = $_POST['fCodigo'];
$email = $_POST['fEmail'];
$nome = $_POST['fNome'];
$username = $_POST['fUsername'];
$senha = $_POST['fSenha'];
$isGerente = $_POST['fIsGerente'];

if ($isGerente == "true") {
    $isGerente = 1;
} else {
    $isGerente = 0;
}


$conexao = new Connection();
$conexao = $conexao->getConnection();

$fun = new Funcionario($email, $nome, $username, $senha, $isGerente);

$fundao = new FuncionarioDAO();

$res = $fundao->salvar($fun, $conexao);

if ($res == TRUE) {
    echo "<script>alert('Funcionario Cadastrado no Banco de Dados!')</script>";
} else {
    echo "<script>alert('Erro ao Cadastrar Funcionário no Banco de Dados: " . $conexao->error . "')</script>";
}

echo "<meta http-equiv='refresh' content='0;URL=/'>";
