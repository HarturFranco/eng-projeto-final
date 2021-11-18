<?php
include_once 'Controle/FuncionarioControle.php';
include_once 'Lib/Util.php';

$id = Util::getArgumento();
$funcionarioControle = new FuncionarioControle();

$funcionario = $funcionarioControle->buscar($id);
?>

<div class="cadastro">
    <h1>Editar Funcionario</h1>

    <div>
        <form action="Controle/Controle" method="POST">
            <div>
                <label for="fNome">Nome:</label>
                <input name="fNome" type="text" placeholder="Entre com o nome do funcionário" value="<?php echo $funcionario["funNome"] ?>">

                <label for="fEmail">Email:</label>
                <input name="fEmail" type="text" placeholder="exemplo@gmail.com" value="<?php echo $funcionario["funEmail"] ?>">

                <label for="fUsername">Username:</label>
                <input value="<?php echo $funcionario["funUsername"]?>" name="fUsername" type="text" placeholder="Username">

                <label for="fSenha">Senha:</label>
                <input value="<?php echo $funcionario["funSenha"]?>" name="fSenha" type="password" placeholder="*******">

                <div class="div-checkbox">
                    <input checked="<?php echo $funcionario["funIsGerente"]?>" type="checkbox" name="fIsGerente">
                    <label for="fIsGerente">Gerente</label>
                </div>

            </div>
            <div></div>
            <input type="text" name="fCodigo" value="<?php echo $funcionario["funCodigo"]?>" hidden>
            <input type="text" name="classeAcao" value="FuncionarioControle/editar" hidden>
            <button class="primary">Editar</button>
        </form>
    </div>
</div>