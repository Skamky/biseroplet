<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
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

    public function index()
    {
        echo "Hello, World!";
    }
    public function rateSchema($schemeId,$value)
    {
        $otvet=Auth::user()->name;;
        //$otvet+= Auth::user()->name;
        echo  $otvet;
    }
}
