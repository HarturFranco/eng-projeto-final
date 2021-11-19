<?php

include_once 'Controle/FuncionarioControle.php';
include_once 'Lib/Auth.php';

class LoginControle
{
  public function __construct()
  {
  }

  public function login($user)
  {
    $username = $user["fUsername"];
    $senha =  $user["fSenha"];

    $funcionarioControle = new FuncionarioControle();

    $userData = $funcionarioControle->buscarPraLogin($username, $senha);

    if ($userData) {
      Auth::login($userData);
      echo "<meta http-equiv='refresh' content='0;URL=/'>";
    }

    echo "<meta http-equiv='refresh' content='0;URL=/login?erro=1'>";
  }

  public function sair()
  {
    Auth::signOut();
    echo "<meta http-equiv='refresh' content='0;URL=/'>";
  }
}
