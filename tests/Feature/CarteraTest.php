<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarteraTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCartera(){
      //\App\Models\Transaccion::factory()->times(2)->create();

        $response = $this->json('GET','/api/cartera');
	//$response->dump();

      $response->assertStatus(200)
	       ->assertJsonStructure([
		 'cartera' =>[
		    'id','cartera_monto','user_id',
		    'created_at','updated_at',
		    'user' =>[
		      'id','name','email' 
		    ],
		    'transacciones'=>[
		      '*' => [
			'id','transaccion_monto'
		      ]
		    ]		    
		 ], 
	       ]);
    }
}
