<?php
include_once "Controle/CategoriaControle.php";
$categoriaControle = new CategoriaControle();
?>

<div class="cadastro">
  <h1>Cadastrar Categoria</h1>

  <div>
    <form action="Controle/Controle" method="POST">
      <div>
        <label for="cNome">Nome:</label>
        <input name="cNome" type="text" maxlength="50" required placeholder="Entre com o nome da categoria">

        <label for="cDescricao">Descrição:</label>
        <textarea maxlength="500" name="cDescricao" type="text" placeholder="Descrição da categoria" cols="0" rows="6"></textarea>

      </div>
      <div></div>
      <input type="text" name="cCodigo" value="<?php echo '' ?>" hidden>
      <input type="text" name="classeAcao" value="CategoriaControle/cadastrar" hidden>
      <button class="primary">Cadastrar</button>
    </form>
  </div>
</div>