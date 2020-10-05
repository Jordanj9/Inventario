<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

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
     * Dado
     * El usuario tiene un producto con el nombre “salchicha”, costo “1000”, precio “1500” cantidad “5”
     * Cuando    va a dar una nueva entrada con una cantidad menor o igual a cero
     * Entonces    El sistema presentará el mensaje. “La cantidad es incorrecta”
     * @test
     */
    public function testCantidadEntradaNegativaCero(): void {
        $productoSimple = new ProductoSimple();
        $result = $productoSimple->entrada(0);
        $this->assertEquals('La cantidad es incorrecta', $result);
    }
}
