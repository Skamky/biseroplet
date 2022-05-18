<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Scheme;
use Illuminate\Database\Eloquent\Model;
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
        $scheme= new Scheme;
        $scheme->id_scheme=$schemeId;
        $scheme->liked=false;
        $scheme->disliked=false;

        Rating::where('id_user',Auth::user()->id)->where('id_scheme',$schemeId)->delete();

        if($value!=0){
            $mark = new Rating;
            $mark->id_user=Auth::user()->id;
            $mark->id_scheme=$schemeId;
            $mark->value=$value;
            $mark->save();

            if ($value==1)
                $scheme->liked=true;
            elseif ($value==-1)
                $scheme->disliked=true;
        }


        $scheme->likes=Rating::where('id_scheme',$schemeId)->where('value',1)->count();
        $scheme->dislikes=Rating::where('id_scheme',$schemeId)->where('value',-1)->count();



        return view('components.likeBar',['scheme'=>$scheme]);
    }
}
