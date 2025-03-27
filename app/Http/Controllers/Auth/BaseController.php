<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * Send success response.
     *
     * @param mixed  $data
     * @param string $message
     * @param int    $statusCode (default: 200)
     * @return \Illuminate\Http\JsonResponse
     */

    public function sendResponse($data = [], $message = 'Success', $statusCode = 201): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ];

        return response()->json($response, $statusCode);
    }


        /**
     * Send error response.
     *
     * @param string     $errorMessage
     * @param array      $errorDetails
     * @param int        $statusCode (default: 400)
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($errorMessage, $errorDetails = [], $statusCode = 400): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $errorMessage,
        ];

        if (!empty($errorDetails)) {
            $response['errors'] = $errorDetails;
        }

        return response()->json($response, $statusCode);
    }
}
