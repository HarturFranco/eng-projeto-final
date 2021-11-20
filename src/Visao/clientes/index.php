<?php
include_once 'Controle/ClienteControle.php';
include_once 'Lib/Auth.php';

$clienteControle = new ClienteControle();
$clientes = $clienteControle->index();

?>

<div class="index">
  <h1>Clientes</h1>
  <?php if (count($clientes) == 0) { ?>
    <div class="not-found">
      Nenhum cliente encontrado...
      <a href="cadastro/cliente" class="button primary">
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
        <a href="cadastro/cliente" class="button primary">
          Adicionar
          <img src="Visao/assets/images/adicionar.svg" alt="add">
        </a>
      </div>

      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>

            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($clientes as $cli) {
          ?>
            <tr string="<?php echo "{$cli->getCodigo()} {$cli->getNome()}" ?>">
              <td><?php echo $cli->getCodigo() ?></td>
              <td><?php echo $cli->getNome() ?></td>
              <td><?php echo $cli->getCpf() ?></td>
              <td>
                <a href="clientes/editar/<?php echo $cli->getCodigo() ?>">
                  <img src="Visao/assets/images/editar.svg" alt="edit">
                </a>
                <?php if (Auth::isGerente()) { ?>
                  <form class="icon" action="Controle/Controle" method="POST">
                    <input type="text" name="cliCodigo" value="<?php echo $cli->getCodigo() ?>" hidden>
                    <input type="text" name="classeAcao" value="ClienteControle/excluir" hidden>
                    <button class="icon">
                      <img src="Visao/assets/images/deletar.svg" alt="delete">
                    </button>
                  </form>
                <?php } ?>
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