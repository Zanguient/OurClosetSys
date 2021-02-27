<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MovimentacaoEstoque;
use App\Models\Estoque;
use App\Models\Venda;

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

    public function tirarPecaDoEstoque($pecaId, $quantidade)
    {
        \DB::beginTransaction();
        try {
            $estoque = Estoque::where('peca_id', $pecaId)->first();
            if (!$estoque) {
                $estoque = Estoque::create(['peca_id' => $pecaId]);
            }
            $estoque->quantidade -= $quantidade;
            $estoque->update();

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            abort(500, $e);
        }
    }

    public function adicionarPecaDoEstoque($pecaId, $quantidade)
    {
        \DB::beginTransaction();
        try {
            $estoque = Estoque::where('peca_id', $pecaId)->first();
            if ($estoque) {
                $estoque->quantidade += $quantidade;
                $estoque->update();
            } else {
                $estoque = Estoque::create(['peca_id' => $pecaId, 'quantidade' => $quantidade]);
            }

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            abort(500, $e);
        }
    }

    public function realizarVenda($valorUnidade, $pecaId, $quantidade)
    {
        \DB::beginTransaction();
        try {
            $venda = new Venda();
            $venda->responsavel_id = \Auth::user()->id;
            $venda->valor = $valorUnidade * $quantidade;
            $venda->peca_id = $pecaId;
            $venda->quantidade = $quantidade;
            $venda->save();

            \DB::commit();
            $this->tirarPecaDoEstoque($pecaId, $quantidade);
        } catch (\Exception $e) {
            \DB::rollback();
            abort(500, $e);
        }
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

            if ($request->tipo == 'VENDA') {
                $this->realizarVenda($request->valor_unidade, $request->peca_id, $request->quantidade);
            }

            if ($request->tipo == 'ENTRADA_EM_ESTOQUE') {
                $this->adicionarPecaDoEstoque($request->peca_id, $request->quantidade);
            }

            if ($request->tipo == 'SAIDA_DE_ESTOQUE') {
                $this->tirarPecaDoEstoque($request->peca_id, $request->quantidade);
            }

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
