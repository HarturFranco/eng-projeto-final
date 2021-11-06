<?php

$caminho = ($_SERVER['PHP_SELF']);
$quant = substr_count($caminho, '/');
$quant = $quant - 1;
for ($k = 0; $k < $quant; $k++) {
  $relativo .= "../";
}
?>

<aside class="menu">
  <li class="menu_list">
    <a class="menu_list-link" href="<?php echo $relativo ?>Visao/Funcionario/cadastro.php">Cadastro</a> <br>
    <a class="menu_list-link" href="<?php echo $relativo ?>Visao/Funcionario/consultar.php">Listar Todos</a><br>
    <a class="menu_list-link" href="<?php echo $relativo ?>Visao/Funcionario/buscar.php">Buscar Por Codigo</a><br>
    <a class="menu_list-link" href="<?php echo $relativo ?>Visao/Funcionario/editar.php">Editar por Codigo</a><br>
    <a class="menu_list-link" href="<?php echo $relativo ?>Visao/Funcionario/excluir.php">Excluir por Codigo</a><br>
  </li>
</aside>