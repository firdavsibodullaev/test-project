<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ArtisanCommandTest extends TestCase
{
    public function test_success_console_auth()
    {
        $user = User::factory()->create();
        $this->artisan('auth:login')
            ->expectsQuestion("Enter username", $user->username)
            ->expectsQuestion("Enter password", "password")
            ->expectsOutputToContain("Authorized successfully")
            ->expectsOutputToContain("Token:")
            ->assertSuccessful();

    }

    public function test_fail_console_auth()
    {
        $this->artisan('auth:login')
            ->expectsQuestion("Enter username", "wrong_username")
            ->expectsQuestion("Enter password", "wrong_password")
            ->expectsOutputToContain("Credentials not found")
            ->assertFailed();

    }
}
