<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_page_is_accessible(): void
    {
        $this->get(route('register'))->assertOk();
    }

    public function test_login_page_is_accessible(): void
    {
        $this->get(route('login'))->assertOk();
    }

    public function test_user_can_register(): void
    {
        $this->post(route('register'), [
            'name'                  => 'testuser',
            'email'                 => 'test@example.com',
            'phone_number'          => '+79001234567',
            'firstname'             => 'Иван',
            'middlename'            => 'Иванович',
            'lastname'              => 'Иванов',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ])->assertRedirect(route('home'));

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    public function test_registration_requires_all_fields(): void
    {
        $this->post(route('register'), [])->assertSessionHasErrors([
            'name', 'email', 'phone_number', 'firstname', 'lastname', 'password',
        ]);
    }

    public function test_registration_requires_unique_email(): void
    {
        User::factory()->create(['email' => 'existing@example.com']);

        $this->post(route('register'), [
            'name'                  => 'another',
            'email'                 => 'existing@example.com',
            'phone_number'          => '+79001234567',
            'firstname'             => 'Иван',
            'middlename'            => 'Иванович',
            'lastname'              => 'Иванов',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ])->assertSessionHasErrors('email');
    }

    public function test_registration_requires_password_confirmation(): void
    {
        $this->post(route('register'), [
            'name'                  => 'testuser',
            'email'                 => 'test@example.com',
            'phone_number'          => '+79001234567',
            'firstname'             => 'Иван',
            'middlename'            => 'Иванович',
            'lastname'              => 'Иванов',
            'password'              => 'password123',
            'password_confirmation' => 'wrongpassword',
        ])->assertSessionHasErrors('password');
    }

    public function test_user_can_login(): void
    {
        $user = User::factory()->create();

        $this->post(route('login'), [
            'email'    => $user->email,
            'password' => 'password',
        ])->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_login_fails_with_wrong_password(): void
    {
        $user = User::factory()->create();

        $this->post(route('login'), [
            'email'    => $user->email,
            'password' => 'wrongpassword',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_user_can_logout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('logout'))
            ->assertRedirect('/');

        $this->assertGuest();
    }

    public function test_authenticated_user_is_redirected_from_login(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('login'))
            ->assertRedirect(route('home'));
    }

    public function test_authenticated_user_is_redirected_from_register(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('register'))
            ->assertRedirect(route('home'));
    }
}
