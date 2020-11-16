<?php


namespace Src\Inventario\Domain;


interface IProductosimpleRepository
{
    public function save(ProductoSimple $simple): void;

    public function search(string $nombre): ?ProductoSimple;

    public function addEntrada(MovimientoInventario $movimiento): void;

    public function salida(MovimientoInventario $movimiento): void;
}
