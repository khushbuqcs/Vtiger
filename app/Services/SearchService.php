<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use App\Traits\VtigerRequestTrait;
use Illuminate\Support\Facades\Log;

class SearchService 
{
    use VtigerRequestTrait;

    public function __construct()
    {
        $this->initializeVtigerRequestTrait(); 
    }

    /**
     * Handle search logic
     *
     * @param array $validatedData
     * @param string|null $sessionId
     * @return array
     */
    public function handleSearch(array $validatedData, ?string $sessionId): array
    {

        Log::info("Using Vtiger Session ID: $sessionId");

        $requestData = [
            '_operation' => 'SearchRecord',
            'module' => $validatedData['module'],
            'search_module' => $validatedData['search_module'],
            'search_value' => $validatedData['search_value'],
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
