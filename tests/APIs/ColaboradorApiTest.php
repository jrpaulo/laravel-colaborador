<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Colaborador;

class ColaboradorApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_colaborador()
    {
        $colaborador = Colaborador::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/colaboradors', $colaborador
        );

        $this->assertApiResponse($colaborador);
    }

    /**
     * @test
     */
    public function test_read_colaborador()
    {
        $colaborador = Colaborador::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/colaboradors/'.$colaborador->id
        );

        $this->assertApiResponse($colaborador->toArray());
    }

    /**
     * @test
     */
    public function test_update_colaborador()
    {
        $colaborador = Colaborador::factory()->create();
        $editedColaborador = Colaborador::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/colaboradors/'.$colaborador->id,
            $editedColaborador
        );

        $this->assertApiResponse($editedColaborador);
    }

    /**
     * @test
     */
    public function test_delete_colaborador()
    {
        $colaborador = Colaborador::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/colaboradors/'.$colaborador->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/colaboradors/'.$colaborador->id
        );

        $this->response->assertStatus(404);
    }
}
