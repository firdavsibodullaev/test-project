<?php

namespace App\Enums;

enum CacheKeys
{
    case TOKEN;

    public function getKeys($key): string
    {
        return "$this->name-$key";
    }
}
