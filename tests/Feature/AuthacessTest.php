<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthacessTest extends TestCase
{
    /**
     * A basic feature test example.
     */
     public function test_un_auth_protected_routes()
    {
        $protectedRoutes = [
            'GET'  => ['/dashboard', '/packages', '/resident', '/newspaper', '/lang/en', '/lang/ar'],
            'POST' => ['/notifications/mark-as-read', '/upload-image'],
        ];

        foreach ($protectedRoutes as $method => $routes) {
            foreach ($routes as $uri) {
                $response = $this->{$method}( $uri );
                $response->assertRedirect('/login', "Failed asserting $method $uri redirects to login.");
            }
        }
    }
    
    public function test_guest_cannot_access_protected_routes()
{
    $getRoutes = [
        '/dashboard',
        '/packages',
        '/resident',
        '/newspaper',
        '/lang/en',
        '/lang/ar',
    ];

    $postRoutes = [
        '/notifications/mark-as-read',
        '/upload-image',
    ];

    foreach ($getRoutes as $uri) {
        $response = $this->get($uri);
        $response->assertRedirect('/login', "GET $uri did not redirect to login.");
    }

    foreach ($postRoutes as $uri) {
        $response = $this->post($uri);
        $response->assertRedirect('/login', "POST $uri did not redirect to login.");
    }
}

}
