<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Rating;
use App\Models\Scheme;
use App\Models\User;
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
        $categories= Category::all();
        $alerts['type']=session()->pull('type',null);
        $alerts['message']=session()->pull('message',null);

        if(Auth::user()!=null)
            $schemes=Scheme::where('login','!=',Auth::user()->name)->where('public',true)->orwhere('login',Auth::user()->name )->latest()->paginate(4);
        else
            $schemes=Scheme::where('public',true)->latest()->paginate(4);

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
        return view('AllSchemes',['categories'=>$categories,'schemes'=>$schemes,'alerts'=>$alerts]);
    }
    public function searchRedirect(Request $request)
    {
        return redirect(route('search',[$request->orderBy1,$request->orderBy2,$request->category,$request->search,$request->countOnPage]));
    }
    public  function search(Request $request)
    {

        $categories= Category::all();
        $alerts['type']=session()->pull('type',null);
        $alerts['message']=session()->pull('message',null);

        $couuntOnPage=$request->countOnPage;
        $category=$request->category;
        $search=$request->search;
//        $request->countOnPage;
        if($request->orderBy1)
        $orderBy=array( $request->orderBy1,$request->orderBy2);
        else $orderBy=false;


        $schemes=Scheme::where('public',true)
            ->when($category,function ($query, $category)
            {
                return $query->where('category',$category);
            })
            ->when($search,function ($query, $search)
            {
                return $query->where('name_scheme','LIKE','%'.$search.'%')->orWhere('description_scheme','LIKE','%'.$search.'%');
            })
            ->when($orderBy,function ($query, $orderBy)
            {
                return $query->orderBy($orderBy[0],$orderBy[1]);
            });

        if(Auth::user()!=null) {
            $UserSchemes = Scheme::where('login', Auth::user()->name)
                ->when($category, function ($query, $category) {
                    return $query->where('category', $category);
                })
                ->union($schemes);
            $schemes = $UserSchemes;
            }
        $schemes=$schemes->paginate($couuntOnPage);
       // $schemes->withPath('/result/search');


        foreach ($schemes as $scheme)
        {
            $scheme->code_scheme=preg_replace('/color/',"id".$scheme->id_scheme."color",$scheme->code_scheme);
            $scheme->color_scheme=explode('#',$scheme->color_scheme) ;
            //тут  подмена ид на название категории
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
        return view('AllSchemes',['categories'=>$categories,'schemes'=>$schemes,'alerts'=>$alerts]);
    }

//    public  function searchResult($categories,$schemes,$alerts)
//    {
//        return view('AllSchemes',['categories'=>$categories,'schemes'=>$schemes,'alerts'=>$alerts]);
//
//    }
}
