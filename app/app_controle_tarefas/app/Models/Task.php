<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // definindo os atributos a serem informados
    protected $fillable = [
        'task',
        'end_date_limit',
        'user_id'
    ];

    // implementando o relacionamento N-1 com a model user
    // o belongsTo é utilizado na entidade fraca, ou seja, a tabela que contém a chave estrangeira
    // o primeiro argumento deve ser model da tabela forte
    // o segundo argumento deve ser a fk na tabela fraca
    // o terceiro argumento deve ser a pk na tabela forte
    public function user()
    {
        return $this->belongsTo('App\Unit', 'user_id', 'id');
    }
}
