<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'estoques';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'peca_id',
        'quantidade'
    ];
}
