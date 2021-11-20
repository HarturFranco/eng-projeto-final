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
    $res = $this->fundao->listarTodos($this->conexao);

    return $res;
  }

  public function cadastro($dados)
  {
    $email = $dados['funEmail'];
    $nome = $dados['funNome'];
    $username = $dados['funUsername'];
    $senha = $dados['funSenha'];
    $isGerente = $dados['funIsGerente'];

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
      Util::redirect('cadastro/funcionario', 'cadastrar funcionário');
    }
  }

  public function buscar($dado)
  {

    $res = null;
    if (is_int($dado)) {
      $res = $this->fundao->buscarPorCodigo($dado, $this->conexao);
    } else {
      $res = $this->fundao->buscarPorNome($dado, $this->conexao);
    }

    return new Funcionario(
      $res['funEmail'],
      $res['funNome'],
      $res['funUsername'],
      $res['funSenha'],
      $res['funIsGerente'],
      $res['funCodigo']
    );
  }

  public function buscarPraLogin($username, $senha)
  {
    $res = $this->fundao->buscarPraLogin($username, $senha, $this->conexao);

    return $res;
  }

  public function editar($dados)
  {
    $codigo = $dados['funCodigo'];
    $email = $dados['funEmail'];
    $nome = $dados['funNome'];
    $username = $dados['funUsername'];
    $senha = $dados['funSenha'];
    $isGerente = $dados['funIsGerente'];

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
      $codigo = $dados['funCodigo'];

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
