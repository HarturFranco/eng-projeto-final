<?php

include_once 'Controle/FuncionarioControle.php';
include_once 'Lib/Auth.php';
include_once 'Lib/Util.php';

class LoginControle
{
  public function __construct()
  {
  }

  public function login($user)
  {
    try {
      $username = $user["fUsername"];
      $senha =  $user["fSenha"];

      $funcionarioControle = new FuncionarioControle();

      $userData = $funcionarioControle->buscarPraLogin($username, $senha);

      if ($userData) {
        Auth::login($userData);
        Util::redirect('');
      } else Util::redirect('login', 'logar. Senha incorreta');

    } catch (Exception $e) {
      Util::redirect('login', 'Erro ao logar. ' . $e->getMessage());
    }
  }

  public function sair()
  {
    Auth::signOut();
    Util::redirect('');
  }
}
