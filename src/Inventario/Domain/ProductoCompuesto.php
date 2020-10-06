<?php


namespace Src\Inventario\Domain;


use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Array_;

class ProductoCompuesto extends Producto
{
    private $combo;
    private $ingredientes = [];


    public function __construct(string $nombre, float $costo = null, float $precio = null, int $cantidad = null, array $ingredientes, string $combo) {
        if (count($ingredientes) > 0) {
            foreach ($ingredientes as $item) {
                if (is_a($item['producto'], ProductoSimple::class)) {
                    $costo = $costo + ($item['producto']->getCosto() * $item['cantidad']);
                } else {
                    foreach ($item['producto']->getIgredientes() as $value){
                        $costo = $costo + ($value['producto']->getCosto() * $value['cantidad']);
                    }
                }
            }
        } else {
            return 'Debe seleccionar los ingredientes.';
        }
        parent::__construct($nombre, $costo, $precio, $cantidad);
        $this->ingredientes = $ingredientes;
        $this->combo = $combo;
    }

    /**
     * @return string[]
     */
    public function getIngredientes(): array {
        return $this->ingredientes;
    }

    public function salida(int $cantidad) {
        if ($cantidad <= 0) return 'La cantidad es incorrecta';

        if ($cantidad > 0 && count($this->ingredientes) > 0) {
            $message = 'El Nuevo stock de los productos: ';
            foreach ($this->ingredientes as $ingrediente) {
                $cant = $ingrediente['producto']->getCantidad() - ($ingrediente['cantidad'] * $cantidad);
                $ingrediente['producto']->setCantidad($cant);
                $message = $message . $ingrediente['producto']->getNombre() . ' es ' . $ingrediente['producto']->getCantidad() . ', ';
            }
            $message = substr($message, 0, -2);

            return $message;
        }
    }

    private function AddMovimiento($cantidad): void {
        new MovimientoInventario($this->getNombre(), $this->getCosto(), $this->getPrecio(), $cantidad, 'SALIDA');
    }
}
