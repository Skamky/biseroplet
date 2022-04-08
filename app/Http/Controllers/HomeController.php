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
        $str= $request->code_scheme;
        $str= preg_replace ('/\s{2,}|\n|\v|\f|\v/','',$str);
        //if(array_key_exists('id_scheme',$request) &&)
        if($request->newScheme)
        {
            $id_scheme= (int)$request->id_scheme;
            $scheme=Scheme::where('login',Auth::user()->name)->where('id_scheme',$id_scheme)
            ->update
            (['name_scheme'=>$request->name_scheme,
                'description_scheme'=>$request->description_scheme,
                'color_scheme'=>$request->color_scheme,
                'code_scheme'=>$str
            ]);
        }
        else
        {
            $scheme = new Scheme;
            $scheme->login=Auth::user()->name;
            $scheme->name_scheme=$request->name_scheme;
            $scheme->description_scheme=$request->description_scheme;
            $scheme->color_scheme=$request->color_scheme;
            $scheme->code_scheme=$str;
            $scheme->save();

        }




        return redirect('/profile/'.Auth::user()->name);
    }

    public function loadScheme($ProfileName,$schemeId)
    {
        $scheme= Scheme::where('login',$ProfileName)->where('id_scheme',$schemeId)->first();
        $colors=explode('#',$scheme-> color_scheme) ;

        return view('LoadScheme',['scheme'=>$scheme,'colors'=>$colors,'schemeId'=>$schemeId]);
    }
}
