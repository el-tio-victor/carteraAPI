<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cartera;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
  public function register( Request $request){
    
    /*Validacion*/
    $valInfo = $request->validate([
      'name' 	=> 'required|max:55',
      'email'	=> 'email|required|unique:users',
      'password'=> 'required'
    ]);
    $valInfo['password'] = Hash::make($request->password);

    /*Si todo esta correcto*/
    $user 	= User::create($valInfo);
    $accessToken= $user->createToken('authToken')->accessToken;

    return response(['user'=> $user,'access_token'=>$accessToken],201); 
  }

  public function login(Request $request){
    //dd($request);
    $infoVal = $request->validate([
      'email' 	=> 'email|required',
      'password'=> 'required'
    ]);

   if(!auth()->attempt($infoVal)){
     return response()->json(['message' =>'Credenciales no válidas.'],401);
      //return response()->json(['ol'=> '09as'],400);
    }

   $accessToken = auth()->user()->createToken('authToken')->accessToken;

    //Retorno el usuario junto a su cartera y transacciones
    $user = auth()->user();
    $cartera = Cartera::where('user_id',$user->id)->first();
    
    //Valido exista una relacion con cartera
    if($cartera){
      $cartera->transacciones =\App\Models\Transaccion::where('cartera_id',$cartera->id)
	      ->orderBy('created_at','desc')
	      ->get();
    }else{
      $cartera = [];
    }

    $user->cartera = $cartera;

    return response(['user'=> $user,'access_token'=> $accessToken]);

   // return response(['ola'=> $auth()->user()],200);
  }
}
