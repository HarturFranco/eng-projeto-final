<?php
include_once "Controle/FuncionarioControle.php";
$funcionarioControle = new FuncionarioControle();
?>

<div class="cadastro">
  <h1>Cadastrar Funcionario</h1>

  <div>
    <form action="Controle/controle.php" method="POST">
      <div>
        <label for="fNome">Nome:</label>
        <input name="fNome" type="text" placeholder="Entre com o nome do funcionário">

        <label for="fEmail">Email:</label>
        <input name="fEmail" type="text" placeholder="exemplo@gmail.com">

        <label for="fUsername">Username:</label>
        <input name="fUsername" type="text" placeholder="Username">

        <label for="fSenha">Senha:</label>
        <input name="fSenha" type="password" placeholder="*******">

        <div class="div-checkbox">
          <input type="checkbox" name="fIsGerente">
          <label for="fIsGerente">Gerente</label>
        </div>

      </div>
      <div></div>
      <input type="text" name="classeAcao" value="FuncionarioControle/cadastro" hidden>
      <button class="primary">Cadastrar</button>
    </form>
  </div>
</div>