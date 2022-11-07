<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Service\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(private PostService $postService)
    {
    }

    /**
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request): JsonResponse
    {
        $post = $this->postService->create($request->all());
        return response()->json([
            "id" => $post->id,
            "lifetime" => round((microtime(true) - LARAVEL_START) * 1000, 2) . " ms",
            "memory" => round(memory_get_usage() / 1024 / 1024, 2) . " MB"
        ]);
    }
}
