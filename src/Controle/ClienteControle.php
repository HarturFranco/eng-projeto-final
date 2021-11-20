<?php

include_once 'Persistencia/Connection.php';
include_once 'Modelo/Cliente.php';
include_once 'Persistencia/ClienteDAO.php';
include_once 'Lib/Util.php';

class ClienteControle{
  private $conexao;
  private $clidao;

  public function __construct(){
    $conexao = new Connection();
    $this->conexao = $conexao->getConnection();
    $this->clidao = new ClienteDAO();
  }

	private function limpaCPF($valor){
		$valor = trim($valor);
		$valor = str_replace(".", "", $valor);
		$valor = str_replace("-", "", $valor);
		return $valor;
	}

	private function arrumaCPF($valor){
		return substr($valor,0,3).'.'.substr($valor,3,3).'.'.substr($valor,6,3).'-'.substr($valor,9,2);
	}

  public function index(){
    $res = $this->clidao->listarTodos($this->conexao);
    for($i = 0; $i < count($res); $i++){
      $res[$i]["cliCPF"] = $this->arrumaCPF($res[$i]["cliCPF"]);
    }
    return $res;
  }

  public function cadastro($dados){
    $nome = $dados['cNome'];
    $cpf = $this->limpaCPF($dados['cCPF']);

    $cli = new Cliente($nome, $cpf);
    $res = $this->clidao->salvar($cli, $this->conexao);

    if ($res == TRUE) {
      Util::redirect('clientes');
    } else {
      Util::redirect('cadastro/cliente', 'cadastrar cliente');
    }
  }

  public function buscar($dado){
	if (is_int($dado)){
		$res = $this->clidao->buscarPorCodigo($dado, $this->conexao);
	}else{
		$res = $this->clidao->buscarPorNome($dado, $this->conexao);
	}
	$res["cliCPF"] = $this->arrumaCPF($res["cliCPF"]);
	return $res;
  }

  public function editar($dados)
  {
    $codigo = $dados['cCodigo'];
    $nome = $dados['cNome'];
    $cpf = $this->limpaCPF($dados['cCPF']);

    $cli = new Cliente($nome, $cpf, $codigo);

    $res = $this->clidao->editar($cli, $this->conexao);

    if ($res == TRUE) {
      Util::redirect('clientes');
    } else {
      Util::redirect('cadastro/cliente', 'editar cliente');
    }
  }

  public function excluir($dados)
  {
    try {
      $codigo = $dados['cliCodigo'];

      $res = $this->clidao->excluir($codigo, $this->conexao);

      if ($res)
        Util::redirect('clientes');
      else
        Util::redirect('clientes', 'deletar cliente');
    } catch (Exception $e) {
      Util::redirect('clientes', 'deletar cliente');
    }
  }
}
