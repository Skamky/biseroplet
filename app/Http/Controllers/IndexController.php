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
    public function searchLatest()
    {
        $categories= Category::all();

        $alerts['type']=session()->pull('type',null);
        $alerts['message']=session()->pull('message',null);

        if(Auth::user()!=null)
            $schemes=Scheme::where('login','!=',Auth::user()->name)->where('public',true)->orwhere('login',Auth::user()->name )->latest()->paginate();
        else
            $schemes=Scheme::where('public',true)->latest()->paginate();

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
        $dataListUsers=User::pluck('name');

        $request=request();
        $request->orderBy1 ="created_at";
        $request->orderBy2 ="desc";

        return view('AllSchemes',['categories'=>$categories,'schemes'=>$schemes,'dataListUsers'=>$dataListUsers,'alerts'=>$alerts,'request'=>$request]);
    }

    public  function search(Request $request)
    {

        $categories= Category::all();


        $author = $request->author;
        $couuntOnPage=$request->countOnPage;
        $category=$request->category;
        $search=$request->search;
        if($request->orderBy1)
            $orderBy=array( $request->orderBy1,$request->orderBy2);
        else
            $orderBy=false;


        $schemes=Scheme::where('public',true)
            ->when($category,function ($query, $category)
            {
                return $query->where('category',$category);
            })
            ->when($author,function ($query, $author)
            {
                return $query->where('login',$author);
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
                ->when($author,function ($query, $author)
                {
                    return $query->where('login',$author);
                })
                ->when($search,function ($query, $search)
                {
                    return $query->where('name_scheme','LIKE','%'.$search.'%')->orWhere('description_scheme','LIKE','%'.$search.'%');
                })
                ->union($schemes)
                ->when($orderBy,function ($query, $orderBy)
                {
                    return $query->orderBy($orderBy[0],$orderBy[1]);
                });
            $schemes = $UserSchemes;
            }

        $schemes=$schemes->paginate($couuntOnPage);
        $schemes->withPath(url()->full());

        if($schemes->count()<=0)
        {
            $request->session()->push('type', 'info');
            $request->session()->push('message', 'ℹ  По вашему запросу ничего не нашлось (。﹏。*)');
        }
        else {

            foreach ($schemes as $scheme) {
                $scheme->code_scheme = preg_replace('/color/', "id" . $scheme->id_scheme . "color", $scheme->code_scheme);
                $scheme->color_scheme = explode('#', $scheme->color_scheme);
                //тут  подмена ид на название категории
                $scheme->category = Category::where('id', $scheme->category)->value('title');

                if (Auth::check()) {
                    $scheme->likes = Rating::where('id_scheme', $scheme->id_scheme)->where('value', 1)->count();
                    $scheme->dislikes = Rating::where('id_scheme', $scheme->id_scheme)->where('value', -1)->count();

                    $scheme->liked = false;
                    $scheme->disliked = false;

                    if (Rating::where('id_scheme', $scheme->id_scheme)->where('value', 1)->where('id_user', Auth::user()->id)->exists())
                        $scheme->liked = true;
                    elseif (Rating::where('id_scheme', $scheme->id_scheme)->where('value', -1)->where('id_user', Auth::user()->id)->exists())
                        $scheme->disliked = true;
                }
            }
        }


        $dataListUsers=User::pluck('name');
        $alerts['type']=session()->pull('type',null);
        $alerts['message']=session()->pull('message',null);

        return view('AllSchemes',['categories'=>$categories,'dataListUsers'=>$dataListUsers,'schemes'=>$schemes,'alerts'=>$alerts,'request'=>$request]);
    }
}
