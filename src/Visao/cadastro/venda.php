<?php
include_once "Controle/VendaControle.php";
include_once "Controle/ProdutoControle.php";
include_once "Controle/FuncionarioControle.php";
include_once "Controle/ClienteControle.php";

$vendaControle = new VendaControle();
$produtoControle = new ProdutoControle();
$clienteControle = new ClienteControle();
$funcionarioControle = new FuncionarioControle();

$produtos = $produtoControle->index();
$clientes = $clienteControle->index();
$funcionarios = $funcionarioControle->index();

?>

<div class="cadastro">
  <h1>Cadastrar Venda</h1>

  <div>
    <form action="Controle/Controle" method="POST" class="venda">
      <div>
        <div class="insert-item">
          <h3>Inserir item</h3>

          <div class="select-item">
            <div>
              <label for="pProduto">Produto:</label>
              <select name="pProduto" required>
                <option value="" disabled selected>Selecione um produto</option>
                <?php
                foreach ($produtos as $pro) {
                  if($pro->getQtdEstoque() > 0) {
                ?>
                  <option 
                    value="<?php echo $pro->getCodigo() ?>" 
                    preco="<?php echo $pro->getPreco()?>"
                    qtd="<?php echo $pro->getQtdEstoque()?>">
                      <?php echo $pro->getNome() ?>
                    </option>
                <?php
                  }
                }
                ?>

              </select>
            </div>

            <div>
              <label for="pQtd">Qtd:</label>
              <input name="pQtd" type="number" min="1">
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
        </div>

      </div>
      <div>
        <div class="client-employee">
          <label for="vCliente">Cliente:</label>
          <select name="vCliente" required>
            <option value="" disabled selected>Selecione um cliente</option>
            <?php
            foreach ($clientes as $cli) {
            ?>
              <option 
                value="<?php echo $cli->getCodigo() ?>">
                  <?php echo $cli->getNome() ?>
                </option>
            <?php
            }
            ?>

          </select>

          <label for="vFuncionario">Funcionario:</label>
          <select name="vFuncionario"required>
            <option value="" disabled selected>Selecione um funcionario</option>
            <?php
              foreach ($funcionarios as $fun) {
              ?>
                <option 
                  value="<?php echo $fun->getCodigo() ?>">
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
            <div class="value value_total">R$ 0,00</div>
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