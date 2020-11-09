<?php


namespace Src\Inventario\Infraestructura\Persistencia;


use Src\Inventario\Domain\IProductosimpleRepository;
use Src\Inventario\Domain\ProductoSimple;
use Src\Inventario\Infraestructura\Persistencia\Eloquent\ProductosimpleModel;
use function MongoDB\BSON\toJSON;

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
}
