<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\User;
use App\Models\Store;
use App\Models\UserJoinStore;
use App\Models\UserAccess;

class UserController extends Controller
{

    public function pesquisar(Request $filtro)
    {
        $resultado = [];
        foreach (User::with('stores.store')->select('id', 'name', 'username')->get() as $key => $user) {
            $stores = [];
            foreach ($user->stores as $store) {
                array_push($stores, $store->store->name);
            }
            $stores = implode(', ', $stores);
            array_push($resultado, [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'stores_list' => $stores
            ]);
        }
        return json_encode($resultado);
    }

    public function listarTodos()
    {
        return User::pluck('name', 'id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ValidacaoAcesso::valida('users', 'search');
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        ValidacaoAcesso::valida('users', 'create');
        return view('user.create')
        -> withStores(Store::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        \DB::transaction(function () use ($request, $modelo) {
            $modelo = new User();
            $modelo->fill($request->all());
            $modelo->save();

            if ($request->stores) {
                foreach ($request->stores as $id) {
                    $loja = new UserJoinStore();
                    $loja->user_id = $modelo->id;
                    $loja->store_id = $id;
                    $loja->save();
                }
            }

            if ($request->accesses) {
                foreach ($request->accesses as $access) {
                    $userAccess = new UserAccess();
                    $userAccess->user_id = $modelo->id;
                    $userAccess->code = $access['code'];
                    $userAccess->search = $access['search'];
                    $userAccess->create = $access['create'];
                    $userAccess->edit = $access['edit'];
                    $userAccess->remove = $access['remove'];
                    $userAccess->save();
                }
            }

        });

        return $modelo->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!\Auth::user()->accesses->where('code', 'users')->first()['edit'] && \Auth::user()->id != $id) {
            abort(401);
        }
        $lojas = Store::all();
        foreach ($lojas as $loja) {
            if ($loja->selecionada($id)) {
                $loja->selecionada = true;
            } else {
                $loja->selecionada = false;
            }
        }
        return view('user.edit')
        -> withUser(User::with('stores.store', 'accesses')->findOrFail($id))
        -> withStores($lojas)
        -> withAccess(\Auth::user()->accesses->where('code', 'users')->first()['edit']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $modelo = User::findOrFail($id);
        \DB::transaction(function () use ($request, $modelo) {
            $modelo->fill($request->all());
            $modelo->save();
            if ($request->stores) {
                UserJoinStore::where('user_id', $modelo->id)->delete();
                foreach ($request->stores as $id) {
                    $loja = new UserJoinStore();
                    $loja->user_id = $modelo->id;
                    $loja->store_id = $id;
                    $loja->save();
                }
            }

            if ($request->accesses) {
                UserAccess::where('user_id', $modelo->id)->delete();
                foreach ($request->accesses as $access) {
                    $userAccess = new UserAccess();
                    $userAccess->user_id = $modelo->id;
                    $userAccess->code = $access['code'];
                    $userAccess->search = $access['search'];
                    $userAccess->create = $access['create'];
                    $userAccess->edit = $access['edit'];
                    $userAccess->remove = $access['remove'];
                    $userAccess->save();
                }
            }

        });

        return $modelo->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ValidacaoAcesso::valida('users', 'remove');
        UserJoinStore::where('user_id', $id)->delete();
        return User::destroy($id);
    }
}
