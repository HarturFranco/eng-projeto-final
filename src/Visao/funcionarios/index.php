<?php
include_once 'Controle/Funcionario/ListarTodos.php';
include_once 'Controle/FuncionarioControle.php';

$func = new FuncionarioControle();
$dados = $func->index();
?>

<div class="index">
  <h1>Funcionários</h1>

  <div>
    <div>
      <form action="">
        <input type="text">
        <button>Filtros</button>
      </form>
      <button>Adicionar</button>
    </div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Email</th>
          <th>Login</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($dados as $fun) {
        ?>
          <tr>
            <td><?php echo $fun["funCodigo"] ?></td>
            <td><?php echo $fun["funNome"] ?></td>
            <td><?php echo $fun["funEmail"] ?></td>
            <td><?php echo $fun["funUsername"] ?></td>
            <td>
              <a href="funcionarios/cadastro">C</a>
              <a href="funcionarios/excluir">E</a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>