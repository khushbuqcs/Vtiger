<?php

namespace App\Services;

use App\Traits\VtigerRequestTrait;
use Illuminate\Support\Facades\Log;

class CommentService 
{
    use VtigerRequestTrait;

    public function __construct()
    {
        $this->initializeVtigerRequestTrait(); 
    }

    public function handleListComment(array $validatedData, ?string $sessionId): array
    {
        Log::info("Using Vtiger Session ID: $sessionId");

        $requestData = [
            '_operation' => 'listRecordComment',
            'record' => $validatedData['record'],
        ];

        $response = $this->sendRequest($requestData, $sessionId);
   
        if (!isset($response['result'])) {
            return [
                'success'   => false,
                'message' => 'Invalid response format from Vtiger API',
                'status'  => 500,
            ];
        }

        return [
            'success'   => true,
            'status'  => 201,
            'data'    => $response['result'],
        ];

    }

    public function handleAddComment(array $validatedData, ?string $sessionId): array
    {
        Log::info("Using Vtiger Session ID: $sessionId");

        $requestData = [
            '_operation' => 'addRecordComment',
            'values' => $validatedData['values'],
        ];

        $response = $this->sendRequest($requestData, $sessionId);
   
        if (!isset($response['result'])) {
            return [
                'success'   => false,
                'message' => 'Invalid response format from Vtiger API',
                'status'  => 500,
            ];
        }

        return [
            'success'   => true,
            'status'  => 201,
            'data'    => $response['result'],
        ];

    }

}
