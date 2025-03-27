<?php

namespace App\Services;

use App\Traits\VtigerRequestTrait;
use Illuminate\Support\Facades\Log;

class ModuleService 
{
    use VtigerRequestTrait;

    public function __construct()
    {
        $this->initializeVtigerRequestTrait(); 
    }

    public function handleRelatedModuleList(array $validatedData, ?string $sessionId): array
    {
        
        Log::info("Using Vtiger Session ID: $sessionId");

        $requestData = [
            '_operation' => 'relatedModuleWithList',
            'module' => $validatedData['module'],
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

    public function handleListModule(array $validatedData, ?string $sessionId): array
    {
        Log::info("Using Vtiger Session ID: $sessionId");

        $requestData = [
            '_operation' => 'listModuleRecords',
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

    public function handleGetAllModule(array $validatedData, ?string $sessionId): array
    {
        Log::info("Using Vtiger Session ID: $sessionId");

        $requestData = [
            '_operation' => 'GetAllModules',
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

    public function handleFetchGroupModule(array $validatedData, ?string $sessionId): array
    {
        Log::info("Using Vtiger Session ID: $sessionId");

        $requestData = [
            'record' => $validatedData['record'],
            '_operation' => 'fetchRecordWithGrouping',
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

    public function handleFetchRecord(array $validatedData, ?string $sessionId): array
    {
        Log::info("Using Vtiger Session ID: $sessionId");

        $requestData = [
            'record' => $validatedData['record'],
            '_operation' => 'fetchRecord',
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

    public function handleSaveRecord(array $validatedData, ?string $sessionId): array
    {
        Log::info("Using Vtiger Session ID: $sessionId");

        $requestData = [
            'module' => $validatedData['module'],
            'record' => $validatedData['record'],
            'values' => $validatedData['values'],
            '_operation' => 'saveRecord',
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
