<?php


namespace Src\Inventario\Domain;


class ProductoSimple extends Producto
{
    private $tipo;

    public function __construct(string $nombre, float $costo, float $precio = null, int $cantidad, string $tipo) {
        if($cantidad == null) return 'La cantidad es incorrecta';
        parent::__construct($nombre, $costo, $precio, $cantidad);
        $this->tipo = $tipo;
    }

    private function entrada(int $cantidad): string {
        if ($cantidad <= 0) return 'La cantidad es incorrecta';

        if ($cantidad > 0) {
            $this->AddMovimiento($cantidad,'ENTRADA');
            $cant = $this->getCantidad() + $cantidad;
            $this->setCantidad($cant);
            return sprintf("El nuevo stock del producto %s es %s", $this->getNombre(), $this->getCantidad());
        }
    }

    public function salida(int $cantidad) {
        if ($cantidad <= 0) return 'La cantidad es incorrecta';

        if($cantidad > 0){
            $this->AddMovimiento($cantidad,'SALIDA');
            $cant = $this->getCantidad() - $cantidad;
            $this->setCantidad($cant);
            return sprintf("El nuevo stock del producto %s es %s", $this->getNombre(), $this->getCantidad());
        }
    }

    private function AddMovimiento(int $cantidad,string $tipo):void{
        new MovimientoInventario($this->getNombre(), $this->getCosto(), $this->getPrecio(), $cantidad, $tipo);
    }


}
