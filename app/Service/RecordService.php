<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class RecordService
{

    /**
     * @return LengthAwarePaginator
     */
    public function fetchRecordsWithPagination(): LengthAwarePaginator
    {
        return Post::query()->orderByDesc("id")->paginate();
    }

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

    /**
     * @param Post $post
     * @param array $payload
     * @return bool
     */
    public function update(Post $post, array $payload): bool
    {
        $data = $this->prepareData($payload);
        return $post->update(compact("data"));
    }

    /**
     * @param $payload
     * @return array
     */
    protected function prepareData($payload): array
    {
        $data = [];

        if (is_array($payload) && empty($payload)) {
            return $data;
        }

        $keys = $payload['key'];

        foreach ($keys as $old_key_name => $new_key_name) {
            $item = Arr::get($payload, $old_key_name, []);

            $data[$new_key_name] = is_array($item)
                ? $this->prepareData($item)
                : (is_numeric($item) ? $item + 0 : $item);
        }
        return $data;
    }

    /**
     * @param Post $post
     * @return bool|null
     */
    public function delete(Post $post): ?bool
    {
        return $post->delete();
    }
}
