<?php

namespace App\Services;

use App\Traits\VtigerRequestTrait;
use Illuminate\Support\Facades\Log;

class DescribeService 
{
    use VtigerRequestTrait;

    public function __construct()
    {
        $this->initializeVtigerRequestTrait(); 
    }

    public function handleDescribe(array $validatedData, string $sessionId): array
    {
        Log::info("Using Vtiger Session ID: $sessionId");

        $requestData = [
            '_operation' => 'describe',
            'module'     => $validatedData['module'],
        ];

        $response = $this->sendRequest($requestData, $sessionId);

        if (!isset($response['result'])) {
            return [
                'success' => false,
                'message' => 'Invalid response format from Vtiger API',
                'status'  => 500,
            ];
        }

        return [
            'success' => true,
            'status'  => 201,
            'data'    => $response['result'],
        ];
    }
}
