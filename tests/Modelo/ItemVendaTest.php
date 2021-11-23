<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class ItemVendaTest extends TestCase {

    public function test_setPreco() {
        $IvemVenda = new ItemVenda(1, 50.5);
        $IvemVenda->setPreco(150.99);
        $this->assertEquals(150.99, $IvemVenda->getPreco());
    }

    public function test_setQtd() {
        $IvemVenda = new ItemVenda(1, 50.5);
        $IvemVenda->setQtd(20);

        $this->assertEquals(20, $IvemVenda->getQtd());
    }
}

?>