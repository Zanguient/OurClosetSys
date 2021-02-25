<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')->withLogged(\Auth::check()?'true':'false');
    }

    public function selecionarLoja(Request $request)
    {
        $user = User::find(\Auth::user()->id);
        $user->current_store_id = $request->store_id;
        $user->last_remember_token = $user->remember_token;
        $user->update();

        return 'true';
    }

    public function getMenu(Request $request)
    {
        if(\Auth::check()) {
            $menu = [
                [
                    'url' => "/schedules", 
                    'icone' => "event", 
                    'titulo' => "Agendamentos"
                ]
            ];
            if (\Auth::user()->cargo == 'ADMIN' || \Auth::user()->cargo == 'DIRETOR' || \Auth::user()->cargo == 'RECEPCIONISTA') {
                array_push($menu, [
                    'url' => "/clients",
                    'icone' => "emoji_people",
                    'titulo' => "Pacientes"
                ]);
                array_push($menu, [
                    'url' => "/users",
                    'icone' => "perm_identity",
                    'titulo' => "Funcionários"
                ]);
                array_push($menu, [
                    'url' => "/reports",
                    'icone' => "assignment",
                    'titulo' => "Relatórios"
                ]);
            }
        } else {
            $menu = [];
        }
        return $menu;
    }

    public function getProfile(Request $request)
    {
        $user = User::with('currentStore')->find(\Auth::user()->id);
        return $user;
    }
}
