<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class UtilTest extends TestCase {

    public function test_limparCPF() {

        $this->assertEquals("15614598690", Util::limpaCPF("156.145.986-90"));
    }

    public function test_arrumarCPF() {

        $this->assertEquals("156.145.986-90", Util::arrumaCPF("15614598690"));
    }

    public function test_formatReal() {

        $this->assertEquals("R$150,50", Util::formatReal("150.50"));
    }    
}

?>