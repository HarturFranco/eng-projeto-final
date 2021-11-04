<?php
include_once '.././Percistencia/Connection.php';
include_once '.././Percistencia/FuncionarioDAO.php';
$codigo = $_POST['fCodigo'];


$conexao = new Connection();
$conexao = $conexao->getConnection();
$fundao = new FuncionarioDAO();
//verifica se registro existe
$res = $fundao->buscarPorCodigo($codigo, $conexao);
//se existe executa a exclusao
if ($res->num_rows == 1){
    $registro = $res->fetch_assoc();
    echo '<html>
            <head>
                <meta charset="UTF-8" lang ="pt-br"> 

            </head>

            <body>
                <h1>Excluir Funcionario</h1>
                <form action="..\Controle\ExcluirFuncionarioDefinitivo.php" method="POST">
                    codigo: <input type="text" name="fCodigo" value='.$codigo.' readonly"> <br> <br>
                    email: <input type="text" name="fEmail" value='.$registro["funEmail"].' readonly> <br> <br>
                    nome: <input type="text" name="fNome" value='.$registro["funNome"].' readonly><br> <br>
                    username: <input type="text" name="fUsername" value='.$registro["funUsername"].' readonly><br> <br>
                    senha: <input type="text" name="fSenha" value='.$registro["funSenha"].' readonly><br> <br>
                    gerente: <input type="text" name="fIsGerente" value='.$registro["funIsGerente"].' readonly><br> <br>
                    <input type="submit" value="Excluir">
                </form>
            </body>

        </html>';

} else{
    // se nao existe cria alerta com erro
    echo "<script>alert('Erro: Funcionario não existe!')</script>";
}


?>