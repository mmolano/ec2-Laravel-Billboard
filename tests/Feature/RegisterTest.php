<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;


class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testRegisterUserView()
    {
        $response = $this->get(route('register'));

        $response->assertViewIs('register.form')
            ->assertStatus(200);
    }

    /** @test */
    public function testRegisterUserWithValidationErrors()
    {
        $userData = [
            'user_name' => 'testuser',
            'password' => 'short',
            'email' => 'invalid-email',
            'name' => '',
        ];

        $response = $this->post(route('register.submit'), $userData);

        $response->assertRedirect(route('register'))
            ->assertSessionHasErrors(['password', 'email', 'name']);
    }

    /** @test */
    public function testRegisterUserWithSameUserName()
    {
        User::factory()->create(['user_name' => 'testuser']);

        $userData = [
            'user_name' => 'testuser',
            'password' => 'password123',
            'email' => 'testuser@example.com',
            'name' => 'Test User',
        ];

        $response = $this->post(route('register.submit'), $userData);

        $response->assertRedirect(route('register'))
            ->assertSessionHasErrors(['user_name']);
    }
}

