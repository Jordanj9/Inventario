<?php

namespace App\Http\Controllers\Simple;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Inventario\Aplication\GenerarSalidaProductoSimpleService;
use Src\Inventario\Domain\ProductoDuplicado;
use Src\Inventario\Domain\ProductoInexistente;


class ProductosimpleSalidaController extends Controller
{
    private GenerarSalidaProductoSimpleService $service;

    /**
     * ProductosimpleSalidaController constructor.
     * @param GenerarSalidaProductoSimpleService $service
     */
    public function __construct(GenerarSalidaProductoSimpleService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *      path="api/productosimple/salida/{nombre}/{cantidad}",
     *      summary="Get project information",
     *      description="Returns project data",
     *      @OA\Parameter(
     *          name="nombre",
     *          description="nombre del producto simple",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="cantidad",
     *          description="cantidad del producto",
     *          required=true,
     *           in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *
     * )
     */
    public function __invoke(string $nombre, int $cantidad)
    {
        try {
            $this->service->__invoke(strtoupper($nombre), $cantidad);
            return response('', Response::HTTP_OK);
        } catch (ProductoInexistente $exception) {

            return response($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }

    }


}
