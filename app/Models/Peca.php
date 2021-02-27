<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peca extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pecas';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'nome',
        'categoria_id',
        'custo',
        'valor_venda',
        'cor',
        'tamanho'
    ];

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria', 'categoria_id', 'id');
    }

    public function estoque()
    {
        return $this->belongsTo('App\Models\Estoque', 'id', 'peca_id');
    }
}
