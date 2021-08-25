<?php

namespace App\Repositories;

use App\Models\Salario;
use App\Repositories\BaseRepository;

/**
 * Class SalarioRepository
 * @package App\Repositories
 * @version August 25, 2021, 2:30 pm UTC
*/

class SalarioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_colaborador',
        'salario',
        'data_inicio'
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
        return Salario::class;
    }
}
