<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Inventario\Domain\ProductoCompuesto;
use Src\Inventario\Domain\ProductoSimple;

class ProductoCompuestoTest extends TestCase
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
     * Escenario: Salida correcta de productos compuestos
     * HU 1. COMO USUARIO QUIERO REGISTRAR LA SALIDA PRODUCTOS
     * Criterio de Aceptación:
     * 1. La cantidad de la de debe ser mayor a 0.
     * 2. Cada salida debe registrar el costo del producto y el precio de la venta
     * 3. En caso de un producto compuesto la cantidad de la salida se le disminuirá a la cantidad existente de cada uno de su ingrediente
     * 4. El costo de los productos compuestos corresponden al costo de sus ingredientes por la cantidad de estos.
     * Dado
     * El usurario tiene los siguientes productos
     * un producto con el nombre “salchicha”, costo “1000”, cantidad “4”, preparacion "SI"
     * un producto con el nombre “pan perro”, costo “1000”, cantidad “3”, preparacion "SI"
     * un producto con el nombre “lamina de queso”, costo “1000”, cantidad “5”, preparacion "SI"
     * El usurario tiene un producto compuesto con el nombre “Perro sencillo”, costo “3000”=>calculado, precio “5000” combo "NO"
     * Cuando    va a registrar la salida con la cantidad “1”
     * Entonces    El sistema registrará la salida AND presentará el mensaje. “El Nuevo stock de los productos: salchicha es 3, pan perro es 2, lamina de queso es 4 ”.
     * @test
     */
    public function testSalidaCorrectaProductoCompuesto(): void {
        $ingredientes[] = ['producto' => new ProductoSimple('salchicha', 1000, null, 4, 'SI'), 'cantidad' => 1];
        $ingredientes[] = ['producto' => new ProductoSimple('pan perro', 1000, null, 3, 'SI'), 'cantidad' => 1];
        $ingredientes[] = ['producto' => new ProductoSimple('lamina de queso', 1000, null, 5, 'SI'), 'cantidad' => 1];

        $productoCompuesto = new ProductoCompuesto('perro sencillo', null, 5000, 0, $ingredientes, 'NO');
        $result = $productoCompuesto->salida(1);
        self::assertEquals('El Nuevo stock de los productos: salchicha es 3, pan perro es 2, lamina de queso es 4', $result);
    }
    /**
     * @aquiestoy:) <<<<<<<=============
     */

    /**
     * Escenario: Salida correcta de productos compuestos tipo combo
     * HU 1. COMO USUARIO QUIERO REGISTRAR LA SALIDA PRODUCTOS
     * Criterio de Aceptación:
     * 1. La cantidad de la de debe ser mayor a 0.
     * 2. Cada salida debe registrar el costo del producto y el precio de la venta
     * 3. En caso de un producto compuesto la cantidad de la salida se le disminuirá a la     cantidad existente de cada uno de su ingrediente
     * 4. El costo de los productos compuestos corresponde al costo de sus ingredientes por la cantidad de estos.
     * Dado
     * El usurario tiene los siguientes productos
     * Un producto con el nombre “gaseosa litro”, costo “2000”, precio "5000", cantidad “2”, preparacion "NO"
     * un producto con el nombre “salchicha”, costo “1000”, cantidad “4”, preparacion "SI"
     * un producto con el nombre “pan perro”, costo “1000”, cantidad “3”, preparacion "SI"
     * un producto con el nombre “lamina de queso”, costo “1000”, cantidad “5”, preparacion "SI"
     * El usurario tiene un producto compuesto con el nombre “Combo para parejas”, costo “8000”=>calculado, precio “12000” combo “SI”
     * Cuando    va a registrar la salida con la cantidad “1”
     * Entonces    El sistema registrará la salida AND presentará el mensaje. “El Nuevo stock de los productos: salchicha es 2, pan perro es 1, lamina de queso es 3”.
     * @test
     */
    public function testSalidaCorrectaProductoCompuestoCombo(): void {
        $ingredientes[] = ['producto' => new ProductoSimple('salchicha', 1000, null, 4, 'SI'), 'cantidad' => 1];
        $ingredientes[] = ['producto' => new ProductoSimple('pan perro', 1000, null, 3, 'SI'), 'cantidad' => 1];
        $ingredientes[] = ['producto' => new ProductoSimple('lamina de queso', 1000, null, 5, 'SI'), 'cantidad' => 1];
        $combo[] = ['producto' => new ProductoSimple('gaseosa litro', 2000, 5000, 2, 'NO'), 'cantidad' => 1];
        $combo[] = ['producto' => new ProductoCompuesto('perro sencillo', null, 5000, 0, $ingredientes, 'NO'), 'cantidad' => 2];
        $productoCompuesto = new ProductoCompuesto('Combo para parejas', null, 12000, 0, $combo, 'SI');
        $result = $productoCompuesto->salida(1);
        self::assertEquals('El Nuevo stock de los productos: gaseosa litro es 1, salchicha es 2, pan perro es 1, lamina de queso es 3', $result);
    }
}
