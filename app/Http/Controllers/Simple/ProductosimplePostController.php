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


    /**
     *  @OA\Post(
     *     path="api/productosimple",
     *     summary="Guardar producto simple",
     *     @OA\Parameter(
     *          name="nombre",
     *          description="nombre del producto simple",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="costo",
     *          description="costo del producto simple",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="precio",
     *          description="precio de venta del producto simple",
     *          required=false,
     *          in="path",
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="cantidad",
     *          description="cantidad del producto simple",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="preparacion",
     *          description="si el producto es de preparación (SI-NO)",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
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
