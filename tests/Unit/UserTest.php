<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Violation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_is_admin_returns_false_for_regular_user(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->assertFalse($user->isAdmin());
    }

    public function test_is_admin_returns_true_for_admin_user(): void
    {
        $user = User::factory()->admin()->create();

        $this->assertTrue($user->isAdmin());
    }

    public function test_user_has_many_violations(): void
    {
        $user = User::factory()->create();
        Violation::factory()->count(3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->violations);
        $this->assertInstanceOf(Violation::class, $user->violations->first());
    }

    public function test_password_is_hidden(): void
    {
        $user = User::factory()->make();

        $this->assertArrayNotHasKey('password', $user->toArray());
    }

    public function test_remember_token_is_hidden(): void
    {
        $user = User::factory()->make();

        $this->assertArrayNotHasKey('remember_token', $user->toArray());
    }

    public function test_is_admin_cast_to_boolean(): void
    {
        $user = User::factory()->create(['is_admin' => 1]);

        $this->assertIsBool($user->is_admin);
        $this->assertTrue($user->is_admin);
    }
}
