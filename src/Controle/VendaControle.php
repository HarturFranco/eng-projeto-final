<?php

include_once 'Persistencia/Connection.php';
include_once 'Persistencia/VendaDAO.php';

include_once 'Controle/ClienteControle.php';
include_once 'Controle/FuncionarioControle.php';

include_once 'Modelo/Venda.php';
include_once 'Modelo/Cliente.php';
include_once 'Modelo/Funcionario.php';

include_once 'Lib/Util.php';

class VendaControle{
  private $conexao;
  private $clidao;

  public function __construct(){
    $conexao = new Connection();
    $this->conexao = $conexao->getConnection();
    $this->vendao = new VendaDAO();
  }

  public function index(){
    $res = $this->vendao->listarTodos($this->conexao);
    $vendas = array();

    foreach ($res as $ven) {
      $cliente = new ClienteControle();
      $cliente = $cliente->buscar((int)$ven['Cliente_cliCodigo']);
      
      
      $funcionario = new FuncionarioControle();
      $funcionario = $funcionario->buscar((int)$ven['Funcionario_funCodigo']);

      $venda = new Venda(
        $ven['venPrecoTotal'],
        $cliente,
        $funcionario,
        false,
        $ven['venCodigo']
      );

      array_push($vendas, $venda);
    }

    return $vendas;
  }

  public function cadastro($dados){
    $cliente = $dados['vCliente'];
    $cliente = $dados['vFuncionario'];
    $carrinho = $dados['vProdutos'];
    /* $nome = $dados['cNome'];
    $cpf = $dados['cCPF'];

    $cli = new Cliente($nome, $cpf);

    $res = $this->clidao->salvar($cli, $this->conexao);

    if ($res == TRUE) {
      Util::redirect('clientes');
    } else {
      Util::redirect('cadastro/cliente', 'cadastrar cliente');
    } */
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
