<?php

class Auth
{
  public static function isLoggedIn()
  {
    return isset($_SESSION['user']);
  }

  public static function isGerente()
  {
    if (self::isLoggedIn()) {
      return $_SESSION['user']->isGerente;
    }
    return false;
  }

  public static function getCodigo(){
    if(Auth::isLoggedIn())
      return $_SESSION['user']->isGerente;
  }

  public static function login($userData)
  {
    $user = new \stdClass();

    $user->id = $userData['funCodigo'];
    $user->isGerente = $userData['funIsGerente'];

    $_SESSION['user'] = $user;
  }

  public static function signOut()
  {
    unset($_SESSION['user']);
  }
}
