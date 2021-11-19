<?php

require_once "Controle/FuncionarioControle.php";
require_once "Controle/LoginControle.php";

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

    if (!Auth::isLoggedIn()) {
      $this->uri = "login";
    }
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

    $file = "";

    if (isset($classe) && !isset($view))
      $file = "Visao/{$classe}/index.php";
    else if (isset($classe) && isset($view)) {
      $file = "Visao/{$classe}/{$view}.php";
    }

    if ($this->uri == "login")
      include "Visao/login.php";
    else {

      include "Visao/menu.php";
      echo '<div class="container">';
      include $file;
      echo "</div>";
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
