<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class VendaTest extends TestCase {

    public function test_setFuncionario() {
        $venda = new Venda(4524.00, 1, 1, true, 1);
        $venda->setFuncionario(2);

        $this->assertEquals(2, $venda->getFuncionario());
    }

    public function test_setCliente() {
        $venda = new Venda(4524.00, 1, 1, true, 1);
        $venda->setCliente(2);

        $this->assertEquals(2, $venda->getCliente());
    }

    public function test_setPrecoTotal() {
        $venda = new Venda("Fender Stratocaster", 4524.00, 10, date('Y-m-d'), "Guitarra de Qualidade", 1);
        $venda->setPrecoTotal(5000.00);

        $this->assertEquals(5000.00, $venda->getPrecoTotal());
    }
}

?>