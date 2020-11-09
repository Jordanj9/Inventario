<?php


namespace Tests\Unit\Aplication\Aplication\Poductosimple;


use Src\Inventario\Aplication\GuardarProductoSimpleService;
use Src\Inventario\Aplication\ProductoSimpleRequest;
use Src\Inventario\Domain\IProductosimpleRepository;
use Src\Inventario\Domain\ProductoSimple;
use Src\Inventario\Shared\Domain\IUnitOfWork;
use Tests\Unit\Aplication\Poductosimple\ProductosimpleModuleTestCase;

class GuardarProductosimpleServiceTest extends ProductosimpleModuleTestCase
{
    private $service;

    protected function setUp(): void
    {
        $this->service = $this->service ?: new GuardarProductoSimpleService($this->repository(), $this->unitofwork());
        parent::setUp();
    }

    public function testGuardarProductosimple(): void
    {
        $request = new ProductoSimpleRequest('GASEOSA LITRO', 2000, 5000, 2, 'NO');
        $producto = new ProductoSimple($request->getNombre(), $request->getCosto(), $request->getPrecio(), $request->getCantidad(), $request->getPreparacion());
//        $this->shouldBegintransaction();
//
//        $this->shouldCommit();
//        //$this->shouldRollback();
//        $this->shouldSearch($request->getNombre());
//        $this->shouldSave($producto);
        $repository = $this->createMock(IProductosimpleRepository::class);
        $unitofwork = $this->createMock(IUnitOfWork::class);
        $service = new GuardarProductoSimpleService($repository, $unitofwork);
        $repository->method('save');
        $service($request);
//        $this->service->__invoke($request);
    }
}
