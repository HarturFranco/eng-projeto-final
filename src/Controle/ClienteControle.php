<?php

include_once 'Persistencia/Connection.php';
include_once 'Modelo/Cliente.php';
include_once 'Persistencia/ClienteDAO.php';
include_once 'Lib/Util.php';

class ClienteControle
{
  private $conexao;
  private $clidao;

  public function __construct()
  {
    $conexao = new Connection();
    $this->conexao = $conexao->getConnection();
    $this->clidao = new ClienteDAO();
  }



  public function index()
  {
    $res = $this->clidao->listarTodos($this->conexao);

    $clientes = array();

    foreach ($res as $cli) {
      $cli["cliCPF"] = Util::arrumaCPF($cli["cliCPF"]);

      $cliente = new Cliente(
        $cli['cliNome'],
        $cli['cliCPF'],
        $cli['cliCodigo']
      );

      array_push($clientes, $cliente);
    }

    return $clientes;
  }

  public function cadastro($dados)
  {
    $nome = $dados['cliNome'];
    $cpf = Util::limpaCPF($dados['cliCPF']);

    $cli = new Cliente($nome, $cpf);
    $res = $this->clidao->salvar($cli, $this->conexao);

    if ($res == TRUE) {
      Util::redirect('clientes');
    } else {
      Util::redirect('cadastro/cliente', 'cadastrar cliente');
    }
  }

  public function buscar($dado)
  {
    if (is_int($dado)) {
      $res = $this->clidao->buscarPorCodigo($dado, $this->conexao);
    } else {
      $res = $this->clidao->buscarPorNome($dado, $this->conexao);
    }

    $cliente = new Cliente(
      $res['cliNome'],
      Util::arrumaCPF($res["cliCPF"]),
      $res['cliCodigo']
    );

    return $cliente;
  }

  public function editar($dados)
  {
    $codigo = $dados['cCodigo'];
    $nome = $dados['cNome'];
    $cpf = Util::limpaCPF($dados['cCPF']);

    $cli = new Cliente($nome, $cpf, $codigo);

    $res = $this->clidao->editar($cli, $this->conexao);

    if ($res == TRUE) {
      Util::redirect('clientes');
    } else {
      Util::redirect('cadastro/cliente', 'editar cliente');
    }
  }

  public function excluir($dados)
  {
    try {
      $codigo = $dados['cliCodigo'];

      $res = $this->clidao->excluir($codigo, $this->conexao);

      if ($res)
        Util::redirect('clientes');
      else
        Util::redirect('clientes', 'deletar cliente');
    } catch (Exception $e) {
      Util::redirect('clientes', 'deletar cliente');
    }
  }
}
