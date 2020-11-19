<?php


namespace Src\Inventario\Domain;


class ProductoSimple extends Producto
{
    private $preparacion;

    public function __construct(string $nombre, float $costo, float $precio = null, int $cantidad, int $id = 0, string $preparacion)
    {
        if ($cantidad == null) return 'La cantidad es incorrecta';
        parent::__construct($nombre, $costo, $precio, $cantidad, $id);
        $this->preparacion = $preparacion;
    }


    public function entrada(int $cantidad)
    {
        if ($cantidad <= 0) return 'La cantidad es incorrecta';

        if ($cantidad > 0) {
            $movimiento = $this->AddMovimiento($cantidad, 'ENTRADA');
            $cant = $this->getCantidad() + $cantidad;
            $this->setCantidad($cant);
            return ['mensaje' => sprintf("El nuevo stock del producto %s es %s", $this->getNombre(), $this->getCantidad()), 'movimiento' => $movimiento];
        }
    }

    public function salida(int $cantidad)
    {
        if ($cantidad <= 0) return 'La cantidad es incorrecta';

        if ($this->getCantidad() < $cantidad) return 'No hay productos en el inventario para la cantidad solicitada';

        if ($cantidad > 0) {
            $movimiento = $this->AddMovimiento($cantidad, 'SALIDA');
            $this->disminuirCantidad($cantidad);
//            $cant = $this->getCantidad() - $cantidad;
//            $this->setCantidad($cant);
            return ['mensaje' => sprintf("El nuevo stock del producto %s es %s", $this->getNombre(), $this->getCantidad()), 'movimiento' => $movimiento];
        }
    }

    public function disminuirCantidad(int $cantidad): void
    {
        $cant = $this->getCantidad() - $cantidad;
        $this->setCantidad($cant);
    }

    private function AddMovimiento(int $cantidad, string $tipo): MovimientoInventario
    {
        return new MovimientoInventario($this->getNombre(), $this->getCosto(), $this->getPrecio(), $cantidad, $tipo);
    }

    /**
     * @return string
     */
    public function getPreparacion(): string
    {
        return $this->preparacion;
    }

    public function toArray(bool $updated = false): array
    {
        if ($updated) {
            return [
                'id' => $this->getId(),
                'nombre' => $this->getNombre(),
                'costo' => $this->getCosto(),
                'precio' => $this->getPrecio(),
                'cantidad' => $this->getCantidad(),
                'preparacion' => $this->getPreparacion()
            ];
        } else {
            return [
                'nombre' => $this->getNombre(),
                'costo' => $this->getCosto(),
                'precio' => $this->getPrecio(),
                'cantidad' => $this->getCantidad(),
                'preparacion' => $this->getPreparacion()
            ];
        }
    }

    static function formtArray(array $model): self
    {
        return new self($model['nombre'], $model['costo'], $model['precio'], $model['cantidad'], $model['id'], $model['preparacion']);
    }

}
