<?php

include_once '../../Percistencia/Connection.php';
include_once '../../Percistencia/FuncionarioDAO.php';

class ListarTodos
{

    public function __construct()
    {
        $this->criarTabela();
    }

    private function criarTabela()
    {
        $conexao = new Connection();
        $conexao = $conexao->getConnection();

        $fundao = new FuncionarioDAO();
        $res = $fundao->listarTodos($conexao);

        if ($res->num_rows > 0) {

            echo "
            
                    <table>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>User</th> 
                                
                            </tr>
                ";

            while ($linha = $res->fetch_assoc()) {
                echo '
                    <tr>
                        <td>' . $linha['funCodigo'] . '</td>
                        <td>' . $linha['funNome'] . '</td>
                        <td>' . $linha['funEmail'] . '</td>
                        <td>' . $linha['funUsername'] . '</td>
                        
                    </tr>';
            }
            echo "      
                        </table>";
        }
    }
}
