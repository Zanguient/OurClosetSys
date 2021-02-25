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

    public function getProfile(Request $request)
    {
        $user = Usuario::find(\Auth::user()->id);
        return $user;
    }
}
