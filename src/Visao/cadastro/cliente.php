<?php
include_once "Controle/ClienteControle.php";
$clienteControle = new ClienteControle();
?>

<div class="cadastro">
  <h1>Cadastrar Cliente</h1>

  <div>
    <form action="Controle/Controle" method="POST">
      <div>
      <label for="cNome">Nome:</label>
        <input name="cNome" type="text" maxlength="50" required placeholder="Entre com o nome do cliente" >

        <label for="cCPF">CPF:</label>
        <input name="cCPF" type="text" maxlength="11" required placeholder="000.000.000-00">

      </div>
      <div></div>
      <input type="text" name="pCodigo" value="<?php echo '' ?>" hidden>
      <input type="text" name="classeAcao" value="ClienteControle/cadastro" hidden>
      <button class="primary">Cadastrar</button>
    </form>
  </div>
</div>