<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProtectedRoutesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
     public function test_guest_cannot_access_dashboard()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

     public function test_guest_cannot_access_package_routes()
    {
        $response = $this->get('/packages');
        $response->assertRedirect('/login');
    }
     public function test_guest_cannot_access_resident_routes()
    {
        $response = $this->get('/resident');
        $response->assertRedirect('/login');
    }
     public function test_guest_cannot_access_notification_routes()
    {
        $response = $this->post('/notifications/mark-as-read');
        $response->assertRedirect('/login');
    }
     public function test_guest_cannot_access_upload_image_routes()
    {
        $response = $this->post('/upload-image');
        $response->assertRedirect('/login');
    }
     public function test_guest_cannot_access_newspaper_routes()
    {
        $response = $this->get('/newspaper');
        $response->assertRedirect('/login');
    }
     public function test_guest_cannot_lang_switch_routes()
    {
        $response = $this->get('/lang/en');
        $response->assertRedirect('/login');

        $response = $this->get('/lang/ar');
        $response->assertRedirect('/login');
    }
}
