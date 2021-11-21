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

    $categorias = array();

    foreach ($res as $cat) {
      $categoria = new Categoria(
        $cat['catNome'],
        $cat['catDescricao'],
        $cat['catCodigo']
      );

      array_push($categorias, $categoria);
    }

    return $categorias;
  }

  public function cadastrar($dados)
  {
    $nome = $dados['cNome'];
    $descricao = $dados['cDescricao'];

    $cat = new Categoria($nome, $descricao);

    try {
      $this->catDao->salvar($cat, $this->conexao);

      Util::redirect('categorias', 'Sucesso. Sucesso ao cadastrar categoria');
    } catch (Exception $e) {
      Util::redirect('cadastro/categoria', 'Erro ao cadastrar. '.$e->getMessage());
    }
  }

  public function buscar($id)
  {
    try {
      $res = $this->catDao->buscarPorCodigo($id, $this->conexao);
      if ($res)
        return new Categoria($res['catNome'], $res['catDescricao'], $res['catCodigo']);
      throw new Exception('Categoria nao encotrado. Verifique se a categoria existe');
    } catch (Exception $e) {
      Util::redirect('categorias', 'Categoria nao encotrada. Verifique se a categoria esta cadastrada');
    }
  }

  public function editar($dados)
  {
    $codigo = $dados['cCodigo'];
    $nome = $dados['cNome'];
    $descricao = $dados['cDescricao'];
    var_dump($descricao);
    $cat = new Categoria($nome, $descricao, $codigo);

    $res = $this->catDao->editar($cat, $this->conexao);
  }

  public function excluir($dados)
  {
    try {
      $codigo = $dados['cCodigo'];

      $this->catDao->excluir($codigo, $this->conexao);

      Util::redirect('categorias', 'Sucesso. Categoria excluida com sucesso');
    } catch (Exception $e) {
      Util::redirect('categorias', 'Erro ao excluir categoria. ' . $e->getMessage());
    }
  }
}