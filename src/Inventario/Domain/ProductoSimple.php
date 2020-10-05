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

        if ($cantidad > 0) {
            $entrada = new MovimientoInventario($this->getNombre(), $this->getCosto(), $this->getPrecio(), $cantidad, 'ENTRADA');
            $cant = $this->getCantidad() + $cantidad;
            $this->setCantidad($cant);
            return sprintf("El nuevo stock del producto %s es %s", $this->getNombre(), $this->getCantidad());
        }

    }


}
