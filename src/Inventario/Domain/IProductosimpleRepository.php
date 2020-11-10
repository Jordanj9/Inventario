<?php


namespace Src\Inventario\Domain;


interface IProductosimpleRepository
{
    public function save(ProductoSimple $simple): void;

    public function search(string $nombre): ?ProductoSimple;

    public function addEntrada(ProductoSimple $simple, int $cantidad): void;

    public function salida(ProductoSimple $simple, int $cantidad): void;
}
