<?php


namespace Src\Inventario\Aplication;


class ProductoSimpleRequest
{
    private string $nombre;
    private float $costo;
    private float $precio;
    private int $cantidad;
    private string $preparacion;

    /**
     * ProductoSimpleRequest constructor.
     * @param string $nombre
     * @param float $costo
     * @param float $precio
     * @param int $cantidad
     * @param string $preparacion
     */
    public function __construct(string $nombre, float $costo, float $precio = 0, int $cantidad, string $preparacion)
    {
        $this->nombre = $nombre;
        $this->costo = $costo;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
        $this->preparacion = $preparacion;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @return float
     */
    public function getCosto(): float
    {
        return $this->costo;
    }

    /**
     * @return float|int
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @return int
     */
    public function getCantidad(): int
    {
        return $this->cantidad;
    }

    /**
     * @return string
     */
    public function getPreparacion(): string
    {
        return $this->preparacion;
    }


}
