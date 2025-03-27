<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Auth\BaseController;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AuthController extends BaseController
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    
    /**
     * @OA\Post(
     *     path="/api/vtiger/v1/login",
     *     summary="User login",
     *     tags={"Login"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 required={"_operation", "username", "password"},
     *                 @OA\Property(property="_operation", type="string", example="login"),
     *                 @OA\Property(property="username", type="string", example=""),
     *                 @OA\Property(property="password", type="string", example="")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Success",
     *     )
     * )
     */

    public function login(Request $request)
    {
        try {
            $result = $this->authService->login($request);
            return $this->sendResponse($result['data'], 'Token validated successfully!', 201);
        } catch (\Exception $e) {
            $status = $e->getCode() ?: 500;
            $message = json_decode($e->getMessage(), true) ?? ['error' => $e->getMessage()];

            return response()->json([
                'success' => false,
                'message' => $message,
                'data' => []
            ], $status);
        }
    }


}
