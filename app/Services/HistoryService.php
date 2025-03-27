<?php

namespace App\Services;

use App\Traits\VtigerRequestTrait;
use Illuminate\Support\Facades\Log;

class HistoryService 
{
    use VtigerRequestTrait;

    public function __construct()
    {
        $this->initializeVtigerRequestTrait(); 
    }

    public function handleHistory(array $validatedData, ?string $sessionId): array
    {
        Log::info("Using Vtiger Session ID: $sessionId");

        $requestData = [
            '_operation' => 'describe',
            'index' => $validatedData['index'],
            'module' => $validatedData['module'],
            'size' => $validatedData['size'],
            'mode' => $validatedData['mode'],
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

}
