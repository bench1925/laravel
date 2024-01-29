<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        // Check if the response is a redirect (HTTP status 302)
        $response->assertStatus(302);

        // Optionally, check the redirected route if needed
        // $response->assertRedirect('/login');
    }
}
