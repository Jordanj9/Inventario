<?php


namespace Productosimple;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class GenerarSalidaProductoSimpleTest extends TestCase
{


    use RefreshDatabase;
    /**
     * @test
     */
    public function testGenerarSalidaProductoSimpleCorrectamente(): void
    {
        $this->post('api/productosimple', [
            'nombre' => 'GASEOSA',
            'costo' => 2000,
            'precio' => 5000,
            'cantidad' => 2,
            'preparacion' => 'NO'
        ]);
        $response = $this->get('api/productosimple/salida/GASEOSA/1');

        $response->assertStatus(Response::HTTP_OK);
    }

}
