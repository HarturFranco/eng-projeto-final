<?php
// include_once 'Controle/ProdutoControle.php';

// $funcionario = new FuncionarioControle();
// $dados = $funcionario->index();
?>

<div class="index">
  <h1>Produtos</h1>
  <?php if (/* count($dados) == 0 */false) { ?>
    <div class="not-found">
      Nenhuma categoria encontrada...
      <a href="cadastro/produto" class="button primary">
        Cadatrar
      </a>
    </div>
  <?php } else { ?>
    <div>
      <div>
        <div class="search">
          <input type="text" name="search">
          <button class="secondary" onclick="filter()">
            Filtros
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4 21V14" stroke="#102A43" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M4 10V3" stroke="#102A43" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M12 21V12" stroke="#102A43" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M12 8V3" stroke="#102A43" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M20 21V16" stroke="#102A43" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M20 12V3" stroke="#102A43" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M1 14H7" stroke="#102A43" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M9 8H15" stroke="#102A43" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M17 16H23" stroke="#102A43" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </button>
        </div>
        <a href="cadastro/categoria" class="button primary">
          Adicionar
          <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 5.5V19.5" stroke="#FFFFFE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M5 12.5H19" stroke="#FFFFFE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </a>
      </div>

      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Desctrição</th>
            
            <th></th>
          </tr>
        </thead>
        <tbody>
          <!-- <?php
          foreach ($dados as $fun) {
          ?>
            <tr string="<?php echo "{$fun["funCodigo"]} {$fun["funNome"]}" ?>">
              <td><?php echo $fun["funCodigo"] ?></td>
              <td><?php echo $fun["funNome"] ?></td>
              <td><?php echo $fun["funEmail"] ?></td>
              <td><?php echo $fun["funUsername"] ?></td>
              <td><?php echo $fun["funIsGerente"] == true ? 'true' : 'false' ?></td>
              <td>
                <a href="funcionarios/editar/<?php echo $fun["funCodigo"]; ?>">
                  <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.6425 16.8C3.6925 16.8 3.7425 16.7948 3.7925 16.7869L7.9975 16.0125C8.0475 16.002 8.095 15.9784 8.13 15.939L18.7275 4.81162C18.7507 4.78734 18.7691 4.75849 18.7816 4.72674C18.7942 4.69498 18.8006 4.66094 18.8006 4.62656C18.8006 4.59218 18.7942 4.55814 18.7816 4.52639C18.7691 4.49463 18.7507 4.46579 18.7275 4.4415L14.5725 0.076125C14.525 0.02625 14.4625 0 14.395 0C14.3275 0 14.265 0.02625 14.2175 0.076125L3.62 11.2035C3.5825 11.2429 3.56 11.2901 3.55 11.3426L2.8125 15.7579C2.78818 15.8985 2.79687 16.0432 2.83782 16.1795C2.87877 16.3158 2.95074 16.4396 3.0475 16.5401C3.2125 16.7081 3.42 16.8 3.6425 16.8ZM5.3275 12.222L14.395 2.70375L16.2275 4.62787L7.16 14.1461L4.9375 14.5582L5.3275 12.222ZM19.2 19.005H0.8C0.3575 19.005 0 19.3804 0 19.845V20.79C0 20.9055 0.09 21 0.2 21H19.8C19.91 21 20 20.9055 20 20.79V19.845C20 19.3804 19.6425 19.005 19.2 19.005Z" fill="#627D98" />
                  </svg>
                </a>
                <form class="icon" action="Controle/Controle" method="POST">
                  <input type="text" name="fCodigo" value="<?php echo $fun["funCodigo"] ?>" hidden>
                  <input type="text" name="classeAcao" value="FuncionarioControle/excluir" hidden>
                  <button class="icon">
                    <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M6.04167 1.98H5.83333C5.94792 1.98 6.04167 1.881 6.04167 1.76V1.98H13.9583V1.76C13.9583 1.881 14.0521 1.98 14.1667 1.98H13.9583V3.96H15.8333V1.76C15.8333 0.78925 15.0859 0 14.1667 0H5.83333C4.91406 0 4.16667 0.78925 4.16667 1.76V3.96H6.04167V1.98ZM19.1667 3.96H0.833333C0.372396 3.96 0 4.35325 0 4.84V5.72C0 5.841 0.09375 5.94 0.208333 5.94H1.78125L2.42448 20.3225C2.46615 21.2603 3.20052 22 4.08854 22H15.9115C16.8021 22 17.5339 21.263 17.5755 20.3225L18.2187 5.94H19.7917C19.9062 5.94 20 5.841 20 5.72V4.84C20 4.35325 19.6276 3.96 19.1667 3.96ZM15.7109 20.02H4.28906L3.65885 5.94H16.3411L15.7109 20.02Z" fill="#627D98" />
                    </svg>
                  </button>
                </form>
              </td>
            </tr>
          <?php
          }
          ?> -->
        </tbody>
      </table>
    </div>
  <?php
  }
  ?>
</div>