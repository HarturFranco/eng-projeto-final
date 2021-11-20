<?php
// include_once 'Controle/FuncionarioControle.php';
include_once 'Lib/Util.php';

// $id = Util::getArgumento();
// $funcionarioControle = new FuncionarioControle();

// $funcionario = $funcionarioControle->buscar($id);
?>

<div class="cadastro">
  <h1>Editar Categoria</h1>

  <div>
    <form action="Controle/Controle" method="POST">
      <div>
        <label for="cNome">Nome:</label>
        <input name="cNome" type="text" maxlength="50" required placeholder="Entre com o nome da categoria" value="<?php echo '' ?>">

        <label for="cDescricao">Descrição:</label>
        <textarea value="<?php echo '' ?>" maxlength="500" name="cDescricao" type="text" placeholder="Descrição da categoria" cols="0" rows="6"></textarea>

      </div>
      <div></div>
      <input type="text" name="cCodigo" value="<?php echo '' ?>" hidden>
      <input type="text" name="classeAcao" value="CategoriaControle/editar" hidden>
      <button class="primary">Editar</button>
    </form>
  </div>
</div>