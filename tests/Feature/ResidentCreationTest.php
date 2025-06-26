<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Resident;
use App\Models\Package; 
use App\Models\User;
use App\Notifications\PackageAsign;
use Illuminate\Support\Facades\Notification;

class ResidentCreationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

      public function test_resident_index()
    {
        $user = User::factory()->create(); 
        $this->actingAs($user);

        $package = Package::factory()->create(); 

        $resident = Resident::factory()->create([
        'package_id' => $package->id, 
    ]);

        $response = $this->get(route('resident.index'));

        $response->assertStatus(200);
        $response->assertViewIs('resident.residentView');
        $response->assertViewHas('residents');
    }


     public function test_resident_create()
    {
        $user = User::factory()->create();
        $this->actingAs($user); 

        Package::factory()->count(2)->create();

        $response = $this->get(route('resident.create'));

        $response->assertStatus(200);
        $response->assertViewIs('resident.residentAdd');
        $response->assertViewHas('packages');
    }



     public function test_resident_notification()
    {
        $this->withoutExceptionHandling();
        Notification::fake();
        
        $users = User::factory()->count(2)->create();
        $this->actingAs($users->first());

        
        $package = Package::factory()->create();

        $data = [
            'res_name' => 'Test Resident',
            'email' => 'resident@example.com',
            'phone' => '1234567890',
            'gender' => 'male',
            'status' => 'active',
            'package_id' =>$package->id,
        ];

    // $response = $this->followingRedirects()->post(route('resident.store'), $data);
    
    $response = $this->post(route('resident.store'), $data);
        // $response->assertSessionHasNoErrors();
        // dump(session()->all()); exit;

        $this->assertDatabaseHas('residents', ['email' => 'resident@example.com']);

        foreach ($users as $user) {
        Notification::assertSentTo($user, PackageAsign::class);
    }

         $response->assertRedirect(route('resident.index'));
    
// $response = $this->withSession(['success' => false])->get('resident.index');
        // $response->assertSee('updated'); // This checks for the alert content
        // $response->assertSessionHas('success', 'updated');
    }




      public function test_resident_edit()
    {
        $user = User::factory()->create(); 
        $this->actingAs($user);

        $package = Package::factory()->create(); 

        $resident = Resident::factory()->create([
        'package_id' => $package->id, 
    ]);
 
        Package::factory()->count(2)->create();
        $response = $this->get(route('resident.edit', $resident->id));

        $response->assertStatus(200);
        $response->assertViewIs('resident.residentEdit');
        $response->assertViewHasAll(['resident', 'packages']);
    }





     public function test_resident_update()
    {
        $user = User::factory()->create(); 
        $this->actingAs($user);

        $package = Package::factory()->create(); 

        $resident = Resident::factory()->create([
        'package_id' => $package->id, 
    ]);

        $newData = [
            'res_name' => 'Updated Name',
            'email' => 'updated@example.com',
            'phone' => '9876543210',
            'gender' => 'female',
            'status' => 'inactive',
            'package_id' => $package->id
        ];

        $response = $this->put(route('resident.update', $resident->id), $newData);

        $this->assertDatabaseHas('residents', ['email' => 'updated@example.com']);
        $response->assertRedirect(route('resident.index'));
        // $response->assertSessionHas('success', 'updated');
    }




      public function test_resident_delete()
    {
        $user = User::factory()->create(); 
        $this->actingAs($user);

        $package = Package::factory()->create(); 

        $resident = Resident::factory()->create([
        'package_id' => $package->id, 
    ]);

        $response = $this->delete(route('resident.destroy', $resident->id));

        $this->assertDatabaseMissing('residents', ['id' => $resident->id]);
        $response->assertRedirect(route('resident.index'));
        // $response->assertSessionHas('success', 'deleted!');
    }
}
