<?php


namespace Src\Inventario\Domain;


class ProductoSimple extends Producto
{
    private $tipo;

    public function __construct(string $nombre, float $costo, float $precio, int $cantidad, string $tipo) {
        parent::__construct($nombre, $costo, $precio, $cantidad);
        $this->tipo = $tipo;
    }

    public function entrada(int $cantidad): string {
        if ($cantidad <= 0) return 'La cantidad es incorrecta';

    }


}
