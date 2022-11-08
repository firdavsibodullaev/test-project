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
        $token = bin2hex(random_bytes(32));

        $encrypted_string = Crypt::encrypt($token);

        cache()->put(
            CacheKeys::TOKEN->getKeys($user_id),
            sprintf("%d|%s", $user_id, $token),
            now()->addMinutes(5)
        );

        return sprintf("%d|%s", $user_id, $encrypted_string);
    }
}
