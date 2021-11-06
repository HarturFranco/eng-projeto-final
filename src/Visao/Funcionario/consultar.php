<?php
include_once '../../Controle/Funcionario/ListarTodos.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
  <title>Editar Funcionario</title>
</head>

<body>
  <?php require('../menu.php') ?>

  <div class="container">
    <?php new ListarTodos() ?>
  </div>

</body>

</html>