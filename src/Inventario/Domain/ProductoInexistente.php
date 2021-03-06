<?php


namespace Src\Inventario\Domain;


use Src\Inventario\Shared\Domain\DomainError;

class ProductoInexistente extends DomainError
{
    private string $nombre;

    /**
     * ProductoDuplicado constructor.
     * @param string $nombre
     */
    public function __construct(string $nombre)
    {
        $this->nombre = $nombre;
        parent::__construct();
    }


    public function errorCode(): string
    {
        return 'producto_duplicado';
    }

    protected function errorMessage(): string
    {
        return sprintf('El producto con el nombre <%s> no se encuentra registrado.', $this->nombre);
    }
}
