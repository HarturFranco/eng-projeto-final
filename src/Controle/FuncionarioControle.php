<?php

include_once 'Persistencia/Connection.php';
include_once 'Modelo/Funcionario.php';
include_once 'Persistencia/FuncionarioDAO.php';
include_once 'Lib/Util.php';

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

    if ($isGerente) {
      $isGerente = 1;
    } else {
      $isGerente = 0;
    }

    $fun = new Funcionario($email, $nome, $username, $senha, $isGerente);

    $res = $this->fundao->salvar($fun, $this->conexao);

    if ($res == TRUE) {
      Util::redirect('funcionarios');
    } else {
      Util::redirect('cadastro/funcionario', 'cadstrar funcionário');
    }
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
      Util::redirect('funcionarios');
    } else {
      Util::redirect('funcionarios', 'editar funcionário');
    }
  }

  public function excluir($dados)
  {
    try {
      $codigo = $dados['fCodigo'];

      $res = $this->fundao->excluir($codigo, $this->conexao);

      if ($res)
        Util::redirect('funcionarios');
      else
        Util::redirect('funcionarios', 'deletar funcionário');
    } catch (Exception $e) {
      Util::redirect('funcionarios', 'deletar funcionário');
    }
  }
}
