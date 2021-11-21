<?php
include_once "Controle/VendaControle.php";
include_once "Controle/FuncionarioControle.php";
include_once "Controle/ClienteControle.php";
include_once "Lib/Util.php";


$id = Util::getArgumento();

$vendaControle = new VendaControle();
$funcionarioControle = new FuncionarioControle();
$clienteControle = new ClienteControle();

$venda = $vendaControle->buscar($id);
$itensVenda = $vendaControle->buscarItemsVenda($id);
$clientes = $clienteControle->index();
$funcionarios = $funcionarioControle->index();

?>

<div class="cadastro">
  <h1>Editar Venda</h1>

  <div>
    <form action="Controle/Controle" method="POST" class="venda">
      <div>
        <div class="insert-item">
          <h3>Inserir item</h3>

          <div class="select-item">
            <div>
              <label for="pProduto">Produto:</label>
              <select name="pProduto" required disabled>
                <option value="" disabled selected>Selecione um produto</option>
              </select>
            </div>

            <div>
              <label for="pQtd">Qtd:</label>
              <input name="pQtd" type="number" min="1" disabled>
            </div>
          </div>

          <button id="button-adicionar_venda" class="primary" type="button">Adicionar</button>
        </div>


        <div class="prodtucts-selected">
          <div class="label">
            <div>Qtd</div>
            <div>Produto</div>
            <div>Preço</div>
            <div>Total</div>
          </div>
          <?php foreach($itensVenda as $item) {
            $total = $item->getQtd() * $item->getPreco()  
          ?>
          <div class="product">
            <div><?php echo $item->getQtd() ?></div>
            <div><?php echo $item->getProduto() ?></div>
            <div><?php echo Util::formatReal($item->getPreco()) ?></div>
            <div><?php echo Util::formatReal($total) ?></div>
          </div>
          <?php } ?>
        </div>

      </div>
      <div>
        <div class="client-employee">
          <label for="vCliente">Cliente:</label>
          <select name="vCliente" required>
            <option value="" disabled>Selecione um cliente</option>
            <?php
            foreach ($clientes as $cli) {
              ?>
              <option 
                value="<?php echo $cli->getCodigo() ?>"
                selected="<?php echo $cli->getCodigo() == $venda->getCliente()->getCodigo()?>">
                  <?php echo $cli->getNome() ?>
                </option>
            <?php
            }
            ?>

          </select>

          <label for="vFuncionario">Funcionario:</label>
          <select name="vFuncionario"required>
            <option value="" disabled>Selecione um funcionario</option>
            <?php
              foreach ($funcionarios as $fun) {
              ?>
                <option 
                  value="<?php echo $fun->getCodigo() ?>"
                  selected="<?php echo $fun->getCodigo() == $venda->getFuncionario()->getCodigo()?>">
                    <?php echo $fun->getNome() ?>
                  </option>
              <?php
              }
              ?>

          </select>
        </div>

        <div class="control">
          <div class="price">
            <div class="label">Preço</div>
            <div class="value value_total"><?php echo $venda->getPrecoTotal()?></div>
          </div>

          <a href="vendas" class="button primary">Cancelar</a>
          <button type="submit" class="primary submit_venda">Finalizar Venda</button>
        </div>
      </div>
      
      <input type="text" name="vProdutos" required hidden>
      <input type="text" name="vValor" hidden>
      <input type="text" name="classeAcao" value="VendaControle/cadastro" hidden>

    </form>
  </div>
</div>