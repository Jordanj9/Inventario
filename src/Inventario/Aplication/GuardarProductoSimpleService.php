<?php


namespace Src\Inventario\Aplication;


use Src\Inventario\Domain\IProductosimpleRepository;
use Src\Inventario\Domain\ProductoDuplicado;
use Src\Inventario\Domain\ProductoSimple;
use Src\Inventario\Shared\Domain\IUnitOfWork;
use Exception;

class GuardarProductoSimpleService
{
    private IProductosimpleRepository $repository;
    private IUnitOfWork $unitOfWork;

    /**
     * GuardarProductoSimpleService constructor.
     * @param IProductosimpleRepository $repository
     * @param IUnitOfWork $unitOfWork
     */
    public function __construct(IProductosimpleRepository $repository, IUnitOfWork $unitOfWork)
    {
        $this->repository = $repository;
        $this->unitOfWork = $unitOfWork;

    }

    public function __invoke(ProductoSimpleRequest $request)
    {
        $producto = $this->repository->search($request->getNombre());
        if ($producto != null)
            throw new ProductoDuplicado($request->getNombre());

        try {
            $this->unitOfWork->beginTransaction();
            $producto = new ProductoSimple($request->getNombre(),$request->getCosto(),$request->getPrecio(),$request->getCantidad(),0,$request->getPreparacion());
            $this->repository->save($producto);
            $movimiento = $producto->entrada($producto->getCantidad())['movimiento'];
            $this->repository->addEntrada($movimiento);
            $this->unitOfWork->commit();
        } catch (Exception $exception) {
            $this->unitOfWork->rollback();
            return $exception->getMessage();
        }
    }

}
