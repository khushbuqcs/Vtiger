<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginApiTest extends TestCase
{
    use RefreshDatabase;

    protected $token;

    protected function setUp(): void
    {
        parent::setUp();

        // Perform login and get the token
        $response = $this->postJson('/api/vtiger/v1/login', [
            'username' => 'admin',
            'password' => 'securePassword@123!',
        ]);

        $response->assertStatus(201); // Ensure login is successful

        $this->token = $response['data']['token'] ?? null; // Store token

        $this->assertNotNull($this->token, 'Token was not received.');
    }

    public function test_it_requires_username_and_password_for_login()
    {
        $response = $this->postJson('/api/vtiger/v1/login', []);

        $response->assertStatus(400)
                 ->assertJson([
                     'success' => false,
                     'message' => 'Operation is required.',
                 ]);
    }

    public function test_it_fails_login_with_invalid_credentials()
    {
        $response = $this->postJson('/api/vtiger/v1/login', [
            'username' => 'invalidUser',
            'password' => 'wrongPassword@123!',
        ]);

        $response->assertStatus(400)
                 ->assertJson([
                     'success' => false,
                     'message' => 'Invalid username or password',
                 ]);
    }

    public function test_it_logs_in_successfully_with_correct_credentials()
    {
        $response = $this->postJson('/api/vtiger/v1/login', [
            'username' => 'admin',
            'password' => 'securePassword@123!',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'data' => ['token'],
                 ]);
    }

    public function test_authenticated_endpoint_requires_token()
    {
        $response = $this->getJson('/api/vtiger/v1/protected-endpoint'); // Example protected route

        $response->assertStatus(401)
                 ->assertJson([
                     'success' => false,
                     'message' => 'Token missing',
                 ]);
    }

    public function test_authenticated_request_with_valid_token()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/vtiger/v1/protected-endpoint'); // Example protected route

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Access granted!',
                 ]);
    }
}
