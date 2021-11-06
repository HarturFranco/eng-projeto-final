<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
    <title>Buscar Funcionario</title>
</head>

<body>
    <?php require('../menu.php') ?>

    <div class="container">
        <h1>Buscar Funcionario</h1>
        <form action="buscarTabela.php" method="POST">
            codigo: <input type="number" name="fCodigo"> <br> <br>
            <input type="submit" value="Buscar">
        </form>
    </div>
</body>

</html>