<?php


namespace Productosimple;


use Illuminate\Http\Response;
use Tests\TestCase;

class GuardarProductoSimpleTest extends TestCase
{
    /**
     * @test
     */
    public function testGuardarProductoSimpleCorrectamente(): void
    {
        $response = $this->post('api/productosimple', [
            'nombre' => 'GASEOSA LITRO',
            'costo' => 2000,
            'precio' => 5000,
            'cantidad' => 2,
            'preparacion' => 'NO'
        ]);

        $response->assertStatus(Response::HTTP_CREATED);

    }

}
