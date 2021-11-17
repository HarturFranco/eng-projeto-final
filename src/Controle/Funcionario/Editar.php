<?php
include_once 'Percistencia/Connection.php';
include_once 'Percistencia/FuncionarioDAO.php';


class Editar
{
    public function __construct()
    {
        $this->exibirEditar();
    }

    private function exibirEditar()
    {
        $codigo = $_POST['fCodigo'];


        $conexao = new Connection();
        $conexao = $conexao->getConnection();
        $fundao = new FuncionarioDAO();
        //verifica se registro existe
        $res = $fundao->buscarPorCodigo($codigo, $conexao);
        //se existe executa a exclusao
        if ($res->num_rows == 1) {
            $registro = $res->fetch_assoc();
            echo '
                <h1>Editar Funcionario</h1>
                <form action="../../Controle/Funcionario/EditarDefinitivo.php" method="POST">
                    codigo: <input type="text" name="fCodigo" value=' . $codigo . ' readonly> <br> <br>
                    email: <input type="text" name="fEmail" value=' . $registro["funEmail"] . '> <br> <br>
                    nome: <input type="text" name="fNome" value=' . $registro["funNome"] . '><br> <br>
                    username: <input type="text" name="fUsername" value=' . $registro["funUsername"] . '><br> <br>
                    senha: <input type="text" name="fSenha" value=' . $registro["funSenha"] . '><br> <br>
                    gerente: <input type="text" name="fIsGerente" value=' . $registro["funIsGerente"] . '><br> <br>
                    <input type="submit" value="Editar">
                </form>';
        } else {
            // se nao existe cria alerta com erro
            echo "'Erro: Funcionario não existe!";
        }
    }
}