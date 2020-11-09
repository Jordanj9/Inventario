<?php


namespace Src\Inventario\Domain;


class ProductoSimple extends Producto
{
    private $preparacion;

    public function __construct(string $nombre, float $costo, float $precio = null, int $cantidad, string $preparacion)
    {
        if ($cantidad == null) return 'La cantidad es incorrecta';
        parent::__construct($nombre, $costo, $precio, $cantidad);
        $this->preparacion = $preparacion;
    }

    public function entrada(int $cantidad): string
    {
        if ($cantidad <= 0) return 'La cantidad es incorrecta';

        if ($cantidad > 0) {
            $this->AddMovimiento($cantidad, 'ENTRADA');
            $cant = $this->getCantidad() + $cantidad;
            $this->setCantidad($cant);
            return sprintf("El nuevo stock del producto %s es %s", $this->getNombre(), $this->getCantidad());
        }
    }

    public function salida(int $cantidad)
    {
        if ($cantidad <= 0) return 'La cantidad es incorrecta';

        if ($cantidad > 0) {
            $this->AddMovimiento($cantidad, 'SALIDA');
            $this->disminuirCantidad($cantidad);
//            $cant = $this->getCantidad() - $cantidad;
//            $this->setCantidad($cant);
            return sprintf("El nuevo stock del producto %s es %s", $this->getNombre(), $this->getCantidad());
        }
    }

    public function disminuirCantidad(int $cantidad): void
    {
        $cant = $this->getCantidad() - $cantidad;
        $this->setCantidad($cant);
    }

    private function AddMovimiento(int $cantidad, string $tipo): void
    {
        new MovimientoInventario($this->getNombre(), $this->getCosto(), $this->getPrecio(), $cantidad, $tipo);
    }

    /**
     * @return string
     */
    public function getPreparacion(): string
    {
        return $this->preparacion;
    }


}
