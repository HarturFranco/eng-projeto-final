<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <base href="http://localhost/">
    <link rel="stylesheet" type="text/css" href="Visao/assets/css/styles.css">
    <title>Toca dos Instrumentos</title>
</head>

<body>
    <?php 
        $rota = $_GET['url'] ?? 'vendas/index';
        //logado
        if(true){
            include "Visao/menu.php";
            ?>
            <div class="container">
                <?php 
                if(file_exists("Visao/{$rota}.php")){
                    include "Visao/{$rota}.php";
                } 
                ?>
            </div>
        <?php
        }
        else include "Visao/login.php"
        ?>
    
</body>
<script type="text/JavaScript" src="Visao/assets/js/scripts.js"></script>
</html>