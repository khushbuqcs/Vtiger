<?php

namespace App\Http\Controllers;

use App\Services\HistoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\BaseController;
use Illuminate\Support\Facades\Log;

class HistoryController extends BaseController
{
    private HistoryService $historyService;

    public function __construct(HistoryService $historyService)
    {
        $this->historyService = $historyService;
    }

    public function history(Request $request) {
        try {
            // Middleware already ensures session exists
            $sessionId = $request->get('session_id');

            // Validate request data
            $validatedData = $request->validate([
                '_operation' => 'required|string|in:history',
                'index' => 'required',
                'module' => 'required',
                'size' => 'required',
                'mode' => 'required',
                'record' => 'required',
            ]);

            Log::info("History Request", $validatedData);

            return $this->historyService->handleHistory($validatedData, $sessionId);
    
        } catch (\Exception $e) {
            Log::error("History Error", ['exception' => $e->getMessage()]);
            return $this->sendError('Something went wrong. Please try again.', [], 500); 
        }
    }

}
