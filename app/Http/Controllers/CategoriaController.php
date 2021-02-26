<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function pesquisar(Request $request)
    {
        $busca = Categoria::with('criador');

        if ($request->id) {
            $busca->where('id', $request->id);
        }
        if ($request->nome) {
            $busca->whereRaw("upper(nome) like '%".strtoupper($request->nome)."%'");
        }
        if ($request->criador_id) {
            $busca->where('criador_id', $request->criador_id);
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
            $modelo = new Categoria();
            $modelo->fill($request->all());
            $modelo->criador_id = \Auth::user()->id;
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
            
            $modelo = Categoria::findOrFail($request->id);
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
            Categoria::destroy($id);
        } catch (\Exception $e) {
            abort(500, $e);
        }
    }
}
