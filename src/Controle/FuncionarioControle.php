<?php

include_once 'Percistencia/Connection.php';
include_once 'Modelo/Funcionario.php';
include_once 'Percistencia/FuncionarioDAO.php';

class FuncionarioControle
{
  private $conexao;
  private $fundao;

  public function __construct()
  {
    $conexao = new Connection();
    $this->conexao = $conexao->getConnection();
    $this->fundao = new FuncionarioDAO();
  }

  public function index()
  {
    $funcdao = new FuncionarioDAO();
    $res = $funcdao->listarTodos($this->conexao);

    return $res;
  }

  public function cadastro($dados)
  {
    $email = $dados['fEmail'];
    $nome = $dados['fNome'];
    $username = $dados['fUsername'];
    $senha = $dados['fSenha'];
    $isGerente = $dados['fIsGerente'];

    if ($isGerente == "true") {
      $isGerente = 1;
    } else {
      $isGerente = 0;
    }

    $fun = new Funcionario($email, $nome, $username, $senha, $isGerente);

    $res = $this->fundao->salvar($fun, $this->conexao);

    if ($res == TRUE) {
      echo "<script>alert('Funcionario Cadastrado no Banco de Dados!')</script>";
    } else {
      echo "<script>alert('Erro ao Cadastrar Funcionário no Banco de Dados: " . $this->conexao->error . "')</script>";
    }

    echo "<meta http-equiv='refresh' content='0;URL=/funcionarios'>";
  }

  public function buscar($id)
  {
    $res = $this->fundao->buscarPorCodigo($id, $this->conexao);

    return $res;
  }

  public function buscarPraLogin($username, $senha)
  {
    $res = $this->fundao->buscarPraLogin($username, $senha, $this->conexao);

    return $res;
  }

  public function editar($dados)
  {
    $codigo = $dados['fCodigo'];
    $email = $dados['fEmail'];
    $nome = $dados['fNome'];
    $username = $dados['fUsername'];
    $senha = $dados['fSenha'];
    $isGerente = $dados['fIsGerente'];

    if ($isGerente == "true") {
      $isGerente = 1;
    } else {
      $isGerente = 0;
    }

    $fun = new Funcionario($email, $nome, $username, $senha, $isGerente, $codigo);

    $res = $this->fundao->editar($fun, $this->conexao);

    if ($res == TRUE) {
      echo "<script>alert('Funcionario Editado no Banco de Dados!')</script>";
    } else {
      echo "<script>alert('Erro ao Editar Editado no Banco de Dados: " . $this->conexao->error . "')</script>";
    }

    echo "<meta http-equiv='refresh' content='0;URL=/funcionarios'>";
  }

  public function excluir($dados)
  {
    $codigo = $dados['fCodigo'];

    $res = $this->fundao->excluir($codigo, $this->conexao);

    if ($res == false) {
      echo "<script>alert('Excluido com sucesso!')</script>";
    } else {
      echo "<script>alert('Não foi possivel excluir:" . $this->conexao->error . "')</script>";
    }

    echo "<meta http-equiv='refresh' content='0;URL=/funcionarios'>";
  }
}
