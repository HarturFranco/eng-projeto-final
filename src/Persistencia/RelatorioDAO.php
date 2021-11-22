<?php

class RelatorioDAO
{

    function __construct()
    {
    }

    public function funcionarios($conn)
    {
      
        try {
          $query = "SELECT 
          Funcionario_funCodigo as funcionario, 
          SUM(venPrecoTotal) as Total, 
          COUNT(*) as QuantidadeVendas  
          FROM `Venda` 
          GROUP BY Funcionario_funCodigo";
            $res = $conn->query($query);

            return $res->fetchAll();
        } catch (Exception $e) {
            throw new $e->getMessage();
        }
    }

    
}
