<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class RegistrationControllerTest extends TestCase
{
   use RefreshDatabase;
   
    public function test_registration_successful(): void
    {
        $response = $this->get('register');

        $response->assertStatus(200);
        $response->assertViewIs('auth.register');

        $email = fake()->unique()->safeEmail();
        $user = User::factory()->create(
        [
          'name'=>'abc',
          'email'=>$email,
          'password' => 'password',
        

        ]);
        // $response->assertStatus(201);

        $response = $this->actingAs( $user )->get('/dashboard');
        $this->assertAuthenticated();

        // $this->assertDatabaseHas('users', ['email' => $email]);
        // $response->assertRedirect('dashboard');
    }

    public function test_un_authorized_access_test(): void
    {
                $response = $this->get('dashboard');
                $response->assertStatus(302);
                $response->assertRedirect('login');
    }
}
