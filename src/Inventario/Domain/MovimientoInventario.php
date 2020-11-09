<?php


namespace Src\Inventario\Domain;


class MovimientoInventario
{
    private $numero = 0;
    private $nombre_producto;
    private $costo;
    private $precio;
    private $cantidad;
    private $tipo;

    public function __construct(string $nombre_producto, float $costo, float $precio = null, int $cantidad, string $tipo)
    {
        $this->numero = $this->numero + 1;
        $this->nombre_producto = $nombre_producto;
        $this->costo = $costo;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
        $this->tipo = $tipo;
    }


    /**
     * @return int
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * @return string
     */
    public function getNombreProducto(): string
    {
        return $this->nombre_producto;
    }

    /**
     * @return float
     */
    public function getCosto(): float
    {
        return $this->costo;
    }

    /**
     * @return float
     */
    public function getPrecio(): float
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
    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function toArray(): array
    {
        return [
            'nombre_producto' => $this->getNombreProducto(),
            'costo' => $this->getCosto(),
            'precio' => $this->getPrecio(),
            'cantidad' => $this->getCantidad(),
            'tipo' => $this->getTipo()
        ];
    }

}
