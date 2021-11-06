<?php

include_once '../../Percistencia/Connection.php';
include_once '../../Percistencia/FuncionarioDAO.php';

class Buscar
{
    public function __construct()
    {
        $this->exibirBuscar();
    }

    private function exibirBuscar()
    {
        $codigo = $_POST['fCodigo'];


        $conexao = new Connection();
        $conexao = $conexao->getConnection();

        $fundao = new FuncionarioDAO();
        $res = $fundao->buscarPorCodigo($codigo, $conexao);

        if ($res->num_rows > 0) {
            $registro = $res->fetch_assoc();
            echo '
        
        
            <table>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>User</th> 
                
                </tr>
                <tr>
                    <td>' . $registro['funCodigo'] . '</td>
                    <td>' . $registro['funNome'] . '</td>
                    <td>' . $registro['funEmail'] . '</td>
                    <td>' . $registro['funUsername'] . '</td>
                
                </tr>
                </table>
                ';
        } else {
            echo "<script>alert('Funcionario não existe')</script>";
        }
    }
}
