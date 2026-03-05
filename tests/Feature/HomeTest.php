<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}