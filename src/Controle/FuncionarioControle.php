<?php

include_once 'Percistencia/Connection.php';
include_once 'Modelo/Funcionario.php';
include_once 'Percistencia/FuncionarioDAO.php';

class FuncionarioControle
{
  private $conexao;

  public function __construct()
  {
    $conexao = new Connection();
    $this->conexao = $conexao->getConnection();
  }

  public function index()
  {
    $funcdao = new FuncionarioDAO();
    $res = $funcdao->listarTodos($this->conexao);

    return $res;
  }
}
