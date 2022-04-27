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
        $alerts['type']=session()->pull('type',null);
        $alerts['message']=session()->pull('message',null);

        return view('home',['alerts'=>$alerts]);
    }

    public  function userProfile($ProfileName)
    {
        $alerts['type']=session()->pull('type',null);
        $alerts['message']=session()->pull('message',null);
        if($ProfileName==Auth::user()->name){
            $schemes=Scheme::where('login',$ProfileName )->get();
        }
        else{
            $schemes=Scheme::where('login',$ProfileName )->where('public',true)->get();
        }
        //return var_export($scheme,true);
         return view('kabinet',['schemes'=>$schemes,'ProfileName'=>$ProfileName,'alerts'=>$alerts]);
    }
    public function redAccess(Request $request,$schemeId)
    {
        if ($request->public){
            Scheme::where('login',Auth::user()->name)->where('id_scheme',$schemeId)
                ->update
                (['public'=>true]);
            $request->session()->push('type', 'info');
            $request->session()->push('message', 'ℹ  Схема доступна для других пользователй.');
        }
        else{
            Scheme::where('login',Auth::user()->name)->where('id_scheme',$schemeId)
                ->update
                (['public'=>false]);
            $request->session()->push('type', 'info');
            $request->session()->push('message', 'ℹ  Схема изъята из общего доступа.');
        }
        //dd($schemeId,$request->check);

        return redirect('/profile/'.Auth::user()->name);

    }

    public function saveScheme(Request $request)
    {
        $str= $request->code_scheme;
        $str= preg_replace ('/(width.*?; )|(height.*?;)/','',$str);
        $str= preg_replace ('/\s{2,}|\n|\f|\v/','',$str);
        if($request->newScheme)
        {
            $id_scheme= (int)$request->id_scheme;
            Scheme::where('login',Auth::user()->name)->where('id_scheme',$id_scheme)
            ->update
            (['name_scheme'=>$request->name_scheme,
                'description_scheme'=>$request->description_scheme,
                'color_scheme'=>$request->color_scheme,
                'code_scheme'=>$str
            ]);
            $request->session()->push('type', 'success');
            $request->session()->push('message', '✅ Изменения успешно сохранены!');

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
            $request->session()->push('message', '✅  Новая схема успешно создана!');

          //  $this->alerts['type'][]='success';
          //  $this->alerts['message'][]="Новая схема успешно создана!";

        }
        return redirect()->back();
    }

    public function loadScheme($ProfileName,$schemeId)
    {
        $scheme= Scheme::where('login',$ProfileName)->where('id_scheme',$schemeId)->first();
        if ($scheme==null)
        {
            session()->push('type', 'danger');
            session()->push('message', '💢 Ошибка - схема не найдена.');
            return  redirect()->back();
        }
        if ($ProfileName==Auth::user()->name||$scheme->public)
        {
            $alerts['type']=session()->pull('type',null);
            $alerts['message']=session()->pull('message',null);
            $colors=explode('#',$scheme-> color_scheme) ;
            return view('loadScheme',['scheme'=>$scheme,'colors'=>$colors,'schemeId'=>$schemeId,'alerts'=>$alerts]);

        }
        else
        {
            session()->push('type', 'danger');
            session()->push('message', '⛔ В доступе к схеме отказано!');
            return redirect()->back();
        }




    }
    public function deleteScheme($id_scheme)
    {
        $scheme=Scheme::where('login',Auth::user()->name)->where('id_scheme',$id_scheme)->delete();

      //  $this->alerts['type'][]='success';
      //  $this->alerts['message'][]="Схема Успешно Удалена!";
        session()->push('type', 'success');
        session()->push('message', '💥 Схема успешно удалена!');
        return redirect('/profile/'.Auth::user()->name);

    }
}

