<?php


namespace Src\Inventario\Domain;


interface IProductosimpleRepository
{
    public function save(ProductoSimple $simple): void;
}
