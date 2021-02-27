<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimentacaoEstoque extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'movimentacoes_estoque';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'tipo',
        'responsavel_id',
        'peca_id',
        'quantidade',
        'tamanho'
    ];

    public function responsavel()
    {
        return $this->belongsTo('App\Models\Usuario', 'responsavel_id', 'id');
    }

    public function peca()
    {
        return $this->belongsTo('App\Models\Peca', 'peca_id', 'id');
    }
}
