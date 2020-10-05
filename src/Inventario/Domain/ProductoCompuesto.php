<?php


namespace Src\Inventario\Domain;


use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Array_;

class ProductoCompuesto extends Producto
{
    private $productosSimples = [];

    public function __construct(string $nombre, float $costo = null, float $precio = null, int $cantidad,array $productosSimples) {
        if(count($productosSimples)>0){
            foreach ($productosSimples as $item){
                $costo = $costo + $item['producto']->getCosto();
            }
        }else{
            return 'Debe seleccionar los ingredientes.';
        }
        parent::__construct($nombre, $costo, $precio, $cantidad);
        $this->ingredientes = $productosSimples;
    }

    /**
     * @return string[]
     */
    public function getIngredientes(): array {
        return $this->ingredientes;
    }

    public function salida(int $cantidad) {
        if ($cantidad <= 0) return 'La cantidad es incorrecta';

        if($cantidad > 0 && count($this->ingredientes) > 0){
            $message = 'El Nuevo stock de los productos: ';
            foreach ($this->ingredientes as $ingrediente){
                $cant =$ingrediente['producto']->getCantidad() - ($ingrediente['cantidad'] * $cantidad);
                var_dump($ingrediente['producto']->getCantidad());
                $ingrediente['producto']->setCantidad($cant);
                var_dump($ingrediente['producto']->getCantidad());
                $message = $message.$ingrediente['producto']->getNombre().' es '.$ingrediente['producto']->getCantidad().', ';
            }
            $message = substr($message,0,-2);
            new MovimientoInventario($this->getNombre(),$this->getCosto(),$this->getPrecio(),$cantidad,'SALIDA');
            return $message;
        }
    }
}
