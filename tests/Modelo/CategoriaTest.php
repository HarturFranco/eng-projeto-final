<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class CategoriaTest extends TestCase {

    public function test_setDescricao() {
        $categoria = new Categoria("Cordas");
        $categoria->setDescricao("Instumentos de cordas");
        $this->assertEquals("Instumentos de", $categoria->getDescricao());

    }
}

?>