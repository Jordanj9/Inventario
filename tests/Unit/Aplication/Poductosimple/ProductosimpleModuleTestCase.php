<?php


namespace Tests\Unit\Aplication\Poductosimple;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Src\Inventario\Domain\IProductosimpleRepository;
use Src\Inventario\Domain\ProductoSimple;
use Src\Inventario\Shared\Domain\IEmailSender;
use Src\Inventario\Shared\Domain\IUnitOfWork;
use Tests\Unit\Shared\Domain\TestUtils;

class ProductosimpleModuleTestCase extends TestCase
{

    private $repository;
    private $unitofwork;
    private $email;

    /**
     * @return MockInterface|IProductosimpleRepository
     */
    protected function repository(): MockInterface
    {
        return $this->repository = $this->repository ?: Mockery::mock(IProductosimpleRepository::class);
    }

    /**
     * @return MockInterface|IUnitOfWork
     */
    protected function unitofwork(): MockInterface
    {
        return $this->unitofwork = $this->unitofwork ?: Mockery::mock(IUnitOfWork::class);
    }

    /**
     * @return MockInterface|IEmailSender
     */
    protected function email(): MockInterface
    {
        return $this->email = $this->email ?: Mockery::mock(IEmailSender::class);
    }

    protected function shouldSave(ProductoSimple $producto): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->with(TestUtils::similarTo($producto))
            ->once();
    }


    protected function shouldSearch(string $nombre, ?ProductoSimple $producto = null)
    {
        $this->repository()
            ->shouldReceive('search')
            ->with(TestUtils::similarTo($nombre))
            ->once()
            ->andReturn($producto);
    }

    protected function shouldSalida(ProductoSimple $simple, int $cantidad)
    {
        $this->repository()
            ->shouldReceive('salida')
            ->with(TestUtils::similarTo($simple), TestUtils::similarTo($cantidad))
            ->once();
    }

    protected function shouldEmail(string $email, string $subject, string $mensaje)
    {
        $this->email()
            ->shouldReceive('enviarEmail')
            ->with($email,$subject, $mensaje);
    }

    protected function shouldBegintransaction()
    {
        $this->unitofwork()
            ->shouldReceive('beginTransaction')
            ->once();
    }

    protected function shouldCommit()
    {
        $this->unitofwork()
            ->shouldReceive('commit')
            ->once();
    }

    protected function shouldRollback()
    {
        $this->unitofwork()
            ->shouldReceive('rollback')
            ->once();
    }
}
