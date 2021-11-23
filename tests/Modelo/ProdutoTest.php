<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class ProdutoTest extends TestCase {

    public function test_setNome() {
        $produto = new Produto("Fender Stratocaster", 4524.00, 10, date('Y-m-d'), "Guitarra de Qualidade", 1);
        $produto->setNome("Fender Telecaster");

        $this->assertEquals("Fender Telecaster", $produto->getNome());
    }

    public function test_setDescricao() {
        $produto = new Produto("Fender Stratocaster", 4524.00, 10, date('Y-m-d'), "Guitarra de Qualidade", 1);
        $produto->setDescricao("Modelo Usado por lendas como Jimi hendrix...");

        $this->assertEquals("Modelo Usado por lendas como Jimi hendrix...", $produto->getDescricao());
    }


    public function test_setPreco() {
        $produto = new Produto("Fender Stratocaster", 4524.00, 10, date('Y-m-d'), "Guitarra de Qualidade", 1);
        $produto->setPreco(5000.00);

        $this->assertEquals(5000.00, $produto->getPreco());
    }

    public function test_setQtdEstoque() {
        $produto = new Produto("Fender Stratocaster", 4524.00, 10, date('Y-m-d'), "Guitarra de Qualidade", 1);
        $produto->setQtdEstoque(20);

        $this->assertEquals(20, $produto->getQtdEstoque());
    }

    public function test_setDataCadastro() {
        $produto = new Produto("Fender Stratocaster", 4524.00, 10, date('Y-m-d'), "Guitarra de Qualidade", 1);
        $produto->setDataCadastro("2020-11-22");

        $this->assertEquals("2020-11-22", $produto->getDataCadastro());
    }
}

?>