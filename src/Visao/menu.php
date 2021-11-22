<?php include_once "Lib/Auth.php" ?>
<aside class="menu">
  <h1 class="menu_title">Toca dos instrumentos</h1>
  <ul class="menu_list">
    <li class="menu_list-item" id="vendas"><a href="vendas">Vendas</a></li>
    <li class="menu_list-item has-submenu" id="cadastro">
      <a href="cadastro/produto">Cadastro</a>
      <ul class="menu_list-submenu">
        <li class="submenu_item" id="produto"><a href="cadastro/produto">Produto</a></li>
        <li class="submenu_item" id="cliente"><a href="cadastro/cliente">Cliente</a></li>
        <li class="submenu_item" id="categoria"><a href="cadastro/categoria">Categoria</a></li>
        <li class="submenu_item" id="venda"><a href="cadastro/venda">Venda</a></li>
        <?php if (Auth::isGerente()) { ?>
          <li class="submenu_item" id="funcionario"><a href="cadastro/funcionario">Funcionário</a></li>
        <?php } ?>
      </ul>
    </li>
    <li class="menu_list-item" id="produtos"><a href="produtos">Produtos</a></li>
    <li class="menu_list-item" id="categorias"><a href="categorias">Categorias</a></li>
    <li class="menu_list-item" id="clientes"><a href="clientes">Clientes</a></li>

    <?php if (Auth::isGerente()) { ?>
      <li class="menu_list-item" id="funcionarios"><a href="funcionarios">Funcionários</a></li>
      <li class="menu_list-item has-submenu" id="relatorios">
        <a href="/relatorios/funcionarios">Relatórios</a>
        <ul class="menu_list-submenu">
          <li class="submenu_item" id="funcionarios"><a href="relatorios/funcionarios">Funcionário</a></li>
        </ul>
      </li>
    <?php } ?>

  </ul>
</aside>

<form action="Controle/Controle" method="POST">
  <input type="text" name="classeAcao" value="LoginControle/sair" hidden>
  <button>Sair</button>
</form>