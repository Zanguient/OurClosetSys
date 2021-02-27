<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MovimentacaoEstoque;

class MovimentacaoEstoqueController extends Controller
{
    public function pesquisar(Request $request)
    {
        $busca = MovimentacaoEstoque::with('responsavel', 'peca');

        if ($request->id) {
            $busca->where('id', $request->id);
        }
        if ($request->tipo) {
            $busca->where('tipo', $request->tipo);
        }
        if ($request->responsavel_id) {
            $busca->where('responsavel_id', $request->responsavel_id);
        }
        if ($request->peca_id) {
            $busca->where('peca_id', $request->peca_id);
        }
        if ($request->periodo_inicio) {
            $busca->where('created_at', '>=', $request->periodo_inicio);
        }
        if ($request->periodo_fim) {
            $busca->where('created_at', '<=', $request->periodo_fim);
        }

        return $busca->orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \DB::beginTransaction();
        try {
            $modelo = new MovimentacaoEstoque();
            $modelo->fill($request->all());
            $modelo->responsavel_id = \Auth::user()->id;
            $modelo->save();

            \DB::commit();
            return $modelo->id;
        } catch (\Exception $e) {
            \DB::rollback();
            abort(500, $e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        \DB::beginTransaction();
        try {
            
            $modelo = MovimentacaoEstoque::findOrFail($request->id);
            $modelo->fill($request->all());
            $modelo->update();

            \DB::commit();
            return $modelo->id;
        } catch (\Exception $e) {
            \DB::rollback();
            abort(500, $e);
        }

    }
}
