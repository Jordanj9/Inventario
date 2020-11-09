<?php


namespace Src\Inventario\Domain;


use Src\Inventario\Shared\DomainError;

class ProductoDuplicado extends DomainError
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
        return sprintf('El producto con el nombre <%s> ya se encuentra registrado.', $this->nombre);
    }
}
