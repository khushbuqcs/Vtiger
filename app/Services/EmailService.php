<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use App\Traits\VtigerRequestTrait;
use Illuminate\Support\Facades\Log;

class EmailService 
{
    use VtigerRequestTrait;

    public function __construct()
    {
        $this->initializeVtigerRequestTrait(); 
    }

    public function handleEmail(array $validatedData, ?string $sessionId): array
    {
        Log::info("Using Vtiger Session ID: $sessionId");

        $requestData = [
            '_operation' => 'AttachEmails',
            'subject' => $validatedData['subject'],
            'to' => $validatedData['to'],
            'record' => $validatedData['record'],
            'description' => $validatedData['description'],
            'date_start' => $validatedData['date_start'],
            'time_start' => $validatedData['time_start'],
            'flag' => $validatedData['flag'],
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

    public function handleFindEmail(array $validatedData, ?string $sessionId): array
    {
        Log::info("Using Vtiger Session ID: $sessionId");

        $requestData = [
            '_operation' => 'FindEmailRecord',
            'email' => $validatedData['email'],
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
