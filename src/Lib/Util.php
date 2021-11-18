<?php

class Util
{
  public static function getArgumento()
  {
    $args = explode("/", $_SERVER['REQUEST_URI']);
    $tamanho = count($args);
    return $args[$tamanho - 1];
  }
}
