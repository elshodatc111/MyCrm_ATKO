<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Models\Guruh;
use App\Models\Room;
use App\Models\Tulov;
use App\Models\GuruhTime;
use App\Models\GuruhUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller{
    public function guruh(){
        $userData = auth()->user();
        $id = $userData->id;
        $GuruhUser = GuruhUser::where('user_id',$id)->where('status','true')->get();
        $Guruh = array();
        foreach ($GuruhUser as $key => $value) {
            $Guruh[$key]['guruh_id'] = $value->guruh_id;
            $Guruh[$key]['guruh_name'] = Guruh::find($value->guruh_id)->guruh_name;
            $Guruh[$key]['guruh_price'] = Guruh::find($value->guruh_id)->guruh_price;
            $RoomID = Guruh::find($value->guruh_id)->room_id;
            $Guruh[$key]['room'] = Room::find($RoomID)->room_name;
            $GuruhTime = array();
            foreach (GuruhTime::where('guruh_id',$value->guruh_id)->get() as $key2 => $value2) {
                $GuruhTime[$key2]['data'] = $value2['dates'];
            }
            $Guruh[$key]['guruh_start'] = Guruh::find($value->guruh_id)->guruh_start;
            $Guruh[$key]['guruh_end'] = Guruh::find($value->guruh_id)->guruh_end;
            $Guruh[$key]['dars_kunlari'] = $GuruhTime;
        }
        return response()->json([
            'id' => $userData->id,
            "status" => true,
            'data' =>$Guruh,
            "message" => "Barcha guruhlari",
        ], 200);
    }
    public function guruhshow(Request $id){
        $userData = auth()->user();
        $Guruh = array();
        $Guruh = Guruh::find($id);
        return response()->json([
            "status" => true,
            "message" => "Guruh haqida",
            'Guruh' =>$Guruh,
            'id' => $userData->id,
        ], 200);
    }
    public function tulovlar(){
        $userData = auth()->user();
        $Tulov = Tulov::where('user_id',$userData->id)->get();
        $Tulovlar = array();
        foreach ($Tulov as $key => $value) {
            $Tulovlar[$key]['id'] = $value->id;
            $Tulovlar[$key]['user_id'] = $value->user_id;
            $Tulovlar[$key]['summa'] = $value->summa;
            $Tulovlar[$key]['type'] = $value->type;
            $Tulovlar[$key]['status'] = $value->status;
            $Tulovlar[$key]['created_at'] = $value->created_at;
        }
        return response()->json([
            "status" => true,
            'data' =>$Tulovlar,
            "message" => "Barcha to'lovlar",
        ], 200);
    }

}
