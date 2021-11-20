<?php
// include_once 'Controle/FuncionarioControle.php';
include_once 'Lib/Util.php';

// $id = Util::getArgumento();
// $funcionarioControle = new FuncionarioControle();

// $funcionario = $funcionarioControle->buscar($id);
?>

<div class="cadastro">
  <h1>Editar Produto</h1>

  <div>
    <form action="Controle/Controle" method="POST">
      <div>
        <label for="pNome">Nome:</label>
        <input name="pNome" type="text" maxlength="150" required placeholder="Entre com o nome do produto" value="<?php echo '' ?>">

        <label for="pCategoria">Categoria:</label>
        <select name="pCategoria">
          <option value="">None</option>
        </select>

        <label for="pDescricao">Descrição:</label>
        <textarea value="<?php echo '' ?>" maxlength="500" name="pDescricao" type="text" placeholder="Descrição do produto" cols="0" rows="6"></textarea>

      </div>
      <div>
        <div class="div-preco_quantidade">
          <div>
            <label for="pPreco">Preço:</label>
            <input name="pPreco" type="text" required placeholder="R$ 0,00" value="<?php echo '' ?>">
          </div>

          <div>
            <label for="pQuantidade">Quantidade:</label>
            <input name="pQuantidade" type="number" required value="<?php echo '' ?>">
          </div>
        </div>
      </div>
      <input type="text" name="pCodigo" value="<?php echo '' ?>" hidden>
      <input type="text" name="classeAcao" value="ProdutoControle/editar" hidden>
      <button class="primary">Editar</button>
    </form>
  </div>
</div>