<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Violation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_dashboard(): void
    {
        $this->get(route('home'))->assertRedirect(route('login'));
    }

    public function test_user_can_access_dashboard(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('home'))
            ->assertOk();
    }

    public function test_dashboard_shows_only_own_violations_for_regular_user(): void
    {
        $user  = User::factory()->create();
        $other = User::factory()->create();

        $ownViolation   = Violation::factory()->create(['user_id' => $user->id, 'number' => 'А001АА77']);
        $otherViolation = Violation::factory()->create(['user_id' => $other->id, 'number' => 'Б002ББ99']);

        $this->actingAs($user)
            ->get(route('home'))
            ->assertSee('А001АА77')
            ->assertDontSee('Б002ББ99');
    }

    public function test_dashboard_shows_all_violations_for_admin(): void
    {
        $admin = User::factory()->admin()->create();
        $user  = User::factory()->create();

        $v1 = Violation::factory()->create(['user_id' => $admin->id, 'number' => 'А001АА77']);
        $v2 = Violation::factory()->create(['user_id' => $user->id,  'number' => 'Б002ББ99']);

        $this->actingAs($admin)
            ->get(route('home'))
            ->assertSee('А001АА77')
            ->assertSee('Б002ББ99');
    }

    // --- User profile ---

    public function test_guest_cannot_access_user_info(): void
    {
        $this->get(route('user.info'))->assertRedirect(route('login'));
    }

    public function test_user_can_access_profile_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('user.info'))
            ->assertOk()
            ->assertSee($user->name);
    }

    public function test_user_can_update_profile(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->patch(route('user.info.save'), [
            'name'         => 'newlogin',
            'email'        => 'new@example.com',
            'phone_number' => '+79009998877',
            'firstname'    => 'Алексей',
            'middlename'   => 'Петрович',
            'lastname'     => 'Смирнов',
        ])->assertRedirect(route('user.info'));

        $this->assertDatabaseHas('users', [
            'id'    => $user->id,
            'name'  => 'newlogin',
            'email' => 'new@example.com',
        ]);
    }

    public function test_user_can_change_password(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->patch(route('user.info.save'), [
            'name'                  => $user->name,
            'email'                 => $user->email,
            'phone_number'          => $user->phone_number,
            'firstname'             => $user->firstname,
            'middlename'            => $user->middlename,
            'lastname'              => $user->lastname,
            'password'              => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ])->assertRedirect(route('user.info'));

        $updatedUser = $user->fresh();
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('newpassword123', $updatedUser->password));
    }

    public function test_profile_update_validates_email_uniqueness(): void
    {
        $user  = User::factory()->create();
        $other = User::factory()->create(['email' => 'taken@example.com']);

        $this->actingAs($user)->patch(route('user.info.save'), [
            'name'         => $user->name,
            'email'        => 'taken@example.com',
            'phone_number' => $user->phone_number,
            'firstname'    => $user->firstname,
            'middlename'   => $user->middlename,
            'lastname'     => $user->lastname,
        ])->assertSessionHasErrors('email');
    }

    public function test_profile_update_allows_same_email(): void
    {
        $user = User::factory()->create(['email' => 'same@example.com']);

        $this->actingAs($user)->patch(route('user.info.save'), [
            'name'         => $user->name,
            'email'        => 'same@example.com',
            'phone_number' => $user->phone_number,
            'firstname'    => $user->firstname,
            'middlename'   => $user->middlename,
            'lastname'     => $user->lastname,
        ])->assertRedirect(route('user.info'));
    }

    public function test_guest_cannot_update_profile(): void
    {
        $this->patch(route('user.info.save'), [
            'name'  => 'hacker',
            'email' => 'hack@example.com',
        ])->assertRedirect(route('login'));
    }
}
