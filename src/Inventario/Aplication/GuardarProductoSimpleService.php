<?php


namespace Src\Inventario\Aplication;


use Src\Inventario\Domain\IProductosimpleRepository;
use Src\Inventario\Domain\ProductoDuplicado;
use Src\Inventario\Domain\ProductoSimple;

class GuardarProductoSimpleService
{
    private IProductosimpleRepository $repository;
//    private IMovimientoinventarioRepository $movimiento;

    /**
     * GuardarProductoSimpleService constructor.
     * @param IProductosimpleRepository $repository
     */
    public function __construct(IProductosimpleRepository $repository)
    {
        $this->repository = $repository;
//        $this->movimiento = $movimiento;

    }

    public function __invoke(ProductoSimpleRequest $request)
    {
        $producto = $this->repository->search($request->getNombre());
        if ($producto != null)
            throw new ProductoDuplicado($request->getNombre());

        $producto = new ProductoSimple($request->getNombre(), $request->getCosto(), $request->getPrecio(), $request->getCantidad(), $request->getPreparacion());
        $this->repository->save($producto);
        $this->repository->addEntrada($producto, $producto->getCantidad());
    }

}
