<?php
include_once 'Controle/FuncionarioControle.php';

$funcionarioControle = new FuncionarioControle();
$funcionarios = $funcionarioControle->index();

?>

<div class="index">
  <h1>Funcionários</h1>
  <?php if (count($funcionarios) == 0) { ?>
    <div class="not-found">
      Nenhum funcionário encontrado...
      <a href="cadastro/funcionario" class="button primary">
        Cadatrar
      </a>
    </div>
  <?php } else { ?>
    <div>
      <div>
        <div class="search">
          <input type="text" name="search">
          <button class="secondary" onclick="filter()">
            Filtros
            <img src="Visao/assets/images/filtros.svg" alt="filters">
          </button>
        </div>
        <a href="cadastro/funcionario" class="button primary">
          Adicionar
          <img src="Visao/assets/images/adicionar.svg" alt="add">
        </a>
      </div>

      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Username</th>
            <th>Gerente</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($funcionarios as $fun) {
          ?>
            <tr string="<?php echo "{$fun->getCodigo()} {$fun->getNome()}" ?>">
              <td><?php echo $fun->getCodigo() ?></td>
              <td><?php echo $fun->getNome() ?></td>
              <td><?php echo $fun->getEmail() ?></td>
              <td><?php echo $fun->getUsername() ?></td>
              <td><?php echo $fun->getIsGErente() == true ? 'Sim' : 'Não' ?></td>
              <td>
                <a href="funcionarios/editar/<?php echo $fun->getCodigo() ?>">
                <img src="Visao/assets/images/editar.svg" alt="edit">
                </a>
                <form class="icon" action="Controle/Controle" method="POST">
                  <input type="text" name="funCodigo" value="<?php echo $fun->getCodigo() ?>" hidden>
                  <input type="text" name="classeAcao" value="FuncionarioControle/excluir" hidden>
                  <button class="icon">
                  <img src="Visao/assets/images/deletar.svg" alt="delete">
                  </button>
                </form>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  <?php
  }
  ?>
</div>