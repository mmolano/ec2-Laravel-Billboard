<?php

namespace Tests\Feature;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testLoginFormIsDisplayed()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200)
            ->assertViewIs('login.form');
    }

    /** @test */
    public function testSuccessfulLogin()
    {
        $user = UserFactory::new()->create([
            'user_name' => 'testuser',
            'password' => 'testing',
        ]);

        $response = $this->post(route('login.submit'), [
            'user_name' => 'testuser',
            'password' => 'testing',
            '_token' => csrf_token()
        ]);

        $response->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function testFailedLogin()
    {
        $response = $this->post(route('login.submit'), [
            'user_name' => 'incorrectuser',
            'password' => 'incorrectpassword',
        ]);

        $response->assertRedirect(route('login'))
            ->assertSessionHasErrors(['login' => 'ログイン情報が間違っています。']);
    }
}

