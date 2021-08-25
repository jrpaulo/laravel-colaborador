<?php namespace Tests\Repositories;

use App\Models\Colaborador;
use App\Repositories\ColaboradorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ColaboradorRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ColaboradorRepository
     */
    protected $colaboradorRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->colaboradorRepo = \App::make(ColaboradorRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_colaborador()
    {
        $colaborador = Colaborador::factory()->make()->toArray();

        $createdColaborador = $this->colaboradorRepo->create($colaborador);

        $createdColaborador = $createdColaborador->toArray();
        $this->assertArrayHasKey('id', $createdColaborador);
        $this->assertNotNull($createdColaborador['id'], 'Created Colaborador must have id specified');
        $this->assertNotNull(Colaborador::find($createdColaborador['id']), 'Colaborador with given id must be in DB');
        $this->assertModelData($colaborador, $createdColaborador);
    }

    /**
     * @test read
     */
    public function test_read_colaborador()
    {
        $colaborador = Colaborador::factory()->create();

        $dbColaborador = $this->colaboradorRepo->find($colaborador->id);

        $dbColaborador = $dbColaborador->toArray();
        $this->assertModelData($colaborador->toArray(), $dbColaborador);
    }

    /**
     * @test update
     */
    public function test_update_colaborador()
    {
        $colaborador = Colaborador::factory()->create();
        $fakeColaborador = Colaborador::factory()->make()->toArray();

        $updatedColaborador = $this->colaboradorRepo->update($fakeColaborador, $colaborador->id);

        $this->assertModelData($fakeColaborador, $updatedColaborador->toArray());
        $dbColaborador = $this->colaboradorRepo->find($colaborador->id);
        $this->assertModelData($fakeColaborador, $dbColaborador->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_colaborador()
    {
        $colaborador = Colaborador::factory()->create();

        $resp = $this->colaboradorRepo->delete($colaborador->id);

        $this->assertTrue($resp);
        $this->assertNull(Colaborador::find($colaborador->id), 'Colaborador should not exist in DB');
    }
}
