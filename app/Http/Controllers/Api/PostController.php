<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Service\recordService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(private recordService $recordService)
    {
    }

    /**
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request): JsonResponse
    {
        $record = $this->recordService->create($request->all());
        return response()->json([
            "id" => $record->id,
            "lifetime" => round((microtime(true) - LARAVEL_START) * 1000, 2) . " ms",
            "memory" => round(memory_get_usage() / 1024 / 1024, 2) . " MB"
        ], 201);
    }
}
