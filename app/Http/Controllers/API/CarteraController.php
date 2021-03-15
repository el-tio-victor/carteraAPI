<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cartera;
use Illuminate\Http\Request;
use App\Http\Resources\CarteraResource;
use Illuminate\Support\Facades\Validator;

class CarteraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {
        //
      //$cartera =  Cartera::where('user_id',auth()->user()->id);
      $cartera =  Cartera::where('user_id',20)->first()->load('user','transacciones');
      //dd($cartera);
      //return response()->json($cartera);
      return response(['cartera' => new CarteraResource($cartera)],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = $request->all();

      $valida = Validator::make($data,[
	"cartera_monto" => "required|numeric",
	"user_id" 	=> "required"
      ]);

      if($valida->fails()){
	return response(['error' => $validator->errors(), 'Validation Error']);
      }
     // $cartera = Cartera::create($valida);
    //  return ['sal' => $valida];
      $cartera = Cartera::create($data);
      
      return response(['cartera' => new CarteraResource($cartera),'meesage'=>'Cartera creada']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cartera  $cartera
     * @return \Illuminate\Http\Response
     */
    public function show(Cartera $cartera)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cartera  $cartera
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cartera $cartera)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cartera  $cartera
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cartera $cartera)
    {
        //
    }
}
