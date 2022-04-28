<?php

namespace App\Http\Controllers;

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

        // $schemes->lastet();

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
        $color= strtr($color,'Z','#');

        $alerts['type']=session()->pull('type',null);
        $alerts['message']=session()->pull('message',null);

        return view('myHome',["w"=>$w,"h"=>$h,"color"=>$color,'alerts'=>$alerts]);
    }
}
