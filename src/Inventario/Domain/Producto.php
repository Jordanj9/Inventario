<?php


namespace Src\Inventario\Domain;


abstract class Producto
{
    private $nombre;
    private $costo;
    private $precio;
    private $cantidad;

    public function __construct(string $nombre, float $costo, float $precio = null, int $cantidad) {
        $this->nombre = $nombre;
        $this->costo = $costo;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }

    /**
     * @string
     */
    public function getNombre(): string {
        return $this->nombre;
    }

    /**
     * @float
     */
    public function getCosto(): float {
        return $this->costo;
    }

    /**
     * @float
     */
    public function getPrecio(): string {
        return $this->precio;
    }

    /**
     * @int
     */
    public function getCantidad(): int {
        return $this->cantidad;
    }

    /**
     * @param int $cantidad
     */
    public function setCantidad(int $cantidad): void {
        $this->cantidad = $cantidad;
    }
}
