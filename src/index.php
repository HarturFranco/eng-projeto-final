<?php
    require_once "api.php";
    $api = new Api();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <base href="http://localhost/">
    <link rel="stylesheet" href="Visao/assets/css/styles.css">
    <title>Toca dos Instrumentos</title>
</head>

<body>
    <?php
    //logado
    if (true) {
        include "Visao/menu.php";
    ?>
        <div class="container">
            <?php $api->execute() ?>
        </div>
    <?php
    } else include "Visao/login.php"
    ?>

</body>
<script type="text/JavaScript" src="Visao/assets/js/scripts.js"></script>

</html>