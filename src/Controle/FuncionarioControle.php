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
    try {
      $res = $this->fundao->listarTodos($this->conexao);

      return $res;
    } catch (Exception $e) {
      Util::redirect('funcionario', 'Erro ao buscar funcionarios. '.$e->getMessage());
    }
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

    try {
      $this->fundao->salvar($fun, $this->conexao);

      Util::redirect('funcionarios', 'Sucesso. Sucesso ao cadastrar funcionario');
    } catch (Exception $e) {
      Util::redirect('cadastro/funcionario', 'Erro ao cadastrar. Erro ao cadastrar funcionario no banco de dados');
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
    try {
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

      $this->fundao->editar($fun, $this->conexao);

      Util::redirect('funcionarios', 'Sucesso. Funcionario editado com sucesso');
    } catch (Exception $e) {
      Util::redirect('funcionarios', 'Erro ao editar. ' . $e->getMessage());
    }
  }

  public function excluir($dados)
  {
    try {
      $codigo = $dados['funCodigo'];

      $this->fundao->excluir($codigo, $this->conexao);

      Util::redirect('funcionarios', 'Sucesso. Funcionario excluido com sucesso');
    } catch (Exception $e) {
      echo 'erro';
      Util::redirect('funcionarios', 'Erro ao excluir funcionario. ' . $e->getMessage());
    }
  }
}
