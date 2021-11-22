<?php
include_once 'Controle/CategoriaControle.php';
include_once 'Lib/Util.php';

$id = Util::getArgumento();
$categoriaControle = new CategoriaControle();

$categoria = $categoriaControle->buscar($id);
?>

<div class="cadastro">
  <h1>Editar Categoria</h1>

  <div>
    <form action="Controle/Controle" method="POST">
      <div>
        <label for="cNome">Nome:</label>
        <input name="cNome" type="text" maxlength="50" required placeholder="Entre com o nome da categoria" value="<?php echo $categoria->getNome() ?>">

        <label for="cDescricao">Descrição:</label>
        <textarea maxlength="500" name="cDescricao" type="text" placeholder="Descrição da categoria" cols="0" rows="6"><?php echo $categoria->getDescricao() ?></textarea>

      </div>
      <div></div>
      <input type="text" name="cCodigo" value="<?php echo $categoria->getCodigo() ?>" hidden>
      <input type="text" name="classeAcao" value="CategoriaControle/editar" hidden>
      <button class="primary">Editar</button>
    </form>
  </div>
</div>