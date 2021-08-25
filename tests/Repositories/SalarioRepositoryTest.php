<?php namespace Tests\Repositories;

use App\Models\Salario;
use App\Repositories\SalarioRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SalarioRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SalarioRepository
     */
    protected $salarioRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->salarioRepo = \App::make(SalarioRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_salario()
    {
        $salario = Salario::factory()->make()->toArray();

        $createdSalario = $this->salarioRepo->create($salario);

        $createdSalario = $createdSalario->toArray();
        $this->assertArrayHasKey('id', $createdSalario);
        $this->assertNotNull($createdSalario['id'], 'Created Salario must have id specified');
        $this->assertNotNull(Salario::find($createdSalario['id']), 'Salario with given id must be in DB');
        $this->assertModelData($salario, $createdSalario);
    }

    /**
     * @test read
     */
    public function test_read_salario()
    {
        $salario = Salario::factory()->create();

        $dbSalario = $this->salarioRepo->find($salario->id);

        $dbSalario = $dbSalario->toArray();
        $this->assertModelData($salario->toArray(), $dbSalario);
    }

    /**
     * @test update
     */
    public function test_update_salario()
    {
        $salario = Salario::factory()->create();
        $fakeSalario = Salario::factory()->make()->toArray();

        $updatedSalario = $this->salarioRepo->update($fakeSalario, $salario->id);

        $this->assertModelData($fakeSalario, $updatedSalario->toArray());
        $dbSalario = $this->salarioRepo->find($salario->id);
        $this->assertModelData($fakeSalario, $dbSalario->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_salario()
    {
        $salario = Salario::factory()->create();

        $resp = $this->salarioRepo->delete($salario->id);

        $this->assertTrue($resp);
        $this->assertNull(Salario::find($salario->id), 'Salario should not exist in DB');
    }
}
