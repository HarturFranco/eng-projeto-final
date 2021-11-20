<?php
include_once "Controle/FuncionarioControle.php";
$funcionarioControle = new FuncionarioControle();
?>

<div class="cadastro">
  <h1>Cadastrar Funcionario</h1>

  <div>
    <form action="Controle/Controle" method="POST">
      <div>
        <label for="funNome">Nome:</label>
        <input name="funNome" type="text" maxlength="50" required placeholder="Entre com o nome do funcionário">

        <label for="funEmail">Email:</label>
        <input name="funEmail" type="email" maxlength="320" required placeholder="exemplo@gmail.com">

        <label for="funUsername">Username:</label>
        <input name="funUsername" type="text" maxlength="25" required placeholder="Username">

        <label for="funSenha">Senha:</label>
        <input name="funSenha" type="password" maxlength="25" required placeholder="*******">

        <div class="div-checkbox">
          <input type="checkbox" name="funIsGerente">
          <label for="funIsGerente">Gerente</label>
        </div>

      </div>
      <div></div>
      <input type="text" name="classeAcao" value="FuncionarioControle/cadastro" hidden>
      <button class="primary">Cadastrar</button>
    </form>
  </div>
</div>