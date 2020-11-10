<?php


namespace Src\Inventario\Aplication;


use Src\Inventario\Domain\IProductosimpleRepository;
use Src\Inventario\Domain\ProductoInexistente;
use Src\Inventario\Shared\Domain\IUnitOfWork;
use Exception;

class GenerarSalidaProductoSimpleService
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

    public function __invoke(string $nombre, int $cantidad)
    {
        $producto = $this->repository->search($nombre);
        if ($producto == null)
            throw new ProductoInexistente($nombre);

        try {
            $this->unitOfWork->beginTransaction();
            $this->repository->salida($producto, $cantidad);
            $this->unitOfWork->commit();
        } catch (Exception $exception) {
            $this->unitOfWork->rollback();
            return $exception->getMessage();
        }

    }

}
