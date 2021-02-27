<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peca;

class EstoqueController extends Controller
{
    
    public function pesquisar(Request $request)
    {
        $busca = Peca::with('estoque', 'categoria');

        $busca->whereRaw('pecas.id in (select peca_id from estoques)');

        if ($request->nome) {
            $busca->whereRaw("upper(nome) like '%".strtoupper($request->nome)."%'");
        }
        if ($request->cor) {
            $busca->whereRaw("upper(cor) like '%".strtoupper($request->cor)."%'");
        }
        if ($request->tamanho) {
            $busca->whereRaw("upper(tamanho) = '".strtoupper($request->tamanho)."'");
        }
        if ($request->categoria_id) {
            $busca->where('categoria_id', $request->categoria_id);
        }

        return $busca->orderBy('nome')->get();
    }
}
