<?php
include_once "Controle/VendaControle.php";
include_once "Controle/ProdutoControle.php";

$vendaControle = new VendaControle();
$produtoControle = new ProdutoControle();

$produtos = $produtoControle->index();

?>

<div class="cadastro">
  <h1>Cadastrar Venda</h1>

  <div>
    <form action="" method="POST" class="venda">
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
                ?>
                  <option 
                    value="<?php echo $pro->getCodigo() ?>" 
                    preco="<?php echo $pro->getPreco()?>"
                    qtd="<?php echo $pro->getQtdEstoque()?>">
                      <?php echo $pro->getNome() ?>
                    </option>
                <?php
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
          </div>         
        </div>

      </div>
      <div>
        <div class="client-employee">
          <label for="vCliente">Cliente:</label>
          <select name="" id="">
            <option value="">Cliente</option>
          </select>

          <label for="vFuncionario">Funcionario:</label>
          <select name="" id="">
            <option value="">Funcionario</option>
          </select>
        </div>

        <div class="control">
          <div class="price">
            <div class="label">Preço</div>
            <div class="value value_total">R$ 0,00</div>
          </div>

          <button>Cancelar</button>
          <button class="primary">Finalizar Venda</button>
        </div>
      </div>
      <input type="text" name="venProdutos" value="[]" hidden>
      <input type="text" name="fCodigo" value="<?php echo '' ?>" hidden>
      <input type="text" name="classeAcao" value="ProdutoControle/cadastrar" hidden>

    </form>
  </div>
</div>