<?php

namespace App\Http\Controllers\Simple;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\Inventario\Aplication\GuardarProductoSimpleService;
use Src\Inventario\Aplication\ProductoSimpleRequest;

class ProductosimplePostController extends Controller
{

    private GuardarProductoSimpleService  $service;

    /**
     * ProductosimplePostController constructor.
     * @param GuardarProductoSimpleService $service
     */
    public function __construct(GuardarProductoSimpleService $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        $productoRequest = new ProductoSimpleRequest($request->nombre, $request->costo, $request->precio, $request->cantidad, $request->preparacion);
    }
}
