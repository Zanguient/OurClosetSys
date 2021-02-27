<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peca;

class EstoqueController extends Controller
{
    
    public function pesquisar(Request $request)
    {
        $busca = Peca::with('estoque');
        return $busca->orderBy('nome')->get();
    }
}
