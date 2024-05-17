<?php

namespace App\Http\Controllers;
use App\Models\Filial;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $time = date("Y-m-d");
        $login = 'elshodatc1116';
        $Setting = Setting::find(1);
        if($Setting->Status == 'false'){
            if($Setting->Username!=Auth::user()->email){
                return view('error');
            }
        }

        if(Auth::user()->type=='SuperAdmin'){
            return redirect()->route('SuperAdmin');
        }elseif(Auth::user()->type=='Admin' OR Auth::user()->type=='Operator'){
            $Filial = Filial::find(Auth::user()->filial_id);
            if(empty($Filial)){
                Auth::logout();
                return redirect()->route('home');
            }
            return redirect()->route('Admin')
                ->withCookie('filial_id', Auth::user()->filial_id, 86400)
                ->withCookie('filial_name', $Filial->filial_name, 86400);
        }elseif(Auth::user()->type=='Techer'){
            $Filial = Filial::find(Auth::user()->filial_id);
            return redirect()->route('Techer')
            ->withCookie('filial_id', Auth::user()->filial_id, 86400)
            ->withCookie('filial_name', $Filial->filial_name, 86400);
        }elseif(Auth::user()->type=='User'){
            $Filial = Filial::find(Auth::user()->filial_id);
            return redirect()->route('User')
            ->withCookie('filial_id', Auth::user()->filial_id, 86400)
            ->withCookie('filial_name', $Filial->filial_name, 86400);
        }else{
            return view('home');
        }
        
    }
}
