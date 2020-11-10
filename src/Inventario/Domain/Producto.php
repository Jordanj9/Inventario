<?php


namespace Src\Inventario\Domain;


abstract class Producto implements Iinventario
{
    private $nombre;
    private $costo;
    private $precio;
    private $cantidad;
    private $id;

    public function __construct(string $nombre, float $costo, float $precio = null, int $cantidad = null, int $id = 0)
    {
        $this->nombre = $nombre;
        $this->costo = $costo;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @float
     */
    public function getCosto(): float
    {
        return $this->costo;
    }

    /**
     * @float
     */
    public function getPrecio(): string
    {
        return $this->precio;
    }

    /**
     * @int
     */
    public function getCantidad(): int
    {
        return $this->cantidad;
    }

    /**
     * @param int $cantidad
     */
    public function setCantidad(int $cantidad): void
    {
        $this->cantidad = $cantidad;
    }
}
