<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

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
        $user = Usuario::find(\Auth::user()->id);
        return $user;
    }
}
