<?php

include_once 'Persistencia/Connection.php';
include_once 'Modelo/Produto.php';
include_once 'Persistencia/ProdutoDAO.php';
include_once 'Controle/CategoriaControle.php';
include_once 'Lib/Util.php';

class ProdutoControle
{
  private $conexao;
  private $proDao;

  public function __construct()
  {
    $conexao = new Connection();
    $this->conexao = $conexao->getConnection();
    $this->proDao = new ProdutoDAO();
  }

  public function index()
  {
    $catControle = new CategoriaControle();
    $res = $this->proDao->listarTodos($this->conexao);

    $produtos = array();

    foreach ($res as $pro) {
      $produto = new Produto(
        $pro['proNome'],
        $pro['proPreco'],
        $pro['proQtdEstoque'],
        $pro['proDataCadastro'],
        $pro['proDescricao'],
        $catControle->buscar($pro["Categoria_catCodigo"]),
        $pro['proCodigo']
      );

      array_push($produtos, $produto);
    }

    return $produtos;
  }

  public function cadastrar($dados)
  {
    $catControle = new CategoriaControle();

    $nome = $dados['pNome'];
    $preco = str_replace(",", ".", $dados['pPreco']);
    $qtdEstoque = $dados['pQuantidade'];
    $dataCadastro = date("Y-m-d");
    $descricao = $dados['pDescricao'];
    $categoria = $catControle->buscar($dados['pCategoria']);

    $pro = new Produto($nome, $preco, $qtdEstoque, $dataCadastro, $descricao, $categoria);

    $res = $this->proDao->salvar($pro, $this->conexao);

    if ($res == TRUE) {
      Util::redirect('produtos');
    } else {
      Util::redirect('cadastro/produto', 'cadastrar produto');
    }
  }

  public function buscar($id)
  {
    $res = $this->proDao->buscarPorCodigo($id, $this->conexao);

    $catControle = new CategoriaControle();

    return new Produto(
      $res['proNome'],
      $res['proPreco'],
      $res['proQtdEstoque'],
      $res['proDataCadastro'],
      $res['proDescricao'],
      $catControle->buscar($res["Categoria_catCodigo"]),
      $res['proCodigo']
    );

    
  }

  public function editar($dados)
  {
    $catControle = new CategoriaControle();

    $codigo = $dados['pCodigo'];
    $nome = $dados['pNome'];
    $preco = str_replace(",", ".", $dados['pPreco']);
    $qtdEstoque = $dados['pQuantidade'];
    $dataCadastro = date("Y-m-d");
    $descricao = $dados['pDescricao'];
    $categoria = $catControle->buscar($dados['pCategoria']);

    $pro = new Produto($nome, $preco, $qtdEstoque, $dataCadastro, $descricao, $categoria, $codigo);

    $res = $this->proDao->editar($pro, $this->conexao);

    if ($res == TRUE) {
      Util::redirect('produtos');
    } else {
      Util::redirect('produtos', 'editar produto');
    }
  }

  public function excluir($dados)
  {
    try {
      $codigo = $dados['pCodigo'];

      $res = $this->proDao->excluir($codigo, $this->conexao);

      if ($res) {
        Util::redirect('produtos');
      } else {
        Util::redirect('produtos', 'deletar 2 produto');
      }
    } catch (Exception $e) {
      Util::redirect('produtos', 'deletar produto');
    }
  }
}
