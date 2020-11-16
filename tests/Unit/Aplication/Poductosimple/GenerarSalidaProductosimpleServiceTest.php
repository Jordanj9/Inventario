<?php


namespace Aplication\Poductosimple;


use Src\Inventario\Aplication\GenerarSalidaProductoSimpleService;
use Src\Inventario\Domain\MovimientoInventario;
use Src\Inventario\Domain\ProductoSimple;
use Tests\Unit\Aplication\Poductosimple\ProductosimpleModuleTestCase;

class GenerarSalidaProductosimpleServiceTest extends ProductosimpleModuleTestCase
{

    private $service;

    protected function setUp(): void
    {
        $this->service = $this->service ?: new GenerarSalidaProductoSimpleService($this->repository(), $this->unitofwork(),$this->email());
        parent::setUp();
    }

    /**
     * @test
     */
    public function GenerarSalidadProductosimpleCorrectamente(): void
    {
        $cantidad = 1;
        $producto = new ProductoSimple('GASEOSA', 2000, 5000, 2, 0, 'NO');
        $movimiento = new MovimientoInventario($producto->getNombre(),$producto->getCosto(),$producto->getPrecio(),$cantidad,'SALIDA');
        $this->shouldBegintransaction();
        $this->shouldSearch($producto->getNombre(), $producto);
        $this->shouldSave($producto);
        $this->shouldSalida($movimiento);
        $this->shouldCommit();
        $this->shouldEmail('jordan_j9@hotmail.com', 'NUEVA SALIDA', 'SALIO UN PRODUCO');
        $this->shouldRollback();
        $this->service->__invoke($producto->getNombre(), $cantidad);
    }
}
