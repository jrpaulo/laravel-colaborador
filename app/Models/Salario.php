<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Salario
 * @package App\Models
 * @version August 25, 2021, 2:30 pm UTC
 *
 * @property integer $id_colaborador
 * @property number $salario
 * @property string|\Carbon\Carbon $data_inicio
 */
class Salario extends Model
{
    //use SoftDeletes;

    //use HasFactory;

    public $table = 'salario';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    //protected $dates = ['deleted_at'];



    public $fillable = [
        'id_colaborador',
        'salario',
        'data_inicio'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_salario' => 'integer',
        'id_colaborador' => 'integer',
        'salario' => 'decimal:0',
        'data_inicio' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_colaborador' => 'required|integer',
        'salario' => 'nullable|numeric',
        'data_inicio' => 'required'
    ];

    
}
