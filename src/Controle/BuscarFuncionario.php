<?php

include_once '.././Percistencia/Connection.php';
include_once '.././Percistencia/FuncionarioDAO.php';
$codigo = $_POST['fCodigo'];


$conexao = new Connection();
$conexao = $conexao->getConnection();

$fundao = new FuncionarioDAO();
$res = $fundao->buscarPorCodigo($codigo, $conexao);

if ($res->num_rows > 0){
    $registro = $res->fetch_assoc();
    echo '<!DOCTYPE html>
    <html>
        <head>
            <style>
                table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
                }
                
                td, th {
                border: 1px solid #A020F0;
                text-align: left;
                padding: 8px;
                }
                
                tr:nth-child(even) {
                background-color: #A020F0;
                }
            </style>
        </head>
        <body>
        
        
            <table>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>User</th> 
                
                </tr>
                <tr>
                    <td>'. $registro['funCodigo'] . '</td>
                    <td>'. $registro['funNome'] . '</td>
                    <td>'. $registro['funEmail'] . '</td>
                    <td>'. $registro['funUsername'] . '</td>
                
                </tr>
                </table>
                
        </body>
    </html>';
    
} else{
    echo "<script>alert('Funcionario não existe')</script>";
}

?>