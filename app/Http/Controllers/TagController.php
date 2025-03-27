<?php

namespace App\Http\Controllers;

use App\Services\TagService;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\BaseController;
use Illuminate\Support\Facades\Log;

class TagController extends BaseController
{
    private TagService $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function addTag(Request $request) {
        try {
            // Middleware already ensures session exists
            $sessionId = $request->get('session_id');

            // Validate request data
            $validatedData = $request->validate([
                'module' => 'required|string',
                'recordId' => 'required|string',
                'tagName' => 'required|string',
                'tagType' => 'required|string',
                '_operation' => 'required|string|in:AddTag',
            ]);

            Log::info("Add Tag Request", $validatedData);

            return $this->tagService->handleAddTag($validatedData, $sessionId);
    
        } catch (\Exception $e) {
            Log::error("Add Tag Error", ['exception' => $e->getMessage()]);
            return $this->sendError('Something went wrong. Please try again.', [], 500); 
        }
    }

    public function listTag(Request $request) {
        try {
            // Middleware already ensures session exists
            $sessionId = $request->get('session_id');

            // Validate request data
            $validatedData = $request->validate([
                'module' => 'required|string',
                '_operation' => 'required|string|in:TagList',
            ]);

            Log::info("List Tag Request", $validatedData);

            return $this->tagService->handleListTag($validatedData, $sessionId);
    
        } catch (\Exception $e) {
            Log::error("List Tag Error", ['exception' => $e->getMessage()]);
            return $this->sendError('Something went wrong. Please try again.', [], 500); 
        }
    }

    public function assignTag(Request $request) {
        try {
            // Middleware already ensures session exists
            $sessionId = $request->get('session_id');
            
            // Validate request data
            $validatedData = $request->validate([
                'module' => 'required|string',
                'recordId' => 'required',
                'selectExisting' => 'required|string',
                '_operation' => 'required|string|in:AssignTag',
            ]);

            Log::info("Assign Tag Request", $validatedData);

            return $this->tagService->handleAssignTag($validatedData, $sessionId);
    
        } catch (\Exception $e) {
            Log::error("Assign Tag Error", ['exception' => $e->getMessage()]);
            return $this->sendError('Something went wrong. Please try again.', [], 500); 
        }
    }

    public function assignedTag(Request $request) {
        try {
            // Middleware already ensures session exists
            $sessionId = $request->get('session_id');

            // Validate request data
            $validatedData = $request->validate([
                'module' => 'required|string',
                'recordId' => 'required',
                '_operation' => 'required|string|in:AssignedTag',
            ]);

            Log::info("Assigned Tag Request", $validatedData);

            return $this->tagService->handleAssignedTag($validatedData, $sessionId);
    
        } catch (\Exception $e) {
            Log::error("Assigned Tag Error", ['exception' => $e->getMessage()]);
            return $this->sendError('Something went wrong. Please try again.', [], 500); 
        }
    }
}
