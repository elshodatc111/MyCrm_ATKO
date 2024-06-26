<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Filial;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller{
    public function login(Request $request){
        try{
            $validated = Validator::make($request->all(),[
                "email" => "required",
                "password" => "required",
            ]);
            if($validated->fails()){
                return response()->json([
                    "status" => false,
                    "message" => "Login yoki parol kiritilmgan",
                    "error" => $validated->errors(),
                ], 401);
            }

            if(!Auth::attempt($request->only(['email','password']))){
                return response()->json([
                    "status" => false,
                    "message" => "Login yoki pariol xato.",
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
            if($user->type!='User'){
                return response()->json([
                    "status" => false,
                    "message" => "Siz bizning talaba emassiz.",
                ], 401);
            }
            $token = response()->json([
                "status"=>true,
                "token" => $user->createToken("API TOKEN")->plainTextToken,
            ], 200);
            return $token;
        }catch(\Throwable $th){
            return response()->json([
                "status" => false,
                "message" => $th->getMessage(),
            ], 402);
        }
    }

    public function profel(){
        $userData = auth()->user();
        return response()->json([
            "status" => true,
            'data' =>[
                'id' => $userData->id,
                'filial'=>Filial::find($userData['filial_id'])->filial_name,
                'name'=>$userData->name,
                'phone'=>$userData->phone,
                'phone2'=>$userData->phone2,
                'tkun'=>$userData->tkun,
                'balans'=>$userData->balans,
                'email'=>$userData->email,
                'created_at'=>$userData->created_at,
                'updated_at'=>$userData->updated_at,
            ],
            "message" => "User About",
        ], 200);
    }
    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json([
            "status" => true,
            'data' => [],
            "message" => "User Log Out",
        ], 200);
    }
}
