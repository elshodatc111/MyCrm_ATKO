<?php

namespace App\Http\Controllers;
use App\Models\Cours;
use App\Models\Online;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class OnlineController extends Controller{
    public function index(){
       $Cours = Cours::get();
       $response = array();
       foreach ($Cours as $key => $value) {
            $response[$key]['id'] = $value->id;
            $response[$key]['cours_name'] = $value->cours_name;
            $Online = Online::where('cours_id',$value->id)->first();
            if($Online){
                $response[$key]['cours_name_api'] = $Online->cours_id_api_name;
            }else{
                $response[$key]['cours_name_api'] = "Online kurs tanlanmagan";
            }
       }
        return view('SuperAdmin.online.index',compact('response'));
    }

    public function update($id){
        $Cours = Cours::find($id);

        $response = json_decode(Http::get('https://atko.uz/api/cours')->body());
        
        return view('SuperAdmin.online.update',compact('Cours','response'));
    }

    public function update_story(Request $reques, $id){
        $response = json_decode(Http::get('https://atko.uz/api/cours')->body());
        $cours_name_api = "";
        $cours_id = $reques->cours_id;
        $cours_id_api = $reques->cours_id_api;
        foreach ($response as $key => $value) {
            if($reques->cours_id_api==$value->cours_id){
                $cours_name_api = $value->cours_name;
            }
        }
        $validated = $reques->validate([
            'cours_id' => 'required',
            'cours_id_api' => 'required',
        ]);
        $validated['cours_id_api_name'] = $cours_name_api;
        $validated['meneger'] = Auth::user()->name;
        $Online = Online::where('cours_id',$cours_id)->first();
        if($Online!=null){
            $Online->update($validated);
        }else{
            Online::create($validated);
        }
        return redirect()->route('online')->with('success', 'Kurs taxrirlandi'); 
    }
}
