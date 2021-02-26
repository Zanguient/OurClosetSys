<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peca;

class PecaController extends Controller
{
    public function pesquisar(Request $request)
    {
        $busca = Peca::with('categoria');

        if ($request->id) {
            $busca->where('id', $request->id);
        }
        if ($request->nome) {
            $busca->whereRaw("upper(nome) like '%".strtoupper($request->nome)."%'");
        }
        if ($request->cor) {
            $busca->whereRaw("upper(cor) like '%".strtoupper($request->cor)."%'");
        }
        if ($request->categoria_id) {
            $busca->where('categoria_id', $request->categoria_id);
        }

        return $busca->orderBy('nome')->get();
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
            $modelo = new Peca();
            $modelo->fill($request->all());
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
            
            $modelo = Peca::findOrFail($request->id);
            $modelo->fill($request->all());
            $modelo->update();

            \DB::commit();
            return $modelo->id;
        } catch (\Exception $e) {
            \DB::rollback();
            abort(500, $e);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Peca::destroy($id);
        } catch (\Exception $e) {
            abort(500, $e);
        }
    }
}
