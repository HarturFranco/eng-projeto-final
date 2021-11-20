<?php
include_once 'Controle/ProdutoControle.php';
include_once 'Lib/Auth.php';

$produtoControle = new ProdutoControle();
$produtos = $produtoControle->index();

?>

<div class="index">
  <h1>Produtos</h1>
  <?php if (count($produtos) == 0) { ?>
    <div class="not-found">
      Nenhum produto encontrado...
      <a href="cadastro/produto" class="button primary">
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
        <a href="cadastro/produto" class="button primary">
          Adicionar
          <img src="Visao/assets/images/adicionar.svg" alt="add">
        </a>
      </div>

      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Data Cadastro</th>
            <th>Categoria</th>
            <th>Descrição</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($produtos as $pro) {
          ?>
            <tr string="<?php echo "{$pro->getCodigo()} {$pro->getNome()}" ?>">
              <td><?php echo $pro->getCodigo() ?></td>
              <td><?php echo $pro->getNome() ?></td>
              <td><?php echo $pro->getPreco() ?></td>
              <td><?php echo $pro->getQtdEstoque() ?></td>
              <td><?php echo $pro->getDataCadastro() ?></td>
              <td><?php echo $pro->getCategoria()->getNome() ?></td>
              <td><?php echo $pro->getDescricao() ?></td>
              <td>
                <a href="produtos/editar/<?php echo $pro->getCodigo() ?>">
                <img src="Visao/assets/images/editar.svg" alt="edit">
                </a>
                <?php if (Auth::isGerente()) { ?>
                  <form class="icon" action="Controle/Controle" method="POST">
                    <input type="text" name="pCodigo" value="<?php echo $pro->getCodigo() ?>" hidden>
                    <input type="text" name="classeAcao" value="ProdutoControle/excluir" hidden>
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