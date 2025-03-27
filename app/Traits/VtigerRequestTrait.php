<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait VtigerRequestTrait
{
    protected string $vtigerBaseUrl;

    public function initializeVtigerRequestTrait()
    {
        $this->vtigerBaseUrl = env('VTIGER_API_URL', 'http://localhost/qcs_vtigercrm/modules/FlowDesigner/api.php');

        if (!$this->vtigerBaseUrl) {
            throw new \Exception('Vtiger Base URL is not set in .env file.');
        }
    }

    protected function sendRequest(array $requestData, string $sessionId): array
    {
        Log::info('Sending Request to Vtiger API', ['request' => $requestData]);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Cookie'       => "PHPSESSID=$sessionId",
        ])->post($this->vtigerBaseUrl, $requestData);

        $data = $response->json();

        Log::info('Vtiger API Response:', ['response' => $data]);

        return $data ?? ['error' => true, 'message' => 'Invalid response from Vtiger API'];
    }
}
