<?php


namespace Src\Inventario\Aplication;


use Src\Inventario\Domain\IProductosimpleRepository;
use Src\Inventario\Domain\ProductoInexistente;
use Src\Inventario\Shared\Domain\IEmailSender;
use Src\Inventario\Shared\Domain\IUnitOfWork;
use Exception;

class GenerarSalidaProductoSimpleService
{
    private IProductosimpleRepository $repository;
    private IUnitOfWork $unitOfWork;
    private IEmailSender $email;

    /**
     * GuardarProductoSimpleService constructor.
     * @param IProductosimpleRepository $repository
     * @param IUnitOfWork $unitOfWork
     * @param IEmailSender $email
     */
    public function __construct(IProductosimpleRepository $repository, IUnitOfWork $unitOfWork, IEmailSender $email)
    {
        $this->repository = $repository;
        $this->unitOfWork = $unitOfWork;
        $this->email = $email;

    }

    public function __invoke(string $nombre, int $cantidad)
    {
        $producto = $this->repository->search($nombre);
        if ($producto == null)
            throw new ProductoInexistente($nombre);

        try {
            $this->unitOfWork->beginTransaction();
            $movimiento = $producto->salida($cantidad)['movimiento'];
            $this->repository->save($producto);
            $this->repository->salida($movimiento);
            $mensaje = 'EL PRODUCTO ' . $nombre . ' GENERO UNA NUEVA SALIDA DE: ' . $cantidad;
            $this->unitOfWork->commit();
            $this->email->enviarEmail('annaisa-12@hotmail.com', 'SALIDA DE PRODUCTO', $mensaje);
        } catch (Exception $exception) {
            $this->unitOfWork->rollback();
            return $exception->getMessage();
        }
    }

}
