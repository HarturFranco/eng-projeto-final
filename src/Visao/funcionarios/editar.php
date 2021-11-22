<?php
include_once 'Controle/FuncionarioControle.php';
include_once 'Lib/Util.php';

$id = Util::getArgumento();
$funcionarioControle = new FuncionarioControle();

$funcionario = $funcionarioControle->buscar((int)$id);

?>

<div class="cadastro">
    <h1>Editar Funcionario</h1>

    <div>
        <form action="Controle/Controle" method="POST">
            <div>
                <label for="funNome">Nome:</label>
                <input 
                    name="funNome" 
                    type="text" 
                    maxlength="50" 
                    required 
                    placeholder="Entre com o nome do funcionário" 
                    value="<?php echo $funcionario->getNome() ?>">

                <label for="funEmail">Email:</label>
                <input 
                    name="funEmail" 
                    type="email" 
                    maxlength="320" 
                    required 
                    placeholder="exemplo@gmail.com" 
                    value="<?php echo $funcionario->getEmail() ?>">

                <label for="funUsername">Username:</label>
                <input 
                    value="<?php echo $funcionario->getUsername() ?>" 
                    maxlength="25" 
                    required 
                    name="funUsername" 
                    type="text" 
                    placeholder="Username">

                <label for="funSenha">Senha:</label>
                <input 
                    value="<?php echo $funcionario->getSenha() ?>" 
                    maxlength="25" 
                    required 
                    name="funSenha" 
                    type="password" 
                    placeholder="*******">

                <div class="div-checkbox">
                <?php if($funcionario->getIsGerente() == 1){ ?> 
                    <input checked type="checkbox" name="funIsGerente">
                <?php } else { ?>
                    <input type="checkbox" name="funIsGerente">
                <?php } ?>
                    <label for="funIsGerente">Gerente</label>
                </div>
                
            </div>
            <div></div>
            <input type="text" name="funCodigo" value="<?php echo $funcionario->getCodigo() ?>" hidden>
            <input type="text" name="classeAcao" value="FuncionarioControle/editar" hidden>
            <button class="primary">Editar</button>
        </form>
    </div>
</div>