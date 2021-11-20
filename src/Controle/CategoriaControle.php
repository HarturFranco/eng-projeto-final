<?php

include_once 'Persistencia/Connection.php';
include_once 'Modelo/Categoria.php';
include_once 'Persistencia/CategoriaDAO.php';
include_once 'Lib/Util.php';

class CategoriaControle
{
  private $conexao;
  private $catDao;

  public function __construct()
  {
    $conexao = new Connection();
    $this->conexao = $conexao->getConnection();
    $this->catDao = new CategoriaDAO();
  }

  public function index()
  {
    $res = $this->catDao->listarTodos($this->conexao);
    return $res;
  }

  public function cadastrar($dados)
  {
    $nome = $dados['cNome'];
    $descricao = $dados['cDescricao'];

    $cat = new Categoria($nome, $descricao);

    $res = $this->catDao->salvar($cat, $this->conexao);

    if ($res == TRUE) {
      Util::redirect('categorias');
    } else {
      Util::redirect('cadastro/categoria', 'cadastrar categoria');
    }
  }

  public function buscar($id)
  {
    $res = $this->catDao->buscarPorCodigo($id, $this->conexao);
    $categoria = new Categoria($res['catNome'], $res['catDescricao'], $res['catCodigo']);
    return $categoria;
    // return $res;
  }

  public function editar($dados)
  {
    $codigo = $dados['cCodigo'];
    $nome = $dados['cNome'];
    $descricao = $dados['cDescricao'];
    var_dump($descricao);
    $cat = new Categoria($nome, $descricao, $codigo);
    
    $res = $this->catDao->editar($cat, $this->conexao);

    if ($res == TRUE) {
      Util::redirect('categorias');
    } else {
      Util::redirect('categorias', 'editar categoria');
    }
  }

  public function excluir($dados)
  {
    try {
      $codigo = $dados['cCodigo'];

      $res = $this->catDao->excluir($codigo, $this->conexao);

      if ($res)
        Util::redirect('categorias');
      else
        Util::redirect('categorias', 'deletar categoria');
    } catch (Exception $e) {
      Util::redirect('categorias', 'deletar categoria');
    }
  }
}
