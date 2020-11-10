<?php

namespace App\Http\Controllers\Simple;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Inventario\Aplication\GuardarProductoSimpleService;
use Src\Inventario\Aplication\ProductoSimpleRequest;
use Src\Inventario\Domain\ProductoDuplicado;

/**
 * @OA\Info(title="API Inventario", version="1.0")
 *
 * @OA\Serve(url="http://127.0.0.1:8000/swagger")
 */
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


    /**
     *  @OA\Post(
     *     path="api/productosimple",
     *     summary="Guardar producto simple",
     *
     *     @OA\Response(
     *         response=201,
     *         description="Se guardo correctamente."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
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
