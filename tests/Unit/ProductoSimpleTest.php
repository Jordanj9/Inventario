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
//    public function testExample() {
//        $this->assertTrue(true);
//    }

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
        $productoSimple = new ProductoSimple('gaseosa litro', 2000, 5000, 5, 'NO');
        $result = $productoSimple->entrada(0);
        $this->assertEquals('La cantidad es incorrecta', $result);
    }

    /**
     * Escenario:  Registro de entrada correcto
     * HU 1. COMO USUARIO QUIERO REGISTRAR LA ENTRADA PRODUCTOS
     * Criterio de Aceptación:
     * 1. La cantidad de la entrada de debe ser mayor a 0.
     * 2. La cantidad de la entrada se le aumentará a la cantidad existente del producto
     * Dado
     * El usuario tiene un producto con el nombre “gaseosa litro”, costo “2000”, precio “5000” cantidad “5” preparación “NO”
     * Cuando    va a dar una nueva entrada con una cantidad de 6
     * Entonces    El sistema registrará la entrada AND presentará el mensaje. “El uevo stock del producto gaseosa litro es 11”.
     * @test
     */
    public function testEntradaCorrecta(): void {
        $productoSimple = new ProductoSimple('gaseosa litro', 2000, 5000, 5, 'NO');
        $result = $productoSimple->entrada(6);
        $this->assertEquals('El nuevo stock del producto gaseosa litro es 11', $result);
    }

    /**
     * Escenario:  Cantidad de salida negativa o cero
     * HU 1. COMO USUARIO QUIERO REGISTRAR LA SALIDA PRODUCTOS
     * Criterio de Aceptación:
     * 1. La cantidad de la de debe ser mayor a 0.
     * Dado El usuario tiene un producto con el nombre “gaseosa litro”, costo “2000”, precio “5000” cantidad “5” preparación “NO”
     * Cuando va a registrar la salida con una cantidad de 0
     * Entonces El sistema presentará el mensaje. “La cantidad es incorrecta”.
     * @test
     */
    public function testCantidadSalidaNegativaCero(): void {
        $productoSimple = new ProductoSimple('gaseosa litro', 2000, 5000, 5, 'NO');
        $result = $productoSimple->salida(0);
        $this->assertEquals('La cantidad es incorrecta', $result);
    }

    /**
     * Escenario:  Salida correcta de productos simples
     * HU 1. COMO USUARIO QUIERO REGISTRAR LA SALIDA PRODUCTOS
     * Criterio de Aceptación:
     * 1. La cantidad de la de debe ser mayor a 0.
     * 2. En caso de un producto sencillo la cantidad de la salida se le disminuirá a la cantidad existente del producto.
     * 3. Cada salida debe registrar el costo del producto y el precio de la venta
     * Dado
     * El usurario tiene un producto con el nombre “gaseosa litro”, costo “2000”, precio “5000” cantidad “4”
     * Cuando    va a registrar la salida con una cantidad de 2
     * Entonces    El sistema registrará la salida AND presentará el mensaje. “El nuevo stock del producto gaseosa litro es 2”.
     * @test
     */
    public function testSalidaCorrectaProductoSimple(): void {
        $productoSimple = new ProductoSimple('gaseosa litro', 2000, 5000, 4, 'NO');
        $result = $productoSimple->salida(2);
        $this->assertEquals('El nuevo stock del producto gaseosa litro es 2', $result);
    }
}
