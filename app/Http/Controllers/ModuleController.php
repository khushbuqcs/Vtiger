<?php

namespace App\Http\Controllers;

use App\Services\ModuleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\BaseController;
use Illuminate\Support\Facades\Log;

class ModuleController extends BaseController
{
    private ModuleService $moduleService;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    public function relatedModuleList(Request $request) {
        try {
            // Middleware already ensures session exists
            $sessionId = $request->get('session_id');

            // Validate request data
            $validatedData = $request->validate([
                'module' => 'required|string',
                'record' => 'required|string',
                '_operation' => 'required|string|in:relatedModuleWithList',
            ]);

            Log::info("Related Module List Request", $validatedData);

            return $this->moduleService->handleRelatedModuleList($validatedData, $sessionId);
    
        } catch (\Exception $e) {
            Log::error("Related Module List Error", ['exception' => $e->getMessage()]);
            return $this->sendError('Something went wrong. Please try again.', [], 500); 
        }
    }

    public function listModule(Request $request) {
        try {
            // Middleware already ensures session exists
            $sessionId = $request->get('session_id');

            // Validate request data
            $validatedData = $request->validate([
                'module' => 'required|string',
                '_operation' => 'required|string|in:listModuleRecords',
            ]);

            Log::info("List Module Request", $validatedData);

            return $this->moduleService->handleListModule($validatedData, $sessionId);
    
        } catch (\Exception $e) {
            Log::error("List Module Error", ['exception' => $e->getMessage()]);
            return $this->sendError('Something went wrong. Please try again.', [], 500); 
        }
    }

    public function getAllModule(Request $request) {
        try {
            // Middleware already ensures session exists
            $sessionId = $request->get('session_id');

            // Validate request data
            $validatedData = $request->validate([
                '_operation' => 'required|string|in:GetAllModules',
            ]);

            Log::info("Get All Module Request", $validatedData);

            return $this->moduleService->handleGetAllModule($validatedData, $sessionId);
    
        } catch (\Exception $e) {
            Log::error("List Module Error", ['exception' => $e->getMessage()]);
            return $this->sendError('Something went wrong. Please try again.', [], 500); 
        }
    }

    public function fetchGroupModule(Request $request) {
        try {
            // Middleware already ensures session exists
            $sessionId = $request->get('session_id');

            // Validate request data
            $validatedData = $request->validate([
                'record' => 'required|string',
                '_operation' => 'required|string|in:fetchRecordWithGrouping',
            ]);

            Log::info("Fetch Group Module Request", $validatedData);

            return $this->moduleService->handleFetchGroupModule($validatedData, $sessionId);
    
        } catch (\Exception $e) {
            Log::error("Fetch Group Module Error", ['exception' => $e->getMessage()]);
            return $this->sendError('Something went wrong. Please try again.', [], 500); 
        }
    }

    public function fetchRecord(Request $request) {
        try {
            // Middleware already ensures session exists
            $sessionId = $request->get('session_id');

            // Validate request data
            $validatedData = $request->validate([
                'record' => 'required|string',
                '_operation' => 'required|string|in:fetchRecord',
            ]);

            Log::info("Fetch Record Request", $validatedData);

            return $this->moduleService->handleFetchRecord($validatedData, $sessionId);
    
        } catch (\Exception $e) {
            Log::error("Fetch Record Error", ['exception' => $e->getMessage()]);
            return $this->sendError('Something went wrong. Please try again.', [], 500); 
        }
    }

    public function saveRecord(Request $request) {
        try {
            // Middleware already ensures session exists
            $sessionId = $request->get('session_id');

            // Validate request data
            $validatedData = $request->validate([
                'module' => 'required|string',
                'record' => 'required|string',
                'values' => 'required',
                '_operation' => 'required|string|in:saveRecord',
            ]);

            Log::info("Save Record Module Request", $validatedData);

            return $this->moduleService->handleSaveRecord($validatedData, $sessionId);
    
        } catch (\Exception $e) {
            Log::error("Save Record Module Error", ['exception' => $e->getMessage()]);
            return $this->sendError('Something went wrong. Please try again.', [], 500); 
        }
    }
}
