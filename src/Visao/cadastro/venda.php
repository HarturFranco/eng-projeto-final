<?php
include_once "Controle/VendaControle.php";
$vendaControle = new VendaControle();
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
              <label for="">Produto:</label>
              <select name="">
                <option value="">None</option>
              </select>
            </div>

            <div>
              <label for="pNome">Qtd:</label>
              <input name="pNome" type="number" max="<?php echo '' ?>">
            </div>
          </div>

          <button class="primary">Adicionar</button>
        </div>


        <div class="prodtucts-selected">
          <div class="label">
            <div>Qtd</div>
            <div>Produto</div>
            <div>Preço</div>
          </div>
          <div class="product">
            <div>1</div>
            <div>Guitarra</div>
            <div>Caro</div>
          </div>

          <div class="product">
            <div>1</div>
            <div>Guitarra</div>
            <div>Caro</div>
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
            <div class="value">Valor</div>
          </div>

          <button>Cancelar</button>
          <button class="primary">Finalizar Venda</button>
        </div>
      </div>
      <input type="text" name="fCodigo" value="<?php echo '' ?>" hidden>
      <input type="text" name="classeAcao" value="ProdutoControle/cadastrar" hidden>

    </form>
  </div>
</div>