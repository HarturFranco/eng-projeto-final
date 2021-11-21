<?php

include_once 'Persistencia/Connection.php';
include_once 'Persistencia/VendaDAO.php';
include_once 'Persistencia/ItemVendaDAO.php';

include_once 'Controle/ClienteControle.php';
include_once 'Controle/FuncionarioControle.php';
include_once 'Controle/ProdutoControle.php';

include_once 'Modelo/Venda.php';
include_once 'Modelo/Cliente.php';
include_once 'Modelo/Funcionario.php';
include_once 'Modelo/ItemVenda.php';

include_once 'Lib/Util.php';

class VendaControle
{
  private $conexao;
  private $vendao;

  public function __construct()
  {
    $conexao = new Connection();
    $this->conexao = $conexao->getConnection();
    $this->vendao = new VendaDAO();
  }

  public function index()
  {
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

  public function cadastro($dados)
  {
    $cliente = $dados['vCliente'];
    $funcionario = $dados['vFuncionario'];
    $valor = $dados['vValor'];
    $carrinho = $dados['vProdutos'];

    $clienteControle = new ClienteControle();
    $funcionarioControle = new FuncionarioControle();

    $venda = new Venda(
      $valor,
      $clienteControle->buscar((int)$cliente),
      $funcionarioControle->buscar((int)$funcionario),
      1
    );

    try {
      $this->vendao->salvar($venda, $this->conexao);

      $idVenda = $this->conexao->lastInsertId();

      $carrinho = json_decode($carrinho, true);
      $itemVendaDao = new ItemVendaDAO();
      $produtoControle = new ProdutoControle();

      foreach ($carrinho as $item) {
        $itemVenda = new ItemVenda(
          $item['proQuantidade'],
          $item['proValor'],
          $item['proCodigo'],
          $idVenda
        );

        $produto = $produtoControle->buscar((int)$itemVenda->getProduto());
        $produtoControle->venderProduto($produto, $itemVenda->getQtd());

        $itemVendaDao->salvar($itemVenda, $this->conexao);
      }

      Util::redirect('vendas', 'Sucesso. Sucesso ao cadastrar venda');
    } catch (Exception $e) {
      Util::redirect('cadastro/venda', 'Erro ao cadastrar. ' . $e->getMessage());
    }
  }

  public function buscar($dado)
  {    
    try {
      $res = $this->vendao->buscarPorCodigo($dado, $this->conexao);      

      if ($res) {
        $clienteControle = new ClienteControle();
        $funcionarioControle = new FuncionarioControle();

        return new Venda(
          $res['venPrecoTotal'],
          $clienteControle->buscar((int)$res['Cliente_cliCodigo']),
          $funcionarioControle->buscar((int)$res['Funcionario_funCodigo']),
          $res['venStatus'],
          $res['venCodigo']
        );
      }
      throw new Exception('Venda nao encotrada. Verifique se a venda existe');
    } catch (Exception $e) {
      Util::redirect('vendas', 'Venda nao encotrada. Verifique se a venda esta cadastrado');
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
