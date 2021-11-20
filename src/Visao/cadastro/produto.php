<?php
// include_once "Controle/FuncionarioControle.php";
// $funcionarioControle = new FuncionarioControle();
?>

<div class="cadastro">
  <h1>Cadastrar Produto</h1>

  <div>
    <form action="Controle/Controle" method="POST">
      <div>
        <label for="pNome">Nome:</label>
        <input name="pNome" type="text" maxlength="150" required placeholder="Entre com o nome do produto">

        <label for="pCategoria">Categoria:</label>
        <select name="pCategoria">
          <option value="">None</option>
        </select>

        <label for="pDescricao">Username:</label>
        <textarea maxlength="500" name="pDescricao" type="text" placeholder="Descrição do produto" cols="0" rows="6"></textarea>

      </div>
      <div>
        <div class="div-preco_quantidade">
          <div>
            <label for="pPreco">Preço:</label>
            <input name="pPreco" type="text" required placeholder="R$ 0,00">
          </div>

          <div>
            <label for="pQuantidade">Quantidade:</label>
            <input name="pQuantidade" type="number" required>
          </div>
        </div>
      </div>
      <input type="text" name="fCodigo" value="<?php echo '' ?>" hidden>
      <input type="text" name="classeAcao" value="ProdutoControle/cadastrar" hidden>
      <button class="primary">Cadastrar</button>
    </form>
  </div>
</div>