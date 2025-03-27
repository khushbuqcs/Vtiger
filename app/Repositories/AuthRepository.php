<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class AuthRepository
{
    private string $laravelBaseUrl;
    private string $vtigerBaseUrl;

    public function __construct()
    {
        $this->laravelBaseUrl = env('LARAVEL_API_URL', 'http://127.0.0.1:8000/api/v1/');
        $this->vtigerBaseUrl = env('VTIGER_API_URL', 'http://localhost/qcs_vtigercrm/modules/FlowDesigner/api.php');
    }

    public function validateToken(string $token)
    {
        Log::info('Validating token via Laravel API');
    
        $response = Http::withHeaders([
            'Authorization' => $token, // Ensure Bearer token format
        ])->get($this->laravelBaseUrl . 'validate-token');
    
        Log::info('Laravel API Response', ['status' => $response->status(), 'body' => $response->body()]);
    
        if ($response->failed()) {
            return [
                'error' => true,
                'message' => $response->body(), // Pass the exact message from the API response
                'status' => $response->status()
            ];
        }
    
        return $response->json();
    }
    

    public function authenticateVtiger(array $data)
    {
        $vtigerRequestData = [
            '_operation' => $data['_operation'],
            'username' => $data['username'] ?? '',
            'password' => $data['password'] ?? '',
        ];

        Log::info('Sending authentication request to Vtiger API', ['request' => $vtigerRequestData]);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($this->vtigerBaseUrl, $vtigerRequestData);

        return $response->json();
    }
}
