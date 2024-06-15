<?php

namespace App\Http\Controllers\User;
use App\Models\User;
use App\Models\Guruh;
use App\Models\Online;
use App\Models\GuruhUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OnlineCoursController extends Controller{
    public function index(){
        $GuruhUser = GuruhUser::where('user_id',Auth::user()->id)->where('status','true')->get();
        $Guruhlar = array();
        foreach ($GuruhUser as $key => $value) {
            $Guruh = Guruh::find($value->guruh_id);
            if(date('Y-m-d')>=$Guruh->guruh_start){
                $Online = Online::where('cours_id',$Guruh->cours_id)->first();
                if($Online!=null){
                    $Guruhlar[$key]['cours_id'] = $Online->cours_id_api;
                    $Guruhlar[$key]['cours_name'] = $Online->cours_id_api_name;
                }
            }
        }
        return view('User.online.index',compact('Guruhlar'));
    }
    public function show($id){
        $response = Http::post('https://atko.uz/api/mavzu', [
            'cours_id' => $id,
        ]);
        $json = $response->json();
        $Cours = $json['cours'];
        $Mavzular = $json['mavzular'];
        return view('User.online.show',compact('Cours','Mavzular'));
    }
    public function lessen($id){
        $response = Http::post('https://atko.uz/api/mavzus', [
            'mavzu_id' => $id,
        ]);
        $json = $response->json();
        $Mavzu = $json['mavzu'];
        //dd($Mavzu['mavzu_name']);
        $CoursID = $json['mavzu']['cours_id'];
        $response2 = Http::post('https://atko.uz/api/mavzu', [
            'cours_id' => $CoursID,
        ]);
        $json2 = $response2->json();
        $Cours = $json2['cours'];
        $Mavzular = $json2['mavzular'];
        return view('User.online.lessen',compact('Mavzu','Cours','Mavzular'));
    }
}
