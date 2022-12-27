<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersModuleTest extends TestCase
{
	use RefreshDatabase;
	/**
	 * A basic feature test example.
	 *
	 * @return void
	 */
/*	public function test_config(){
		// Crear un nuevo usuario y iniciar sesión
		$user = factory(User::class)->create();
        $this->actingAs($user);

        // Intentar acceder a la ruta protegida
		$response = $this->get('/config');
		$response->assertSuccessful();
		$response->assertStatus(200);
	}*/

	public function test_update(){
		// Crear un nuevo usuario y iniciar sesión
		$user = factory(User::class)->create();
        $this->actingAs($user);

		$response = $this->get('/user/update');
		$response->assertSuccessful();
		//$response->assertStatus(200);
		//$response->assertSee('Usuario actualizado');
	}

/*	public function test_detail(){
		$response = $this->get('/user/2');
		$response->assertStatus(200);
		$response->assertSee('Detalles de usuario 2');
	}

	public function test_avatar(){
		$response = $this->get('/user/avatar/file.jpg');
		$response->assertStatus(200);
		$response->assertSee('Avatar');
	}

	public function test_search(){
		$response = $this->get('/users/carlos');
		$response->assertStatus(200);
		$response->assertSee('Resultado de carlos');
	}*/

}
