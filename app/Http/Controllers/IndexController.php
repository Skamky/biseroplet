<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }
    public function createNewScheme()
    {
        return view('start');
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

        return view('myHome',["w"=>$w,"h"=>$h,"color"=>$color]);
    }
}
