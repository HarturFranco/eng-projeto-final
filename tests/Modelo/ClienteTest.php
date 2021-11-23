<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class ClienteTest extends TestCase {
    

    public function test_setCodigo() {
        $cliente = new Cliente("Arthur Franco", "103.104.945-90");
        $cliente->setCodigo(1);
        $this->assertEquals(1, $cliente->getCodigo());

    }

    public function test_setNome() {
        $cliente = new Cliente("Arthur Franco", "103.104.945-90");
        $cliente->setNome("Acordoamentos");

        $this->assertEquals("Acordoamentos", $cliente->getNome());

    }

    public function test_setCpf() {
        $cliente = new Cliente("Arthur Franco", "103.104.945-90");
        $cliente->setCpf("103.148.945-90");
        $this->assertEquals("103.148.945-90", $cliente->getCpf());
    }
}

?>