<?php

include_once 'Persistencia/Connection.php';
include_once 'Modelo/Cliente.php';
include_once 'Persistencia/ClienteDAO.php';
include_once 'Lib/Util.php';

class ClienteControle
{
  private $conexao;
  private $clidao;

  public function __construct()
  {
    $conexao = new Connection();
    $this->conexao = $conexao->getConnection();
    $this->clidao = new ClienteDAO();
  }



  public function index()
  {
    $res = $this->clidao->listarTodos($this->conexao);

    $clientes = array();

    foreach ($res as $cli) {
      $cli["cliCPF"] = Util::arrumaCPF($cli["cliCPF"]);

      $cliente = new Cliente(
        $cli['cliNome'],
        $cli['cliCPF'],
        $cli['cliCodigo']
      );

      array_push($clientes, $cliente);
    }

    return $clientes;
  }

  public function cadastro($dados)
  {
    $nome = $dados['cliNome'];
    $cpf = Util::limpaCPF($dados['cliCPF']);

    $cli = new Cliente($nome, $cpf);

    try {
      $this->clidao->salvar($cli, $this->conexao);

      Util::redirect('clientes', 'Sucesso. Sucesso ao cadastrar cliente');
    } catch (Exception $e) {
      Util::redirect('cadastro/cliente', 'Erro ao cadastrar. ' . $e->getMessage());
    }
  }

  public function buscar($dado)
  {
    try {
      if (is_int($dado)) {
        $res = $this->clidao->buscarPorCodigo($dado, $this->conexao);
      } else {
        $res = $this->clidao->buscarPorNome($dado, $this->conexao);
      }

      if($res){
        return new Cliente(
          $res['cliNome'],
          Util::arrumaCPF($res["cliCPF"]),
          $res['cliCodigo']
        );
      }
      throw new Exception('Cliente nao encotrado. Verifique se o cliente existe');
    }catch(Exception $e){
      Util::redirect('clientes', 'Cliente nao encotrado. Verifique se o cliente esta cadastrado');
    }
  }

  public function editar($dados)
  {
    try {
      $codigo = $dados['cCodigo'];
      $nome = $dados['cNome'];
      $cpf = Util::limpaCPF($dados['cCPF']);

      $cli = new Cliente($nome, $cpf, $codigo);

      $this->clidao->editar($cli, $this->conexao);

      Util::redirect('clientes', 'Sucesso. Cliente editado com sucesso');
    } catch (Exception $e) {
      Util::redirect('clientes', 'Erro ao editar. ' . $e->getMessage());
    }
  }

  public function excluir($dados)
  {
    try {
      $codigo = $dados['cliCodigo'];

      $this->clidao->excluir($codigo, $this->conexao);

      Util::redirect('clientes', 'Sucesso. Cliente excluido com sucesso');
    } catch (Exception $e) {
      Util::redirect('clientes', 'Erro ao excluir cliente. ' . $e->getMessage());
    }
  }
}
