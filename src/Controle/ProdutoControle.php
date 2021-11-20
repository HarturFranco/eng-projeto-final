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
    for($i = 0; $i < count($res); $i++){
      $res[$i]["Categoria_catCodigo"] = $catControle->buscar($res[$i]["Categoria_catCodigo"]);
    }
    return $res;
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

    return $res;
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

      if ($res){
        Util::redirect('produtos');
      }
      else{
        Util::redirect('produtos', 'deletar 2 produto');
      }
        
    } catch (Exception $e) {
      Util::redirect('produtos', 'deletar produto');
    }
  }
}
