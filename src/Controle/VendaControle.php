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
  private $itemVendaDao;

  public function __construct()
  {
    $conexao = new Connection();
    $this->conexao = $conexao->getConnection();
    $this->vendao = new VendaDAO();
    $this->itemVendaDao = new ItemVendaDAO();
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

        $this->itemVendaDao->salvar($itemVenda, $this->conexao);
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

  public function buscarItemsVenda($codigo)
  {
    return $this->itemVendaDao->listarTodosPorVenda($codigo, $this->conexao);
  }


  public function excluir($dados)
  {
    try {
      $codigo = $dados['venCodigo'];

      $itensVenda = $this->buscarItemsVenda($codigo);

      $produtoControle = new ProdutoControle();

      foreach ($itensVenda as $item) {
        $produto = $produtoControle->buscar((int)$item->getProduto());
        $produtoControle->venderProduto($produto, $item->getQtd(), 'devolucao');
      }

      $this->itemVendaDao->excluirPorVenda($codigo, $this->conexao);
      $this->vendao->excluir($codigo, $this->conexao);

      Util::redirect('vendas', 'Sucesso. Venda excluida com sucesso');
    } catch (Exception $e) {
      Util::redirect('vendas', 'Erro ao excluir venda. ' . $e->getMessage());
    }
  }

  public function editar($dados)
  {
    try {
      $codigo = $dados['vCodigo'];
      $cliCodigo = $dados['vCliente'];
      $funCodigo = $dados['vFuncionario'];
      $valor = str_replace(",", ".", $dados['vVenda']);

      $venda = new Venda(
        $valor,
        $cliCodigo,
        $funCodigo,
        1,
        $codigo
      );
      $this->vendao->editar($venda, $this->conexao);

      Util::redirect('vendas', 'Sucesso. Venda editada com sucesso');
    } catch (Exception $e) {
      Util::redirect('vendas', 'Erro ao editar. ' . $e->getMessage());
    }
  }
}
