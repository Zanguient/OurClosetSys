<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vendas';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'responsavel_id',
        'valor',
        'quantidade',
        'peca_id'
    ];
}
