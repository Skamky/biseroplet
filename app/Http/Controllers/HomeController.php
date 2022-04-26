<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
   // public  $alerts =array('type'=>array(),'message'=>array());

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
        $alerts['type']=session()->pull('type',null);
        $alerts['message']=session()->pull('message',null);

        $schemes=Scheme::where('login',$ProfileName )->get();
        //return var_export($scheme,true);
         return view('kabinet',['schemes'=>$schemes,'ProfileName'=>$ProfileName,'alerts'=>$alerts]);
    }

    public function saveScheme(Request $request)
    {
        $str= $request->code_scheme;
        $str= preg_replace ('/(width.*?; )|(height.*?;)/','',$str);
        $str= preg_replace ('/\s{2,}|\n|\f|\v/','',$str);
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
            $request->session()->push('type', 'success');
            $request->session()->push('message', 'Изменения успешно сохранены!');

            //$this->alerts['type'][]='success';
            //$this->alerts['message'][]="Изменения успешно сохранены!";
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

            $request->session()->push('type', 'success');
            $request->session()->push('message', 'Новая схема успешно создана!');

          //  $this->alerts['type'][]='success';
          //  $this->alerts['message'][]="Новая схема успешно создана!";

        }
        return redirect('/profile/'.Auth::user()->name);
    }

    public function loadScheme($ProfileName,$schemeId)
    {
        $scheme= Scheme::where('login',$ProfileName)->where('id_scheme',$schemeId)->first();
        $colors=explode('#',$scheme-> color_scheme) ;

        return view('loadScheme',['scheme'=>$scheme,'colors'=>$colors,'schemeId'=>$schemeId]);
    }
    public function deleteScheme($id_scheme)
    {
        $scheme=Scheme::where('login',Auth::user()->name)->where('id_scheme',$id_scheme)->delete();

      //  $this->alerts['type'][]='success';
      //  $this->alerts['message'][]="Схема Успешно Удалена!";
        session()->push('type', 'success');
        session()->push('message', 'Схема Успешно Удалена!');
        return redirect('/profile/'.Auth::user()->name);

    }
}

