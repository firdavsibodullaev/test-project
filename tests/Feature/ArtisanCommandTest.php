<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ArtisanCommandTest extends TestCase
{
    public function test_success_console_auth()
    {
        $this->artisan('auth:login')
            ->expectsQuestion("Enter username", "admin")
            ->expectsQuestion("Enter password", "admin")
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
