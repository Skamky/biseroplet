<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Rating;
use App\Models\Scheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function welcome()
    {
        $alerts['type']=session()->pull('type',null);
        $alerts['message']=session()->pull('message',null);

        if(Auth::user()!=null)
            $schemes=Scheme::where('login','!=',Auth::user()->name)->where('public',true)->orwhere('login',Auth::user()->name )->latest()->limit(10)->get();
        else
            $schemes=Scheme::where('public',true)->latest()->limit(10)->get();

        foreach ($schemes as $scheme)
        {
            $scheme->code_scheme=preg_replace('/color/',"id".$scheme->id_scheme."color",$scheme->code_scheme);
            $scheme->color_scheme=explode('#',$scheme->color_scheme) ;
            //тут название категории
            $scheme->category=Category::where('id',$scheme->category)->value('title');

            if(Auth::check())
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
        return view('welcome',['schemes'=>$schemes,'alerts'=>$alerts]);
      //  dd($alerts);
    }
    public function createNewScheme()
    {
        $alerts['type']=session()->pull('type',null);
        $alerts['message']=session()->pull('message',null);

        return view('start',['alerts'=>$alerts]);
    }
    public function generate(Request $request)
    {
      //$this->home($request->width_sc,$request->height_sc,$request->color_sc);
       $color = $request->color_sc;
       $color= strtr($color,'#','Z');
        return redirect("/generate/{$color}/{$request->width_sc}/{$request->height_sc}");
    }
        public function home($color,$w,$h)
    {
        $categories= Category::all();
        $color= strtr($color,'Z','#');

        $alerts['type']=session()->pull('type',null);
        $alerts['message']=session()->pull('message',null);

        return view('myHome',["w"=>$w,"h"=>$h,"color"=>$color,'alerts'=>$alerts,'categories'=> $categories]);
    }
    public function searchView()
    {
        return view('AllSchemes');
    }
    public  function search()
    {

    }
}
