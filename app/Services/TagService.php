<?php

namespace App\Services;

use App\Traits\VtigerRequestTrait;
use Illuminate\Support\Facades\Log;

class TagService 
{
    use VtigerRequestTrait;

    public function __construct()
    {
        $this->initializeVtigerRequestTrait(); 
    }

    public function handleAddTag(array $validatedData, ?string $sessionId): array
    {
        Log::info("Using Vtiger Session ID: $sessionId");

        $requestData = [
            '_operation' => 'AddTag',
            'module' => $validatedData['module'],
            'recordId' => $validatedData['recordId'],
            'tagName' => $validatedData['tagName'],
            'tagType' => $validatedData['tagType'],
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

    public function handleListTag(array $validatedData, ?string $sessionId): array
    {
        Log::info("Using Vtiger Session ID: $sessionId");

        $requestData = [
            '_operation' => 'TagList',
            'module' => $validatedData['module'],
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

    public function handleAssignTag(array $validatedData, ?string $sessionId): array
    {
        Log::info("Using Vtiger Session ID: $sessionId");

        $requestData = [
            '_operation' => 'AssignTag',
            'module' => $validatedData['module'],
            'recordId' => $validatedData['recordId'],
            'selectExisting' => $validatedData['selectExisting'],
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

    public function handleAssignedTag(array $validatedData, ?string $sessionId): array
    {
        Log::info("Using Vtiger Session ID: $sessionId");

        $requestData = [
            '_operation' => 'AssignedTag',
            'module' => $validatedData['module'],
            'recordId' => $validatedData['recordId'],  
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
