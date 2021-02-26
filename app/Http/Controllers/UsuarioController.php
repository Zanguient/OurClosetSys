<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{

    public function pesquisar(Request $request)
    {
        $busca = Usuario::select('*');

        if ($request->id) {
            $busca->where('id', $request->id);
        }
        if ($request->nome) {
            $busca->whereRaw("nome like '%".$request->nome."%'");
        }
        if ($request->email) {
            $busca->whereRaw("email like '%".$request->email."%'");
        }
        if ($request->status) {
            $busca->where('status', $request->status);
        }

        return $busca->get();
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
            
            $modelo = new Usuario();
            $modelo->fill($request->all());
            $modelo->save();

            \DB::commit();
            return $modelo->id;
        } catch (\Exception $e) {
            \DB::rollback();
            abort($e);
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
            
            $modelo = Usuario::findOrFail($request->id);
            $modelo->fill($request->all());
            $modelo->update();

            \DB::commit();
            return $modelo->id;
        } catch (\Exception $e) {
            \DB::rollback();
            abort($e);
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
            Usuario::destroy($id);
        } catch (\Exception $e) {
            abort($e);
        }
    }
}
