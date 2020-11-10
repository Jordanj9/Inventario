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
