<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
    <title>Cadastrar Funcionario</title>
</head>

<body>
    <?php require('../menu.php') ?>

    <div class="container">
        <h1>Cadastrar Funcionario</h1>
        <form action="../../Controle/Funcionario/Cadastrar.php" method="POST">
            email: <input type="text" name="fEmail"> <br> <br>
            nome: <input type="text" name="fNome"><br> <br>
            username: <input type="text" name="fUsername"><br> <br>
            senha: <input type="text" name="fSenha"><br> <br>
            gerente: <input type="text" name="fIsGerente"><br> <br>
            <input type="submit" value="Cadastrar">
        </form>
    </div>
</body>

</html>