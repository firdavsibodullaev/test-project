<?php

namespace Tests\Feature;

use App\Enums\CacheKeys;
use App\Models\User;
use App\Traits\Auth;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Tests\TestCase;

class TokenGenerateTest extends TestCase
{
    use Auth;

    public function test_success_attempt_user()
    {
        $user = User::factory()->create();
        $attempt = $this->attempt([
            'username' => $user->username,
            'password' => 'password'
        ]);
        $this->assertTrue($attempt);
        $this->assertTrue(auth()->check());
        $this->assertEquals($user->id, auth()->id());
    }

    public function test_fail_attempt_user()
    {
        $user = User::factory()->create();
        $attempt = $this->attempt([
            'username' => $user->username,
            'password' => 'wrong_password'
        ]);
        $this->assertFalse($attempt);
        $this->assertFalse(auth()->check());
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function test_success_generate_token()
    {
        $user = User::factory()->create();

        $this->attempt([
            'username' => $user->username,
            'password' => 'password'
        ]);

        $token = $this->generateToken();

        list($id, $encrypt_string) = explode("|", $token);
        $decrypt = Crypt::decrypt($encrypt_string);

        $this->assertEquals(
            sprintf("%d|%s", $id, $decrypt),
            cache()->get(CacheKeys::TOKEN->getKeys($id))
        );
    }
}
