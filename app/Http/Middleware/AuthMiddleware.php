<?php

namespace App\Http\Middleware;

use App\Enums\CacheKeys;
use App\Models\User;
use Closure;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Throwable;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        try {

            $token = $request->header("Authorization");

            list($user_id, $encrypted_string) = explode("|", $token);

            $decrypted_string = $this->decryptToken($encrypted_string);

            $this->verifyToken($decrypted_string, $user_id);
            $this->loginUser($user_id);

        } catch (Throwable) {
            $this->throwAuthenticationException();
        }

        return $next($request);
    }

    /**
     * Method decrypts token
     * @param string $token
     * @return string
     */
    protected function decryptToken(string $token): string
    {
        return Crypt::decrypt($token);
    }

    /**
     * Method checks is token valid or not. If token is invalid or cache is clear, then throws an authentication exception
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws AuthenticationException
     */
    protected function verifyToken($decrypted_string, $user_id): bool
    {
        $token = cache()->get(CacheKeys::TOKEN->getKeys($user_id));
        if ($token !== "$user_id|$decrypted_string") {
            $this->throwAuthenticationException();
        }

        return true;
    }

    /**
     * Method authorizes user into server
     * @throws AuthenticationException
     */
    protected function loginUser(int $user_id)
    {
        /** @var User $user */
        $user = User::query()->find($user_id);
        if (!$user) {
            throw new AuthenticationException();
        }
        Auth::login($user);
    }

    /**
     * Method throws unauthenticated exception
     * @throws AuthenticationException
     */
    protected function throwAuthenticationException()
    {
        throw new AuthenticationException();
    }
}
