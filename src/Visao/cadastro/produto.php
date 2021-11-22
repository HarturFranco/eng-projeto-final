<?php
include_once "Controle/CategoriaControle.php";
$categoriaControle = new CategoriaControle();
$categorias = $categoriaControle->index();
?>

<div class="cadastro">
  <h1>Cadastrar Produto</h1>

  <div>
    <form action="Controle/Controle" method="POST">
      <div>
        <label for="pNome">Nome:</label>
        <input name="pNome" type="text" maxlength="150" required placeholder="Entre com o nome do produto">

        <label for="pCategoria">Categoria:</label>
        <select name="pCategoria" required>
          <option value="" disabled selected>Selecione uma categoria</option>
        <?php
          foreach ($categorias as $cat) {
        ?>
          <option value="<?php echo $cat->getCodigo() ?>"><?php echo $cat->getNome() ?></option>
        <?php
          }
        ?>
        
        </select>

        <label for="pDescricao">Descricao:</label>
        <textarea maxlength="500" name="pDescricao" type="text" placeholder="Descrição do produto" cols="0" rows="6"></textarea>

      </div>
      <div>
        <div class="div-preco_quantidade">
          <div>
            <label for="pPreco">Preço:</label>
            <input name="pPreco" type="text" required placeholder="0,00" class="price" pattern="[0-9]{1,6},[0-9]{2}">
          </div>

          <div>
            <label for="pQuantidade">Quantidade:</label>
            <input name="pQuantidade" type="number" maxlength="11" required>
          </div>
        </div>
      </div>
      <input type="text" name="classeAcao" value="ProdutoControle/cadastrar" hidden>
      <button class="primary">Cadastrar</button>
    </form>
  </div>
</div>

<script>console.log('aqui')</script>