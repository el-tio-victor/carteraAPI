<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CarteraResource;

class TransaccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
      $data = $request->all();

      $valida = Validator::make($data,[
	"transaccion_monto" 	=> "required|numeric",
	"descripcion" 		=> "required|min:3|string",
	"cartera_id" 		=> "required|numeric"	
      ]); 

      if($valida->fails()){
	return response(['errors'=>$valida->errors(), 'Error validación datos']);
      }

     Transaccion::create($data);
      //dd($data);
      $cartera = \App\Models\Cartera::find($data['cartera_id']);
      $transacciones	= Transaccion::where('cartera_id',$data['cartera_id'])->orderBy('created_at','desc')->get(); 
      //dd($transacciones);
      //$t2 = \App\Models\Cartera::where('id',5)->first()->transacciones();
 //     $t2 = \App\Models\Transaccion::where('id',3)->first()->cartera;
//      dd($t2);
      //dd($transacciones);

      return response(
	['transacciones' => new CarteraResource($transacciones),
	'cartera' => new CarteraResource($cartera),
	'message' => 'Transacción Creada']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
      $transaccion = Transaccion::findOrFail($id);
      $cartera_id = $transaccion->cartera_id;
      $transaccion->delete();
      $cartera = \App\Models\Cartera::find($cartera_id);
      $transacciones = Transaccion::where('cartera_id',$cartera_id)->orderBy('created_at','desc')->get();

      return response(['transacciones'=>$transacciones,'cartera'=>$cartera,'message' => 'modelo eliminado']);

    }
}
