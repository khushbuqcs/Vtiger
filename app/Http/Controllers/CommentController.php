<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\BaseController;
use Illuminate\Support\Facades\Log;

class CommentController extends BaseController
{
    private CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function listComment(Request $request) {
        try {
            // Middleware already ensures session exists
            $sessionId = $request->get('session_id');

            // Validate request data
            $validatedData = $request->validate([
                'record' => 'required',
                '_operation' => 'required|string|in:listRecordComment',
            ]);

            Log::info("List Comment Request", $validatedData);

            return $this->commentService->handleListComment($validatedData, $sessionId);
    
        } catch (\Exception $e) {
            Log::error("List Comment Error", ['exception' => $e->getMessage()]);
            return $this->sendError('Something went wrong. Please try again.', [], 500); 
        }
    }

    public function addComment(Request $request) {
        try {
           // Middleware already ensures session exists
           $sessionId = $request->get('session_id');

            // Validate request data
            $validatedData = $request->validate([
                'values' => 'required',
                '_operation' => 'required|string|in:addRecordComment',
            ]);

            Log::info("Add Comment Request", $validatedData);

            return $this->commentService->handleAddComment($validatedData, $sessionId);
    
        } catch (\Exception $e) {
            Log::error("Add Comment Error", ['exception' => $e->getMessage()]);
            return $this->sendError('Something went wrong. Please try again.', [], 500); 
        }
    }

}
