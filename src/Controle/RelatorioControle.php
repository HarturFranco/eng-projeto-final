<?php

include_once 'Persistencia/Connection.php';
include_once 'Persistencia/RelatorioDAO.php';

include_once 'Controle/FuncionarioControle.php';
include_once 'Controle/VendaControle.php';

class RelatorioControle
{
  private $conexao;
  private $relatorioDAO;

  public function __construct()
  {
    $conexao = new Connection();
    $this->conexao = $conexao->getConnection();
    $this->relatorioDAO = new RelatorioDAO();
  }

  public function funcionarios()
  {
    $funcionarioControle = new FuncionarioControle();

    $res = $this->relatorioDAO->funcionarios($this->conexao);

    $relatorio = array();

    foreach($res as $dado){
      $func = new stdClass();
      $func->funcionario = $funcionarioControle->buscar((int)$dado['funcionario']);
      $func->quantidadeVendas = $dado['QuantidadeVendas'];
      $func->totalVendas = $dado['Total'];

      array_push($relatorio, $func);
    }

    return $relatorio;
  }
}
