<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class CategoriaTest extends TestCase {

    // public function test_setCodigo() {
    //     $categoria = new Categoria("Cordas");
    //     $categoria->setCodigo(1);
    //     $this->assertEquals(1, $categoria->getCodigo());

    // }

    public function test_setNome() {
        $categoria = new Categoria("Cordas");
        $categoria->setNome("Acordoamentos");

        $this->assertEquals("Acordoamentos", $categoria->getNome());
    }

    public function test_setDescricao() {
        $categoria = new Categoria("Cordas");
        $categoria->setDescricao("Instumentos de cordas");
        $this->assertEquals("Instumentos de cordas", $categoria->getDescricao());
    }
}

?>