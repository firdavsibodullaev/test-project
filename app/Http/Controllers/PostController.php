<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Service\RecordService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(private RecordService $recordService)
    {
    }

    /**
     * @return string
     */
    public function index(): string
    {
        $records = $this->recordService->fetchRecordsWithPagination();

        return view("posts.index", compact("records"))->render();
    }

    /**
     * @param Post $post
     * @return string
     */
    public function show(Post $post): string
    {
        return view('posts.show', compact('post'))->render();
    }

    /**
     * @param Post $post
     * @return string
     */
    public function edit(Post $post): string
    {
        return view('posts.edit', compact('post'))->render();
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        $this->recordService->update($post, $request->get('data', []));
        return to_route('show', $post->id);
    }

    /**
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->recordService->delete($post);

        return to_route('index');
    }
}
