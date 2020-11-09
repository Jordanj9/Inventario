<?php


namespace Src\Inventario\Aplication;


use Src\Inventario\Domain\IProductosimpleRepository;
use Src\Inventario\Domain\ProductoSimple;

class GuardarProductoSimpleService
{
    private IProductosimpleRepository $repository;

    /**
     * GuardarProductoSimpleService constructor.
     * @param IProductosimpleRepository $repository
     */
    public function __construct(IProductosimpleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ProductoSimpleRequest $request)
    {
        $producto = new ProductoSimple($request->getNombre(), $request->getCosto(), $request->getPrecio(), $request->getCantidad(), $request->getPreparacion());
        $this->repository->save($producto);
    }

}
