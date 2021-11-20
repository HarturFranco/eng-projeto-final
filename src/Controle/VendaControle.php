<?php

include_once 'Persistencia/Connection.php';
include_once 'Modelo/Venda.php';
include_once 'Persistencia/VendaDAO.php';
include_once 'Lib/Util.php';

class ClienteControle{
  private $conexao;
  private $clidao;

  public function __construct(){
    $conexao = new Connection();
    $this->conexao = $conexao->getConnection();
    $this->vendao = new VendaDAO();
  }

  public function index(){
    $res = $this->vendao->listarTodos($this->conexao);
    return $res;
  }

  public function cadastro($dados){
    $nome = $dados['cNome'];
    $cpf = $dados['cCPF'];

    $cli = new Cliente($nome, $cpf);

    $res = $this->clidao->salvar($cli, $this->conexao);

    if ($res == TRUE) {
      Util::redirect('clientes');
    } else {
      Util::redirect('cadastro/cliente', 'cadastrar cliente');
    }
  }

  public function buscar($dado){
	if (is_int($dado)){
		return $this->clidao->buscarPorCodigo($dado, $this->conexao);
	}
	return $this->clidao->buscarPorNome($dado, $this->conexao);
  }

  public function editar($dados)
  {
    $codigo = $dados['cCodigo'];
    $nome = $dados['cNome'];
    $cpf = $dados['cCPF'];

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
