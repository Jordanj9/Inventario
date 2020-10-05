<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Inventario\Domain\ProductoSimple;

class ProductoSimpleTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample() {
        $this->assertTrue(true);
    }

    /**
     * Escenario:  Cantidad de entrada negativa o cero
     * HU 1. COMO USUARIO QUIERO REGISTRAR LA ENTRADA PRODUCTOS
     * Criterio de Aceptación:
     * 1 La cantidad de la entrada de debe ser mayor a 0.
     * Dado El usuario tiene un producto con el nombre “gaseosa litro”, costo “2000”, precio “5000” cantidad “5” preparacion "NO"
     * Cuando    va a dar una nueva entrada con una cantidad menor o igual a cero
     * Entonces    El sistema presentará el mensaje. “La cantidad es incorrecta”
     * @test
     */
    public function testCantidadEntradaNegativaCero(): void {
        $productoSimple = new ProductoSimple('gaseosa litro',2000,5000,5,'NO');
        $result = $productoSimple->entrada(0);
        $this->assertEquals('La cantidad es incorrecta', $result);
    }
}
