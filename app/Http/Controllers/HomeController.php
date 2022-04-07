<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public  function userProfile($ProfileName)
    {
        $schemes=Scheme::where('login',Auth::user()->name )->get();
        //return var_export($scheme,true);

         return view('kabinet',['schemes'=>$schemes]);
    }

    public function saveScheme(Request $request)
    {
        $scheme = new Scheme;
        $scheme->login=Auth::user()->name;
        $scheme->name_scheme=$request->name_scheme;
        $scheme->description_scheme=$request->description_scheme;
        $scheme->color_scheme=$request->color_scheme;
        $scheme->code_scheme=$request->code_scheme;

        $scheme->save();

        return redirect('/');
    }
    public function loadScheme($ProfileName,$schemeId)
    {
        return view();
    }
}
