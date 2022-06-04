<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Rating;
use App\Models\Scheme;
use App\Models\User;
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
                $schemes=Scheme::where('login',$ProfileName )->latest('updated_at')->paginate(10);
                if  (Scheme::where('login',$ProfileName )->doesntExist()) {
                    session()->push('type', 'warning');
                    session()->push('message', '🤔 Это ваш профиль и он пуст.');
                    session()->push('type', 'info');
                    session()->push('message', 'ℹ Подсказка - создать схему можно сохранив к себе чужую публичную схему или выбрав в навигации пункт "Создать схему". ');
                }
            }
            else{
                $schemes=Scheme::where('login',$ProfileName )->where('public',true)->latest()->paginate(10);
            }

        foreach ($schemes as $scheme)
        {
            $scheme->code_scheme=preg_replace('/color/',"id".$scheme->id_scheme."color",$scheme->code_scheme);
            //dd($scheme);
            $scheme->color_scheme=explode('#',$scheme->color_scheme) ;
            $scheme->category=Category::where('id',$scheme->category)->value('title');

            if($ProfileName!=Auth::user()->name)
            {
                $scheme->likes=Rating::where('id_scheme',$scheme->id_scheme)->where('value',1)->count();
                $scheme->dislikes=Rating::where('id_scheme',$scheme->id_scheme)->where('value',-1)->count();

                $scheme->liked=false;
                $scheme->disliked=false;

                if(Rating::where('id_scheme',$scheme->id_scheme)->where('value',1)->where('id_user',Auth::user()->id)->exists())
                    $scheme->liked=true;
                elseif (Rating::where('id_scheme',$scheme->id_scheme)->where('value',-1)->where('id_user',Auth::user()->id)->exists())
                    $scheme->disliked=true;
            }
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

        return redirect('/profile/'.Auth::user()->name);
    }

    public function saveScheme(Request $request)
    {

        $str= $request->code_scheme;
        $str= preg_replace ('/(width.*?; )|(height.*?;)/','',$str);
        $str= preg_replace ('/style=""/',' ',$str);
        $str= preg_replace ('/\s{2,}|\n|\f|\v/','',$str);
        $validatedData = $request->validate([
            'name_scheme' => ['required'],
            'category' => ['required'],
            'color_scheme' => ['required'],
            'code_scheme' => ['required'],

        ]);
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
        Scheme::where('login', Auth::user()->name)->where('id_scheme', $id_scheme)->delete();

        //  $this->alerts['type'][]='success';
        //  $this->alerts['message'][]="Схема Успешно Удалена!";
        session()->push('type', 'success');
        session()->push('message', '💥 Схема успешно удалена!');
        return redirect('/profile/');
    }

    public function favoritesSchemes()
    {   $likedSchemes=Rating::where('id_user',Auth::user()->id)->where('value',1)->pluck('id_scheme');
        //dd($likedSchemes);
        $schemes=Scheme::whereIn('id_scheme',$likedSchemes)
            ->where('public',true)
            ->latest()
            ->paginate();
        foreach ($schemes as $scheme)
        {
            $scheme->code_scheme=preg_replace('/color/',"id".$scheme->id_scheme."color",$scheme->code_scheme);
            $scheme->color_scheme=explode('#',$scheme->color_scheme) ;
            //тут название категории
            $scheme->category=Category::where('id',$scheme->category)->value('title');

            $scheme->likes=Rating::where('id_scheme',$scheme->id_scheme)->where('value',1)->count();
            $scheme->dislikes=Rating::where('id_scheme',$scheme->id_scheme)->where('value',-1)->count();

            $scheme->liked=false;
            $scheme->disliked=false;

            if(Rating::where('id_scheme',$scheme->id_scheme)->where('value',1)->where('id_user',Auth::user()->id)->exists())
                $scheme->liked=true;

        }

        $alerts['type']=session()->pull('type',null);
        $alerts['message']=session()->pull('message',null);

        return view('favorites',['schemes'=>$schemes,'alerts'=>$alerts]);
    }
}


