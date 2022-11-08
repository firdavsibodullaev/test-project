<?php

namespace Tests\Feature;

use App\Models\User;
use App\Traits\Auth;
use Tests\TestCase;
use Throwable;

class FrontEndTest extends TestCase
{
    use Auth;

    public function test_success_send_json_data_get_method()
    {
        define('LARAVEL_START', microtime(true));

        $user = User::factory()->create();
        $this->attempt([
            "username" => $user->username,
            "password" => "password"
        ]);
        $token = $this->generateToken();

        $data = [
            "some" => "data",
            "array" => [
                "foo" => "bar",
                "null" => null,
                "empty" => []
            ],
            "integer" => 12
        ];

        $response = $this->get("/api/post?" . http_build_query($data), [
            "Accept" => "application/json",
            "Authorization" => $token
        ]);

        $response->assertCreated();

        $data = $response->decodeResponseJson();
        $this->assertArrayHasKey("id", $data);
        $this->assertArrayHasKey("lifetime", $data);
        $this->assertArrayHasKey("memory", $data);
    }

    public function test_success_send_json_data_post_method()
    {
        $user = User::factory()->create();
        $this->attempt([
            "username" => $user->username,
            "password" => "password"
        ]);
        $token = $this->generateToken();

        $data = [
            "some" => "data",
            "array" => [
                "foo" => "bar",
                "null" => null
            ],
            "integer" => 12
        ];

        $response = $this->post("/api/post", $data, [
            "Accept" => "application/json",
            "Authorization" => $token
        ]);

        $response->assertCreated();

        $data = $response->decodeResponseJson();
        $this->assertArrayHasKey("id", $data);
        $this->assertArrayHasKey("lifetime", $data);
        $this->assertArrayHasKey("memory", $data);
    }

    public function test_fail_send_json_data_without_token()
    {
        $data = [
            "some" => "data",
            "array" => [
                "foo" => "bar",
                "null" => null
            ],
            "integer" => 12
        ];

        $response = $this->post("/api/post", $data, [
            "Accept" => "application/json"
        ]);

        $response->assertUnauthorized();
    }
}
