<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;

    protected $fillable = ['cartera_id','transaccion_monto','descripcion'];

    /*Relación inversa con cartera*/
    public function cartera(){
    return   $this->belongsTo('App\Models\Cartera');	
    }
}
