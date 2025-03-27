<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\SearchService;
use App\Http\Controllers\Auth\BaseController;

class SearchController extends BaseController
{
    private SearchService $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

     /**
     * Search Records in Vtiger
     * 
     * @OA\Get(
     *     path="/api/vtiger/v1/search",
     *     summary="Search records in Vtiger",
     *     tags={"Search"},
     *     security={{"sessionAuth":{}}},
     *     @OA\Parameter(
     *         name="_operation",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         example="SearchRecord"
     *     ),
     *     @OA\Parameter(
     *         name="module",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         example=""
     *     ),
     *     @OA\Parameter(
     *         name="search_module",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         example=""
     *     ),
     *     @OA\Parameter(
     *         name="search_value",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         example=""
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Success"
     *     )
     * )
     */

    public function search(Request $request)
    {
        try {
            // Middleware already ensures session exists
            $sessionId = $request->get('session_id');

            $validatedData = $request->validate([
                'module' => 'required|string',
                'search_module' => 'required|string',
                'search_value' => 'required|string',
                '_operation' => 'required|string|in:SearchRecord',
            ]);

            Log::info("Search Record Request", $validatedData);

            // Call the service
            return $this->searchService->handleSearch($validatedData, $sessionId);

        } catch (\Exception $e) {
            Log::error("Search Record Error", ['exception' => $e->getMessage()]);
            return $this->sendError('Something went wrong. Please try again.', [], 500); 
        }
    }
}
