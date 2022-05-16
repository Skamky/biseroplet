<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Scheme;
use App\Models\User;
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
    public  function userProfileRedirect()
    {
        return redirect('/profile/'.Auth::user()->name);
    }

    public  function userProfile($ProfileName)
    {
       if  (User::where('name',$ProfileName )->doesntExist())
       {
           session()->push('type', 'danger');
           session()->push('message', '💢 Ошибка userProfile - профиль не найден.');

           return redirect()->back();
       }
            if($ProfileName==Auth::user()->name){
                $schemes=Scheme::where('login',$ProfileName )->get();
                if  (Scheme::where('login',$ProfileName )->doesntExist()) {
                    session()->push('type', 'warning');
                    session()->push('message', '🤔 Это ваш профиль и он пуст.');
                    session()->push('type', 'info');
                    session()->push('message', 'ℹ Подсказка - создать схему можно сохранив к себе чужую публичную схему или выбрав в навигации пункт "Создать схему". ');
                }
            }
            else{
                $schemes=Scheme::where('login',$ProfileName )->where('public',true)->get();
            }

        foreach ($schemes as $scheme)
        {
            $scheme->code_scheme=preg_replace('/color/',"id".$scheme->id_scheme."color",$scheme->code_scheme);
            //dd($scheme);
            $scheme->color_scheme=explode('#',$scheme->color_scheme) ;
            $scheme->category=Category::where('id',$scheme->category)->value('title');

        }

        $alerts['type']=session()->pull('type',null);
        $alerts['message']=session()->pull('message',null);
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
        //$alerts['type']=session()->pull('type',null);
        //$alerts['message']=session()->pull('message',null);


        //return view('components.alert' );

    }

    public function saveScheme(Request $request)
    {
        $str= $request->code_scheme;
        $str= preg_replace ('/(width.*?; )|(height.*?;)/','',$str);
        $str= preg_replace ('/style=""/',' ',$str);
        $str= preg_replace ('/\s{2,}|\n|\f|\v/','',$str);

        if($request->newScheme)
        {
            $id_scheme= (int)$request->id_scheme;
            Scheme::where('login',Auth::user()->name)->where('id_scheme',$id_scheme)
            ->update
            (['name_scheme'=>$request->name_scheme,
                'description_scheme'=>$request->description_scheme,
                'category'=>$request->category,
            'color_scheme'=>$request->color_scheme,
                'code_scheme'=>$str
            ]);
            $request->session()->push('type', 'success');
            $request->session()->push('message', '✅ Изменения успешно сохранены!');
            return redirect()->back();

            //$this->alerts['type'][]='success';
            //$this->alerts['message'][]="Изменения успешно сохранены!";
        }
        else
        {
            $scheme = new Scheme;
            $scheme->login=Auth::user()->name;
            $scheme->name_scheme=$request->name_scheme;
            $scheme->description_scheme=$request->description_scheme;
            $scheme->category=$request->category;
            $scheme->color_scheme=$request->color_scheme;
            $scheme->code_scheme=$str;
            $scheme->save();

            $request->session()->push('type', 'success');
            $request->session()->push('message', '✅  Новая схема успешно создана!');
            return redirect('/profile/'.Auth::user()->name);

            //  $this->alerts['type'][]='success';
          //  $this->alerts['message'][]="Новая схема успешно создана!";

        }
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
            $categories= Category::all();
            $alerts['type']=session()->pull('type',null);
            $alerts['message']=session()->pull('message',null);
            $colors=explode('#',$scheme-> color_scheme) ;
            return view('loadScheme',['scheme'=>$scheme,'categories'=> $categories, 'colors'=>$colors,'schemeId'=>$schemeId,'alerts'=>$alerts]);

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
        Scheme::where('login',Auth::user()->name)->where('id_scheme',$id_scheme)->delete();

      //  $this->alerts['type'][]='success';
      //  $this->alerts['message'][]="Схема Успешно Удалена!";
        session()->push('type', 'success');
        session()->push('message', '💥 Схема успешно удалена!');
        return redirect('/profile/'.Auth::user()->name);

    }
}

