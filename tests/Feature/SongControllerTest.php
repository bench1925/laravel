<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Song;

class SongControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->followingRedirects()->get('/');
        $response->assertStatus(200);
    }

    public function test_the_application_returns_a_successful_response_without_middleware(): void
    {
        $this->withoutMiddleware([\App\Http\Middleware\Authenticate::class]);

        $response = $this->get('/');
        $response->assertStatus(200);
    }
}