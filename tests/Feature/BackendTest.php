<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class BackendTest extends TestCase
{
    public function test_success_get_records_list()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/');

        $response->assertOk();
    }

    public function test_fail_get_records_list_without_authorization()
    {
        $response = $this->get('/');

        $response->assertRedirect();
    }

}
