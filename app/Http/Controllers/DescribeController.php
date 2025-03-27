<?php

namespace App\Http\Controllers;

use App\Services\DescribeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\BaseController;
use Illuminate\Support\Facades\Log;

class DescribeController extends BaseController
{
    private DescribeService $describeService;

    public function __construct(DescribeService $describeService)
    {
        $this->describeService = $describeService;
    }

    public function describe(Request $request) {
        try {
            // Middleware already ensures session exists
            $sessionId = $request->get('session_id');

            // Validate request data
            $validatedData = $request->validate([
                'module'      => 'required|string',
                '_operation'  => 'required|string|in:describe',
            ]);

            Log::info("Describe Request", $validatedData);

            return $this->describeService->handleDescribe($validatedData, $sessionId);
    
        } catch (\Exception $e) {
            Log::error("Describe Error", ['exception' => $e->getMessage()]);
            return $this->sendError('Something went wrong. Please try again.', [], 500); 
        }
    }
}
