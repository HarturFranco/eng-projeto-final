<?php

class Util
{
  public static function getArgumento()
  {
    $args = explode("/", $_SERVER['REQUEST_URI']);
    $tamanho = count($args);
    return $args[$tamanho - 1];
  }

  public static function redirect($caminho, $erro = false)
  {
    if ($erro)
      echo "echo<meta http-equiv='refresh' content='0;URL=/{$caminho}?erro={$erro}'>";
    else echo "echo<meta http-equiv='refresh' content='0;URL=/{$caminho}'>";
  }
}
