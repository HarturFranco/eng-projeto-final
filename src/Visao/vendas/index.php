<?php
include_once 'Controle/VendaControle.php';
include_once 'Lib/Auth.php';

$vendaControle = new VendaControle();
$vendas = $vendaControle->index();
?>

<div class="index">
  <h1>Vendas</h1>
  <?php if (count($vendas) == 0) { ?>
    <div class="not-found">
      Nenhuma venda realizada...
      <a href="cadastro/venda" class="button primary">
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
        <a href="cadastro/venda" class="button primary">
          Adicionar
          <img src="Visao/assets/images/adicionar.svg" alt="add">
        </a>
      </div>

      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Funcionario</th>
            <th>Valor total</th>

            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($vendas as $ven) {
          ?>
            <tr string="<?php echo "{$ven->getCodigo()} {$ven->getCliente()->getNome()}" ?>">
              <td><?php echo $ven->getCodigo() ?></td>
              <td><?php echo $ven->getCliente()->getNome() ?></td>
              <td><?php echo $ven->getFuncionario()->getNome() ?></td>
              <td><?php echo $ven->getPrecoTotal() ?></td>
              <td>
                <a href="funcionarios/editar/<?php echo $ven->getCodigo() ?>">
                  <img src="Visao/assets/images/editar.svg" alt="edit">
                </a>
                <?php if (Auth::isGerente()) { ?>
                <form class="icon" action="Controle/Controle" method="POST">
                  <input type="text" name="fCodigo" value="<?php echo $ven->getCodigo() ?>" hidden>
                  <input type="text" name="classeAcao" value="FuncionarioControle/excluir" hidden>
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