<?php

include_once 'Persistencia/Connection.php';
include_once 'Modelo/Produto.php';
include_once 'Persistencia/ProdutoDAO.php';
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
    $res = $this->proDao->listarTodos($this->conexao);
    return $res;
  }

  public function cadastrar($dados)
  {
    
	$nome = $dados['pNome'];
	$preco = $dados['pPreco'];
	$qtdEstoque = $dados['pQuantidade'];
	$dataCadastro = date("d-m-Y");
	$descricao = $dados['pDescricao'];
    $categoria = $dados['pCategoria'];

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

    return $res;
  }

  public function editar($dados)
  {
    $codigo = $dados['pCodigo'];
    $nome = $dados['pNome'];
	$preco = $dados['pPreco'];
	$qtdEstoque = $dados['pQuantidade'];
	$dataCadastro = date("d-m-Y");
	$descricao = $dados['pDescricao'];
    $categoria = $dados['pCategoria'];
    var_dump($descricao);
    $pro = new Produto($nome, $descricao, $codigo);
    
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
      $codigo = $dados['cCodigo'];

      $res = $this->proDao->excluir($codigo, $this->conexao);

      if ($res)
        Util::redirect('produtos');
      else
        Util::redirect('produtos', 'deletar produto');
    } catch (Exception $e) {
      Util::redirect('produtos', 'deletar produto');
    }
  }
}
