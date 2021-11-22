<?php
include_once('Controle/RelatorioControle.php');

$relatorioControle = new RelatorioControle();

$relatorio = $relatorioControle->funcionarios();

?>

<div class="index">
  <h1>Relatório por funcionário</h1>
  <?php if (count($relatorio) == 0) { ?>
    <div class="not-found">
      Nenhum dado encontrado...
    </div>
  <?php } else { ?>
    <div>
      <div>
        <div class="search">
          <input type="text" name="search">
          <button class="secondary" onclick="filter()">
            Filtros
            <img src="Visao/assets/images/filtros.svg" alt="filters">
        </div>
        <a href="#" class="button primary">
          Exportar relatório
          <img src="Visao/assets/images/adicionar.svg" alt="add">
        </a>
      </div>

      <table>
        <thead>
          <tr>
            <th>Funcionario</th>
            <th>Quantidade de vendas</th>
            <th>Total das vendas</th>

            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($relatorio as $dado) {
          ?>
            <tr string="<?php echo "{$dado->funcionario->getNome()} {$dado->quantidadeVEndas}" ?>">
              <td><?php echo $dado->funcionario->getNome() ?></td>
              <td><?php echo $dado->quantidadeVendas ?></td>
              <td><?php echo $dado->totalVendas ?></td>

              <td></td>
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