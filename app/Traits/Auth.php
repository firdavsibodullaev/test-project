<?php

namespace App\Traits;

use App\Enums\CacheKeys;
use Illuminate\Support\Facades\Crypt;

trait Auth
{
    public function attempt(array $credentials): bool
    {
        return \Illuminate\Support\Facades\Auth::attempt($credentials);
    }

    /**
     * @throws \Exception
     */
    public function generateToken(): string
    {
        $user_id = auth()->id();
        $random_string = bin2hex(random_bytes(32));

        $token = Crypt::encrypt("$user_id|$random_string");

        cache()->put(CacheKeys::TOKEN->getKeys($user_id), $token, now()->addMinutes(5));

        return $token;
    }
}
