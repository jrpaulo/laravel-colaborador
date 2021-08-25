<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Salario;

class SalarioApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_salario()
    {
        $salario = Salario::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/salarios', $salario
        );

        $this->assertApiResponse($salario);
    }

    /**
     * @test
     */
    public function test_read_salario()
    {
        $salario = Salario::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/salarios/'.$salario->id
        );

        $this->assertApiResponse($salario->toArray());
    }

    /**
     * @test
     */
    public function test_update_salario()
    {
        $salario = Salario::factory()->create();
        $editedSalario = Salario::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/salarios/'.$salario->id,
            $editedSalario
        );

        $this->assertApiResponse($editedSalario);
    }

    /**
     * @test
     */
    public function test_delete_salario()
    {
        $salario = Salario::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/salarios/'.$salario->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/salarios/'.$salario->id
        );

        $this->response->assertStatus(404);
    }
}
