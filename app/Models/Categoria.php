<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categorias';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'nome',
        'criador_id'
    ];

    public function criador()
    {
        return $this->belongsTo('App\Models\Usuario', 'criador_id', 'id');
    }
}
