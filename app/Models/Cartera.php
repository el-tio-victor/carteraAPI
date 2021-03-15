<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartera extends Model
{
    use HasFactory;

    protected $fillable = [
      "cartera_monto","user_id"
    ];

    /*
     * Relacion con usuario
    */
    public function user(){
      return $this->belongsTo('App\Models\User');
    }

    public function transacciones(){
      return $this->hasMany('App\Models\Transaccion');
    }
}
