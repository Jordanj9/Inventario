<?php


namespace Src\Inventario\Domain;


use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Array_;

class ProductoCompuesto extends Producto
{
    private $combo;
    private $productosSimples = [];


    public function __construct(string $nombre, float $costo = null, float $precio = null, int $cantidad = null, array $productosSimples, string $combo) {
        if (count($productosSimples) > 0) {
            foreach ($productosSimples as $item) {
                if (is_a($item['producto'], ProductoSimple::class)) {
                    $costo = $costo + ($item['producto']->getCosto() * $item['cantidad']);
                } else {
                    var_dump('no sirve');
                }
            }
        } else {
            return 'Debe seleccionar los ingredientes.';
        }
        parent::__construct($nombre, $costo, $precio, $cantidad);
        $this->productosSimples = $productosSimples;
        $this->combo = $combo;
    }

    /**
     * @return string[]
     */
    public function getIngredientes(): array {
        return $this->productosSimples;
    }

    public function salida(int $cantidad) {
        if ($cantidad <= 0) return 'La cantidad es incorrecta';

        if ($cantidad > 0 && count($this->productosSimples) > 0) {
            $message = 'El Nuevo stock de los productos: ';
            foreach ($this->productosSimples as $ingrediente) {
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
