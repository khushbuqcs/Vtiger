<?php

namespace App\Http\Controllers;

use App\Services\EmailService;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\BaseController;
use Illuminate\Support\Facades\Log;

class EmailController extends BaseController
{
    private EmailService $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function emailAttachment(Request $request) {
        try {
            // Middleware already ensures session exists
            $sessionId = $request->get('session_id');

            // Validate request data
            $validatedData = $request->validate([
                'subject' => 'required|string',
                'to' => 'required|string|email',
                'record' => 'required|string',
                'description' => 'required|string',
                'date_start' => 'required|date_format:d-m-Y',
                'time_start' => 'required|date_format:H:i:s',
                'flag' => 'required|string',
                '_operation' => 'required|string|in:AttachEmails',
            ]);

            Log::info("Attach Email Request", $validatedData);

            // Call service to handle email attachment logic
            return $this->emailService->handleEmail($validatedData, $sessionId);
    
        } catch (\Exception $e) {
            Log::error("Attach Email Error", ['exception' => $e->getMessage()]);
            return $this->sendError('Something went wrong. Please try again.', [], 500); 
        }
    }

    public function findEmail(Request $request) {
        try {
            // Middleware already ensures session exists
            $sessionId = $request->get('session_id');
            
            // Validate request data
            $validatedData = $request->validate([
                'email' => 'required|string|email',
                '_operation' => 'required|string|in:FindEmailRecord',
            ]);

            Log::info("Find Email Request", $validatedData);

            // Call service to handle email attachment logic
            return $this->emailService->handleFindEmail($validatedData, $sessionId);
    
        } catch (\Exception $e) {
            Log::error("Find Email Error", ['exception' => $e->getMessage()]);
            return $this->sendError('Something went wrong. Please try again.', [], 500); 
        }
    }
}
