<?php
// include_once 'Controle/FuncionarioControle.php';
include_once 'Lib/Util.php';

// $id = Util::getArgumento();
// $funcionarioControle = new FuncionarioControle();

// $funcionario = $funcionarioControle->buscar($id);
?>

<div class="cadastro">
  <h1>Editar Cliente</h1>

  <div>
    <form action="Controle/Controle" method="POST">
      <div>
        <label for="cNome">Nome:</label>
        <input name="cNome" type="text" maxlength="50" required placeholder="Entre com o nome do cliente" value="<?php echo '' ?>">

        <label for="cCPF">CPF:</label>
        <input name="cCPF" type="text" maxlength="11" required placeholder="Entre com o CPF do cliente" value="<?php echo '' ?>">

      </div>
      <div></div>
      <input type="text" name="cCodigo" value="<?php echo '' ?>" hidden>
      <input type="text" name="classeAcao" value="ClienteControle/editar" hidden>
      <button class="primary">Editar</button>
    </form>
  </div>
</div>