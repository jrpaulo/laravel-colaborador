<?php

namespace App\Repositories;

use App\Models\Colaborador;
use App\Repositories\BaseRepository;

/**
 * Class ColaboradorRepository
 * @package App\Repositories
 * @version August 25, 2021, 3:11 am UTC
*/

class ColaboradorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'cpf',
        'rg',
        'datanascimento',
        'cep',
        'endereco',
        'numero',
        'cidade',
        'estado',
        'email'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Colaborador::class;
    }
}
