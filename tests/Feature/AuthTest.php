<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
      /*$response = $this->json('POST','api/login',[
	'email'	   => 'rvid19@example.com',
	'password' => 'password'
      ]);*/


      $user = User::factory()->make();
      $response = $this->json('POST','api/register',[
	'name' 	   => $user->name,
	'password' => 'password',
	'email'    => $user->email	
      ]);

      if(!$response->assertStatus(201)){
	$response->dump();
      }

      $response->assertStatus(201)
	       ->assertJsonStructure([
		  'user' => [
		    'id', 'email'
		  ],
		  'access_token'
	       ]);
      $this->assertDatabaseHas('users',[
	'name' => $user->name,
	'email' => $user->email
      ]);

    }
}
