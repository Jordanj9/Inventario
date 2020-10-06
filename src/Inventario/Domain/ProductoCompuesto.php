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
            $costo = $this->calcularCosto($ingredientes);
        } else {
            return 'Debe seleccionar los ingredientes.';
        }
        parent::__construct($nombre, $costo, $precio, $cantidad);
        $this->ingredientes = $ingredientes;
        $this->combo = $combo;
    }

    private function calcularCosto(array $ingredientes) {
        $costo = 0;
        foreach ($ingredientes as $item) {
            if (is_a($item['producto'], ProductoSimple::class)) {
                $costo = $costo + ($item['producto']->getCosto() * $item['cantidad']);
            } else {
                foreach ($item['producto']->getIngredientes() as $value) {
                    $costo = $costo + ($value['producto']->getCosto() * $item['cantidad']);
                }
            }
        }
        return $costo;
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
                if (is_a($ingrediente['producto'], ProductoSimple::class)) {
                    $cant = $ingrediente['producto']->getCantidad() - ($ingrediente['cantidad'] * $cantidad);
                    $ingrediente['producto']->setCantidad($cant);
                    $message = $message . $ingrediente['producto']->getNombre() . ' es ' . $ingrediente['producto']->getCantidad() . ', ';
                } else {
                    var_dump($this->getCosto());
                    foreach ($ingrediente['producto']->getIngredientes() as $item) {
                        $cant = $item['producto']->getCantidad() - ($item['cantidad'] * $cantidad);
                        $item['producto']->setCantidad($cant);
                        $message = $message . $item['producto']->getNombre() . ' es ' . $item['producto']->getCantidad() . ', ';
                    }
                }
            }
            $message = substr($message, 0, -2);

            return $message;
        }
    }

    private function AddMovimiento($cantidad): void {
        new MovimientoInventario($this->getNombre(), $this->getCosto(), $this->getPrecio(), $cantidad, 'SALIDA');
    }
}
