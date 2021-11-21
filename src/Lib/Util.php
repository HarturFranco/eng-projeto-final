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

  public static function limpaCPF($valor){
		$valor = trim($valor);
		$valor = str_replace(".", "", $valor);
		$valor = str_replace("-", "", $valor);
		return $valor;
	}

	public static function arrumaCPF($valor){
		return substr($valor,0,3).'.'.substr($valor,3,3).'.'.substr($valor,6,3).'-'.substr($valor,9,2);
	}

  public static function formatReal($valor){
    return 'R$' . number_format($valor, 2, ',', '.');
  }
}
