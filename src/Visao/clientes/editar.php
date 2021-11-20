<?php
include_once 'Controle/ClienteControle.php';
include_once 'Lib/Util.php';

$id = Util::getArgumento();
$clienteControle = new ClienteControle();
$cliente = $clienteControle->buscar((int)$id);
?>

<div class="cadastro">
  <h1>Editar Cliente</h1>

  <div>
    <form action="Controle/Controle" method="POST">
      <div>
        <label for="cNome">Nome:</label>
        <input name="cNome" type="text" maxlength="50" required placeholder="Entre com o nome do cliente" value="<?php echo $cliente["cliNome"] ?>">

        <label for="cCPF">CPF:</label>
        <input name="cCPF" type="text" maxlength="14" required placeholder="000.000.000-00" value="<?php echo $cliente["cliCPF"] ?>" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}">

      </div>
      <div></div>
      <input type="text" name="cCodigo" value="<?php echo $cliente["cliCodigo"] ?>" hidden>
      <input type="text" name="classeAcao" value="ClienteControle/editar" hidden>
      <button class="primary">Editar</button>
    </form>
  </div>
</div>