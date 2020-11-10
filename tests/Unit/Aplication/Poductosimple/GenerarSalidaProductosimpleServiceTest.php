<?php


namespace Aplication\Poductosimple;


use Src\Inventario\Aplication\GenerarSalidaProductoSimpleService;
use Src\Inventario\Aplication\ProductoSimpleRequest;
use Src\Inventario\Domain\IProductosimpleRepository;
use Src\Inventario\Domain\ProductoSimple;
use Src\Inventario\Shared\Domain\IUnitOfWork;
use Tests\Unit\Aplication\Poductosimple\ProductosimpleModuleTestCase;

class GenerarSalidaProductosimpleServiceTest extends ProductosimpleModuleTestCase
{

    private $service;

    protected function setUp(): void
    {
        $this->service = $this->service ?: new GenerarSalidaProductoSimpleService($this->repository(), $this->unitofwork());
        parent::setUp();
    }

    /**
     * @test
     */
    public function GenerarSalidadProductosimpleCorrectamente(): void
    {
        $cantidad = 1;
        $producto = new ProductoSimple('GASEOSA', 2000, 5000, 2, 0, 'NO');
        $this->shouldBegintransaction();
        $this->shouldSearch($producto->getNombre(),$producto);
        $this->shouldSalida($producto,$cantidad);
        $this->shouldCommit();
        $this->service->__invoke($producto->getNombre(),$cantidad);
    }
}
