<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PostService
{
    /**
     * @param array $payload
     * @return Model|Builder
     */
    public function create(array $payload): Model|Builder
    {
        return Post::query()->create([
            "data" => $payload
        ]);
    }
}
