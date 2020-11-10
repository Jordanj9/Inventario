<?php


namespace Src\Inventario\Infraestructura\Persistencia;


use Src\Inventario\Domain\IProductosimpleRepository;
use Src\Inventario\Domain\ProductoSimple;
use Src\Inventario\Infraestructura\Persistencia\Eloquent\MovimientoInventarioModel;
use Src\Inventario\Infraestructura\Persistencia\Eloquent\ProductosimpleModel;

class ProductosimpleEloquentRepository implements IProductosimpleRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new ProductosimpleModel();
    }

    public function save(ProductoSimple $simple): void
    {
        $this->model->fill($simple->toArray());
        $this->model->save();
    }

    public function search(string $nombre): ?ProductoSimple
    {
        $producto = ProductosimpleModel::where('nombre', $nombre)->first();
        return $producto != null ? ProductoSimple::formtArray($producto->attributesToArray()) : null;
    }

    public function addEntrada(ProductoSimple $simple, int $cantidad): void
    {

        $movimiento = $simple->entrada($cantidad)['movimiento'];
        $mo = new MovimientoInventarioModel($movimiento->toArray());
        $mo->save();
        //$this->model->fill($simple->toArray());
        $this->model->save();
    }

    public function salida(ProductoSimple $simple, int $cantidad): void
    {
        $this->model = ProductosimpleModel::find($simple->getId());
        $movi = $simple->salida($cantidad)['movimiento'];
        $this->model->cantidad = $simple->getCantidad();
        $this->model->save();
        $movimiento = new MovimientoInventarioModel($movi->toArray());
        $movimiento->save();
    }

}
