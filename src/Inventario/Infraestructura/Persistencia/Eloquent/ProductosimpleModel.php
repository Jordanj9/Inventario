<?php


namespace Src\Inventario\Infraestructura\Persistencia\Eloquent;


use Illuminate\Database\Eloquent\Model;

class ProductosimpleModel extends Model
{
    protected $table = 'productosimple';
    protected $fillable = ['id', 'nombre', 'costo', 'precio', 'cantidad', 'preparacion', 'created_at', 'updated_at'];

}
