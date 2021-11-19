<?php

require_once "Controle/FuncionarioControle.php";

class Api
{
  private $uri;
  private $metodo;

  public function __construct()
  {
    $this->initialize();
  }

  private function initialize()
  {
    $this->metodo = $_SERVER['REQUEST_METHOD'];

    $this->uri = $_SERVER['REQUEST_URI'];
  }

  public function execute()
  {
    switch ($this->metodo) {
      case 'GET':
        $this->executeGet();
        break;
      case 'POST':
        $this->executePost();
        break;
    }
  }

  private function executeGet()
  {
    $classeAcao = explode("/", $this->uri);

    $classe = $classeAcao[1] != "" ? $classeAcao[1] : "vendas";
    $view = $classeAcao[2];
    $id = $classeAcao[3];

    if (isset($classe) && !isset($view))
      include "Visao/{$classe}/index.php";
    else if (isset($classe) && isset($view)) {
      $file = "Visao/{$classe}/{$view}.php";

      if (file_exists($file))
        include $file;
    }
  }

  private function executePost()
  {
    $classeAcao = explode("/", $_POST["classeAcao"]);

    $classe = $classeAcao[0];
    $acao = $classeAcao[1];
    if (isset($classe) && isset($acao)) {
      call_user_func_array([
        new $classe,
        $acao
      ], [$_POST]);
    }
  }
}
