<?php

namespace App\Http\Controllers\Simple;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Inventario\Aplication\GuardarProductoSimpleService;
use Src\Inventario\Aplication\ProductoSimpleRequest;
use Src\Inventario\Domain\ProductoDuplicado;

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
        try {
            $this->service->__invoke($productoRequest);
            return response('', Response::HTTP_CREATED);
        } catch (ProductoDuplicado $exception) {
            return response($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
