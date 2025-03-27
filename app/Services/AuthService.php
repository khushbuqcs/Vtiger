<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthService 
{
    protected AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(Request $request): array
    {
        try {
            $token = $request->header('Authorization');
            if (!$token) {
                throw new \Exception('Token missing', 400);
            }

            Log::info('Validating token...');
            $userData = $this->authRepository->validateToken($token);

            if (isset($userData['error'])) {
                throw new \Exception($userData['message'], $userData['status']);
            }

            Log::info("Token validated successfully", ['user' => $userData]);

            $recordData = $request->all();
            if (empty($recordData['_operation'])) {
                throw new \Exception('Operation is required.', 400);
            }

            Log::info('Sending request to Vtiger API', ['request' => $recordData]);
            $response = $this->authRepository->authenticateVtiger($recordData);

            if (!$response || !isset($response['result']['login']['session'])) {
                throw new \Exception('Invalid response format', 500);
            }

            return ['data' => $response['result']];

        } catch (\Exception $e) {
            Log::error("Login Error", ['exception' => $e->getMessage()]);
            throw $e; // Ensure the exception message is returned
        }
    }

}
