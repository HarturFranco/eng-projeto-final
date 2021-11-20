<?php
include_once 'Controle/CategoriaControle.php';
include_once 'Lib/Auth.php';

$categoriaControle = new CategoriaControle();
$categorias = $categoriaControle->index();

?>

<div class="index">
  <h1>Categorias</h1>
  <?php if (count($categorias) == 0) { ?>
    <div class="not-found">
      Nenhuma categoria encontrada...
      <a href="cadastro/categoria" class="button primary">
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
        <a href="cadastro/categoria" class="button primary">
          Adicionar
          <img src="Visao/assets/images/adicionar.svg" alt="add">
        </a>
      </div>

      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($categorias as $cat) {
          ?>
            <tr string="<?php echo "{$cat->getCodigo()} {$cat->getNome()}" ?>">
              <td><?php echo $cat->getCodigo() ?></td>
              <td><?php echo $cat->getNome() ?></td>
              <td><?php echo $cat->getDescricao() ?></td>
              <td>
                <a href="categorias/editar/<?php echo $cat->getCodigo() ?>">
                  <img src="Visao/assets/images/editar.svg" alt="edit">
                </a>
                <?php if (Auth::isGerente()) { ?>
                  <form class="icon" action="Controle/Controle" method="POST">
                    <input type="text" name="cCodigo" value="<?php echo $cat->getCodigo() ?>" hidden>
                    <input type="text" name="classeAcao" value="CategoriaControle/excluir" hidden>
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