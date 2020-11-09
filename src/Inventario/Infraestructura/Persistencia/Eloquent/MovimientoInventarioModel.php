<?php


namespace Src\Inventario\Infraestructura\Persistencia\Eloquent;


use Illuminate\Database\Eloquent\Model;

class MovimientoInventarioModel extends Model
{
    protected $table = 'movimientoinventarios';
    protected $fillable = ['id', 'nombre_producto', 'costo', 'precio', 'cantidad', 'tipo', 'created_at', 'updated_at'];
}
