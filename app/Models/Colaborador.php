<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Colaborador
 * @package App\Models
 * @version August 25, 2021, 3:11 am UTC
 *
 * @property string $nome
 * @property string $cpf
 * @property string $rg
 * @property string $datanascimento
 * @property string $cep
 * @property string $endereco
 * @property integer $numero
 * @property string $cidade
 * @property string $estado
 * @property string $email
 */
class Colaborador extends Model
{
    //use SoftDeletes;

    //use HasFactory;

    public $table = 'colaborador';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    //protected $dates = ['deleted_at'];



    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_colaborador' => 'integer',
        'nome' => 'string',
        'cpf' => 'string',
        'rg' => 'string',
        'datanascimento' => 'date',
        'cep' => 'string',
        'endereco' => 'string',
        'numero' => 'integer',
        'cidade' => 'string',
        'estado' => 'string',
        'email' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nome' => 'nullable|string|max:100',
        'cpf' => 'required|string|max:11',
        'rg' => 'nullable|string|max:9',
        'datanascimento' => 'nullable',
        'cep' => 'nullable|string|max:9',
        'endereco' => 'nullable|string|max:100',
        'numero' => 'nullable|integer',
        'cidade' => 'nullable|string|max:60',
        'estado' => 'nullable|string|max:40',
        'email' => 'required|string|max:150'
    ];



    public function salarios()
    {
        return $this->hasMany(Salario::class, 'id_colaborador', 'id_colaborador');
    }

    
}
