<?php
// include_once "Controle/FuncionarioControle.php";
// $funcionarioControle = new FuncionarioControle();
?>

<div class="cadastro">
  <h1>Cadastrar Categoria</h1>

  <div>
    <form action="Controle/Controle" method="POST">
      <div>
        <label for="pNome">Nome:</label>
        <input name="pNome" type="text" maxlength="50" required placeholder="Entre com o nome da categoria">

        <label for="pDescricao">Username:</label>
        <textarea maxlength="500" name="pDescricao" type="text" placeholder="Descrição da categoria" cols="0" rows="6"></textarea>

      </div>
      <div></div>
      <input type="text" name="pCodigo" value="<?php echo '' ?>" hidden>
      <input type="text" name="classeAcao" value="CategoriaControle/cadastrar" hidden>
      <button class="primary">Cadastrar</button>
    </form>
  </div>
</div>