<?php
require_once "api.php";
require_once "Lib/Auth.php";

session_start();

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

    <?php $api->execute() ?>

</body>
<script type="text/JavaScript" src="Visao/assets/js/scripts.js"></script>

</html>