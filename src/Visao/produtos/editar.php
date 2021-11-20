<?php
include_once 'Controle/ProdutoControle.php';
include_once 'Controle/CategoriaControle.php';
include_once 'Lib/Util.php';

$id = Util::getArgumento();
$produtoControle = new ProdutoControle();
$categoriaControle = new CategoriaControle();

$produto = $produtoControle->buscar($id);

$categorias = $categoriaControle->index();

$categoriaProduto = $categoriaControle->buscar($produto["Categoria_catCodigo"]);
?>

<div class="cadastro">
  <h1>Editar Produto</h1>

  <div>
    <form action="Controle/Controle" method="POST">
      <div>
        <label for="pNome">Nome:</label>
        <input name="pNome" type="text" maxlength="150" required placeholder="Entre com o nome do produto" value="<?php echo $produto["proNome"] ?>">

        <label for="pCategoria">Categoria:</label>
          <select name="pCategoria" required>
            <option value="" disabled selected>Selecione uma categoria</option>
          <?php
            foreach ($categorias as $cat) {
              if($cat["catCodigo"] == $categoriaProduto->getCodigo()){
          ?>
                <option value="<?php echo $cat["catCodigo"] ?>" selected><?php echo $cat["catNome"] ?></option>
          <?php                            
              } else {
          ?>
            <option value="<?php echo $cat["catCodigo"] ?>"><?php echo $cat["catNome"] ?></option>
          <?php
              }
            }
          ?>
        </select>

        <label for="pDescricao">Descrição:</label>
        <textarea maxlength="500" name="pDescricao" type="text" placeholder="Descrição do produto" cols="0" rows="6"><?php echo $produto["proDescricao"] ?></textarea>

      </div>
      <div>
        <div class="div-preco_quantidade">
          <div>
            <label for="pPreco">Preço:</label>
            <input name="pPreco" type="text" required placeholder="R$ 0,00" value="<?php echo $produto["proPreco"] ?>">
          </div>

          <div>
            <label for="pQuantidade">Quantidade:</label>
            <input name="pQuantidade" type="number" required value="<?php echo $produto["proQtdEstoque"] ?>">
          </div>
        </div>
      </div>
      <input type="text" name="pCodigo" value="<?php echo $produto["proCodigo"] ?>" hidden>
      <input type="text" name="classeAcao" value="ProdutoControle/editar" hidden>
      <button class="primary">Editar</button>
    </form>
  </div>
</div>