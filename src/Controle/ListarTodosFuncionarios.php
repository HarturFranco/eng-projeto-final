<?php

include_once '.././Percistencia/Connection.php';
include_once '.././Percistencia/FuncionarioDAO.php';

$conexao = new Connection();
$conexao = $conexao->getConnection();

$fundao = new FuncionarioDAO();
$res = $fundao->listarTodos($conexao);

if ($res->num_rows > 0){

    echo "<!DOCTYPE html>
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

        ";

    while($linha = $res->fetch_assoc()){
        echo '<tr>
                <td>'. $linha['funCodigo'] . '</td>
                <td>'. $linha['funNome'] . '</td>
                <td>'. $linha['funEmail'] . '</td>
                <td>'. $linha['funUsername'] . '</td>
                
            </tr>';
    }
    echo "      
                </table>
            </body>
        </html>";
    
}

?>